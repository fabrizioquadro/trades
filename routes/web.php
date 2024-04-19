<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CorretoraController;
use App\Http\Controllers\AtivoController;
use App\Http\Controllers\LoginAlunoController;
use App\Http\Controllers\DashboardAlunoController;
use App\Http\Controllers\ContaAlunoController;
use App\Http\Controllers\TradeAlunoController;
use App\Http\Controllers\ResultadoAlunoController;
use App\Http\Controllers\FinanceiroAlunoController;
use App\Http\Controllers\AtivoAlunoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MensagemAlunoController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\TutorialAlunoController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqAlunoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MatrizDecisaoAlunoController;
use App\Http\Controllers\ResultadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::get('/teste', [LoginController::class, 'teste']);
//Route::get('/', function(){ echo "Atualizando..."; });
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/esqueceuSenha', [LoginController::class, 'esqueceuSenha'])->name('esqueceuSenha');
Route::post('/recuperarSenha', [LoginController::class, 'recuperarSenha'])->name('recuperarSenha');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//link para impressão

Route::middleware(['auth'])->group(function () {
    Route::any('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perfil', [DashboardController::class, 'perfil'])->name('perfil');
    Route::get('/perfilAlterarSenha', [DashboardController::class, 'alterarSenha'])->name('perfil.alterarSenha');
    Route::post('/perfilUpdate', [DashboardController::class, 'perfilUpdate'])->name('perfil.update');
    Route::post('/perfilAlterarSenhaUpdate', [DashboardController::class, 'updatePassword'])->name('perfil.alterarSenha.update');
    Route::get('/filtroTagsAlunos', [DashboardController::class, 'filtroTagsAlunos'])->name('filtroTagsAlunos');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
    Route::get('/usuariosAdicionar', [UserController::class, 'adicionar'])->name('usuarios.adicionar');
    Route::get('/usuariosEditar/{id}', [UserController::class, 'editar'])->name('usuarios.editar');
    Route::get('/usuariosExcluir/{id}', [UserController::class, 'excluir'])->name('usuarios.excluir');
    Route::get('/usuariosVisualizar/{id}', [UserController::class, 'visualizar'])->name('usuarios.visualizar');
    Route::get('/usuariosAlterarSenha/{id}', [UserController::class, 'alterarSenha'])->name('usuarios.alterarSenha');
    Route::post('/usuariosInsert', [UserController::class, 'insert'])->name('usuarios.insert');
    Route::post('/usuariosUpdate', [UserController::class, 'update'])->name('usuarios.update');
    Route::post('/usuariosDelete', [UserController::class, 'delete'])->name('usuarios.delete');
    Route::post('/usuariosAlterarSenhaUpdate', [UserController::class, 'updateSenha'])->name('usuarios.alterarSenha.update');

    Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos');
    Route::get('/alunosAdicionar', [AlunoController::class, 'adicionar'])->name('alunos.adicionar');
    Route::get('/alunosEditar/{id}', [AlunoController::class, 'editar'])->name('alunos.editar');
    Route::get('/alunosExcluir/{id}', [AlunoController::class, 'excluir'])->name('alunos.excluir');
    Route::get('/alunosAlterarSenha/{id}', [AlunoController::class, 'alterarSenha'])->name('alunos.alterarSenha');
    Route::post('/alunosInsert', [AlunoController::class, 'insert'])->name('alunos.insert');
    Route::post('/alunosUpdate', [AlunoController::class, 'update'])->name('alunos.update');
    Route::post('/alunosDelete', [AlunoController::class, 'delete'])->name('alunos.delete');
    Route::post('/alunosAlterarSenhaUpdate', [AlunoController::class, 'alterarSenhaUpdate'])->name('alunos.alterarSenha.update');

    Route::get('/corretoras', [CorretoraController::class, 'index'])->name('corretoras');
    Route::get('/corretorasAdicionar', [CorretoraController::class, 'adicionar'])->name('corretoras.adicionar');
    Route::get('/corretorasEditar/{id}', [CorretoraController::class, 'editar'])->name('corretoras.editar');
    Route::get('/corretorasExcluir/{id}', [CorretoraController::class, 'excluir'])->name('corretoras.excluir');
    Route::post('/corretorasInsert', [CorretoraController::class, 'insert'])->name('corretoras.insert');
    Route::post('/corretorasUpdate', [CorretoraController::class, 'update'])->name('corretoras.update');
    Route::post('/corretorasDelete', [CorretoraController::class, 'delete'])->name('corretoras.delete');

    Route::get('/ativos', [AtivoController::class, 'index'])->name('ativos');
    Route::get('/ativosAdicionar', [AtivoController::class, 'adicionar'])->name('ativos.adicionar');
    Route::get('/ativosEditar/{id}', [AtivoController::class, 'editar'])->name('ativos.editar');
    Route::get('/ativosExcluir/{id}', [AtivoController::class, 'excluir'])->name('ativos.excluir');
    Route::get('/ativosVisualizar/{id}', [AtivoController::class, 'visualizar'])->name('ativos.visualizar');
    Route::post('/ativosInsert', [AtivoController::class, 'insert'])->name('ativos.insert');
    Route::post('/ativosUpdate', [AtivoController::class, 'update'])->name('ativos.update');
    Route::post('/ativosDelete', [AtivoController::class, 'delete'])->name('ativos.delete');
    Route::get('/ativosImportar', [AtivoController::class, 'importar'])->name('ativos.importar');
    Route::post('/ativosImportarInsert', [AtivoController::class, 'importarInsert'])->name('ativos.importar.insert');

    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::get('/tagsAdicionar', [TagController::class, 'adicionar'])->name('tags.adicionar');
    Route::get('/tagsEditar/{id}', [TagController::class, 'editar'])->name('tags.editar');
    Route::get('/tagsExcluir/{id}', [TagController::class, 'excluir'])->name('tags.excluir');
    Route::post('/tagsInsert', [TagController::class, 'insert'])->name('tags.insert');
    Route::post('/tagsUpdate', [TagController::class, 'update'])->name('tags.update');
    Route::post('/tagsDelete', [TagController::class, 'delete'])->name('tags.delete');

    Route::get('/mensagens', [MensagemController::class, 'index'])->name('mensagens');
    Route::get('/mensagensAluno/{id}', [MensagemController::class, 'aluno'])->name('mensagens.aluno');
    Route::post('/mensagensAlunoInsert', [MensagemController::class, 'insert'])->name('mensagens.aluno.insert');

    Route::get('/tutoriais', [TutorialController::class, 'index'])->name('tutoriais');
    Route::get('/tutoriaisAdicionar', [TutorialController::class, 'adicionar'])->name('tutoriais.adicionar');
    Route::get('/tutoriaisEditar/{id}', [TutorialController::class, 'editar'])->name('tutoriais.editar');
    Route::get('/tutoriaisExcluir/{id}', [TutorialController::class, 'excluir'])->name('tutoriais.excluir');
    Route::post('/tutoriaisInsert', [TutorialController::class, 'insert'])->name('tutoriais.insert');
    Route::post('/tutoriaisUpdate', [TutorialController::class, 'update'])->name('tutoriais.update');
    Route::post('/tutoriaisDelete', [TutorialController::class, 'delete'])->name('tutoriais.delete');

    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/faqAdicionar', [FaqController::class, 'adicionar'])->name('faq.adicionar');
    Route::get('/faqEditar/{id}', [FaqController::class, 'editar'])->name('faq.editar');
    Route::get('/faqExcluir/{id}', [FaqController::class, 'excluir'])->name('faq.excluir');
    Route::get('/faqVisaulizar/{id}', [FaqController::class, 'visualizar'])->name('faq.visualizar');
    Route::post('/faqInsert', [FaqController::class, 'insert'])->name('faq.insert');
    Route::post('/faqUpdate', [FaqController::class, 'update'])->name('faq.update');
    Route::post('/faqDelete', [FaqController::class, 'delete'])->name('faq.delete');
    Route::get('/faqOrdenaSequencia', [FaqController::class, 'ordenaSequencia'])->name('faq.ordenar');

    Route::any('/resultados', [ResultadoController::class, 'index'])->name('resultados');
    Route::post('/resultadosOnepageReport', [ResultadoController::class, 'onePageReport'])->name('resultados.onePageReport');
    Route::post('/resultadosExportarListaTrades', [ResultadoController::class, 'exportarListaTrades'])->name('resultados.exportarListaTrades');
});

