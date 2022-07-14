<x-layout title="Séries">
    <a href="{{route('series.create')}}" class="btn btn-outline-dark mb-2">
        Adicionar
    </a>

    @isset($messageSuccess)
    <div class="alert alert-success">
        {{$messageSuccess}}
    </div>
    @endisset
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex align-items-center justify-content-between">
            {{ $serie->nome }}
            {{--Não é interessante ter um link com ações destrutivas já que pode ser
            acessado por crawlers de busca que vão performar ações destrutivas em nosso sistema.--}}
            <span class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-success btn-sm">
                    Editar
                </a>
                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>
