@extends('admin.app')

@section('title', 'Data Paket Tour')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Data Paket Tour</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#addPaket"><i
                                class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                        <a href="{{ route('paket.download') }}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Unduh Rekap Data</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Paket</x-admin.th>
                                        <x-admin.th>Nama Objek Wisata</x-admin.th>
                                        <x-admin.th>Nama Penginapan</x-admin.th>
                                        <x-admin.th>Owner</x-admin.th>
                                        <x-admin.th>Harga</x-admin.th>
                                        <x-admin.th>Foto</x-admin.th>
                                        <x-admin.th>Item Tambahan</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($paketTour as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td>{{ $item->nama_paket ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->deskripsi ?? '' }}</x-admin.td>
                                        <x-admin.td> {{ $item->rObjekWisata?->nama_wisata ?? '' }} </x-admin.td>
                                        <x-admin.td> {{ $item->rPenginapan?->nama_penginapan ?? '' }} </x-admin.td>
                                        <x-admin.td>{{ $item->rPemilik?->name ?? '' }}</x-admin.td>
                                        <x-admin.td>Rp.
                                            {{ App\Helpers\GlobalFunction::formatMoney($item->harga ?? '') }}</x-admin.td>
                                        <x-admin.td>
                                            <a href="{{ asset('dist/assets/img/paket-tour/' . $item->image) }}"
                                                target="_blank">
                                                <img src="{{ asset('dist/assets/img/paket-tour/' . $item->image) }}"
                                                    alt="" style="max-width: 100px" class="img-fluid img-thumbnail">
                                            </a>
                                        </x-admin.td>
                                        <x-admin.td>
                                            <ul>
                                                @foreach ($item->rItemTambahan as $item2)
                                                    <li>{{ $item2->nama_item ?? '' }}</li>
                                                @endforeach
                                            </ul>
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a href="{{ route('paket.edit', $item->id) }}" class="btn bg-gradient-info"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusPaket{{ $item->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Hapus Paket -->
                                        <div class="modal fade" id="hapusPaket{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="hapusPaketLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusPaketLabel">Hapus Data
                                                            Paket
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
                                                        <a href="{{ route('paket.destroy', $item->id) }}" type="submit"
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

    <!-- Modal Add Paket -->
    <div class="modal fade" id="addPaket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addPaketLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPaketLabel">Tambah Data Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('paket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama Paket" label="Nama Paket" name="namaPaket" />

                        <x-admin.input type="text" placeholder="Deskripsi" label="Deskripsi" name="deskripsi" />

                        <Label>Objek Wisata</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="wisata_id"
                            id="wisata_id">
                            <option selected hidden value="">--- Pilih Objek Wisata ---</option>
                            @foreach ($objekWisata as $wisata)
                                <option value="{{ $wisata->id }}">{{ $wisata->nama_wisata }}</option>
                            @endforeach
                        </select>

                        <Label>Penginapan</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="penginapan_id"
                            id="penginapan_id">
                            <option selected hidden value="">--- Pilih Penginapan ---</option>
                            @foreach ($penginapan as $inap)
                                <option value="{{ $inap->id }}">{{ $inap->nama_penginapan }}</option>
                            @endforeach
                        </select>

                        <Label>Owner</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="owner_id"
                            id="owner_id">
                            <option selected hidden>--- Pilih Owner ---</option>
                            @foreach ($pemilik as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                            @endforeach
                        </select>

                        <x-admin.input type="number" placeholder="Harga Paket" label="Harga Paket" name="hargaPaket" />

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>

                        <div class="addOn">
                            <div class="row me-1">
                                <div class="col-10">
                                    <x-admin.input type="text" placeholder="Item Tambahan" label="Item Tambahan"
                                        name="item[]" />
                                </div>
                                <div class="col-2 mt-3 pt-3">
                                    <button type="button" class="btn btn-sm btn-primary"
                                        onclick="addItem(this)">+</button>
                                </div>
                            </div>
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

    <script>
        function addItem(element) {
            var prestasiClass = element.closest('.addOn');
            var input = prestasiClass.querySelector('input');
            var inputName = input.getAttribute('name');
            var div = document.createElement('div');
            div.className = 'row me-1';
            div.innerHTML = `
            <div class="col-10">
                <input class="form-control" type="text" placeholder="Item Tambahan"
                    name="${inputName}" />
            </div>
            <div class="col-2 mt-1">
                <button type="button" class="btn btn-sm btn-warning"
                    onclick="deleteForm(this)">-</button>
            </div>`;

            prestasiClass.appendChild(div);
        }

        function deleteForm(element) {
            var row = element.closest('.row');
            row.remove();
        }
    </script>
@endsection
