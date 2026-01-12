<button onclick="openLogoutModal()"
    class="bg-red-600 text-white px-4 py-2 rounded">
    🔓 Logout
</button>

<div id="logoutModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white p-6 rounded shadow">
        <p class="mb-4">Yakin ingin logout?</p>

        <div class="flex justify-end space-x-2">
            <button onclick="closeLogoutModal()">Batal</button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
