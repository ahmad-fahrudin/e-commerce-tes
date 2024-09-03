@extends('layouts.admin')

@section('title', 'Semua Orderan')

@section('content')
    <div class="page-heading">
        <h3>Semua Orderan</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th style="width: 50px">No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Tanggal</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($item->status == 'Bayar Berhasil')
                                            <button class="btn btn-success">{{ $item->status }}</button>
                                        @else
                                            <button class="btn btn-secondary">{{ $item->status }}</button>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('orders.delete', $item->id) }}"
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
