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
use App\Http\Controllers\PlanTradeAlunoController;
use App\Http\Controllers\AtivoMercadoController;
use App\Http\Controllers\ProntuarioController;
use App\Http\Controllers\AgreementsController;
use App\Http\Controllers\MatrizDecisaoController;
use App\Http\Controllers\PlanTradeController;
use App\Http\Controllers\ConsistenceDiamondAlunoController;
use App\Http\Controllers\ConsistenceController;
use App\Http\Controllers\ConsistenceFaseController;
use App\Http\Controllers\TaskManagerAlunoController;
use App\Http\Controllers\KanbanAlunoController;
use App\Http\Controllers\ActionPlanAlunoController;
use App\Http\Controllers\FiltroAlunoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FiltroController;
use App\Http\Controllers\ActionPlanController;
use App\Http\Controllers\NotesAlunoController;

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

    Route::get('/filtroTempo/{tempo}/{redirect}', [FiltroController::class, 'filtroTempo'])->name('filtroTempo');

    Route::get('/filtro', [FiltroController::class, 'index'])->name('filtro');
    Route::post('/filtroTagAluno', [FiltroController::class, 'filtroTagAluno'])->name('filtroTagAluno');
    Route::get('/filtroLimpar/{redirect}', [FiltroController::class, 'limpar'])->name('filtroLimpar');

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
    Route::get('/alunosVisualizar/{id}', [AlunoController::class, 'visualizar'])->name('alunos.visualizar');
    Route::post('/alunosInsert', [AlunoController::class, 'insert'])->name('alunos.insert');
    Route::post('/alunosUpdate', [AlunoController::class, 'update'])->name('alunos.update');
    Route::post('/alunosDelete', [AlunoController::class, 'delete'])->name('alunos.delete');
    Route::post('/alunosAlterarSenhaUpdate', [AlunoController::class, 'alterarSenhaUpdate'])->name('alunos.alterarSenha.update');
    Route::get('/alunosPlanTrade/{id}', [AlunoController::class, 'planTrade'])->name('alunos.planTrade');
    Route::post('/alunosPlanTradeSet', [AlunoController::class, 'planTradeSet'])->name('alunos.planTrade.set');

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
    Route::get('/mensagensAluno/{id?}', [MensagemController::class, 'aluno'])->name('mensagens.aluno');
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
    Route::post('/resultadosAvaliar', [ResultadoController::class, 'avaliar'])->name('resultados.avaliar');
    Route::get('/resultadosBuscarAvaliacao', [ResultadoController::class, 'buscarAvaliacao'])->name('resultados.buscar.avaliacao');
    Route::post('/resultadosOnepageReport', [ResultadoController::class, 'onePageReport'])->name('resultados.onePageReport');
    Route::post('/resultadosExportarListaTrades', [ResultadoController::class, 'exportarListaTrades'])->name('resultados.exportarListaTrades');

    Route::get('/ativosMercado', [AtivoMercadoController::class, 'index'])->name('ativosMercado');
    Route::get('/ativosMercadoAdicionar', [AtivoMercadoController::class, 'adicionar'])->name('ativosMercado.adicionar');
    Route::get('/ativosMercadoExcluir/{id}', [AtivoMercadoController::class, 'excluir'])->name('ativosMercado.excluir');
    Route::post('/ativosMercadoInsert', [AtivoMercadoController::class, 'insert'])->name('ativosMercado.insert');
    Route::post('/ativosMercadoDelete', [AtivoMercadoController::class, 'delete'])->name('ativosMercado.delete');

    Route::get('/prontuarioTurma', [ProntuarioController::class, 'indexTurma'])->name('prontuarioTurma');
    Route::get('/prontuarioTurmaAdicionar', [ProntuarioController::class, 'turmaAdicionar'])->name('prontuarioTurma.adicionar');
    Route::get('/prontuarioTurmaEditar/{id}', [ProntuarioController::class, 'turmaEditar'])->name('prontuarioTurma.editar');
    Route::get('/prontuarioTurmaVisualizar/{id}', [ProntuarioController::class, 'turmaVisualizar'])->name('prontuarioTurma.visualizar');
    Route::get('/prontuarioTurmaExcluir/{id}', [ProntuarioController::class, 'turmaExcluir'])->name('prontuarioTurma.excluir');
    Route::post('/prontuarioTurmaInsert', [ProntuarioController::class, 'turmaInsert'])->name('prontuarioTurma.insert');
    Route::post('/prontuarioTurmaUpdate', [ProntuarioController::class, 'turmaUpdate'])->name('prontuarioTurma.update');
    Route::post('/prontuarioTurmaDelete', [ProntuarioController::class, 'turmaDelete'])->name('prontuarioTurma.delete');
    Route::get('/prontuarioAluno', [ProntuarioController::class, 'indexAluno'])->name('prontuarioAluno');
    Route::get('/prontuarioAlunoAdicionar', [ProntuarioController::class, 'alunoAdicionar'])->name('prontuarioAluno.adicionar');
    Route::post('/prontuarioAlunoInsert', [ProntuarioController::class, 'alunoInsert'])->name('prontuarioAluno.insert');
    Route::post('/prontuarioAlunoUpdate', [ProntuarioController::class, 'alunoUpdate'])->name('prontuarioAluno.update');
    Route::post('/prontuarioAlunoDelete', [ProntuarioController::class, 'alunoDelete'])->name('prontuarioAluno.delete');
    Route::get('/prontuarioAlunoEditar/{id}', [ProntuarioController::class, 'alunoEditar'])->name('prontuarioAluno.editar');
    Route::get('/prontuarioAlunoVisualizar/{id}', [ProntuarioController::class, 'alunoVisualizar'])->name('prontuarioAluno.visualizar');
    Route::get('/prontuarioAlunoExcluir/{id}', [ProntuarioController::class, 'alunoExcluir'])->name('prontuarioAluno.excluir');

    Route::get('/termosPrivacyPolicy', [AgreementsController::class, 'termosPrivacyPolicy'])->name('termosPrivacyPolicy');
    Route::post('/termosPrivacyPolicy/insert', [AgreementsController::class, 'termosPrivacyPolicyInsert'])->name('termosPrivacyPolicy.insert');
    Route::get('/cookiesPolicy', [AgreementsController::class, 'cookiesPolicy'])->name('cookiesPolicy');
    Route::post('/cookiesPolicy/insert', [AgreementsController::class, 'cookiesPolicyInsert'])->name('cookiesPolicy.insert');
    Route::get('/termsAndConditions', [AgreementsController::class, 'termsAndConditions'])->name('termsAndConditions');
    Route::post('/termsAndConditions/insert', [AgreementsController::class, 'termsAndConditionsInsert'])->name('termsAndConditions.insert');
    Route::get('/nonDisclosure', [AgreementsController::class, 'nonDisclosure'])->name('nonDisclosure');
    Route::post('/nonDisclosure/insert', [AgreementsController::class, 'nonDisclosureInsert'])->name('nonDisclosure.insert');
    Route::get('/riskWarning', [AgreementsController::class, 'riskWarning'])->name('riskWarning');
    Route::post('/riskWarning/insert', [AgreementsController::class, 'riskWarningInsert'])->name('riskWarning.insert');
    Route::get('/agreementsLogs', [AgreementsController::class, 'logs'])->name('agreements.logs');

    Route::any('/matrizDecisao', [MatrizDecisaoController::class, 'index'])->name('matrizDecisao');
    Route::any('/matrizDecisaoVisualizar/{id}', [MatrizDecisaoController::class, 'visualizar'])->name('matrizDecisao.visualizar');

    Route::any('/planTrade', [PlanTradeController::class, 'index'])->name('planTrade');
    Route::any('/planTradeVisualizar/{id}', [PlanTradeController::class, 'visualizar'])->name('planTrade.visualizar');

    Route::get('/consistenceRiskReward', [ConsistenceController::class, 'riskReward'])->name('consistence.riskReward');
    Route::get('/consistenceweeks', [ConsistenceController::class, 'weeks'])->name('consistence.weeks');
    Route::get('/consistencemonths', [ConsistenceController::class, 'months'])->name('consistence.months');
    Route::get('/consistencegainsLosses', [ConsistenceController::class, 'gainsLosses'])->name('consistence.gainsLosses');
    Route::get('/consistencetrades', [ConsistenceController::class, 'trades'])->name('consistence.trades');
    Route::post('/consistenceUpdate', [ConsistenceController::class, 'update'])->name('consistence.update');

    Route::any('/consistenceListar', [ConsistenceController::class, 'listar'])->name('consistence.listar');
    Route::get('/consistenceView/{id}', [ConsistenceController::class, 'visualizar'])->name('consistence.view');

    Route::get('/consistenceFases', [ConsistenceFaseController::class, 'index'])->name('consistenceFases');
    Route::get('/consistenceFasesAdicionar', [ConsistenceFaseController::class, 'adicionar'])->name('consistenceFases.adicionar');
    Route::get('/consistenceFasesEditar/{id}', [ConsistenceFaseController::class, 'editar'])->name('consistenceFases.editar');
    Route::get('/consistenceFasesExcluir/{id}', [ConsistenceFaseController::class, 'excluir'])->name('consistenceFases.excluir');
    Route::get('/consistenceFasesVisualizar/{id}', [ConsistenceFaseController::class, 'visualizar'])->name('consistenceFases.visualizar');
    Route::post('/consistenceFasesInsert', [ConsistenceFaseController::class, 'insert'])->name('consistenceFases.insert');
    Route::post('/consistenceFasesUpdate', [ConsistenceFaseController::class, 'update'])->name('consistenceFases.update');
    Route::post('/consistenceFasesDelete', [ConsistenceFaseController::class, 'delete'])->name('consistenceFases.delete');

    Route::get('/ticketsAcessar/{id?}', [TicketController::class, 'acessar'])->name('tickets.acessar');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
    Route::post('/ticketsAddMensagem', [TicketController::class, 'adicionarMensagem'])->name('tickets.addMensagem');
    Route::get('/ticketsEncerrarTicket/{id}', [TicketController::class, 'encerrarTicket'])->name('tickets.encerrarTicket');

    Route::get('/actionPlans', [ActionPlanController::class, 'index'])->name('actionPlan');
    Route::get('/actionPlansBuscar', [ActionPlanController::class, 'buscar'])->name('actionPlan.buscar');
    Route::post('/actionPlansUpdate', [ActionPlanController::class, 'update'])->name('actionPlan.update');
    Route::get('/actionPlanDelete', [ActionPlanController::class, 'delete'])->name('actionPlan.delete');
});

