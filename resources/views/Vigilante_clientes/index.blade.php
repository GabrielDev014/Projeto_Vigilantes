@extends("Vigilante_layout.index")
@section("vigilante_template")

<div class="container-fluid px-4">
    <h1 class="mt-4">Clientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

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
                        Novo
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
                    <th>Opções</th>
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
                                <td>
                                    <a href='{{ route("cliente_upd", ["id" => $linha->id, "endereco_id" => $endereco->id]) }}' class='btn btn-success'>
                                        <li class='fa fa-pencil'></li>
                                    </a>                                                                      
                                    | 
                                    <a href='{{ route("cliente_exc", ["id" => $linha->id, "endereco_id" => $endereco->id]) }}' 
                                        class='btn btn-danger'
                                        onclick="return confirm('Você tem certeza de que deseja desativar este cliente?')">
                                         <li class='fa fa-trash'></li>
                                     </a>
                                       
                                </td>
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
                <form method = "POST" action = "{{route('novo_cliente')}}">
                    @csrf
                    <input type="hidden" name="vigilante_id" value="{{ Auth::user()->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <label for="inputEstado">Estado</label>
                        <select id="inputEstado" name="estado_id" class="form-select mb-4">
                            <option value="" selected>Selecione o estado...</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->estado_nome }}</option>
                            @endforeach
                        </select>

                        <label for="inputCidade">Cidade</label>
                        <select id="inputCidade" name="cidade_id" class="form-select mb-4">
                            <option value="" selected>Selecione a cidade...</option>
                        </select>
                    
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="cliente_nome" name = "cliente_nome" 
                            placeholder="Digite o nome do produto">
                            <label for="floatingInput">Nome do Cliente</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="cliente_celular" name = "cliente_celular" 
                            placeholder="Digite o nome da descrição">
                            <label for="floatingInput">Celular</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="mensalidade" name = "cliente_mensalidade" 
                            placeholder="Digite o nome da descrição">
                            <label for="floatingInput">Mensalidade</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vencimento" name = "cliente_vencimento" 
                            placeholder="Digite o nome da descrição">
                            <label for="floatingInput">Vencimento</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="rua" name = "rua" 
                            placeholder="Digite o nome da descrição">
                            <label for="floatingInput">Rua</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="bairro" name = "bairro" 
                            placeholder="Digite o nome da descrição">
                            <label for="floatingInput">Bairro - opcional</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numero_casa" name = "numero_casa" 
                            placeholder="Digite o nome da descrição">
                            <label for="floatingInput">Número da residência</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#inputEstado').on('change', function() {
            var estadoId = $(this).val();
            if(estadoId) {
                $.ajax({
                    url: '/cidades/' + estadoId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#inputCidade').empty();
                        $('#inputCidade').append('<option value="">Selecione a cidade...</option>');
                        $.each(data, function(key, cidade) {
                            $('#inputCidade').append('<option value="'+ cidade.id +'">'+ cidade.cidade_nome +'</option>');
                        });
                    }
                });
            } else {
                $('#inputCidade').empty();
                $('#inputCidade').append('<option value="">Selecione a cidade...</option>');
            }
        });
    });
</script>

@endsection

