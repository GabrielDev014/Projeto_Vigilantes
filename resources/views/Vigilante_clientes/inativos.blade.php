@extends('Vigilante_layout.index')
@section('vigilante_template')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Clientes Inativos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Inativos</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Lista de Clientes Desativados
            </div>

            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Celular</th>
                        <th>Mensalidade</th>
                        <th>Vencimento</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Opção</th>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $linha)
                            @foreach ($linha->endereco as $endereco)
                                <tr>
                                    <td>{{ $linha->id }}</td>
                                    <td>{{ $linha->cliente_nome }}</td>
                                    <td>{{ $linha->cliente_celular }}</td>
                                    <td>{{ $linha->cliente_mensalidade }}</td>
                                    <td>{{ $linha->cliente_vencimento }}</td>
                                    <td>{{ $endereco->rua }}</td>
                                    <td>{{ $endereco->numero_casa }}</td>
                                    <td>{{ $endereco->cidade->cidade_nome }}</td>
                                    <td>{{ $endereco->cidade->estado->estado_nome }}</td>
                                    <td>
                                        <form
                                            action='{{ route('cliente_ativar', ['id' => $linha->id, 'endereco_id' => $endereco->id]) }}'
                                            method="POST">
                                            @csrf
                                            <button type="submit" class='btn btn-success'>Ativar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
