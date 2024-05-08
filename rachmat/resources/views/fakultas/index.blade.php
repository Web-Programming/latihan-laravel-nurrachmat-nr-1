@extends('layouts.master')

@section('title', 'Selamat Datang')
@section('content')
    <h1>Fakultas</h1>
    @foreach($fakultas as $item)
    <li> {{ $item }} </li>
    @endforeach
@endsection
