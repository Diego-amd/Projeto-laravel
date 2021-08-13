@extends('admin.layout.app')

@section('title', 'Detalhes do ticket')

@section('content')
    <h3>Detalhes do ticket</h3>
    <div>
        <strong>Data de criação: </strong>{{ $ticket->created_at }}
    </div>
    <div>
        <ul>
            <label for="assunto">Assunto do ticket</label>
            <li name="assunto" id="assunto">{{ $ticket->title }}</li>
            <li><strong>Conteúdo: </strong>{{ $ticket->content }}</li>
            <li><strong>Categoria: </strong>{{ $ticket->category }}</li>
            <li><strong>Urgência: </strong>{{ $ticket->urgency }}</li>
            <li><strong>Imagem: </strong>
                <img src="{{ url("storage/{$ticket->image}") }}" alt="{{ $ticket->title }}" style="width:100px;">
            </li>
            <li><strong>status: </strong>{{ $ticket->status }}</li>
        </ul>
    </div>

    @if($ticket->status != 'Resolvido')
    <div class="row">
        <div class="col-3">
            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Apagar ticket {{ $ticket->title }}</button>
            </form>
        </div>
        <div class="col-2">
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-dark">Editar</a>
        </div>
    </div>
    @endif
@endsection