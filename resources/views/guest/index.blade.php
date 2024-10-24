<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <div class="h-full bg-gradient-to-r from-violet-500 to-violet-300 shadow-xl">
        {{-- Navbar --}}
        <nav class="bg-gradient-to-r from-violet-500 to-violet-300 fixed w-full z-20 top-0 start-0">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">SIOP</span>
                </a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <a href="{{ route('login') }}" type="button"
                        class="focus:outline-none text-white bg-[#fa9f59] hover:bg-orange-600 focus:ring-4 focus:ring-orange-500 font-medium rounded-xl text-sm px-5 py-2.5">
                        Login
                    </a>
                    <button data-collapse-toggle="navbar-sticky" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                        <li>
                            <a href="#home"
                                class="block py-2 px-3 text-slate-900 rounded md:bg-transparent hover:text-white md:p-0"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#pariwisata"
                                class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0">Daftar
                                Objek Pariwisata</a>
                        </li>
                        <li>
                            <a href="#penginapan"
                                class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0">Daftar
                                Penginapan</a>
                        </li>
                        <li>
                            <a href="#paket"
                                class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0">Daftar
                                Paket Tour</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Home --}}
        <section id="home" class="container mx-auto py-36">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="text-[#EBF4F6] py-16 mx-12 md:mx-0 text-center md:text-start" data-aos="fade-right"
                    data-aos-duration="1000">
                    <p class="text-xl">Nikmati Pilihan Wisata Tanpa Kebingungan</p>
                    <p class="text-5xl font-bold mb-5 my-2">
                        Sistem Informasi Objek Pariwisata Dan Paket Tour Wisata Pada 3 Danau Kabupaten Solok
                    </p>
                    <a href="{{ route('register') }}" type="button"
                        class="focus:outline-none text-white bg-[#3DC2EC] hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-500 font-medium rounded-xl text-sm px-5 py-2.5 mb-2">
                        Register
                    </a>
                </div>
                <div class="overflow-hidden border rounded-3xl shadow-xl mx-12 md:mx-0 max-h-[350px]"
                    data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('dist/assets/img/team-2.jpg') }}" alt=""
                        class="object-cover h-full w-full" />
                </div>
            </div>
        </section>
    </div>

    <main class="container mx-auto">
        <!-- pariwisata -->
        <section id="pariwisata" class="mt-20">
            <p class="text-center text-2xl font-bold text-slate-700">DAFTAR OBJEK PARIWISATA</p>

            @foreach ($objekWisata as $wisata)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                    <a href="{{ route('detail-wisata', $wisata->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/objek-wisata/' . $wisata->image ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <div class="flex justify-between">
                                    <p class="text-xl font-bold text-slate-700 my-2">
                                        {{ $wisata->nama_wisata ?? '' }}
                                    </p>
                                    <p class="text-sm desc my-3 text-violet-800">
                                        {{ $wisata->rKategori?->kategori ?? '' }}
                                    </p>
                                </div>
                                <p class="text-sm desc my-2">
                                    {{ $wisata->deskripsi ?? '' }}
                                </p>
                                <p class="text-end mt-3 text-orange-500 text-lg">Rp.
                                    {{ App\Helpers\GlobalFunction::formatMoney($wisata->harga ?? 0) }} / orang</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </section>

        <!-- penginapan -->
        <section id="penginapan" class="mt-20">
            <p class="text-center text-2xl font-bold text-slate-700">DAFTAR PENGINAPAN</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                @foreach ($penginapan as $inap)
                    <a href="{{ route('detail-penginapan', $inap->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/penginapan/' . $inap->image ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    {{ $inap->nama_penginapan ?? '' }}
                                </p>
                                <p class="text-sm desc my-2">
                                    {{ $inap->deskripsi ?? '' }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </section>

        <!-- paket -->
        <section id="paket" class="my-20">
            <p class="text-center text-2xl font-bold text-slate-700">DAFTAR PAKET TOUR WISATA</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                @foreach ($paketTour as $tour)
                    <a href="{{ route('detail-paket', $tour->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/paket-tour/' . $tour->image ?? '') }}" alt=""
                                    class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                    {{ $tour->nama_paket ?? '' }}
                                </p>
                                <p class="text-orange-500 text-md my-2 text-center">
                                    Rp. {{ App\Helpers\GlobalFunction::formatMoney($tour->harga ?? 0) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
