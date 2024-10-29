@extends('admin_layout.index')
@section('admin_template')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Altere ou Adicione os Chat IDs</h1>
        <div class="card-body">
            <form action="/adm_clientes/upd" method="POST">
                @csrf
                <input type="hidden" name="cliente_id" value="{{ $cliente->id }}"/>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome do Vigilante</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $cliente->vigilante->name }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cliente_nome">Nome do Cliente</label>
                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" value="{{ $cliente->cliente_nome }}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cliente_celular">Celular</label>
                        <input type="text" class="form-control" id="cliente_celular" name="cliente_celular" value="{{ $cliente->cliente_celular }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="chat_id">Chat ID</label>
                        <input type="text" class="form-control" id="chat_id" name="chat_id" value="{{ $cliente->chat_id }}">
                    </div>
                </div>
            
                <!-- Botões -->
                <div class="d-flex justify-content-center">
                    <a href="{{ route('adm_clientes_index') }}" class="btn btn-secondary mr-2">Fechar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>            
        </div>
    </div>
@endsection
