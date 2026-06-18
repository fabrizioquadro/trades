<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Ticket;
use App\Models\TicketMensagem;

class FaqAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');
        $faqs = Faq::all()->sortBy('numero');
        $i=0;

        $tickets = Ticket::where('aluno_id', $aluno->id)->orderByDesc('dtHrTicket')->get();
        return view('acessoAluno/faq/index', compact('faqs','i','tickets'));
    }

    public function adicionatTicket(){
        return view('acessoAluno/faq/adicionarTicket');
    }

    public function insertTicket(Request $request){
        $aluno = session()->get('aluno');
        $dados = $request->except('_token');
        $dados['aluno_id'] = $aluno->id;
        $dados['dtHrTicket'] = date('Y-m-d H:i:s');
        $dados['stTicket'] = 'Aberto';
        $dados['stLidoAdm'] = 'Não';
        $dados['stLidoAluno'] = 'Sim';

        Ticket::create($dados);
        return redirect()->route('aluno.faq');
    }

    public function acessarTicket($id = null){
        $ticket = Ticket::where('id', $id)->first();
        $ticket->stLidoAluno = 'Sim';
        $ticket->save();
        $mensagens = TicketMensagem::where('ticket_id', $ticket->id)->orderBy('dtHrMensagem')->get();

        return view('acessoAluno/faq/acessarTicket', compact('ticket','mensagens'));
    }

    public function adicionarMensagemTicket(Request $request){
        $ticket = Ticket::where('id', $request->get('ticket_id'))->first();

        $dados = $request->all();
        $dados['dtHrMensagem'] = date('Y-m-d H:i:s');
        $dados['dsEmissor'] = 'Aluno';

        TicketMensagem::create($dados);

        $ticket->stLidoAdm = 'Não';
        $ticket->stLidoAluno = 'Sim';

        $ticket->save();

        return redirect()->route('aluno.faq.ticket.acessar', $ticket->id);
    }

    public function encerrarTicket($id){
        $ticket = Ticket::where('id', $id)->first();
        $ticket->stTicket = 'Encerrado';
        $ticket->save();

        return redirect()->route('aluno.faq');
    }
}
