<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body style="background-color: #e2e8f0">
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a class="nav-link" href="{{ route('tickets.index') }}">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('tickets.create') }}">Criar novo ticket</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('tickets.statistics') }}">Estatísticas</a>
                </li>
            </ul>
            <form action="{{ route('tickets.search') }}" method="post">
            @csrf
            <div class="bg-light input-group" style="float: right">
                <input type="text" name="search" placeholder="Procurar por: assunto, categoria, urgência ou status" class="form-control">
                <button type="submit" class="btn btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            </form>
        </div>
    </nav>
    

    <div class="container">
        @yield('content')
    </div>

    
</body>
</html>