@extends('admin.layout.app')

@section('title', 'Criar novo ticket')

@section('content')
    <div class="bg-white" style="border-radius: 1rem; margin-top: 1rem;">
        <h3 style="text-align: center;">Novo ticket</h3>
    
        <div class="container">
            <form action="{{ route('tickets.creation') }}" method="post" enctype="multipart/form-data" class="row g-3">
                @include('admin.tickets._partials.form')
            </form>
        </div>
    </div>

@endsection