Route::get('/alunoIndex', [LoginAlunoController::class, 'index'])->name('aluno.index');
//Route::get('/alunoIndex', function(){ echo "Atualizando..."; });
Route::get('/alunoEsqueceuSenha', [LoginAlunoController::class, 'esqueceuSenha'])->name('aluno.esqueceuSenha');
Route::post('/alunoLogin', [LoginAlunoController::class, 'login'])->name('aluno.login');
Route::post('/alunoRecuperarSenha', [LoginAlunoController::class, 'recuperarSenha'])->name('aluno.recuperarSenha');
Route::get('/alunoLogout', [LoginAlunoController::class, 'logout'])->name('aluno.logout');

//---------------------------------------------------------------------------
Route::middleware('verificaloginaluno')->group(function(){
    Route::get('/alunoFiltro', [FiltroAlunoController::class, 'index'])->name('aluno.filtro');
    Route::get('/alunoFiltroLimpar/{redirect}', [FiltroAlunoController::class, 'limparFiltros'])->name('aluno.filtro.limpar');
    Route::post('/alunoFiltroSetar', [FiltroAlunoController::class, 'setarFiltros'])->name('aluno.filtro.setar');
    Route::get('/alunoFiltroTempo/{tempo}/{redirect}', [FiltroAlunoController::class, 'filtrarTempo'])->name('aluno.filtro.tempo');

    Route::get('/alunoAceitarTermosCumplice/{controle?}', [LoginAlunoController::class, 'aceitarTermosCumplice'])->name('aluno.aceitarTermosCumplice');
    Route::post('/alunoAceitarTermosCumpliceSet', [LoginAlunoController::class, 'aceitarTermosCumpliceSet'])->name('aluno.aceitarTermosCumpliceSet');
    Route::get('/alunoExcluirConta', [LoginAlunoController::class, 'excluirConta'])->name('aluno.excluirConta');
    Route::post('/alunoExcluirContaDelete', [LoginAlunoController::class, 'excluirContaDelete'])->name('aluno.excluirContaDelete');


    Route::any('/alunoDashboardMercadoStocks', [DashboardAlunoController::class, 'stocks'])->name('aluno.dashboard.mercado.stocks');
    Route::any('/alunoDashboardMercadoForex', [DashboardAlunoController::class, 'forex'])->name('aluno.dashboard.mercado.forex');
    Route::any('/alunoDashboardMercadoCryptos', [DashboardAlunoController::class, 'cryptos'])->name('aluno.dashboard.mercado.cryptos');
    Route::any('/alunoDashboardMercadoWorldIndexes', [DashboardAlunoController::class, 'worldIndex'])->name('aluno.dashboard.mercado.worldIndex');
    Route::any('/alunoDashboard', [DashboardAlunoController::class, 'index'])->name('aluno.dashboard');
    Route::post('/alunoSetarMoedaBase', [DashboardAlunoController::class, 'setarMoedaBase'])->name('aluno.setarMoedaBase');
    Route::post('/alunoSetarPorcentagemLucroPrejuizo', [DashboardAlunoController::class, 'setarPorcentagemLucroPrejuizo'])->name('aluno.setarPorcentagemLucroPrejuizo');
    Route::get('/alunoPerfil', [DashboardAlunoController::class, 'perfil'])->name('aluno.perfil');
    Route::post('/alunoPerfilUpdate', [DashboardAlunoController::class, 'perfilUpdate'])->name('aluno.perfil.update');
    Route::get('/alunoPerfilAlterarSenha', [DashboardAlunoController::class, 'alterarSenha'])->name('aluno.perfil.alterarSenha');
    Route::post('/alunoPerfilAlterarSenhaUpdate', [DashboardAlunoController::class, 'alterarSenhaUpdate'])->name('aluno.perfil.alterarSenha.update');
    Route::get('/alunoPerfilSettings', [DashboardAlunoController::class, 'settings'])->name('aluno.perfil.settings');

    Route::get('/alunoAtivos', [AtivoAlunoController::class, 'index'])->name('aluno.ativos');
    Route::get('/alunoAtivosVisualizar/{id?}', [AtivoAlunoController::class, 'visualizar'])->name('aluno.ativos.visualizar');
    Route::get('/alunoAtivosFavorito', [AtivoAlunoController::class, 'favorito'])->name('aluno.ativos.favorito');


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
    Route::get('/alunoTradesBuscaValorContratoAtivo', [TradeAlunoController::class, 'buscaValorContratoAtivo'])->name('aluno.trade.buscaValorContratoAtivo');
    Route::post('/alunoTradesInsert', [TradeAlunoController::class, 'insert'])->name('aluno.trades.insert');
    Route::post('/alunoTradesUpdate', [TradeAlunoController::class, 'update'])->name('aluno.trades.update');
    Route::get('/alunoTradesbuscar/{id}', [TradeAlunoController::class, 'buscar'])->name('aluno.trades.buscar');
    Route::get('/alunoTradesDelete/{id?}', [TradeAlunoController::class, 'delete'])->name('aluno.trades.delete');
    Route::get('/alunoTradesFiltroTempo/{tempo}', [TradeAlunoController::class, 'filtroTempo'])->name('aluno.trades.filtroTempo');


    Route::any('/alunoResultados', [ResultadoAlunoController::class, 'index'])->name('aluno.resultados');
    Route::post('/alunoResultadosOnePageReport', [ResultadoAlunoController::class, 'onePageReport'])->name('aluno.resultados.onePageReport');
    Route::get('/alunoLimparFiltros/{controle?}', [ResultadoAlunoController::class, 'limparFiltros'])->name('aluno.limparFiltros');
    Route::post('/alunoResultadosExportarListaTrades', [ResultadoAlunoController::class, 'exportarListaTrades'])->name('aluno.resultados.exportarListaTrades');
    Route::get('/alunoResultados/FiltroTempo/{tempo}', [ResultadoAlunoController::class, 'filtroTempo'])->name('aluno.resultados.onePageReportTempo');

    Route::get('/alunoFinanceiroExtratoConta', [FinanceiroAlunoController::class, 'extratoConta'])->name('aluno.financeiro.extratoConta');
    Route::post('/alunoFinanceiroExtratoContaGerar', [FinanceiroAlunoController::class, 'extratoContaGerar'])->name('aluno.financeiro.extratoConta.gerar');

    Route::get('/alunoFinanceiroResumoGlobal/{moeda?}', [FinanceiroAlunoController::class, 'resumoGlobal'])->name('aluno.financeiro.resumoGlobal');

    Route::get('/alunoMensagens', [MensagemAlunoController::class, 'index'])->name('aluno.mensagens');
    Route::post('/alunoMensagensInsert', [MensagemAlunoController::class, 'insert'])->name('aluno.mensagens.insert');

    Route::any('/alunoTutoriais', [TutorialAlunoController::class, 'index'])->name('aluno.tutoriais');

    Route::get('/alunoFaq', [FaqAlunoController::class, 'index'])->name('aluno.faq');
    Route::get('/alunoFaqTicketAdicionar', [FaqAlunoController::class, 'adicionatTicket'])->name('aluno.faq.ticket.adicionar');
    Route::post('/alunoFaqTicketInsert', [FaqAlunoController::class, 'insertTicket'])->name('aluno.faq.ticket.insert');
    Route::get('/alunoFaqTicketAcessar/{id?}', [FaqAlunoController::class, 'acessarTicket'])->name('aluno.faq.ticket.acessar');
    Route::post('/alunoFaqTicketAddMensagem', [FaqAlunoController::class, 'adicionarMensagemTicket'])->name('aluno.faq.ticket.addMensagem');
    Route::get('/alunoFaqTicketEncerrarTicket/{id}', [FaqAlunoController::class, 'encerrarTicket'])->name('aluno.faq.ticket.encerrarTicket');

    Route::get('/alunoMatrizDecisao/{id?}/{controle?}', [MatrizDecisaoAlunoController::class, 'index'])->name('aluno.matrizDecisao');
    Route::post('/alunoMatrizDecisaoInsert', [MatrizDecisaoAlunoController::class, 'insert'])->name('aluno.matrizDecisao.insert');
    Route::post('/alunoMatrizDecisaoUpdate', [MatrizDecisaoAlunoController::class, 'update'])->name('aluno.matrizDecisao.update');
    Route::get('/alunoMatrizDecisaoDelete/{id?}', [MatrizDecisaoAlunoController::class, 'delete'])->name('aluno.matrizDecisao.delete');

    Route::get('/alunoPlanTrade', [PlanTradeAlunoController::class, 'index'])->name('aluno.planTrade');
    Route::get('/alunoPlanTradeAdicionar', [PlanTradeAlunoController::class, 'adicionar'])->name('aluno.planTrade.adicionar');
    Route::post('/alunoPlanTradeInsert', [PlanTradeAlunoController::class, 'insert'])->name('aluno.planTrade.insert');
    Route::get('/alunoPlanTradeAcessar/{id?}', [PlanTradeAlunoController::class, 'acessar'])->name('aluno.planTrade.acessar');
    Route::post('/alunoPlanTradeLancar', [PlanTradeAlunoController::class, 'lancar'])->name('aluno.planTrade.lancar');
    Route::post('/alunoPlanTradeRecalcular', [PlanTradeAlunoController::class, 'recalcular'])->name('aluno.planTrade.recalcular');
    //Route::get('/alunoPlanTradeRecalcular/{id}', [PlanTradeAlunoController::class, 'recalcular'])->name('aluno.planTrade.recalcular');
    Route::get('/alunoPlanTradeBuscarLancado', [PlanTradeAlunoController::class, 'buscarLancado'])->name('aluno.planTrade.buscar.lancado');
    Route::get('/alunoPlanTradeExcluir/{id}', [PlanTradeAlunoController::class, 'excluir'])->name('aluno.planTrade.excluir');
    Route::post('/alunoPlanTradeDelete', [PlanTradeAlunoController::class, 'delete'])->name('aluno.planTrade.delete');

    Route::get('/alunoTermosPrivacyPolicy', [DashboardAlunoController::class, 'termosPrivacyPolicy'])->name('aluno.termosPrivacyPolicy');
    Route::get('/alunoCookiesPolicy', [DashboardAlunoController::class, 'cookiesPolicy'])->name('aluno.cookiesPolicy');
    Route::get('/alunoTermsAndConditions', [DashboardAlunoController::class, 'termsAndConditions'])->name('aluno.termsAndConditions');
    Route::get('/alunoNonDisclosure', [DashboardAlunoController::class, 'nonDisclosure'])->name('aluno.nonDisclosure');
    Route::get('/alunoRiskWarning', [DashboardAlunoController::class, 'riskWarning'])->name('aluno.riskWarning');

    Route::get('/alunoConsistence', [ConsistenceDiamondAlunoController::class, 'index'])->name('aluno.consistence');
    Route::get('/alunoConsistenceAdicionar', [ConsistenceDiamondAlunoController::class, 'adicionar'])->name('aluno.consistence.adicionar');
    Route::post('/alunoConsistenceInsert', [ConsistenceDiamondAlunoController::class, 'insert'])->name('aluno.consistence.insert');
    Route::get('/alunoConsistenceAcessar/{id?}', [ConsistenceDiamondAlunoController::class, 'acessar'])->name('aluno.consistence.acessar');
    Route::post('/alunoConsistenceUpdate', [ConsistenceDiamondAlunoController::class, 'update'])->name('aluno.consistence.update');
    Route::get('/alunoConsistenceExcluir/{id}', [ConsistenceDiamondAlunoController::class, 'excluir'])->name('aluno.consistence.excluir');
    Route::post('/alunoConsistenceDelete', [ConsistenceDiamondAlunoController::class, 'delete'])->name('aluno.consistence.delete');

    Route::any('/alunoTaskManager', [TaskManagerAlunoController::class, 'index'])->name('aluno.taskManager');
    Route::post('/alunoTaskManagerInsert', [TaskManagerAlunoController::class, 'insert'])->name('aluno.taskManager.insert');
    Route::get('/alunoTaskManagerBuscar', [TaskManagerAlunoController::class, 'buscar'])->name('aluno.taskManager.buscar');

    Route::get('/alunoKanban', [KanbanAlunoController::class, 'index'])->name('aluno.kanban');
    Route::post('/alunoKanbanInsert', [KanbanAlunoController::class, 'insert'])->name('aluno.kanban.insert');
    Route::get('/alunoKanbanBuscar', [KanbanAlunoController::class, 'buscar'])->name('aluno.kanban.buscar');
    Route::post('/alunoKanbanUpdate', [KanbanAlunoController::class, 'update'])->name('aluno.kanban.update');
    Route::get('/alunoKanbanDelete', [KanbanAlunoController::class, 'delete'])->name('aluno.kanban.excluir');
    Route::get('/alunoKanbanMudarDia', [KanbanAlunoController::class, 'mudarDia'])->name('aluno.kanban.mudar.dia');

    Route::get('/alunoActionPlan', [ActionPlanAlunoController::class, 'index'])->name('aluno.actionPlan');
    Route::post('/alunoActionPlanInsert', [ActionPlanAlunoController::class, 'insert'])->name('aluno.actionPlan.insert');
    Route::get('/alunoActionPlanBuscar', [ActionPlanAlunoController::class, 'buscar'])->name('aluno.actionPlan.buscar');
    Route::post('/alunoActionPlanUpdate', [ActionPlanAlunoController::class, 'update'])->name('aluno.actionPlan.update');
    Route::get('/alunoActionPlanDelete', [ActionPlanAlunoController::class, 'delete'])->name('aluno.actionPlan.delete');
    Route::get('/alunoActionPlanOrdenar', [ActionPlanAlunoController::class, 'ordenar'])->name('aluno.actionPlan.ordenar');

    Route::get('/alunoNotes', [NotesAlunoController::class , 'index'])->name('aluno.notes');
    Route::get('/alunoNotesAdicionar', [NotesAlunoController::class , 'adicionar'])->name('aluno.notes.adicionar');
    Route::post('/alunoNotesInsert', [NotesAlunoController::class , 'insert'])->name('aluno.notes.insert');
    Route::get('/alunoNotesEditar/{id?}', [NotesAlunoController::class , 'editar'])->name('aluno.notes.editar');
    Route::post('/alunoNotesUpdate', [NotesAlunoController::class , 'update'])->name('aluno.notes.update');
    Route::get('/alunoNotesDelete/{id}', [NotesAlunoController::class , 'delete'])->name('aluno.notes.delete');
});

Route::any('/exportarDadosPdf', [ExportController::class, 'exportPdf'])->name('exportarDadosPdf');
Route::get('/alunoConsistenceDetalhesFase', [ConsistenceDiamondAlunoController::class, 'detalhesFase'])->name('aluno.consistence.detalhesFase');
