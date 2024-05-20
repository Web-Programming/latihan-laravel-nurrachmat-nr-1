@extends('layouts.master')

@section('title', 'Edit Data Prodi')
@section('content')
    <div class="container">
        <h1>Form Edit Prodi</h1>
        @if (session()->has('info'))
            <div class="alert alert-success">
            {{ session()->get('info') }}
            </div>
        @endif
        <form action="{{ route('prodi.update', ['prodi' => $prodi->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="nama">Nama Prodi</label>
                <input type="text" class="form-control" name="nama" id="nama" value="{{ old("nama") ?? $prodi->nama }}">
                @error('nama')
                    <div class="text-danger"> {{ $message }} </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning mt-2">Ubah</button>
        </form>
    </div>
@endsection
