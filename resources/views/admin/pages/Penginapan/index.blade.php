@extends('admin.app')

@section('title', 'Data Penginapan')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Penginapan</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="#" class="btn bg-gradient-success" data-bs-toggle="modal"
                            data-bs-target="#addPenginapan"><i class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
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
                                        <x-admin.th>Pemilik</x-admin.th>
                                        <x-admin.th>Kontak</x-admin.th>
                                        <x-admin.th>Foto</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                <tr>
                                    <x-admin.td>1</x-admin.td>
                                    <x-admin.td> Lorem ipsum dolor sit amet. </x-admin.td>
                                    <x-admin.td style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas accusantium
                                        sapiente, nam commodi ab et minus soluta voluptatum temporibus recusandae!
                                    </x-admin.td>
                                    <x-admin.td>Bangunan</x-admin.td>
                                    <x-admin.td>Rick</x-admin.td>
                                    <x-admin.td>0808989</x-admin.td>
                                    <x-admin.td>
                                        <a href="{{ asset('dist/assets/img/apple-icon.png') }}" target="_blank">
                                            <img src="{{ asset('dist/assets/img/apple-icon.png') }}" alt=""
                                                style="max-width: 100px" class="img-fluid img-thumbnail">
                                        </a>
                                    </x-admin.td>
                                    <x-admin.td>
                                        <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                            data-bs-target="#editPenginapan"><i class="fa fa-pencil"
                                                aria-hidden="true"></i><span class="text-capitalize ms-1">Edit</span></a>
                                        <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusPenginapan"><i class="fa fa-trash"
                                                aria-hidden="true"></i><span class="text-capitalize ms-1">Hapus</span></a>
                                    </x-admin.td>

                                    <!-- Modal Edit Penginapan -->
                                    <div class="modal fade" id="editPenginapan" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPenginapanLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editPenginapanLabel">Edit Data
                                                        Penginapan
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="#" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <x-admin.input type="text" placeholder="Nama Penginapan"
                                                            label="Nama Penginapan" name="namaPenginapan" />

                                                        <label>Deskripsi</label>
                                                        <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5"></textarea>

                                                        <x-admin.input type="text" placeholder="Lokasi" label="Lokasi"
                                                            name="lokasi" />

                                                        <Label>Owner</Label>
                                                        <select class="form-select mb-3" aria-label="Default select example"
                                                            name="owner_id" id="owner_id">
                                                            <option selected hidden>--- Pilih Owner ---</option>
                                                            <option>Rick</option>
                                                            <option>Joko</option>
                                                        </select>

                                                        <x-admin.input type="number" placeholder="Kontak" label="Kontak"
                                                            name="kontak" />

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
                                    <div class="modal fade" id="hapusPenginapan" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusPenginapanLabel"
                                        aria-hidden="true">
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

    <!-- Modal Add Penginapan -->
    <div class="modal fade" id="addPenginapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addPenginapanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPenginapanLabel">Tambah Data Penginapan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama Penginapan" label="Nama Penginapan"
                            name="namaPenginapan" />

                        <label>Deskripsi</label>
                        <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5"></textarea>

                        <x-admin.input type="text" placeholder="Lokasi" label="Lokasi" name="lokasi" />

                        <Label>Owner</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="owner_id"
                            id="owner_id">
                            <option selected hidden>--- Pilih Owner ---</option>
                            <option>Rick</option>
                            <option>Joko</option>
                        </select>

                        <x-admin.input type="number" placeholder="Kontak" label="Kontak" name="kontak" />

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
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
