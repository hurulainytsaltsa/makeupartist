@extends('admin.layouts.main')
@section('title', 'Welcome Girls')
@section('navHomePage', 'active')

@section('content')
<h1>Haii Selamat Datang {{ Auth::user()->name}}</h1>
@endsection
