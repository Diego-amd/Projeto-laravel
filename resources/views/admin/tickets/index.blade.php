@extends('admin.layout.app')

@section('title', 'Listagem de tickets')

@section('content')
<div class="row">
    <div class="col-4" style="border: 1px solid red; border-radius: 1rem; width: auto">
        Usuário 2
    </div>
    <div class="col-6" style="border: 1px solid blue; width:auto; border-radius: 1rem; margin-left: auto;">
        <h3 style="text-align: center; padding: 2px; margin-top: 0.25rem;">Listagem de tickets</h3>
        
        @if(session('message'))
        <div class="container">
            {{ session('message') }}
        </div>
        @endif
        
        <table class="table">
            <thead class="thead-light">
                <th>Código</th>
                <th>Assunto</th>
                <th>Categoria</th>
                <th>Urgência</th>
                <th>Status</th>
                <th>Data criação</th>
            </thead>
            
            <tbody>
                @foreach ($tickets as $ticket)
                
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->category }}</td>
                    <td>{{ $ticket->urgency }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info">Visualizar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="btn-group" style="margin-left: 43%">
            <a href="{{ route('tickets.create') }}" class="btn btn-dark">Criar novo ticket</a>
        </div>
    </div>

</div>
@endsection