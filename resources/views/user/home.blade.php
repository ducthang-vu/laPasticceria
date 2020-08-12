@extends('layouts.layout_base')

@section('main-content')
    <div class="container">
        <div class="head-section m-5">
            <h1>Bentornata {{  Auth::user()->name }}</h1>
            <p>Email: {{ Auth::user()->email }}</p>
        </div>
        <div class="instructions m-5">
            <h2>Istruzioni</h2>
            <p>Usa il menù di navigazione per usare il sito.</p>
            <ul>
                <li>
                    Premi <strong>Home</strong> per tornare a questa pagina.
                </li>
                <li>
                    Premi <strong>Esplora</strong> per vedere la parte pubblica del sito accessibile senza loggarsi.
                </li>
                <li>
                    Premi <strong>Ricettario</strong> per vedere tutte le ricette disponibili.
                    Potrai inoltre andare nella pagine di dettaglio delle singole ricette, creare o modificare una ricetta.
                    Nella pagina dei dettagli potrai vedere il numero di torte totali, fatte oggi, ieri o l'altroieri; e il prezzo relativo in base agli sconti previsti.
                    Puoi anche eliminare una ricetta, ma ciò comporterà l'eliminazione di tutte le torte attualmente registrate nell'invetario.
                </li>
                <li>
                    Usa l'<strong>Inventario</strong> per vedere le torte attualmente salvata nel database.
                    Le righe in giallo indicato le torte scadute che hai dimenticato di eliminare. Le torte scadute, comunque, non vengono computate nella pagina pubblica accessibili ai clienti.
                    Dall'inventario puoi creare o eliminare le torte.
                </li>
            </ul>
        </div>
    </div>
@endsection
