<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Pariwisata</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    @include('guest.layouts.navbar')

    <p class="mt-32 text-center text-2xl font-bold text-slate-700 hover:text-orange-500">Cari Rekomendasi
        Penginapan</p>
    <main class="container mx-auto mt-12 mb-20 px-5 md:px-0">
        <form class="max-w-xl mx-auto" action="{{ route('rekomendasi-hasil') }}" method="GET">
            <div class="mb-8">
                <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Di Area Mana
                    Anda Ingin Menginap?</label>
                <select id="lokasi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    name="lokasi_id">
                    <option selected hidden>--- Pilih Lokasi ---</option>
                    <option>Diatas Bukit</option>
                    <option>Di Tepi Danau</option>
                    <option>Pusat Keramaian</option>
                    <option>Kebun Teh</option>
                </select>
            </div>
            <div class="mb-8">
                <label for="kapasitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Untuk Berapa
                    Orang Anda Memesan Penginapan?</label>
                <input type="number" id="kapasitas"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5""
                    required />
            </div>
            <div class="mb-8">
                <label for="jenisPenginapan"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penginapan
                    Yang Anda Cari Berupa Apa?</label>
                <select id="jenisPenginapan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    name="jenisPenginapan">
                    <option selected hidden>--- Pilih Jenis Penginapan ---</option>
                    <option>Villa</option>
                    <option>Homestay</option>
                    <option>Glamping</option>
                    <option>Camping</option>
                </select>
            </div>
            <div class="mb-8">
                <label for="anggaran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berapa
                    Anggaran Anda Untuk Menginap Per Malam?</label>
                <select id="anggaran"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    name="anggaran">
                    <option selected hidden>--- Pilih Anggaran ---</option>
                    <option>
                        < Rp.500.000 </option>
                    <option>Rp. 500.000 - Rp.1.000.000</option>
                    <option>> Rp.1.000.000</option>
                </select>
            </div>
            <div class="mb-8">
                <label for="wahana" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apakah Anda
                    Ingin Menginap Di Tempat Yang Memiliki Wahana Permainan?</label>
                <select id="wahana"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    name="wahana">
                    <option selected hidden>--- Pilih Jawaban ---</option>
                    <option>
                        Ya, Saya Ingin Penginapan Dengan Wahana Permainan
                    </option>
                    <option>
                        Tidak, Fasilitas Tersebut Tidak Diperlukan
                    </option>
                </select>
            </div>
            <div class="mb-8">
                <label for="funGames" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apakah Anda
                    Mencari Penginapan Yang Memiliki Fasilitas Fun Games dan Outbound?</label>
                <select id="funGames"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    name="funGames">
                    <option selected hidden>--- Pilih Jawaban ---</option>
                    <option>
                        Ya, Saya Mencari Penginapan Yang Memiliki Fasilitas Fun Games dan Outbound
                    </option>
                    <option>
                        Tidak, Fasilitas Tersebut Tidak Diperlukan
                    </option>
                </select>
            </div>
            <div class="mb-8">
                <label for="kafe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apakah Anda
                    Ingin Menginap Di Tempat Yang Memiliki Kafe Atau Restoran di Dalamnya?</label>
                <select id="kafe"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    name="kafe">
                    <option selected hidden>--- Pilih Jawaban ---</option>
                    <option>
                        Ya, Saya Membutuhkan Penginapan Dengan Kafe atau Restoran
                    </option>
                    <option>
                        Tidak, Fasilitas Tersebut Tidak Diperlukan
                    </option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-[#fa9f59] hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cari
                    Rekomendasi</button>
            </div>
        </form>

    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
