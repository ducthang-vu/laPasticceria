@extends('layouts.layout_base')

@section('main-content')
    <div class="container">
        <h1 class="m-5">Bentornata {{  Auth::user()->name }}</h1>
    </div>
@endsection
