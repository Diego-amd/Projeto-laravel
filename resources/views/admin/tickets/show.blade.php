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
    <hr>

    @if($ticket->status != 'Resolvido')
    <div class="row" style="margin-top: 1rem; margin-bottom: 1rem;">
        <div class="col" style="text-align: center;">
            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Apagar ticket {{ $ticket->title }}</button>
            </form>
        </div>
        <div class="col" style="text-align: center;">
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-dark">Editar</a>
        </div>
        <div class="col" style="text-align: center;">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#horasClockify" id="btn-modal">
                Adicionar horas
            </button>
            <!-- Modal -->
            <div class="modal fade" id="horasClockify" tabindex="-1" aria-labelledby="horasClockify" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="horasClockify">Horas ao Clockify</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('tickets.start') }}" method="post" class="form-row">
                                @csrf
                                <div class="row" style="padding: 0.75rem;">
                                    <div class="col">
                                        <label for="description">Descrição</label>
                                        <input type="text" class="form-control" name="description" id="description" value="{{ $ticket->id.' - '.$ticket->title }}" placeholder="Descrição do tempo no clockify">
                                    </div>
                                </div>
                                <div class="row" style="padding: 0.75rem;">
                                    <div class="col">
                                        <label for="initialDate">Data que começou: </label>
                                        <input type="date" name="initialDate" id="initialDate" class="form-control-plaintext bg-light">
                                    </div>
                                    <div class="col">
                                        <label for="initialTime">Hora que começou: </label>
                                        <input type="time" name="initialTime" id="initialTime" class="form-control-plaintext bg-light">
                                    </div>
                                </div>
                                <div class="row" style="padding: 0.75rem;">
                                    <div class="col">
                                        <label for="finalDate">Data que terminou: </label>
                                        <input type="date" name="finalDate" id="finalDate" class="form-control-plaintext bg-light">
                                    </div>
                                    <div class="col">
                                        <label for="finalTime">Hora que terminou: </label>
                                        <input type="time" name="finalTime" id="finalTime" class="form-control-plaintext bg-light">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <input type="hidden" name="_method" value="POST">
                            <button type="submit" class="btn btn-info">Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection