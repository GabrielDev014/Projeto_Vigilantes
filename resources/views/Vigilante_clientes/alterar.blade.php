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
            Alteração de Clientes
        </div>
        <div class="card-body">
            <form method="POST" action="/clientes/upd">
                @csrf
                <input type="hidden" name="vigilante_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                <input type="hidden" name="endereco_id" value="{{ $endereco->id }}">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="estado_id" id="estado_id"> 
                            <option selected value="{{ $endereco->cidade->estado->id }}">{{ $endereco->cidade->estado->estado_nome }}</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->estado_nome }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInput">Estado</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="cidade_id" id="cidade_id">
                            <option selected value="{{ $endereco->cidade->id }}">{{ $endereco->cidade->cidade_nome }}</option>
                            <!-- As opções de cidades serão carregadas dinamicamente com base no estado -->
                        </select>
                        <label for="floatingInput">Cidade</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cliente_nome" id="cliente_nome"
                            value="{{ $cliente->cliente_nome }}">
                        <label for="floatingInput">Nome do cliente</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cliente_celular" id="cliente_celular"
                            value="{{ $cliente->cliente_celular }}">
                        <label for="floatingInput">Celular</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cliente_mensalidade" id="cliente_mensalidade"
                            value="{{ $cliente->cliente_mensalidade }}">
                        <label for="floatingInput">Mensalidade</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cliente_vencimento" id="cliente_vencimento"
                            value="{{ $cliente->cliente_vencimento }}">
                        <label for="floatingInput">Vencimento</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="rua" id="rua"
                            value="{{ $endereco->rua }}">
                        <label for="floatingInput">Rua</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="bairro" id="bairro"
                            value="{{ $endereco->bairro }}">
                        <label for="floatingInput">Bairro</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="numero_casa" id="numero_casa"
                            value="{{ $endereco->numero_casa }}">
                        <label for="floatingInput">Número da residência</label>
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <a href="/clientes" class="btn btn-secondary me-2">Fechar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Função para carregar cidades com base no estado selecionado
        function carregarCidades(estadoId, cidadeSelecionadaId = null) {
            $.ajax({
                url: '/get-cidades/' + estadoId, // URL para buscar as cidades
                type: 'GET',
                success: function (response) {
                    // Limpa o select de cidades
                    $('#cidade_id').empty().append('<option value="">Selecione uma cidade</option>');

                    // Itera sobre as cidades retornadas e as adiciona no select
                    $.each(response.cidades, function (key, cidade) {
                        var selected = cidade.id == cidadeSelecionadaId ? 'selected' : '';
                        $('#cidade_id').append('<option value="' + cidade.id + '" ' + selected + '>' + cidade.cidade_nome + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Erro ao buscar cidades:', error);
                }
            });
        }

        // Carrega as cidades do estado selecionado ao carregar a página
        var estadoSelecionadoId = $('#estado_id').val(); // Estado já selecionado
        var cidadeSelecionadaId = '{{ $endereco->cidade->id }}'; // Cidade já selecionada
        carregarCidades(estadoSelecionadoId, cidadeSelecionadaId);

        // Quando o estado for alterado, busca as cidades para o novo estado
        $('#estado_id').on('change', function () {
            var estadoId = $(this).val(); // Pega o valor do estado selecionado
            carregarCidades(estadoId); // Carrega as cidades do novo estado
        });
    });
</script>



@endsection