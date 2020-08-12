@extends('layouts.layout_base')

@section('main-content')
    <div class="user-ingredients-index-page container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('ingredientSaved'))
            <div class="alert alert-success">
                <p>L'ingrediente {{ session('ingredientSaved') }} è stato salvato. Potrai usarlo per le tue ricette.</p>
            </div>
        @endif
        
        <h1 class="text-center mt-5">Ingredienti usati nelle ricette</h1>
        <div class="d-flex page-content">
            <table class="table table-hover col-md-3 mt-2">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">Ingrediente</th>
                        <th scope="col" class="text-center">Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr class="table-row">
                            <th scope="row" class="text-center">{{ $ingredient->getNameCapitalized() }}</th>
                            <td class="text-center">
                                <form action="{{ route('user.ingredients.destroy', $ingredient->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Elimina" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-wrapper text-center">
                <div>
                    <h2 class="form-wrapper__title">Aggiungi un nuovo ingrediente</h2>
                    <form
                        action="{{ route('user.ingredients.store') }}"
                        method="POST"
                        class="form col-md-4 form-bg p-2 d-inline-block"
                    >
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="name">Nuovo ingrediente</label>
                            <input type="text" minlength="5" maxlength="50" name="name" id="name">
                        </div>

                        <div class="form-group text-right pr-5 mt-5">
                            <button type="submit" class="btn btn-primary">Conferma</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
