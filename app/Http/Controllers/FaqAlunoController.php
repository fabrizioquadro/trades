<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqAlunoController extends Controller
{
    public function index(){
        $faqs = Faq::all()->sortBy('numero');
        $i=0;

        return view('acessoAluno/faq/index', compact('faqs','i'));
    }
}
