@extends('layouts.master')

@section('title', 'Data Prodi')
@section('content')
    <div class="container">
        <h1>Data List Prodi</h1>
        <a href="{{ route('prodi.create') }}" class="btn btn-success">
            Tambah Prodi
        </a>
        <table class="table table-stripped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listprodi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <a href="{{ url('/prodi/'.$item->id) }}" class="btn btn-warning">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
