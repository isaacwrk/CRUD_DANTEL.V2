@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Produto</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <label>Whoops!</label> Algo não funcionou corretamente.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" value="{{ $project->nome }}" class="form-control" placeholder="nome">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>CPF:</label>
                    <textarea class="form-control cpf" name="cpf"
                        placeholder="cpf">{{ $project->cpf }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Data de Nacimento:</label>
                    <input type="date" name="data_nascimento" class="form-control"
                        value="{{ $project->data_nascimento }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control" required>
                        <option value="M" {{ ($project->sexo === 'M') ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ ($project->sexo === 'F') ? 'selected' : '' }}>Feminino</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>

    </form>
@endsection