@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')

    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif

    <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{$serie->id}}">{{ $serie->nome }}</span>
                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <div class="d-flex">
                    @auth
                        <button class="btn btn-info btn-sm" onclick="toggleInput({{ $serie->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endauth
                    <a class="btn-info btn-sm ml-2" href="/series/{{$serie->id}}/temporadas">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @auth
                        <form method="post" action="/series/{{ $serie->id }}" class="ml-2"
                              onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    @endauth
                </div>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(id) {
            const divInput = document.getElementById(`input-nome-serie-${id}`);
            const nomeSerie = document.getElementById(`nome-serie-${id}`);
            if (divInput.hasAttribute('hidden')) {
                divInput.removeAttribute('hidden');
                nomeSerie.hidden = true;
                return;
            }
            divInput.setAttribute('hidden', 'hidden');
            nomeSerie.hidden = false;
        }

        function editarSerie(id) {
            const inputValue = document.querySelector(`#input-nome-serie-${id} > input`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            const endpoint = `/series/${id}/editaNome`;

            let formData = new FormData();
            formData.append('nome', inputValue);
            formData.append('_token', token);

            fetch(endpoint, {
                method: 'POST',
                body: formData,

            }).then((res) => {
                if (res.status === 200) {
                    document.getElementById(`nome-serie-${id}`).textContent = inputValue;
                    toggleInput(id);
                }
            });
        }
    </script>
@endsection
