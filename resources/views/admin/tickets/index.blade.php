@extends('admin.layout.app')

@section('title', 'Listagem de tickets')

@section('content')
<div class="row" style="margin-top: 1rem;">
    <div class="col-4 bg-white" style="border-radius: 1rem; width: auto; height: 25%">
        <div class="d-flex flex-column align-items-center text-center">
            <img src="https://img.icons8.com/material-rounded/96/000000/user-male-circle.png" alt="Avatar" class="rounded-circle" width="150">
        </div>
        <div class="col-md-12" style="margin-top: 0;">
            <div class="mb-10">
                <div style="flex: 1 1 auto; min-height: 1px; padding: 1rem;">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Nome completo</h6>
                      </div>
                      <div class="col-sm-9 text-secondary" style="text-align: right">
                          {{ Auth::user()->name }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">E-mail</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                          {{ Auth::user()->email }}
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 bg-white" style="width: 70%; border-radius: 1rem; margin-left: auto;">
        <h3 style="text-align: center; padding: 2px; margin-top: 0.25rem;">Listagem de tickets</h3>
        <hr>
        
        @if(session('message'))
        <div class="p-3 mb-2 bg-light text-dark" style="border-radius: 0.25rem;">
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
                    <td>{{ date( 'd/m/Y' , strtotime($ticket->created_at))}}</td>
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