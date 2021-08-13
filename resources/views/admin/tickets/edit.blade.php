@extends('admin.layout.app')

@section('title', 'Editar Ticket')

@section('content')
    <h3>Editar o Ticket: <strong>{{ $ticket->title }}</strong></h3>

    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12 mx-auto">
        <form action="{{ route('tickets.update', $ticket->id) }}" method="post" enctype="multipart/form-data" class="row g-3">
            @method('put')
            @include('admin.tickets._partials.form')
        </form>
    </div>
@endsection