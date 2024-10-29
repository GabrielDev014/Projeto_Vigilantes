@extends('admin_layout.index')
@section('admin_template')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cidades Inativas</h1>
        <p class="mb-4">Todas as cidades desativadas</p>       

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cidades Desativadas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Estado</th>
                            <th>Opções</th>
                        </thead>
                        <tbody>
                            @foreach ($cidades as $linha)
                                <tr>
                                    <td>{{ $linha->id }}</td>
                                    <td>{{ $linha->cidade_nome }}</td>
                                    <td>{{ $linha->estado->estado_nome }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('adm_cidades_ativar', ['id' => $linha->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success mr-2">Ativar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
