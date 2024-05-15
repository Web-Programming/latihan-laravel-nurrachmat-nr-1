@extends('layouts.master')

@section('title', 'Selamat Datang')
@section('content')
    <h1>Data Mahasiswa</h1>
    <table>
    <thead>
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Alamat</th>
        </tr>
        <tbody>
            @foreach($mahasiswa as $item)
            <tr>
                <td> {{ $item->npm }} </td>
                <td> {{ $item->nama_mahasiswa }} </td>
                <td> {{ $item->alamat }} </td>
            </tr>
            @endforeach
        </tbody>
    </thead>
   </table>
@endsection
