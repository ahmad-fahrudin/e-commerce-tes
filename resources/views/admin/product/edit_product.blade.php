@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
    <div class="page-heading">
        <h3>Create Product</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('products.all') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update') }}" method="POST" id="myForm" enctype="multipart/form-data"
                    id="myForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="no_kk">Nama</label>
                                <input type="text" name="name" id="" class="form-control"
                                    value="{{ $product->name }}">
                            </div>
                        </div>
                        {{-- No Induk Kependudukan --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik">Price</label>
                                <input type="number" name="price" id="" class="form-control"
                                    data-parsley-type="number" value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Description</label>
                        <textarea name="description" id="" cols="50" rows="4" class="form-control"
                            placeholder="Deskripsi Product">{{ $product->description }}</textarea>
                    </div>
                    <div class="row">
                        {{-- Nama Lengkap --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" name="image" id="image" class="form-control"
                                    value="{{ $product->image }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <img src="{{ asset('upload/' . $product->image) }}" style="width: 100px"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" id="showImage">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nis">Stock</label>
                                <input type="number" name="stock" id="" class="form-control"
                                    data-parsley-type="number" value="{{ $product->stock }}">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="flex">
                        <a href="{{ route('products.all') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
