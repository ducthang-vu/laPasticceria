@extends('layouts.layout_base')

@section('main-content')
    <div class="user-cakes-index-page container">
        <h1 class="page-title col-md-8 m-auto text-center mb-5">
            <span>Inventario: torte</span>
            <a class="btn btn-success" href="{{ Route('user.cakes.create') }}" role="button">Nuove torte</a>
        </h1>
        <p class="col-md-8 m-auto">I righi in giallo rappresentano torte scadute. Considera di rimooverli dall'invetario</p>
        <table class="table table-hover col-md-8 m-auto mt-2">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Tipo</th>
                    <th scope="col" class="text-center">Prodotto il</th>
                    <th scope="col" class="text-center">Prezzo</th>
                    <th scope="col" class="text-center">Elimina</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cakes as $cake)
                    <tr class="table-row @if($cake->isWasted()) wasted  @endif">
                        <th scope="row" class="text-center">{{ $cake->id }}</th>
                        <th scope="row" class="text-center">
                            <a href="{{ route('user.cake_type.id', $cake->cake_type_id) }}">{{ $cake->getType() }}
                            </a>
                        </th>
                        <td class="text-center">{{ Carbon\Carbon::parse($cake->created_at)->format('d/m/Y h:m') }}</td>
                        <td class="text-right pr-5">{{ $cake->getPrice() }} €</td>
                        <td class="text-center">
                            <form action="{{ route('user.cakes.destroy', $cake->id) }}" method="POST">
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
