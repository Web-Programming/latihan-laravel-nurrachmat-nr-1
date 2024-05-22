@extends('layouts.master')

@section('title', 'Form Data Prodi')
@section('content')
    <div class="container">
        <h1>Form Prodi</h1>
        @if (session()->has('info'))
            <div class="alert alert-success">
            {{ session()->get('info') }}
            </div>
        @endif
        <form action="{{ url('prodi/store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Prodi</label>
                <input type="text" name="nama" id="nama" value="{{ old("nama") }}" class="form-control">
                @error('nama')
                    <div class="text-danger"> {{ $message }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Foto/logo</label>
                <input type="file" name="foto" id="foto" class="form-control">
                @error('foto')
                    <div class="text-danger"> {{ $message }} </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
@endsection
