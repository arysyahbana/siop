@extends('admin.app')

@section('title', 'Edit Paket Tour')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Edit Paket Tour</h6>
                <div class="card mb-4">
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-5">
                            <form action="{{ route('paket.update', $paketTour->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <p class="text-center">
                                    <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                        style="max-width: 800px">
                                </p>
                                <x-admin.input type="text" placeholder="Nama Paket" label="Nama Paket" name="namaPaket"
                                    value="{{ $paketTour->nama_paket ?? '' }}" />

                                <x-admin.input type="text" placeholder="Deskripsi" label="Deskripsi" name="deskripsi"
                                    value="{{ $paketTour->deskripsi ?? '' }}" />

                                <Label>Objek Wisata</Label>
                                <select class="form-select mb-3" aria-label="Default select example" name="wisata_id"
                                    id="wisata_id">
                                    <option selected hidden value="">--- Pilih Objek Wisata ---</option>
                                    @foreach ($objekWisata as $wisata)
                                        <option value="{{ $wisata->id }}" @selected($wisata->id == $paketTour->id_objek_wisata)>
                                            {{ $wisata->nama_wisata }}
                                        </option>
                                    @endforeach
                                </select>
                                <Label>Penginapan</Label>
                                <select class="form-select mb-3" aria-label="Default select example" name="penginapan_id"
                                    id="penginapan_id">
                                    <option selected hidden value="">--- Pilih Penginapan ---</option>
                                    @foreach ($penginapan as $inap)
                                        <option value="{{ $inap->id }}" @selected($inap->id == $paketTour->id_penginapan)>
                                            {{ $inap->nama_penginapan }}
                                        </option>
                                    @endforeach
                                </select>

                                @if (Auth::user()->role == 'Admin')
                                    <Label>Owner</Label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="owner_id"
                                        id="owner_id">
                                        <option selected hidden value="">--- Pilih Owner ---</option>
                                        @foreach ($pemilik as $owner)
                                            <option value="{{ $owner->id }}" @selected($owner->id == $paketTour->id_pemilik)>
                                                {{ $owner->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                                @endif

                                <x-admin.input type="number" placeholder="Harga Paket" label="Harga Paket"
                                    name="hargaPaket" value="{{ $paketTour->harga }}" />

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Perbarui Foto</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>

                                <div class="addOn">
                                    @foreach ($paketTour->rItemTambahan as $key => $value)
                                        <div class="row me-1">
                                            <div class="col-11">
                                                <x-admin.input type="text" placeholder="Item Tambahan"
                                                    label="{{ $key == 0 ? 'Item Tambahan' : '' }}" name="item[]"
                                                    value="{{ $value->nama_item }}" />
                                            </div>
                                            @if ($key == 0)
                                                <div class="col-1 mt-3 pt-3">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        onclick="addItem(this)">+</button>
                                                </div>
                                            @else
                                                <div class="col-1">
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="deleteForm(this)">-</button>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <x-admin.input type="text" placeholder="Medsos" label="Medsos" name="medsos"
                                    value="{{ $paketTour->medsos }}" />

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
            <div class="col-11">
                <input class="form-control" type="text" placeholder="Item Tambahan"
                    name="${inputName}" />
            </div>
            <div class="col-1 mt-1">
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
