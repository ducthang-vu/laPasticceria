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
    <div class="user-cakeTypes-index-page container">
        <h1 class="page-title col-md-10 m-auto text-center mb-3">
            <span>Ricettario</span>
            <a class="btn btn-success" href="{{ Route('user.cake_types.create') }}" role="button">Aggiungi nuova ricetta</a>
        </h1>
        <table class="table table-hover col-md-10 m-auto">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">Ricetta</th>
                    <th scope="col" class="text-center">Prezzo standard</th>
                    <th scope="col" class="text-center">Quantità</th>
                    <th scope="col" class="text-center">Quantità (fatte oggi)</th>
                    <th scope="col" class="text-center" colspan="3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cakeTypes as $cakeType)
                    <tr>
                        <th scope="row" class="pl-3">{{ $cakeType->getNameCapitalized() }}</th>
                        <td class="text-right pr-5">{{ $cakeType->getPriceFormatted() }} €</td>
                        <td class="text-center">{{ $cakeType->getQuantityOnSale() }}</td>
                        <td class="text-center">{{ $cakeType->getQuantityOnSaleMadeToday() }}</td>
                        <td class="text-center">
                            <a href="{{ route('user.cake_types.show', $cakeType->slug) }}" class="btn btn-primary">Dettagli</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('user.cake_types.edit', $cakeType->slug)}}" class="btn btn-warning">Modifica</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('user.cake_types.destroy', $cakeType->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Elimina" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
