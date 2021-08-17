@extends('admin.layout.app')

@section('title', 'Editar Ticket')

@section('content')
<div class="bg-white container" style="border-radius: 1rem; margin-top: 1rem">
    <h3>Editar o Ticket: <strong>{{ $ticket->title }}</strong></h3>

    <div>
        <form action="{{ route('tickets.update', $ticket->id) }}" method="post" enctype="multipart/form-data" class="row g-3">
            @method('put')
            @include('admin.tickets._partials.form')
        </form>
    </div>
</div>
@endsection