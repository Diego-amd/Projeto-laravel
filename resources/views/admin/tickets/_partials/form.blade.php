@if ($errors->any())
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>  
        @endforeach
    </ul>
@endif

@csrf
<div class="col-12">
    <input type="text" name="title" id="title" placeholder="Assunto do ticket:" value="{{ $ticket->title ?? old('title') }}" class="form-control">
</div>
<div class="col-12">
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Escreva oque está acontecendo" class="form-control">{{ $ticket->content ?? old('content') }}</textarea>
</div>
<div class="col-md-6">
    <div class="col">
        <select name="category" id="category" class="form-select">
            <option value="">Escolha a categoria</option>
            <option value="Defeito">Defeito</option>
            <option value="Erro">Erro</option>
            <option value="Mudanca">Mudança</option>
            <option value="Configuracao">Configuração</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="col">
        <select name="urgency" id="urgency" class="form-select">
            <option value="">Defina a urgência</option>
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
            <option value="Gravissímo">Gravissímo</option>
        </select>
    </div>
</div>
<div>
    <input type="file" name="image" id="image" class="form-control" class="form-control">
</div>
<div class="col-md-3">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>
<div class="col-md-4">
    <select name="status" id="status" class="form-select">
        <option value="">Status do ticket</option>
        <option value="Aguardando departamento responsável">Aguardando departamento responsável</option>
        <option value="Atendimento">Em atendimento</option>
        <option value="Resolvido">Resolvido</option>
    </select>
</div>


