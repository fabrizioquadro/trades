<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreements;
use App\Models\LogAceiteTermos;

class AgreementsController extends Controller
{
    public function termosPrivacyPolicy(){
        $agreements = Agreements::where('id',1)->first();

        return view('agreements/termosPrivacyPolicy', compact('agreements'));
    }

    public function cookiesPolicy(){
        $agreements = Agreements::where('id',1)->first();

        return view('agreements/cookiesPolicy', compact('agreements'));
    }

    public function termsAndConditions(){
        $agreements = Agreements::where('id',1)->first();

        return view('agreements/termsAndConditions', compact('agreements'));
    }

    public function nonDisclosure(){
        $agreements = Agreements::where('id',1)->first();

        return view('agreements/nonDisclosure', compact('agreements'));
    }

    public function riskWarning(){
        $agreements = Agreements::where('id',1)->first();

        return view('agreements/riskWarning', compact('agreements'));
    }

    public function termosPrivacyPolicyInsert(Request $request){
        $dados = [
            'termosPrivacyPolicy' => $request->get('termosPrivacyPolicy'),
        ];

        if(Agreements::all()->count() > 0){
            Agreements::where('id', 1)->update($dados);
        }
        else{
            Agreements::create($dados);
        }

        //vamos setar todos os alunos para ter que aceitar essa alterarção
        $dados = [
            'aceitePrivacyPolice' => false,
            'dataPrivacyPolice' => null,
        ];

        \DB::table('alunos')->update($dados);

        return redirect()->route('termosPrivacyPolicy');
    }

    public function cookiesPolicyInsert(Request $request){
        $dados = [
            'cookiesPolicy' => $request->get('cookiesPolicy'),
        ];

        if(Agreements::all()->count() > 0){
            Agreements::where('id', 1)->update($dados);
        }
        else{
            Agreements::create($dados);
        }

        //vamos setar todos os alunos para ter que aceitar essa alterarção
        $dados = [
            'aceiteCookiesPolice' => false,
            'dataCookiesPolice' => null,
        ];

        \DB::table('alunos')->update($dados);

        return redirect()->route('cookiesPolicy');
    }

    public function termsAndConditionsInsert(Request $request){
        $dados = [
            'termsAndConditions' => $request->get('termsAndConditions'),
        ];

        if(Agreements::all()->count() > 0){
            Agreements::where('id', 1)->update($dados);
        }
        else{
            Agreements::create($dados);
        }

        //vamos setar todos os alunos para ter que aceitar essa alterarção
        $dados = [
            'aceiteTermsAndConditions' => false,
            'dataTermsAndConditions' => null,
        ];

        \DB::table('alunos')->update($dados);

        return redirect()->route('termsAndConditions');
    }

    public function nonDisclosureInsert(Request $request){
        $dados = [
            'nonDisclosure' => $request->get('nonDisclosure'),
        ];

        if(Agreements::all()->count() > 0){
            Agreements::where('id', 1)->update($dados);
        }
        else{
            Agreements::create($dados);
        }

        //vamos setar todos os alunos para ter que aceitar essa alterarção
        $dados = [
            'aceiteNonDisclosure' => false,
            'dataNonDisclosure' => null,
        ];

        \DB::table('alunos')->update($dados);

        return redirect()->route('nonDisclosure');
    }

    public function riskWarningInsert(Request $request){
        $dados = [
            'riskWarning' => $request->get('riskWarning'),
        ];

        if(Agreements::all()->count() > 0){
            Agreements::where('id', 1)->update($dados);
        }
        else{
            Agreements::create($dados);
        }

        //vamos setar todos os alunos para ter que aceitar essa alterarção
        $dados = [
            'aceiteRiskWarning' => false,
            'dataRiskWarning' => null,
        ];

        \DB::table('alunos')->update($dados);

        return redirect()->route('riskWarning');
    }

    public function logs(){
        $logs = LogAceiteTermos::all();

        return view('agreements/logs', compact('logs'));
    }
}
