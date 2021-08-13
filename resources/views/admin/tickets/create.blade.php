@extends('admin.layout.app')

@section('title', 'Criar novo ticket')

@section('content')
    <h3>Novo ticket</h3>

    <div>
        <form action="{{ route('tickets.creation') }}" method="post" enctype="multipart/form-data" class="row g-3">
            @include('admin.tickets._partials.form')
        </form>
    </div>

@endsection