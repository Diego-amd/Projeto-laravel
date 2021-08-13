@extends('admin.layout.app')

@section('title', 'Detalhes do ticket')

@section('content')
    <div class="row bg-white" style="border-radius: 1rem; margin-top: 1rem">
        <div class="col" style="display: flex; justify-content: center;">
            <h3 style="margin-left: 40%;">Detalhes do ticket</h3>
            <div class="col" style="text-align: right;">
                <strong>Data de criação: </strong>{{ date( 'd/m/Y' , strtotime($ticket->created_at))}}
            </div>
        </div>
        <div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Assunto do ticket: </strong>{{ $ticket->title }}</li>
                <li class="list-group-item"><strong>Conteúdo: </strong>{{ $ticket->content }}</li>
                <li class="list-group-item"><strong>Categoria: </strong>{{ $ticket->category }}</li>
                <li class="list-group-item"><strong>Urgência: </strong>{{ $ticket->urgency }}</li>
                <li class="list-group-item"><strong>Imagem: </strong><br>
                    <img src="{{ url("storage/{$ticket->image}") }}" alt="{{ $ticket->title }}" style="width: 300px;">
                </li>
                <li class="list-group-item"><strong>status: </strong>{{ $ticket->status }}</li>
            </ul>
        </div>
    
        @if($ticket->status != 'Resolvido')
        <div class="row" style="margin-top: 1rem;">
            <div class="col-3">
                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Apagar ticket {{ $ticket->title }}</button>
                </form>
            </div>
            <!-- <div class="col-2">
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-dark">Editar</a>
            </div> -->
        </div>
        @endif
    </div>
@endsection