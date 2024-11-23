@extends('admin.app')

@section('title', 'Data Transportasi')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Transportasi</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal"
                            data-bs-target="#addTransportasi"><i class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                        <a href="{{ route('transportasi.download') }}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Unduh Rekap Data</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Transportasi</x-admin.th>
                                        <x-admin.th>Harga</x-admin.th>
                                        <x-admin.th>Deskripsi</x-admin.th>
                                        <x-admin.th>Rute</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($transportasi as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td> {{ $item->namaTransportasi }}</> </x-admin.td>
                                        <x-admin.td>Rp.
                                            {{ App\helpers\GlobalFunction::formatMoney($item->harga) }}</x-admin.td>
                                        <x-admin.td
                                            style="word-wrap: break-word; word-break: break-word; white-space: normal; min-width: 300px">
                                            {{ $item->deskripsi }}
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->rute }}</x-admin.td>
                                        <x-admin.td>
                                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                data-bs-target="#editTransportasi"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusTransportasi"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Edit Transportasi -->
                                        <div class="modal fade" id="editTransportasi" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTransportasiLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editTransportasiLabel">Edit Data
                                                            Transportasi
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('transportasi.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <x-admin.input type="text" placeholder="Nama Transportasi"
                                                                label="Nama Transportasi" name="namaTransportasi"
                                                                value="{{ $item->namaTransportasi }}" />
                                                            <x-admin.input type="number" placeholder="Harga" label="Harga"
                                                                name="harga" value="{{ $item->harga }}" />

                                                            <label>Deskripsi</label>
                                                            <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5">
                                                                {{ $item->deskripsi }}
                                                            </textarea>

                                                            <x-admin.input type="text" placeholder="Rute" label="Rute"
                                                                name="rute" value="{{ $item->rute }}" />
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

                                        <!-- Modal Hapus Transportasi -->
                                        <div class="modal fade" id="hapusTransportasi" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusTransportasiLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusTransportasiLabel">Hapus Data
                                                            Transportasi
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
                                                        <a href="{{ route('transportasi.destroy', $item->id) }}" type="submit"
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

    <!-- Modal Add Transportasi -->
    <div class="modal fade" id="addTransportasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addTransportasiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTransportasiLabel">Tambah Data Transportasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transportasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama Transportasi" label="Nama Transportasi"
                            name="namaTransportasi" />
                        <x-admin.input type="number" placeholder="Harga" label="Harga" name="harga" />

                        <label>Deskripsi</label>
                        <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="20" rows="5"></textarea>

                        <x-admin.input type="text" placeholder="Rute" label="Rute" name="rute" />
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
