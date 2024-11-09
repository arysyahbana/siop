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

<body class="min-h-screen flex flex-col">
    @include('guest.layouts.navbar')

    <p class="mt-32 text-center text-2xl font-bold text-slate-700 hover:text-orange-500">Penginapan Yang Direkomendasikan
    </p>
    <main class="container mx-auto my-12 px-5 md:px-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-12 justify-items-center gap-5">
            {{-- @foreach ($penginapan as $inap) --}}
            <a href="#" class="w-full max-w-lg">
                <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                    data-aos-duration="1000">
                    <div class="p-5 overflow-hidden rounded-xl flex-grow">
                        <img src="{{ asset('dist/assets/img/penginapan/penginapan 1.jpg') }}" alt=""
                            class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                        <p class="text-xl font-bold text-slate-700 my-2">
                            Penginapan 1
                        </p>
                        <p class="text-sm desc my-2">
                            awkoawokawokawko wakoawok
                        </p>
                    </div>
                </div>
            </a>
            <a href="#" class="w-full max-w-lg">
                <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                    data-aos-duration="1000">
                    <div class="p-5 overflow-hidden rounded-xl flex-grow">
                        <img src="{{ asset('dist/assets/img/penginapan/penginapan 1.jpg') }}" alt=""
                            class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                        <p class="text-xl font-bold text-slate-700 my-2">
                            Penginapan 1
                        </p>
                        <p class="text-sm desc my-2">
                            awkoawokawokawko wakoawok
                        </p>
                    </div>
                </div>
            </a>
            <a href="#" class="w-full max-w-lg">
                <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                    data-aos-duration="1000">
                    <div class="p-5 overflow-hidden rounded-xl flex-grow">
                        <img src="{{ asset('dist/assets/img/penginapan/penginapan 1.jpg') }}" alt=""
                            class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                        <p class="text-xl font-bold text-slate-700 my-2">
                            Penginapan 1
                        </p>
                        <p class="text-sm desc my-2">
                            awkoawokawokawko wakoawok
                        </p>
                    </div>
                </div>
            </a>
            <a href="#" class="w-full max-w-lg">
                <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                    data-aos-duration="1000">
                    <div class="p-5 overflow-hidden rounded-xl flex-grow">
                        <img src="{{ asset('dist/assets/img/penginapan/penginapan 1.jpg') }}" alt=""
                            class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                        <p class="text-xl font-bold text-slate-700 my-2">
                            Penginapan 1
                        </p>
                        <p class="text-sm desc my-2">
                            awkoawokawokawko wakoawok
                        </p>
                    </div>
                </div>
            </a>
            <a href="#" class="w-full max-w-lg">
                <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                    data-aos-duration="1000">
                    <div class="p-5 overflow-hidden rounded-xl flex-grow">
                        <img src="{{ asset('dist/assets/img/penginapan/penginapan 1.jpg') }}" alt=""
                            class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                        <p class="text-xl font-bold text-slate-700 my-2">
                            Penginapan 1
                        </p>
                        <p class="text-sm desc my-2">
                            awkoawokawokawko wakoawok
                        </p>
                    </div>
                </div>
            </a>
            {{-- @endforeach --}}
        </div>
        {{-- <div class="text-center">
            {{ $penginapan->links() }}
        </div> --}}
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
