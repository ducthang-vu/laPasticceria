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
    <div class="user-cakesTypes-create-Page container">
        <header class="page-navigation-header ml-3 mb-2 mt-5">
            <a class="anchor" href="{{ route('user.cake_types.index') }}">Ricettario</a>
            <i class="fas fa-chevron-right"></i>
            <span>Aggiungi nuova ricetta</span>
        </header>

        <section class="form-section form-bg col-md-6 col-lg-4 .col-sm-9 p-4 m-auto">
            <h1 class="text-center mt-2 mb-3">Crea nuova ricetta!</h1>
            <form
                action="{{ route('user.cake_types.store') }}"
                method="POST" enctype="multipart/form-data"
                class="m-auto"
            >
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="name">Nome della ricetta</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        maxlength="60"
                        placeholder="Nome della ricetta"
                    >
                </div>
                <div class="form-group">
                    <label for="price">Prezzo (€)</label>
                    <input
                        type="number"
                        class="form-control text-center"
                        name="price"
                        id="price"
                        step="0.1"
                        min="1"
                        max="100"
                        value="{{ old('price', 5.5) }}"
                    >
                </div>
                <div class="form-group">
                    <label class="" for="image">Immagine</label>
                    <input
                        type="file"
                        class="form-control-file"
                        name="image"
                        id="image"
                        accept="image/*"
                        value="{{ old('image') }}"
                    >
                </div>

                <h4 class="mt-4">Ingredienti (in g):</h4>
                @foreach($ingredients as $ingredient)
                    <div class="form-group-flex m-2">
                        <input
                            type="number"
                            class="pl-3"
                            name="{{ $ingredient->getSlug() }}"
                            id="{{ $ingredient->getSlug() }}"
                            min="0"
                            max="2000"
                            value="{{ old($ingredient->name, 0) }}"
                        >
                        <label for="{{ $ingredient->name }}">{{ $ingredient->name }}</label>
                    </div>
                @endforeach
                <div class="form-group text-right pr-5 mt-5">
                    <button type="submit" class="btn btn-primary">Aggiungi ricetta</button>
                </div>
            </form>
        </section>
    </div>
@endsection
