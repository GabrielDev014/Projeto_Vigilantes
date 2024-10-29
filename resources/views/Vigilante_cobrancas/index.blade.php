@extends("Vigilante_layout.index")
@section("vigilante_template")

<div class="container-fluid px-4">
    <h1 class="mt-4">Clientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lista de Clientes
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="" class = "btn btn-success"
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal">
                        Realizar Cobrança
                    </a>
                </div>
            </div>
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
                </thead>
                <tbody>
                    @foreach($clientes as $linha)
                        @foreach($linha->endereco as $endereco)
                            <tr>
                                <td>{{$linha->id}}</td>
                                <td>{{$linha->cliente_nome}}</td>
                                <td>{{$linha->cliente_celular}}</td>
                                <td>{{$linha->cliente_mensalidade}}</td>
                                <td>{{$linha->cliente_vencimento}}</td>
                                <td>{{$endereco->rua}}</td>
                                <td>{{$endereco->numero_casa}}</td>
                                <td>{{$endereco->cidade->cidade_nome}}</td>
                                <td>{{$endereco->cidade->estado->estado_nome}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method = "POST" action = "{{ route('enviar_cobranca') }}">
                    @csrf
                    <input type="hidden" name="vigilante_id" value="{{ Auth::user()->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selecione o dia do vencimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="cliente_vencimento" name = "cliente_vencimento" 
                            placeholder="Digite o nome do produto">
                            <label for="floatingInput">Dia do vencimento</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cobrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

