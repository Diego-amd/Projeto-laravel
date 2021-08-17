@extends('admin.layout.app')

@section('title', 'Estatísticas')

@section('content')
<div class="row bg-white" style="border-radius: 1rem; margin-top: 1rem">
    <h3 style="text-align: center;">Tempos do clockify</h3>

    <div class="col">
        @foreach($descricao as $desc)
            <strong>Descrição: </strong>{{ $desc }}<hr>
        @endforeach
    </div>
    <div class="col">
        @foreach ($time as $times)
            <strong>Tempo de duração: </strong>{{ $times->duration }}<hr>
        @endforeach
    </div>
    

    <!-- <table class="table">
        <tbody>
            <tr>
                @foreach ($descricao as $desc)
                <td><strong>Descrição: </strong>{{ $desc }}</td>
                @endforeach
            </tr>
            <tr>
                @foreach ($time as $times)
                <td><strong>Tempo de duração: </strong>{{ $times->duration }}</td>
                @endforeach
            </tr>
        </tbody>
    </table> -->
</div>
@endsection

