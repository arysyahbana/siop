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
                            <form action="#" method="post" enctype="multipart/form-data">
                                @csrf
                                <p class="text-center">
                                    <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                        style="max-width: 800px">
                                </p>
                                <x-admin.input type="text" placeholder="Nama Paket" label="Nama Paket"
                                    name="namaPaket" />

                                <Label>Objek Wisata</Label>
                                <select class="form-select mb-3" aria-label="Default select example" name="wisata_id"
                                    id="wisata_id">
                                    <option selected hidden>--- Pilih Objek Wisata ---</option>
                                    <option>asdasd</option>
                                    <option>qweqwe</option>
                                </select>

                                <Label>Penginapan</Label>
                                <select class="form-select mb-3" aria-label="Default select example" name="penginapan_id"
                                    id="penginapan_id">
                                    <option selected hidden>--- Pilih Penginapan ---</option>
                                    <option>asdasd</option>
                                    <option>qweqwe</option>
                                </select>

                                <Label>Owner</Label>
                                <select class="form-select mb-3" aria-label="Default select example" name="owner_id"
                                    id="owner_id">
                                    <option selected hidden>--- Pilih Owner ---</option>
                                    <option>asdasd</option>
                                    <option>qweqwe</option>
                                </select>

                                <x-admin.input type="number" placeholder="Harga Paket" label="Harga Paket"
                                    name="hargaPaket" />

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Perbarui Foto</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>

                                <div class="addOn">
                                    <div class="row me-1">
                                        <div class="col-11">
                                            <x-admin.input type="text" placeholder="Item Tambahan" label="Item Tambahan"
                                                name="item[]" />
                                        </div>
                                        <div class="col-1 mt-3 pt-3">
                                            <button type="button" class="btn btn-sm btn-primary"
                                                onclick="addItem(this)">+</button>
                                        </div>
                                    </div>
                                </div>

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
