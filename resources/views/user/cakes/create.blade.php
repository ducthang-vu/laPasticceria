@extends('layouts.layout_base')

@section('main-content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="user-cakes-create-page container">
        <header class="page-navigation-header ml-5 mb-4">
            <a class="anchor" href="{{ route('user.cakes.index') }}">Torte</a>
            <i class="fas fa-chevron-right"></i>
            <span>Aggiungi nuove torte</span>
        </header>

        <p class="form-heading text-center">Compila il form per aggiungere nuove torte al tuo inventario</p>
        <form
            action="{{ route('user.cakes.store') }}"
            method="POST"
            class="form .col-xl-2 col-lg-4 col-md-6 col-sm-9 m-auto p-4 form-bg"
        >
            @csrf
            @method('POST')

            @foreach ($cakeTypes as $cakeType)
                <div class="form-group-flex m-2">
                    <input
                        type="number"
                        min="0"
                        max="5000"
                        value="{{ old($cakeType->id, 0) }}"
                        class="pl-2 ml-5"
                        name="{{ $cakeType->slug }}">
                    <label for=""><a href="{{ route('user.cake_types.show', $cakeType->slug) }}">
                        {{ $cakeType->getNameCapitalized() }}</a>
                    </label>
                </div>
            @endforeach

            <div class="form-group text-right pr-5 mt-5">
                <button type="submit" class="btn btn-primary">Conferma</button>
            </div>
        </form>
    </div>
@endsection
