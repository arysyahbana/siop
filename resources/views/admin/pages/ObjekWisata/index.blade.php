@extends('admin.app')

@section('title', 'Data Objek Pariwisata')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Objek Pariwisata</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#addWisata"><i
                                class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                        <a href="{{ route('objek-wisata.download') }}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Unduh Rekap Data</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Wisata</x-admin.th>
                                        <x-admin.th>Kategori</x-admin.th>
                                        <x-admin.th>Deskripsi</x-admin.th>
                                        <x-admin.th>Lokasi</x-admin.th>
                                        <x-admin.th>Harga Tiket</x-admin.th>
                                        <x-admin.th>Kontak</x-admin.th>
                                        <x-admin.th>Foto</x-admin.th>
                                        <x-admin.th>Medsos</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($wisata as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td> {{ $item->nama_wisata ?? '' }} </x-admin.td>
                                        <x-admin.td>{{ $item->rKategori?->kategori }}</x-admin.td>
                                        <x-admin.td
                                            style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                            {{ $item->deskripsi ?? '' }}
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->lokasi ?? '' }}</x-admin.td>
                                        <x-admin.td>Rp.
                                            {{ App\Helpers\GlobalFunction::formatMoney($item->harga ?? '') }}</x-admin.td>
                                        <x-admin.td>{{ $item->no_hp }}</x-admin.td>
                                        <x-admin.td>
                                            <a href="{{ asset('dist/assets/img/objek-wisata/' . $item->image) }}"
                                                target="_blank">
                                                <img src="{{ asset('dist/assets/img/objek-wisata/' . $item->image) }}"
                                                    alt="" style="max-width: 100px" class="img-fluid img-thumbnail">
                                            </a>
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a
                                                href="{{ $item->medsos ?? '#' }}">{{ explode('/', parse_url($item->medsos, PHP_URL_PATH))[1] ?? 'Belum Memasukan Link' }}</a>
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                data-bs-target="#editWisata{{ $item->id }}"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusWisata{{ $item->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Edit Wisata -->
                                        <div class="modal fade" id="editWisata{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="editWisataLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editWisataLabel">Edit Data Objek
                                                            Wisata
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('objek-wisata.update', $item->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <x-admin.input type="text" placeholder="Nama Wisata"
                                                                label="Nama Wisata" name="namawisata"
                                                                value="{{ $item->nama_wisata }}" />

                                                            <Label>Kategori</Label>
                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" name="kategori_id"
                                                                id="kategori_id">
                                                                <option selected hidden value="">--- Pilih Kategori
                                                                    ---
                                                                </option>
                                                                @foreach ($kategori as $item2)
                                                                    <option value="{{ $item2->id }}"
                                                                        @selected($item->rKategori?->id == $item2->id)>{{ $item2->kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            <label>Deskripsi</label>
                                                            <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5">
                                                                {{ $item->deskripsi }}
                                                            </textarea>

                                                            <x-admin.input type="text" placeholder="Lokasi"
                                                                label="Lokasi" name="lokasi"
                                                                value="{{ $item->lokasi }}" />
                                                            <x-admin.input type="number" placeholder="Harga Tiket"
                                                                label="Harga Tiket" name="harga"
                                                                value="{{ $item->harga }}" />
                                                            <x-admin.input type="number" placeholder="Kontak"
                                                                label="Kontak" name="kontak"
                                                                value="{{ $item->no_hp }}" />
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Foto
                                                                    Sebelumnya</label>
                                                                <br>
                                                                <div class="text-center">
                                                                    <img src="{{ asset('dist/assets/img/objek-wisata/' . $item->image) }}"
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
                                                                label="Medsos" name="medsos" value="{{$item->medsos}}" />
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

                                        <!-- Modal Hapus Wisata -->
                                        <div class="modal fade" id="hapusWisata{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="hapusWisataLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusWisataLabel">Hapus Data
                                                            Objek Wisata
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
                                                        <a href="{{ route('objek-wisata.destroy', $item->id) }}"
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

    <!-- Modal Add Wisata -->
    <div class="modal fade" id="addWisata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addWisataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addWisataLabel">Tambah Data Objek Wisata</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('objek-wisata.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama Wisata" label="Nama Wisata" name="namawisata" />

                        <Label>Kategori</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="kategori_id"
                            id="kategori_id">
                            <option selected hidden value="">--- Pilih Kategori ---</option>
                            @foreach ($kategori as $item3)
                                <option value="{{ $item3->id }}">{{ $item3->kategori }}</option>
                            @endforeach
                        </select>

                        <label>Deskripsi</label>
                        <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5"></textarea>

                        <x-admin.input type="text" placeholder="Lokasi" label="Lokasi" name="lokasi" />
                        <x-admin.input type="number" placeholder="Harga Tiket" label="Harga Tiket" name="harga" />
                        <x-admin.input type="number" placeholder="Kontak" label="Kontak" name="kontak" />

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>

                        <x-admin.input type="text" placeholder="Medsos" label="Medsos" name="medsos" />
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
