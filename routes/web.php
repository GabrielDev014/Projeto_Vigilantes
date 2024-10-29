<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EstadoInativoController;
use App\Http\Controllers\CidadeInativaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CobrancaController;
use App\Http\Controllers\AdminClienteController;
use App\Http\Controllers\ClienteInativoController;
use App\Http\Controllers\PerfilVigiaController;


Route::get('/admin/cadastro', [AdminAuthController::class, 'showRegisterForm'])->name('admin_cadastro');
Route::post('/admin/cadastro', [AdminAuthController::class, 'register']);

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin_login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/cadastro', [AuthController::class, 'formCadastroVigilante'])->name('cadastroVigilante');
Route::post('/cadastro', [AuthController::class, 'cadastroVigilante']);

Route::get('/login', [AuthController::class, 'formLoginVigilante'])->name('loginVigilante');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/clientes',[ClienteController::class, 'index'])->name('clientes_index');
    //Buscando cidades depois de ter selecionado o estado
    Route::get('/cidades/{estado_id}', [ClienteController::class, 'buscarCidades']);
    Route::post('/clientes', [ClienteController::class, 'salvarCliente'])->name('novo_cliente');
    Route::get('/clientes/upd/{id}/{endereco_id}', [ClienteController::class, 'formularioAlterar'])->name('cliente_upd');
    //Para o select dinâmico de alteração
    Route::get('/get-cidades/{estado_id}', [ClienteController::class, 'buscarCidadesAlteracao']);
    Route::post('/clientes/upd', [ClienteController::class, 'salvarAlteracaoCliente']);
    Route::get('/clientes/exc/{id}/{endereco_id}', [ClienteController::class, 'excluirCliente'])->name('cliente_exc');

    Route::get('/cobrar', [CobrancaController::class, 'index'])->name('cobrancaIndex');
    Route::post('/cobrar', [CobrancaController::class, 'enviarCobranca'])->name('enviar_cobranca');

    Route::get('/clientes/ativar',[ClienteInativoController::class, 'index'])->name('clientes_ativar_index');
    Route::post('/clientes/ativar/{id}/{endereco_id}', [ClienteInativoController::class, 'ativar'])->name('cliente_ativar');

    Route::get('/perfil', [PerfilVigiaController::class, 'index'])->name('vigilante_perfil');
    Route::post('/perfil', [PerfilVigiaController::class, 'salvarAlteracao'])->name('vigilante_perfil_alterar');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:admin')->group(function () {

    Route::get('/adm_index', function () {
        return view('admin_layout.index');
    });

    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');

    Route::get('/adm_estados',[EstadoController::class, 'index']);
    Route::get('/adm_estados/incluir', [EstadoController::class, 'BuscarInclusao'])->name('adm_estados.incluir');
    Route::post('/adm_estados/incluir', [EstadoController::class, 'ExecutaInclusao']);
    Route::get('/adm_estados/exc/{id}', [EstadoController::class, 'ExcluirEstado'])->name('adm_estados_ex');
    Route::get('/adm_estados/upd/{id}', [EstadoController::class, 'BuscarAlteracao'])->name('adm_estados_upd');
    Route::post('/adm_estados/upd', [EstadoController::class, 'ExecutaAlteracao']);

    Route::get('/adm_estados/inativos', [EstadoInativoController::class, 'index'])->name('adm_estados_inativos');
    Route::post('/adm_estados/ativar/{id}', [EstadoInativoController::class, 'ativar'])->name('adm_estados_ativar');

    Route::get('/adm_cidades',[CidadeController::class, 'index'])->name('adm_cidades_index');
    Route::get('/adm_cidades/incluir', [CidadeController::class, 'BuscarInclusao'])->name('adm_cidades.incluir');
    Route::post('/adm_cidades/incluir', [CidadeController::class, 'salvarNovaCidade']);
    Route::get('/adm_cidades/upd/{id}', [CidadeController::class, 'formularioAlterar'])->name('adm_cidades_upd');
    Route::post('/adm_cidades/upd', [CidadeController::class, 'salvarAlterarCidade']);
    Route::get('/adm_cidades/exc/{id}', [CidadeController::class, 'excluirCidade'])->name('adm_cidades_ex');

    Route::get('/adm_cidades/inativas', [CidadeInativaController::class, 'index'])->name('adm_cidades_inativas');
    Route::post('/adm_cidades/ativar/{id}', [CidadeInativaController::class, 'ativar'])->name('adm_cidades_ativar');

    Route::get('/adm_vigilantes',[VigilanteController::class, 'index'])->name('adm_vigilantes_index');
    Route::get('/adm_vigilantes/incluir', [VigilanteController::class, 'BuscarInclusao'])->name('adm_vigilantes.incluir');
    Route::post('/adm_vigilantes/incluir', [VigilanteController::class, 'salvarNovoVigilante']);
    Route::get('/adm_vigilantes/upd/{id}', [VigilanteController::class, 'BuscarAlteracao'])->name('adm_vigilantes_upd');
    Route::post('/adm_vigilantes/upd', [VigilanteController::class, 'ExecutaAlteracao']);
    Route::get('/adm_vigilantes/exc/{id}', [VigilanteController::class, 'ExcluirVigilante'])->name('adm_vigilantes_ex');

    Route::get('/adm_clientes',[AdminClienteController::class, 'index'])->name('adm_clientes_index');
    Route::get('/adm_clientes/upd/{id}', [AdminClienteController::class, 'formularioAlterar'])->name('adm_clientes_upd');
    Route::post('/adm_clientes/upd', [AdminClienteController::class, 'salvarAlterar']);

});




