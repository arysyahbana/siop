@extends('admin.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Kategori</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="#" class="btn bg-gradient-success" data-bs-toggle="modal"
                            data-bs-target="#addKategori"><i class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Barang</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($kategori as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td>{{ $item->kategori}}</x-admin.td>
                                        <x-admin.td>
                                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                data-bs-target="#editKategori{{ $item->id }}"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusKategori{{$item->id}}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Edit Kategori -->
                                        <div class="modal fade" id="editKategori{{ $item->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="editKategoriLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editKategoriLabel">Edit Data
                                                            Kategori
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('kategori.update', $item->id)}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <x-admin.input type="text" placeholder="Nama Kategori"
                                                                label="Nama Kategori" name="kategori"
                                                                value="{{ $item->kategori }}" />
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

                                        <!-- Modal Hapus Kategori -->
                                        <div class="modal fade" id="hapusKategori{{$item->id}}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusKategoriLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusKategoriLabel">Hapus Data
                                                            Kategori
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
                                                        <a href="{{route('kategori.destroy', $item->id)}}" type="submit"
                                                            class="btn btn-sm btn-danger">Hapus</a>
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

    <!-- Modal Add Kategori -->
    <div class="modal fade" id="addKategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addKategoriLabel">Tambah Data Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kategori.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama kategori" label="Nama kategori"
                            name="kategori" />
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
