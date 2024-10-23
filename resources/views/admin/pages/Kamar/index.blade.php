@extends('admin.app')

@section('title', 'Data Kamar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Kamar</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#addKamar"><i
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
                                        <x-admin.th>Nomor Kamar</x-admin.th>
                                        <x-admin.th>Nama Penginapan</x-admin.th>
                                        <x-admin.th>Harga Kamar</x-admin.th>
                                        <x-admin.th>Foto</x-admin.th>
                                        <x-admin.th>Status</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                <tr>
                                    <x-admin.td>1</x-admin.td>
                                    <x-admin.td>1203</x-admin.td>
                                    <x-admin.td> Lorem ipsum dolor sit amet. </x-admin.td>
                                    <x-admin.td>Rp. 0808989</x-admin.td>
                                    <x-admin.td>
                                        <a href="{{ asset('dist/assets/img/apple-icon.png') }}" target="_blank">
                                            <img src="{{ asset('dist/assets/img/apple-icon.png') }}" alt=""
                                                style="max-width: 100px" class="img-fluid img-thumbnail">
                                        </a>
                                    </x-admin.td>
                                    <x-admin.td>Kosong</x-admin.td>
                                    <x-admin.td>
                                        <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                            data-bs-target="#editKamar"><i class="fa fa-pencil" aria-hidden="true"></i><span
                                                class="text-capitalize ms-1">Edit</span></a>
                                        <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusKamar"><i class="fa fa-trash" aria-hidden="true"></i><span
                                                class="text-capitalize ms-1">Hapus</span></a>
                                    </x-admin.td>

                                    <!-- Modal Edit Kamar -->
                                    <div class="modal fade" id="editKamar" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editKamarLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editKamarLabel">Edit Data
                                                        Kamar
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="#" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <x-admin.input type="text" placeholder="Nomor Kamar"
                                                            label="Nomor Kamar" name="nomorKamar" />

                                                        <Label>Penginapan</Label>
                                                        <select class="form-select mb-3" aria-label="Default select example"
                                                            name="penginapan_id" id="penginapan_id">
                                                            <option selected hidden>--- Pilih Penginapan ---</option>
                                                            <option>asdasd</option>
                                                            <option>qweqwe</option>
                                                        </select>

                                                        <x-admin.input type="number" placeholder="Harga Kamar"
                                                            label="Harga Kamar" name="hargaKamar" />

                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Foto Sebelumnya</label>
                                                            <br>
                                                            <div class="text-center">
                                                                <img src="{{ asset('dist/assets/img/apple-icon.png') }}"
                                                                    alt="" style="max-width: 300px"
                                                                    class="img-fluid img-thumbnail">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Foto</label>
                                                            <input class="form-control" type="file" id="formFile"
                                                                name="image">
                                                        </div>

                                                        <Label>Status</Label>
                                                        <select class="form-select mb-3" aria-label="Default select example"
                                                            name=status" id=status">
                                                            <option selected hidden>--- Pilih Status ---</option>
                                                            <option>Terisi</option>
                                                            <option>Kosong</option>
                                                        </select>

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

                                    <!-- Modal Hapus Kamar -->
                                    <div class="modal fade" id="hapusKamar" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusKamarLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="hapusKamarLabel">Hapus Data
                                                        Kamar
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
                                                    <a href="#" type="submit"
                                                        class="btn btn-sm btn-danger">Hapus</a>
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

    <!-- Modal Add Kamar -->
    <div class="modal fade" id="addKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addKamarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addKamarLabel">Tambah Data Kamar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nomor Kamar" label="Nomor Kamar" name="nomorKamar" />

                        <Label>Penginapan</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="penginapan_id"
                            id="penginapan_id">
                            <option selected hidden>--- Pilih Penginapan ---</option>
                            <option>asdasd</option>
                            <option>qweqwe</option>
                        </select>

                        <x-admin.input type="number" placeholder="Harga Kamar" label="Harga Kamar" name="hargaKamar" />

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>

                        <Label>Status</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name=status" id=status">
                            <option selected hidden>--- Pilih Status ---</option>
                            <option>Terisi</option>
                            <option>Kosong</option>
                        </select>
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
