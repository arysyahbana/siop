@extends('admin.app')

@section('title', 'Data Jenis Lokasi Penginapan')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Jenis Lokasi Penginapan</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#addLokasi"><i
                                class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                        <a href="#" class="btn bg-gradient-success"><i class="bi bi-plus-circle"></i><span
                                class="text-capitalize ms-1">Unduh Rekap Data</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Lokasi</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                <tr>
                                    <x-admin.td>1</x-admin.td>
                                    <x-admin.td>Diatas Bukit</x-admin.td>
                                    <x-admin.td>
                                        <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                            data-bs-target="#editLokasi"><i class="fa fa-pencil"
                                                aria-hidden="true"></i><span class="text-capitalize ms-1">Edit</span></a>
                                        <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusLokasi"><i class="fa fa-trash"
                                                aria-hidden="true"></i><span class="text-capitalize ms-1">Hapus</span></a>
                                    </x-admin.td>

                                    <!-- Modal Edit Lokasi -->
                                    <div class="modal fade" id="editLokasi" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLokasiLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editLokasiLabel">Edit Data
                                                        Lokasi
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="#" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <x-admin.input type="text" placeholder="Nama Lokasi"
                                                            label="Nama Lokasi" name="lokasi" value="Diatas Bukit" />
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

                                    <!-- Modal Hapus Lokasi -->
                                    <div class="modal fade" id="hapusLokasi" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusLokasiLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="hapusLokasiLabel">Hapus Data
                                                        Lokasi
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
                                                    <a href="#" type="submit" class="btn btn-sm btn-danger">Hapus</a>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            </x-admin.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Lokasi -->
    <div class="modal fade" id="addLokasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addLokasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addLokasiLabel">Tambah Data Jenis Lokasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama Lokasi" label="Nama Lokasi" name="lokasi" />
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
