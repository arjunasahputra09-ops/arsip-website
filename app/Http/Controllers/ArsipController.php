<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
// Impor untuk Fitur Backup
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use ZipArchive;

class ArsipController extends Controller
{
    /**
     * Menampilkan daftar semua arsip (halaman "Data Arsip").
     */
    public function index()
    {
        // ... (kode method index Anda sudah benar) ...
        $arsips = Arsip::latest()->paginate(10);
        
        return view('arsip.index', compact('arsips'));
    }

    /**
     * Menampilkan form untuk membuat arsip baru (halaman "Input Arsip").
     */
    public function create()
    {
        // ... (kode method create Anda sudah benar) ...
        return view('arsip.create');
    }

    /**
     * Menyimpan arsip baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_arsip' => 'required|string|max:255|unique:arsips,kode_arsip',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_arsip' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:102400', // 100MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('arsip_files', 'public');
        }

        Arsip::create([
            'kode_arsip' => $request->kode_arsip,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jenis_arsip' => $request->jenis_arsip,
            'tanggal' => $request->tanggal,
            'file' => $filePath,
        ]);

        // ==========================================
        // INI ADALAH PERUBAHAN KEMBALI SESUAI PERMINTAAN ANDA
        // Mengarahkan kembali ke halaman input, bukan ke halaman index
        return redirect()->back()->with('success', 'Arsip berhasil ditambahkan!');
        // ==========================================
    }

    /**
     * Menampilkan form untuk mengedit arsip.
     */
    public function edit(Arsip $arsip)
    {
        // ... (kode method edit Anda sudah benar) ...
        return view('arsip.edit', compact('arsip'));
    }

    /**
     * Memperbarui data arsip di database.
     */
    public function update(Request $request, Arsip $arsip)
    {
        // ... (kode method update Anda sudah benar) ...
        $request->validate([
            'kode_arsip' => ['required', 'string', 'max:255', Rule::unique('arsips')->ignore($arsip->id)],
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_arsip' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:102400', // 100MB
        ]);

        $filePath = $arsip->file; 

        if ($request->hasFile('file')) {
            if ($arsip->file) {
                Storage::disk('public')->delete($arsip->file);
            }
            $filePath = $request->file('file')->store('arsip_files', 'public');
        }

        $arsip->update([
            'kode_arsip' => $request->kode_arsip,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jenis_arsip' => $request->jenis_arsip,
            'tanggal' => $request->tanggal,
            'file' => $filePath,
        ]);

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui!');
    }

    /**
     * Menghapus arsip dari database.
     */
    public function destroy(Arsip $arsip)
    {
        // ... (kode method destroy Anda sudah benar) ...
        if ($arsip->file) {
            Storage::disk('public')->delete($arsip->file);
        }
        $arsip->delete();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }

    /**
     * Menampilkan halaman pencarian.
     */
    public function search(Request $request)
    {
        // ... (kode method search Anda sudah benar) ...
        $query = $request->input('q');
        $arsips = Arsip::where('judul', 'like', "%$query%")
                      ->orWhere('kode_arsip', 'like', "%$query%")
                      ->orWhere('deskripsi', 'like', "%$query%")
                      ->latest()
                      ->paginate(10); 
        return view('arsip.search', compact('arsips', 'query'));
    }

    /**
     * Mendownload file arsip.
     */
    public function downloadFile($id)
    {
        // ... (kode method downloadFile Anda sudah benar) ...
        $arsip = Arsip::findOrFail($id);
        if (!$arsip->file) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
        $filePath = storage_path('app/public/' . $arsip->file);
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }
        return response()->download($filePath);
    }

    // ================================================
    // 
    //            METHOD BARU UNTUK FITUR BACKUP
    // 
    // ================================================

    /**
     * Menampilkan halaman backup dan daftar file backup yang ada.
     */
    public function showBackupPage()
    {
        $backupPath = storage_path('app/backups');
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath);
        }

        $files = File::files($backupPath);
        $backupFiles = collect($files)->map(function ($file) {
            return [
                'name' => $file->getFilename(),
                'size' => $file->getSize(),
                'type' => $file->getExtension() == 'zip' ? 'Files' : 'Database',
                'created_at' => $file->getMTime(),
            ];
        })->sortByDesc('created_at');

        return view('backup.index', compact('backupFiles'));
    }

    /**
     * Membuat backup database (file .sql).
     * PENTING: Membutuhkan path ke mysqldump.exe dari XAMPP Anda.
     */
    public function backupDatabase(Request $request)
    {
        $request->validate([
            'mysqldump_path' => 'required|string|ends_with:mysqldump.exe'
        ], [
            'mysqldump_path.ends_with' => 'Path harus diakhiri dengan mysqldump.exe'
        ]);

        if (!File::exists($request->mysqldump_path)) {
            return redirect()->back()->with('error', 'File mysqldump.exe tidak ditemukan di path tersebut. Cek kembali path Anda.');
        }

        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD') ?? '';
        $dbHost = env('DB_HOST');

        $backupPath = storage_path('app/backups');
        $filename = "db-backup-" . now()->format('Y-m-d-His') . ".sql";
        $filePath = $backupPath . '/' . $filename;

        // Perintah untuk mysqldump
        $command = sprintf(
            '"%s" --user=%s --password=%s --host=%s %s > %s',
            $request->mysqldump_path,
            $dbUser,
            $dbPass,
            $dbHost,
            $dbName,
            $filePath
        );

        $process = Process::fromShellCommandline($command);

        try {
            $process->mustRun();
            return redirect()->route('backup.index')->with('success', 'Backup database berhasil dibuat: ' . $filename);
        } catch (ProcessFailedException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Membuat backup file arsip (file .zip).
     */
    public function backupFiles()
    {
        $zip = new ZipArchive;
        $backupPath = storage_path('app/backups');
        $filename = "files-backup-" . now()->format('Y-m-d-His') . ".zip";
        $filePath = $backupPath . '/' . $filename;

        $arsipFolderPath = storage_path('app/public/arsip_files');

        if ($zip->open($filePath, ZipArchive::CREATE) !== TRUE) {
            return redirect()->back()->with('error', 'Tidak bisa membuat file zip.');
        }

        // Tambahkan file ke zip
        $files = File::allFiles($arsipFolderPath);
        foreach ($files as $file) {
            $relativePath = substr($file->getPathname(), strlen($arsipFolderPath) + 1);
            $zip->addFile($file->getPathname(), $relativePath);
        }

        $zip->close();

        return redirect()->route('backup.index')->with('success', 'Backup file arsip berhasil dibuat: ' . $filename);
    }

    /**
     * Mendownload file backup (.sql atau .zip).
     */
    public function downloadBackup($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);

        if (!File::exists($filePath)) {
            abort(404, 'File backup tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}

