<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Penginapan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    @include('guest.layouts.navbar')

    <main class="container mx-auto mt">
        <!-- detail penginapan -->
        <section id="detail-penginapan" class="mt-32">
            <p class="text-center text-2xl font-bold text-slate-700">DETAIL PENGINAPAN</p>

            <div class="grid grid-cols-1 mt-5 justify-items-center gap-5">
                <div class="w-full">
                    <div class="bg-white rounded-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                        data-aos-duration="1000">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-3.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[400px] w-full" />
                            <div class="flex justify-between">
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    Kayu Joo Resort
                                </p>
                                {{-- <p class="text-end my-2 text-orange-500 text-lg">Rp. 50.000 / orang</p> --}}
                            </div>
                            <p class="text-sm desc my-2">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore ab natus accusantium
                                autem dolore beatae perspiciatis, reprehenderit nulla assumenda quae, doloribus dolores
                                eum et. Odit sequi eos commodi nobis, facere repellat amet reprehenderit cumque quidem,
                                veniam aliquam nemo in perspiciatis, laborum error ratione voluptatem nam quam harum!
                                Dolores perferendis vel unde facilis accusantium non, iste distinctio illum suscipit
                                mollitia aliquam placeat quod voluptate cum vitae id totam impedit beatae magni alias
                                nobis consequuntur sit corrupti. Cupiditate quam deleniti dolorum, excepturi voluptatum
                                veritatis sapiente expedita aliquam soluta eos ipsam, labore debitis illo earum eum
                                doloribus. Magni aperiam exercitationem at ab alias.
                            </p>
                            <p class="text-sm desc text-violet-800">Owner : Rick
                            </p>
                            <p class="text-sm desc text-violet-800">Lokasi : Taluak Anjalai, Lembah Gumanti, Solok
                                Regency, West Sumatra
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- kamar -->
        <section id="kamar" class="my-20">
            <p class="text-center text-2xl font-bold text-slate-700">KAMAR YANG TERSEDIA DI PENGINAPAN INI</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                <div class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1000">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <div class="flex justify-between">
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    No 1023
                                </p>
                                <p class="text-sm desc my-3 text-violet-800">
                                    Kamar
                                </p>
                            </div>
                            <p class="text-sm desc my-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, necessitatibus....
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-orange-500 text-lg">Rp. 500.000 / Malam</p>
                                <a href="#" type="button"
                                    class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-500 font-medium rounded-xl text-sm px-5 py-2.5">
                                    <div class="flex gap-2 items-center">
                                        <img src="{{ asset('dist/assets/img/wa.svg') }}" alt="" class="w-4 h-4">
                                        <span>Pesan</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1200">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <div class="flex justify-between">
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    No 1023
                                </p>
                                <p class="text-sm desc my-3 text-violet-800">
                                    Kamar
                                </p>
                            </div>
                            <p class="text-sm desc my-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, necessitatibus....
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-orange-500 text-lg">Rp. 500.000 / Malam</p>
                                <a href="#" type="button"
                                    class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-500 font-medium rounded-xl text-sm px-5 py-2.5">
                                    <div class="flex gap-2 items-center">
                                        <img src="{{ asset('dist/assets/img/wa.svg') }}" alt="" class="w-4 h-4">
                                        <span>Pesan</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1400">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <div class="flex justify-between">
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    No 1023
                                </p>
                                <p class="text-sm desc my-3 text-violet-800">
                                    Kamar
                                </p>
                            </div>
                            <p class="text-sm desc my-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, necessitatibus....
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-orange-500 text-lg">Rp. 500.000 / Malam</p>
                                <a href="#" type="button"
                                    class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-500 font-medium rounded-xl text-sm px-5 py-2.5">
                                    <div class="flex gap-2 items-center">
                                        <img src="{{ asset('dist/assets/img/wa.svg') }}" alt="" class="w-4 h-4">
                                        <span>Pesan</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1600">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <div class="flex justify-between">
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    No 1023
                                </p>
                                <p class="text-sm desc my-3 text-violet-800">
                                    Kamar
                                </p>
                            </div>
                            <p class="text-sm desc my-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, necessitatibus....
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-orange-500 text-lg">Rp. 500.000 / Malam</p>
                                <a href="#" type="button"
                                    class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-500 font-medium rounded-xl text-sm px-5 py-2.5">
                                    <div class="flex gap-2 items-center">
                                        <img src="{{ asset('dist/assets/img/wa.svg') }}" alt=""
                                            class="w-4 h-4">
                                        <span>Pesan</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>