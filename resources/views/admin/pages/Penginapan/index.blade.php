@extends('admin.app')

@section('title', 'Data Penginapan')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Penginapan</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal"
                            data-bs-target="#addPenginapan"><i class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                        <a href="{{ route('penginapan.download') }}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Unduh Rekap Data</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Penginapan</x-admin.th>
                                        <x-admin.th>Deskripsi</x-admin.th>
                                        <x-admin.th>Lokasi</x-admin.th>
                                        <x-admin.th>Maps</x-admin.th>
                                        <x-admin.th>Jenis Penginapan</x-admin.th>
                                        <x-admin.th>Wahana Permainan</x-admin.th>
                                        <x-admin.th>Fun Games dan Outbound</x-admin.th>
                                        <x-admin.th>Kafe / Restoran</x-admin.th>
                                        <x-admin.th>Pemilik</x-admin.th>
                                        <x-admin.th>Kontak</x-admin.th>
                                        <x-admin.th>Foto</x-admin.th>
                                        <x-admin.th>Medsos (Instagram)</x-admin.th>
                                        <x-admin.th>Status</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($penginapan as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td> {{ $item->nama_penginapan ?? '' }} </x-admin.td>
                                        <x-admin.td
                                            style="word-wrap: break-word; word-break: break-word; white-space: normal; min-width: 300px">
                                            {{ $item->deskripsi ?? '' }}
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->rLokasi?->nama_lokasi }}</x-admin.td>
                                        <x-admin.td>
                                            <a href="{{ $item->maps ?? '#' }}" target="_blank">Maps
                                                {{ $item->nama_penginapan ?? '' }}</a>
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->jenis_penginapan ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->wahana ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->outbound ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->kafe ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rPemilik?->name ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rPemilik?->no_hp ?? '' }}</x-admin.td>
                                        <x-admin.td>
                                            <a href="{{ asset('dist/assets/img/penginapan/' . $item->image) }}"
                                                target="_blank">
                                                <img src="{{ asset('dist/assets/img/penginapan/' . $item->image) }}"
                                                    alt="" style="max-width: 100px" class="img-fluid img-thumbnail">
                                            </a>
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a
                                                href="{{ $item->medsos ?? '#' }}">{{ explode('/', parse_url($item->medsos, PHP_URL_PATH))[1] ?? 'Belum Memasukan Link' }}</a>
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->status }}</x-admin.td>
                                        <x-admin.td>
                                            @if (Auth::user()->role == 'Admin')
                                                <a href="#" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                                    data-bs-target="#accPenginapan{{ $item->id }}"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i><span
                                                        class="text-capitalize ms-1">Acc</span></a>
                                            @endif
                                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                data-bs-target="#editPenginapan{{ $item->id }}"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusPenginapan{{ $item->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Acc -->
                                        @if (Auth::user()->role == 'Admin')
                                            <div class="modal fade" id="accPenginapan{{ $item->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="accPenginapanLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="accPenginapanLabel">Acc Data
                                                                Penginapan
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="#" method="post">
                                                            @csrf
                                                            <div class="modal-body text-sm">
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Nama Penginapan
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">{{ $item->nama_penginapan }}</div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Deskripsi
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">{{ $item->deskripsi }}</div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Lokasi
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->rLokasi?->nama_lokasi }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Maps
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        <a href="{{ $item->maps ?? '#' }}"
                                                                            target="_blank">Maps
                                                                            {{ $item->nama_penginapan ?? '' }}</a>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Jenis Penginapan
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->jenis_penginapan ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Wahana Permainan
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->wahana ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Fun Games dan Outbound
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->outbound ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Kafe / Restoran
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->kafe ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Owner
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->rPemilik?->name ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Kontak
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        {{ $item->rPemilik?->no_hp ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Foto
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        <a href="{{ asset('dist/assets/img/penginapan/' . $item->image ?? '') }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset('dist/assets/img/penginapan/' . $item->image ?? '') }}"
                                                                                alt="" style="max-width: 300px"
                                                                                class="img-fluid img-thumbnail">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 mb-2">
                                                                    <div class="col-3 fw-bold">
                                                                        Medsos (Instagram)
                                                                    </div>
                                                                    <div class="">:</div>
                                                                    <div class="">
                                                                        <a
                                                                            href="{{ $item->medsos ?? '#' }}">{{ explode('/', parse_url($item->medsos, PHP_URL_PATH))[1] ?? 'Belum Memasukan Link' }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{ route('penginapan.AccPenginapan', ['id' => $item->id, 'action' => 'Accept']) }}"
                                                                    class="btn btn-sm btn-primary">Acc</a>
                                                                <a href="{{ route('penginapan.AccPenginapan', ['id' => $item->id, 'action' => 'Decline']) }}"
                                                                    class="btn btn-sm btn-danger">Decline</a>
                                                                <a href="#" class="btn btn-sm btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Modal Edit Penginapan -->
                                        <div class="modal fade" id="editPenginapan{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="editPenginapanLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editPenginapanLabel">Edit Data
                                                            Penginapan
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('penginapan.update', $item->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <x-admin.input type="text" placeholder="Nama Penginapan"
                                                                label="Nama Penginapan" name="namaPenginapan"
                                                                value="{{ $item->nama_penginapan }}" />

                                                            <label>Deskripsi</label>
                                                            <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5">
                                                                {{ $item->deskripsi }}
                                                            </textarea>

                                                            <Label>Lokasi</Label>
                                                            <select required class="form-select mb-3"
                                                                aria-label="Default select example" name="lokasi_id"
                                                                id="lokasi_id">
                                                                <option selected hidden value="">--- Pilih Lokasi ---
                                                                </option>
                                                                @foreach ($lokasi as $item4)
                                                                    <option value="{{ $item4->id }}"
                                                                        @selected($item->id_lokasi == $item4->id)>
                                                                        {{ $item4->nama_lokasi }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            <x-admin.input type="link" placeholder="Maps"
                                                                label="Maps" name="maps"
                                                                value="{{ $item->maps }}" />

                                                            <Label>Jenis Penginapan</Label>
                                                            <select required class="form-select mb-3"
                                                                aria-label="Default select example"
                                                                name="jenis_penginapan" id="jenis_penginapan">
                                                                <option selected hidden value="">--- Pilih Jenis
                                                                    Penginapan ---
                                                                </option>
                                                                <option @selected($item->jenis_penginapan == 'Camping') value="Camping">
                                                                    Camping
                                                                </option>
                                                                <option @selected($item->jenis_penginapan == 'Glamping') value="Glamping">
                                                                    Glamping</option>
                                                                <option @selected($item->jenis_penginapan == 'Homestay') value="Homestay">
                                                                    Homestay</option>
                                                                <option @selected($item->jenis_penginapan == 'Hotel') value="Hotel">
                                                                    Hotel</option>
                                                                <option @selected($item->jenis_penginapan == 'Resort') value="Resort">Resort
                                                                </option>
                                                                <option @selected($item->jenis_penginapan == 'Villa') value="Villa">Villa
                                                                </option>
                                                            </select>

                                                            <Label>Wahana Permainan</Label>
                                                            <br>
                                                            <div class="text-xs mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="wahanaPermainan" id="adaWahana"
                                                                        value="Ada" @checked($item->wahana == 'Ada')>
                                                                    <label class="form-check-label"
                                                                        for="adaWahana">Ada</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="wahanaPermainan" id="tidakAdaWahana"
                                                                        value="Tidak Ada" @checked($item->wahana == 'Tidak Ada')>
                                                                    <label class="form-check-label"
                                                                        for="tidakAdaWahana">Tidak Ada</label>
                                                                </div>
                                                            </div>

                                                            <Label>Fun Games dan Outbound</Label>
                                                            <br>
                                                            <div class="text-xs mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="fungames" id="adaFun" value="Ada"
                                                                        @checked($item->outbound == 'Ada')>
                                                                    <label class="form-check-label"
                                                                        for="adaFun">Ada</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="fungames" id="tidakAdaFun"
                                                                        value="Tidak Ada" @checked($item->outbound == 'Tidak Ada')>
                                                                    <label class="form-check-label"
                                                                        for="tidakAdaFun">Tidak Ada</label>
                                                                </div>
                                                            </div>

                                                            <Label>Kafe / Restoran</Label>
                                                            <br>
                                                            <div class="text-xs mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="kafe" id="adaKafe" value="Ada"
                                                                        @checked($item->kafe == 'Ada')>
                                                                    <label class="form-check-label"
                                                                        for="adaKafe">Ada</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="kafe" id="tidakAdaKafe"
                                                                        value="Tidak Ada" @checked($item->kafe == 'Tidak Ada')>
                                                                    <label class="form-check-label"
                                                                        for="tidakAdaKafe">Tidak Ada</label>
                                                                </div>
                                                            </div>

                                                            @if (Auth::user()->role == 'Admin')
                                                                <Label>Owner</Label>
                                                                <select required class="form-select mb-3"
                                                                    aria-label="Default select example" name="owner_id"
                                                                    id="owner_id">
                                                                    <option selected hidden>--- Pilih Owner --- </option>
                                                                    @foreach ($pemilik as $item2)
                                                                        <option value="{{ $item2->id }}"
                                                                            @selected($item->rPemilik?->id == $item2->id)>
                                                                            {{ $item2->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <input type="hidden" name="owner_id"
                                                                    value="{{ Auth::user()->id }}">
                                                            @endif
                                                            {{-- <x-admin.input type="number" placeholder="Kontak"
                                                                label="Kontak" name="kontak" /> --}}

                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Foto
                                                                    Sebelumnya</label>
                                                                <br>
                                                                <div class="text-center">
                                                                    <img src="{{ asset('dist/assets/img/penginapan/' . $item->image ?? '') }}"
                                                                        alt="" style="max-width: 300px"
                                                                        class="img-fluid img-thumbnail">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Foto</label>
                                                                <input class="form-control" type="file" id="formFile"
                                                                    name="image">
                                                            </div>
                                                            <x-admin.input type="text" placeholder="Medsos"
                                                                label="Medsos (Instagram)" name="medsos"
                                                                value="{{ $item->medsos ?? '' }}" />

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success">Update</button>
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus Penginapan -->
                                        <div class="modal fade" id="hapusPenginapan{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="hapusPenginapanLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusPenginapanLabel">Hapus Data
                                                            Penginapan
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                                            class="img-fluid w-25">
                                                        <p>Yakin ingin menghapus data?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('penginapan.destroy', $item->id) }}"
                                                            type="submit" class="btn btn-sm btn-danger">Hapus</a>
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </x-admin.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Penginapan -->
    <div class="modal fade" id="addPenginapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addPenginapanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPenginapanLabel">Tambah Data Penginapan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('penginapan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama Penginapan" label="Nama Penginapan"
                            name="namaPenginapan" />

                        <label>Deskripsi</label>
                        <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5"></textarea>

                        {{-- <x-admin.input type="text" placeholder="Lokasi" label="Lokasi" name="lokasi" /> --}}

                        <Label>Lokasi</Label>
                        <select required class="form-select mb-3" aria-label="Default select example" name="lokasi_id"
                            id="lokasi_id">
                            <option selected hidden value="">--- Pilih Lokasi ---</option>
                            @foreach ($lokasi as $namaLokasi)
                                <option value="{{ $namaLokasi->id }}">{{ $namaLokasi->nama_lokasi }}</option>
                            @endforeach
                        </select>

                        <x-admin.input type="link" placeholder="Maps" label="Maps" name="maps" />

                        <Label>Jenis Penginapan</Label>
                        <select required class="form-select mb-3" aria-label="Default select example"
                            name="jenis_penginapan" id="jenis_penginapan">
                            <option value="" selected hidden>--- Pilih Jenis Penginapan ---</option>
                            <option value="Camping">Camping</option>
                            <option value="Glamping">Glamping</option>
                            <option value="Homestay">Homestay</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Resort">Resort</option>
                            <option value="Villa">Villa</option>
                        </select>

                        <Label>Wahana Permainan</Label>
                        <br>
                        <div class="text-xs mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wahanaPermainan" id="adaWahana"
                                    value="Ada">
                                <label class="form-check-label" for="adaWahana">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wahanaPermainan"
                                    id="tidakAdaWahana" value="Tidak Ada" checked>
                                <label class="form-check-label" for="tidakAdaWahana">Tidak Ada</label>
                            </div>
                        </div>

                        <Label>Fun Games dan Outbound</Label>
                        <br>
                        <div class="text-xs mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fungames" id="adaFun"
                                    value="Ada">
                                <label class="form-check-label" for="adaFun">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fungames" id="tidakAdaFun"
                                    value="Tidak Ada" checked>
                                <label class="form-check-label" for="tidakAdaFun">Tidak Ada</label>
                            </div>
                        </div>

                        <Label>Kafe / Restoran</Label>
                        <br>
                        <div class="text-xs mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kafe" id="adaKafe"
                                    value="Ada">
                                <label class="form-check-label" for="adaKafe">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kafe" id="tidakAdaKafe"
                                    value="Tidak Ada" checked>
                                <label class="form-check-label" for="tidakAdaKafe">Tidak Ada</label>
                            </div>
                        </div>

                        @if (Auth::user()->role == 'Admin')
                            <Label>Owner</Label>
                            <select required class="form-select mb-3" aria-label="Default select example" name="owner_id"
                                id="owner_id">
                                <option selected hidden value="">--- Pilih Owner ---</option>
                                @foreach ($pemilik as $item3)
                                    <option value="{{ $item3->id }}">{{ $item3->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                        @endif

                        {{-- <x-admin.input type="number" placeholder="Kontak" label="Kontak" name="kontak" /> --}}

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                        <x-admin.input type="text" placeholder="Medsos" label="Medsos (Instagram)" name="medsos" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
