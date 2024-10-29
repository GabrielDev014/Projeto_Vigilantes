@extends('admin_layout.index')
@section('admin_template')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
        <p class="mb-4">Clientes cadastrados</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Vigilante Responsável</th>
                                <th>Cliente</th>
                                <th>Celular Cliente</th>
                                <th>Chat ID</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vigilantes as $vigilante)
                                @foreach ($vigilante->clientes as $cliente)
                                    <tr>
                                        <td>{{ $vigilante->name }}</td>
                                        <td>{{ $cliente->cliente_nome }}</td>
                                        <td>{{ $cliente->cliente_celular }}</td>
                                        <td>{{ $cliente->chat_id ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('adm_clientes_upd', ['id' => $cliente->id]) }}" class="btn btn-success mr-2">
                                                    <li class="fas fa-pencil-alt"></li>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
