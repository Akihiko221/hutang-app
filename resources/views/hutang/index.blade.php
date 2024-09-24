@extends('layouts.content')

@section('content')
    <section class="py-10 md:py-20">
        <div class="container mx-auto px-4">
            <!-- Grid untuk membagi menjadi dua bagian: List Hutang di kiri dan Total di kanan -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">

                <!-- Bagian Kanan: Total Hutang -->
                <div class="order-1 lg:order-2">
                    <h3 class="text-xl md:text-2xl font-bold text-blue-500 mb-4 text-center">Total Hutang</h3>
                    <div
                        class="p-4 md:p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                        <div id="total-hutang"
                            class="text-2xl md:text-3xl font-bold text-blue-500 mb-4 text-center md:text-left">
                            Rp. {{ number_format($totalHutang, 0, ',', '.') }}
                        </div>
                        <p class="text-blue-600 text-center md:text-left">Total hutang Anda yang tersisa.</p>
                    </div>
                </div>

                <!-- Bagian Kiri: List Hutang -->
                <div class="lg:col-span-2 order-2 lg:order-1">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                        <h3 class="text-xl md:text-2xl font-bold text-blue-500 text-center md:text-left">Daftar Hutang</h3>
                        <button onclick="openModal('addDebtModal')"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                            Tambah Hutang +
                        </button>
                    </div>
                    <div class="space-y-4">
                        @foreach ($debts as $debt)
                            <div
                                class="p-4 md:p-6 bg-white rounded-lg shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center">
                                <div class="mb-4 md:mb-0">
                                    <h4 class="text-lg md:text-xl font-semibold text-blue-500">{{ $debt->creditor }} <span
                                            class="font-bold">- {{ $debt->nama_barang }}</span></h4>
                                    <p class="mt-2 text-blue-600">Rp. {{ number_format($debt->amount, 0, ',', '.') }} -
                                        Jatuh tempo: {{ $debt->due_date }}</p>
                                    <p class="mt-2 text-{{ $debt->status ? 'green' : 'red' }}-500">Status:
                                        {{ $debt->status ? 'Lunas' : 'Belum Lunas' }}</p>
                                </div>

                                <div class="flex flex-row md:flex-col space-x-4 md:space-x-0 md:space-y-4 items-center">
                                    <!-- Tombol Mark as Paid -->
                                    @if (!$debt->status)
                                        <form action="{{ route('hutang.markAsPaid', $debt->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menandai hutang ini sebagai lunas?');">
                                            @csrf
                                            <button type="submit" class="text-green-500 hover:text-green-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Tombol Edit -->
                                    <button
                                        onclick="openEditModal({{ $debt->id }}, '{{ $debt->creditor }}', '{{ $debt->nama_barang }}', {{ $debt->amount }}, '{{ $debt->due_date }}', {{ $debt->status ? 'true' : 'false' }})"
                                        class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('hutang.destroy', $debt->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus hutang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0 1 16.137 21H7.863a2 2 0 0 1-1.996-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2m-6 0h6" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $debts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Tambah Hutang -->
    <div id="addDebtModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden modal">
        <div
            class="bg-white rounded-lg shadow-lg w-full md:w-1/2 lg:w-1/3 p-6 transform transition-all duration-300 scale-95 opacity-0 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg md:text-xl font-semibold text-blue-500">Tambah Hutang</h3>
                <button onclick="closeModal('addDebtModal')" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Form untuk menambah hutang baru -->
            <form action="{{ route('hutang.store') }}" method="POST" onsubmit="return validateForm('addDebtForm')">
                @csrf
                <div class="mb-4">
                    <label for="creditor" class="block text-sm font-medium text-gray-700">Pemberi Hutang</label>
                    <input type="text" name="creditor" id="creditor" placeholder="Masukkan nama pemberi hutang"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" placeholder="Masukkan nama barang"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Hutang (Rp)</label>
                    <input type="number" name="amount" id="amount" placeholder="Masukkan jumlah hutang"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Tanggal Jatuh Tempo</label>
                    <input type="date" name="due_date" id="due_date"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('addDebtModal')"
                        class="mr-2 px-4 py-2 text-gray-500 hover:text-gray-700">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                        Tambah Hutang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Hutang -->
    <div id="editDebtModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden modal">
        <div
            class="bg-white rounded-lg shadow-lg w-full md:w-1/2 lg:w-1/3 p-6 transform transition-all duration-300 scale-95 opacity-0 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg md:text-xl font-semibold text-blue-500">Edit Hutang</h3>
                <button onclick="closeModal('editDebtModal')" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Form untuk edit hutang -->
            <form id="editDebtForm" method="POST" onsubmit="return validateForm('editDebtForm')">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_creditor" class="block text-sm font-medium text-gray-700">Pemberi Hutang</label>
                    <input type="text" name="creditor" id="edit_creditor"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="edit_nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" id="edit_nama_barang"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="edit_amount" class="block text-sm font-medium text-gray-700">Jumlah Hutang (Rp)</label>
                    <input type="number" name="amount" id="edit_amount"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="edit_due_date" class="block text-sm font-medium text-gray-700">Tanggal Jatuh Tempo</label>
                    <input type="date" name="due_date" id="edit_due_date"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="edit_status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="edit_status"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="0">Belum Lunas</option>
                        <option value="1">Lunas</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editDebtModal')"
                        class="mr-2 px-4 py-2 text-gray-500 hover:text-gray-700">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript untuk modal dan validasi -->
    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.firstElementChild.classList.remove('opacity-0', 'scale-95');
                modal.firstElementChild.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.firstElementChild.classList.add('opacity-0', 'scale-95');
            modal.firstElementChild.classList.remove('opacity-100', 'scale-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Delay sesuai dengan durasi animasi (300ms)
        }

        function openEditModal(id, creditor, nama_barang, amount, due_date, status) {
            document.getElementById('edit_creditor').value = creditor;
            document.getElementById('edit_nama_barang').value = nama_barang;
            document.getElementById('edit_amount').value = amount;
            document.getElementById('edit_due_date').value = due_date;
            document.getElementById('edit_status').value = status ? 1 : 0;
            document.getElementById('editDebtForm').action = '/hutang/' + id;
            openModal('editDebtModal');
        }

        function validateForm(formId) {
            const form = document.getElementById(formId);
            const amount = form.querySelector('input[name="amount"]').value;

            if (amount <= 0) {
                alert('Jumlah hutang harus lebih besar dari 0.');
                return false;
            }
            return true;
        }
    </script>
@endsection
