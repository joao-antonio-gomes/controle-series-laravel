@extends('layout')

@section('cabecalho')
    Episódios da Série {{$serie->nome}} - Temporada nº {{$temporada->numero}}
@endsection

@section('conteudo')

    @include('mensagens.success', ['mensagens.success' => $mensagem])

    <form action="/series/{{$serie->id}}/temporadas/{{$temporada->id}}/episodios/assistir" method="POST">
        @csrf
        @auth
            <button class="btn btn-primary mt-3">Salvar</button>
        @endauth
        <ul class="list-group">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Episódio {{ $episodio->numero }}</span>
                    <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}"
                           @if ($episodio->assistido) checked @endif @guest onclick="return false;" @endguest>
                </li>
            @endforeach
        </ul>
        @auth
            <button class="btn btn-primary mt-3">Salvar</button>
        @endauth
    </form>
@endsection
