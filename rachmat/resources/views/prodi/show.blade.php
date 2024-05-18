@extends('layouts.master')

@section('title', 'Data Prodi')
@section('content')
    <div class="container">
        <h1>Detail Prodi {{ $prodi->nama }}</h1>
        <table class="table table-stripped table-hover">
            <thead>
                <tr>
                    <th>ID Prodi</th>
                    <td>{{ $prodi->id }}</td>
                </tr>
                <tr>
                    <th>Nama Prodi</th>
                    <td>{{ $prodi->nama }}</td>
                </tr>
            </thead>
        </table>
    </div>
@endsection
