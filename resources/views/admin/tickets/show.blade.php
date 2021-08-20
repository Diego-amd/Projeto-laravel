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
            <li class="list-group-item"><strong>Status: </strong>{{ $ticket->status }}</li>
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
        <div class="col-2">
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-dark">Editar</a>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>
        </div>
    </div>
    @endif
    <!-- <hr> -->
    <br>
    <br>
    <br>
    <hr>
    <div class="p-3 mb-2">
        <h3>Horas Clockify</h3>
        <form action="{{ route('tickets.start') }}" method="post" class="form-row">
            @csrf
            <div class="row" style="margin-bottom: 0.25rem;">
                <div class="col-4">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ $ticket->id.' - '.$ticket->title }}" placeholder="Descrição do tempo no clockify">
                </div>
            </div>
            <div class="row" style="margin-bottom: 0.25rem;">
                <div class="col-4">
                    <label for="date">Data que começou: </label>
                    <input type="date" name="initialDate" id="initialDate">
                </div>
                <div class="col-4" style="margin-bottom: 0.25rem;">
                    <label for="time">Hora que começou: </label>
                    <input type="time" name="initialTime" id="initialTime">
                </div>
            </div>
            <div class="row" style="margin-bottom: 0.25rem;">
                <div class="col-4">
                    <label for="date">Data que terminou: </label>
                    <input type="date" name="finalDate" id="finalDate">
                </div>
                <div class="col-4" style="margin-bottom: 0.25rem;">
                    <label for="time">Hora que terminou: </label>
                    <input type="time" name="finalTime" id="finalTime">
                </div>
            </div>

            <input type="hidden" name="_method" value="POST">
            <button type="submit" class="btn btn-info">Adicionar horas</button>
        </form>
    </div>
</div>
@endsection