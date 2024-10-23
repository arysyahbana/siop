<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Paket Tour</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    @include('guest.layouts.navbar')

    <main class="container mx-auto mt">
        <!-- detail paket -->
        <section id="detail-paket" class="mt-32">
            <p class="text-center text-2xl font-bold text-slate-700">DETAIL PAKET TOUR</p>

            <div class="grid grid-cols-1 mt-10 justify-items-center gap-5">
                <div class="w-full">
                    <div class="bg-white rounded-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                        data-aos-duration="1000">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <a href="{{ asset('dist/assets/img/team-4.jpg') }}" target="blank">
                                <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                    class="object-cover shadow-lg rounded-xl h-[400px] w-full" />
                            </a>
                            <div class="place-self-center">
                                <p class="text-2xl font-bold text-slate-700 my-2">
                                    Paket A
                                </p>
                                <table class="text-sm desc my-5">
                                    <tr>
                                        <td>Nama Objek Pariwisata</td>
                                        <td class="px-3">:</td>
                                        <td>Nagari 1000 Rumah Gadang</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Penginapan</td>
                                        <td class="px-3">:</td>
                                        <td>Taluak Anjalai Resort</td>
                                    </tr>
                                    <tr>
                                        <td>Owner</td>
                                        <td class="px-3">:</td>
                                        <td>Rick</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Paket</td>
                                        <td class="px-3">:</td>
                                        <td>Rp. 1.350.000</td>
                                    </tr>
                                </table>
                                <p class="text-sm desc my-2">
                                    {{-- untuk item lu jabarin dalam bentuk paragraf aja cok --}}
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore ab natus
                                    accusantium
                                    autem dolore beatae perspiciatis, reprehenderit nulla assumenda quae, doloribus
                                    dolores
                                    eum et. Odit sequi eos commodi nobis, facere repellat amet reprehenderit cumque
                                    quidem,
                                    veniam aliquam nemo in perspiciatis, laborum error ratione voluptatem nam quam
                                    harum!
                                    Dolores perferendis vel unde facilis accusantium non, iste distinctio illum suscipit
                                    mollitia aliquam placeat quod voluptate cum vitae id totam impedit beatae magni
                                    alias
                                    nobis consequuntur sit corrupti. Cupiditate quam deleniti dolorum, excepturi
                                    voluptatum
                                    veritatis sapiente expedita aliquam soluta eos ipsam, labore debitis illo earum eum
                                    doloribus. Magni aperiam exercitationem at ab alias.
                                </p>

                                <div class="my-6">
                                    <a href="#" type="button"
                                        class="focus:outline-none text-white bg-green-500 hover:bg-green-600  font-medium rounded-xl text-sm px-5 py-2.5">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- paket -->
        <section id="paket" class="my-20">
            <p class="text-center text-2xl font-bold text-slate-700">PAKET TOUR LAINNYA</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                <a href="{{ route('detail-paket') }}" class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1000">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                Paket A
                            </p>
                            <p class="text-orange-500 text-md my-2 text-center">
                                Rp. 1.350.000
                            </p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('detail-paket') }}" class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1200">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                Paket A
                            </p>
                            <p class="text-orange-500 text-md my-2 text-center">
                                Rp. 1.350.000
                            </p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('detail-paket') }}" class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1400">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                Paket A
                            </p>
                            <p class="text-orange-500 text-md my-2 text-center">
                                Rp. 1.350.000
                            </p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('detail-paket') }}" class="w-full max-w-lg">
                    <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                        data-aos="fade-up" data-aos-duration="1600">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/team-4.jpg') }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                            <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                Paket A
                            </p>
                            <p class="text-orange-500 text-md my-2 text-center">
                                Rp. 1.350.000
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
