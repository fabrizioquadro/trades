<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMensagem;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::all()->sortBy('dtHrTicket');

        return view('tickets/index', compact('tickets'));
    }

    public function acessar($id){
        $ticket = Ticket::where('id', $id)->first();
        $ticket->stLidoAdm = 'Sim';
        $ticket->save();
        $mensagens = TicketMensagem::where('ticket_id', $ticket->id)->orderBy('dtHrMensagem')->get();

        return view('tickets/acessarTicket', compact('ticket','mensagens'));
    }

    public function adicionarMensagem(Request $request){
        $ticket = Ticket::where('id', $request->get('ticket_id'))->first();

        $dados = $request->all();
        $dados['dtHrMensagem'] = date('Y-m-d H:i:s');
        $dados['dsEmissor'] = 'Adm';

        TicketMensagem::create($dados);

        $ticket->stLidoAdm = 'Sim';
        $ticket->stLidoAluno = 'Não';

        $ticket->save();

        return redirect()->route('tickets.acessar', $ticket->id);
    }

    public function encerrarTicket($id){
        $ticket = Ticket::where('id', $id)->first();
        $ticket->stTicket = 'Encerrado';
        $ticket->save();

        return redirect()->route('tickets');
    }
}
