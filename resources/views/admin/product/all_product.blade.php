@extends('layouts.admin')

@section('title', 'Semua Product')

@section('content')
    <div class="page-heading">
        <h3>Semua Product</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('upload/' . $item->image) }}" alt=""
                                            style="width: 50px; height:40px;">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td><button class="btn btn-secondary">{{ $item->stock }}</button></td>
                                    <td>Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $item->id) }}"
                                            class="btn btn-warning text-center">edit</a>
                                        <a href="{{ route('products.delete', $item->id) }}"
                                            onclick="return confirm('Anda yakin Menghapus data?')"
                                            class="btn
                                            btn-danger text-center">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