Route::get('/alunoIndex', [LoginAlunoController::class, 'index'])->name('aluno.index');
//Route::get('/alunoIndex', function(){ echo "Atualizando..."; });
Route::get('/alunoEsqueceuSenha', [LoginAlunoController::class, 'esqueceuSenha'])->name('aluno.esqueceuSenha');
Route::post('/alunoLogin', [LoginAlunoController::class, 'login'])->name('aluno.login');
Route::post('/alunoRecuperarSenha', [LoginAlunoController::class, 'recuperarSenha'])->name('aluno.recuperarSenha');
Route::get('/alunoLogout', [LoginAlunoController::class, 'logout'])->name('aluno.logout');

//---------------------------------------------------------------------------
Route::middleware('verificaloginaluno')->group(function(){
    Route::any('/alunoDashboard', [DashboardAlunoController::class, 'index'])->name('aluno.dashboard');
    Route::post('/alunoSetarMoedaBase', [DashboardAlunoController::class, 'setarMoedaBase'])->name('aluno.setarMoedaBase');
    Route::post('/alunoSetarPorcentagemLucroPrejuizo', [DashboardAlunoController::class, 'setarPorcentagemLucroPrejuizo'])->name('aluno.setarPorcentagemLucroPrejuizo');
    Route::get('/alunoPerfil', [DashboardAlunoController::class, 'perfil'])->name('aluno.perfil');
    Route::post('/alunoPerfilUpdate', [DashboardAlunoController::class, 'perfilUpdate'])->name('aluno.perfil.update');
    Route::get('/alunoPerfilAlterarSenha', [DashboardAlunoController::class, 'alterarSenha'])->name('aluno.perfil.alterarSenha');
    Route::post('/alunoPerfilAlterarSenhaUpdate', [DashboardAlunoController::class, 'alterarSenhaUpdate'])->name('aluno.perfil.alterarSenha.update');
    Route::get('/alunoPerfilSettings', [DashboardAlunoController::class, 'settings'])->name('aluno.perfil.settings');

    Route::get('/alunoAtivos', [AtivoAlunoController::class, 'index'])->name('aluno.ativos');
    Route::get('/alunoAtivosVisualizar/{id}', [AtivoAlunoController::class, 'visualizar'])->name('aluno.ativos.visualizar');


    Route::get('/alunoContas', [ContaAlunoController::class, 'index'])->name('aluno.contas');
    Route::get('/alunoContasAdicionar', [ContaAlunoController::class, 'adicionar'])->name('aluno.contas.adicionar');
    Route::get('/alunoContasEditar/{id}', [ContaAlunoController::class, 'editar'])->name('aluno.contas.editar');
    Route::get('/alunoContasExcluir/{id}', [ContaAlunoController::class, 'excluir'])->name('aluno.contas.excluir');
    Route::post('/alunoContasInsert', [ContaAlunoController::class, 'insert'])->name('aluno.contas.insert');
    Route::post('/alunoContasUpdate', [ContaAlunoController::class, 'update'])->name('aluno.contas.update');
    Route::post('/alunoContasDelete', [ContaAlunoController::class, 'delete'])->name('aluno.contas.delete');
    Route::get('/alunoContasDeposito/{id}', [ContaAlunoController::class, 'depositos'])->name('aluno.contas.deposito');
    Route::get('/alunoContasDepositoAdicionar/{id}', [ContaAlunoController::class, 'depositosAdicionar'])->name('aluno.contas.deposito.adicionar');
    Route::get('/alunoContasDepositoExcluir/{id}', [ContaAlunoController::class, 'depositosExcluir'])->name('aluno.contas.deposito.excluir');
    Route::post('/alunoContasDepositoInsert', [ContaAlunoController::class, 'depositosInsert'])->name('aluno.contas.deposito.insert');
    Route::post('/alunoContasDepositoDelete', [ContaAlunoController::class, 'depositosDelete'])->name('aluno.contas.deposito.delete');
    Route::get('/alunoContasSaque/{id}', [ContaAlunoController::class, 'saques'])->name('aluno.contas.saque');
    Route::get('/alunoContasSaqueAdicionar/{id}', [ContaAlunoController::class, 'saquesAdicionar'])->name('aluno.contas.saque.adicionar');
    Route::get('/alunoContasSaqueExcluir/{id}', [ContaAlunoController::class, 'saquesExcluir'])->name('aluno.contas.saque.excluir');
    Route::post('/alunoContasSaqueInsert', [ContaAlunoController::class, 'saquesInsert'])->name('aluno.contas.saque.insert');
    Route::post('/alunoContasSaqueDelete', [ContaAlunoController::class, 'saquesDelete'])->name('aluno.contas.saque.delete');


    Route::any('/alunoTrades', [TradeAlunoController::class, 'index'])->name('aluno.trades');
    Route::get('/alunoTradesBuscaAtivosCorretora', [TradeAlunoController::class, 'buscaAtivosCorretora'])->name('aluno.trade.buscaAtivosCorretora');
    Route::post('/alunoTradesInsert', [TradeAlunoController::class, 'insert'])->name('aluno.trades.insert');
    Route::post('/alunoTradesUpdate', [TradeAlunoController::class, 'update'])->name('aluno.trades.update');
    Route::get('/alunoTradesbuscar/{id}', [TradeAlunoController::class, 'buscar'])->name('aluno.trades.buscar');
    Route::get('/alunoTradesDelete/{id?}', [TradeAlunoController::class, 'delete'])->name('aluno.trades.delete');


    Route::any('/alunoResultados', [ResultadoAlunoController::class, 'index'])->name('aluno.resultados');
    Route::post('/alunoResultadosOnePageReport', [ResultadoAlunoController::class, 'onePageReport'])->name('aluno.resultados.onePageReport');
    Route::get('/alunoLimparFiltros/{controle?}', [ResultadoAlunoController::class, 'limparFiltros'])->name('aluno.limparFiltros');
    Route::post('/alunoResultadosExportarListaTrades', [ResultadoAlunoController::class, 'exportarListaTrades'])->name('aluno.resultados.exportarListaTrades');

    Route::get('/alunoFinanceiroExtratoConta', [FinanceiroAlunoController::class, 'extratoConta'])->name('aluno.financeiro.extratoConta');
    Route::post('/alunoFinanceiroExtratoContaGerar', [FinanceiroAlunoController::class, 'extratoContaGerar'])->name('aluno.financeiro.extratoConta.gerar');

    Route::get('/alunoFinanceiroResumoGlobal', [FinanceiroAlunoController::class, 'resumoGlobal'])->name('aluno.financeiro.resumoGlobal');

    Route::get('/alunoMensagens', [MensagemAlunoController::class, 'index'])->name('aluno.mensagens');
    Route::post('/alunoMensagensInsert', [MensagemAlunoController::class, 'insert'])->name('aluno.mensagens.insert');

    Route::any('/alunoTutoriais', [TutorialAlunoController::class, 'index'])->name('aluno.tutoriais');

    Route::get('/alunoFaq', [FaqAlunoController::class, 'index'])->name('aluno.faq');

    Route::get('/alunoMatrizDecisao/{id?}/{controle?}', [MatrizDecisaoAlunoController::class, 'index'])->name('aluno.matrizDecisao');
    Route::post('/alunoMatrizDecisaoInsert', [MatrizDecisaoAlunoController::class, 'insert'])->name('aluno.matrizDecisao.insert');
    Route::post('/alunoMatrizDecisaoUpdate', [MatrizDecisaoAlunoController::class, 'update'])->name('aluno.matrizDecisao.update');
    Route::get('/alunoMatrizDecisaoDelete/{id?}', [MatrizDecisaoAlunoController::class, 'delete'])->name('aluno.matrizDecisao.delete');
});

Route::any('/exportarDadosPdf', [ExportController::class, 'exportPdf'])->name('exportarDadosPdf');
