<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservasi={{ $reservasi->kode_reservasi }}</title>

    <link rel="stylesheet" href="{{ asset('build/assets/app-60452f03.css') }}">
</head>
<body>
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Detail Transaksi</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 font-semibold">ID Transaksi:</p>
                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                        $reservasi->transaksi->kode_transaksi }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Tanggal:</p>
                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                        date($reservasi->transaksi->created_at) }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Metode Pembayaran:</p>
                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                        $reservasi->transaksi->metode_bayar }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Potongan/Diskon Pembayaran:</p>
                    <p class="text-sm md:text-lg font-bold text-indigo-700">Rp. {{
                        number_format($reservasi->transaksi->diskon, 0,2) }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Total Pembayaran:</p>
                    <p class="text-sm md:text-lg font-bold text-indigo-700">Rp. {{
                        number_format($reservasi->transaksi->sub_total,0,2) }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Status Pembayaran:</p>
                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{ $reservasi->transaksi->status }}
                    </p>
                </div>
            </div>

            <hr>
            <h2 class="text-2xl font-bold mt-4 text-gray-800">Detail Reservasi</h2>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 font-semibold">Kode Reservasi:</p>
                    <p class="text-lg font-bold text-indigo-700">{{ $reservasi->kode_reservasi }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Status:</p>
                    <p class="text-lg font-bold text-indigo-700">{{ $reservasi->status }}</p>
                </div>
            </div>
            <hr class="my-4 border-gray-300">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 font-semibold">Nama Tamu:</p>
                    <p class="text-lg font-bold text-indigo-700">{{ $reservasi->detail->nama }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Email Tamu:</p>
                    <p class="text-lg font-bold text-indigo-700">{{ $reservasi->detail->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Jumlah Tamu:</p>
                    <p class="text-lg font-bold text-indigo-700">{{ $reservasi->jumlah_tamu }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Nomor Tamu:</p>
                    <p class="text-lg font-bold text-indigo-700">{{ $reservasi->detail->no_hp }}</p>
                </div>
            </div>
            <hr class="my-4 border-gray-300">


           <div class="grid grid-cols-2 gap-4">
            <div class="mt-4">
                <p class="text-gray-600 font-semibold">Tipe Kamar:</p>
                <p class="text-lg font-bold text-indigo-700">{{ $reservasi->detail->tipe_kamar }}</p>
            </div>

            <div class="mt-4">
                <p class="text-gray-600 font-semibold">Tanggal Check-in:</p>
                <p class="text-lg font-bold text-indigo-700">{{ $reservasi->tgl_masuk }}</p>
            </div>

            <div class="mt-4">
                <p class="text-gray-600 font-semibold">Kode Kamar:</p>
                <p class="text-lg font-bold text-indigo-700">{{ $reservasi->detail->kode_kamar }}</p>
            </div>

            <div class="mt-4">
                <p class="text-gray-600 font-semibold">Tanggal Check-out:</p>
                <p class="text-lg font-bold text-indigo-700">{{ $reservasi->tgl_keluar }}</p>
            </div>
           </div>

            <!-- Add more details as needed -->
        </div>
    </div>
</body>
</html>
