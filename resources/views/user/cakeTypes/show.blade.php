@extends('layouts.layout_base')

@section('main-content')
    <div class="user-cakeType-show-page container">
        <header class="page-navigation-header ml-3 mb-2">
            <a class="anchor" href="{{ route('user.cake_types.index') }}">Ricettario</a>
            <i class="fas fa-chevron-right"></i>
            <span>Torta: {{ $cakeType->getNameCapitalized() }}</span>
        </header>
        <div class="page-content">
            <section>
                <h2 class="text-center">Dati</h2>
                <table class="table table-hover col-md-5 m-auto">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th scope="col"></th>
                            <th scope="col">Quantità</th>
                            <th scope="col">Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="pl-1">Fatte oggi</th>
                            <td class="text-center">{{ $cakeType->getQuantityOnSaleMadeToday() }}</td>
                            <td class="text-center"> {{ $cakeType->getPriceFormatted() }} €</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pl-1">Fatte ieri</th>
                            <td class="text-center">{{ $cakeType->getQuantityOnSaleMadeYesterday() }}</td>
                            <td class="text-center"> {{ $cakeType->getPriceFormatted(1) }} € </td>
                        </tr>
                        <tr>
                            <th scope="row" class="pl-1">Fatte due giorni fa</th>
                            <td class="text-center">{{ $cakeType->getQuantityOnSaleMadeTwoDaysAgo() }}</td>
                            <td class="text-center"> {{ $cakeType->getPriceFormatted(2) }} € </td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row" class="pl-1">Totale in vendita</th>
                            <td class="text-center">{{ $cakeType->getQuantityOnSale() }}</td>
                            <td class="text-center"></td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="page-content__show d-flex mt-3">
                <div class="page-content__show__igm-wrapper">
                    <img src="{{ asset('storage/' . $cakeType->image) }}" alt="{{ $cakeType->name }}">
                </div>
                <div class="page-content__show__table-wrapper">
                    <h2 class=text-center>Ingredienti</h2>
                    <table class="table table-hover col-md-2 m-auto">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">Ingrediente</th>
                                <th scope="col">Quantità</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cakeType->ingredients as $ingredient)
                                <tr>
                                    <th scope="row" class="pl-3">{{ $ingredient->name }}</th>
                                    <td class="text-right pr-3">{{ $ingredient->pivot->quantity }} g</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
