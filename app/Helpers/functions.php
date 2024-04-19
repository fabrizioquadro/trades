<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\AtivoCorretora;
use App\Models\Tag;
use App\Models\Mensagen;

if(!function_exists('defineCorTendenciaMatriz')){
    function defineCorTendenciaMatriz($data){
        switch ($data) {
            case 'Compra':
                $retorno = "style='background-color: #4472c4; color: #fff'";
                break;

            case 'Venda':
                $retorno = "style='background-color: #ff0000; color: #fff'";
                break;

            /*
            case 'Onda A':
                $retorno = "style='background-color: #ff0000; color: #fff'";
                break;

            case 'Onda B':
                $retorno = "style='background-color: #ffff00; color: #000'";
                break;

            case 'Onda C':
                $retorno = "style='background-color: #ffc000; color: #fff'";
                break;
            */
            case '+ Volume':
                $retorno = "style='background-color: #ff0000; color: #fff'";
                break;

            case '- Volume':
                $retorno = "style='background-color: #00b0f0; color: #fff'";
                break;

            case 'Subindo':
                $retorno = "style='background-color: #4472c4; color: #fff'";
                break;

            case 'Descendo':
                $retorno = "style='background-color: #ff0000; color: #fff'";
                break;

            case 'Divergência':
                $retorno = "style='background-color: #ed7d31; color: #fff'";
                break;

            case 'Trend Compra':
                $retorno = "style='background-color: #4472c4; color: #fff'";
                break;

            case 'Trend Venda':
                $retorno = "style='background-color: #ff0000; color: #fff'";
                break;

            default:
                $retorno = "#fff";
                $retorno = "style='background-color: #fff; color: #000'";
                break;
        }

        return $retorno;
    }
}

if(!function_exists('verificaMensagensAdm')){
    function verificaMensagensAdm(){
        $dados = [
            'stViewAdm' => 'Não',
        ];
        if(Mensagen::where($dados)->count() == 0){
            return false;
        }
        else{
            return true;
        }
    }
}

if(!function_exists('verificaMensagensAluno')){
    function verificaMensagensAluno(){
        $aluno = session()->get('aluno');
        $dados = [
            'id_aluno' => $aluno->id,
            'stViewAluno' => 'Não',
        ];
        if(Mensagen::where($dados)->count() == 0){
            return false;
        }
        else{
            return true;
        }
    }
}

if(!function_exists('buscaTagsStringAluno')){
    function buscaTagsStringAluno($id_aluno){
        $tags = Tag::buscaTagsAluno($id_aluno);
        $retorno = "";
        foreach ($tags as $tag){
            $retorno .= ",".$tag->nmTag;
        }
        return substr($retorno, 1);
    }
}

if(!function_exists('createPassword')){
    function createPassword($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $senha = "";
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);

    }
}


if(!function_exists('dataDbForm')){
    function dataDbForm($data){
        $data = explode("-", $data);
        $data = $data[2]."/".$data[1]."/".$data[0];
        return $data;
    }
}


if(!function_exists('dataFormDb')){
    function dataFormDb($data){
        $data = explode("/", $data);
        $data = $data[2]."-".$data[1]."-".$data[0];
        return $data;
    }
}


if(!function_exists('valorFormDb')){
    function valorFormDb($valor){
        //vamos procurar se foi digitado a ,
        $virgula = strpos($valor, ',');

        if($virgula === false){
            $valor = str_replace(".","",$valor);
            $valor = $valor.".00";
            return $valor;
        }

        $var = explode(',', $valor);
        $variavel = $var[1];
        $var = str_replace('.', '', $var[0]);
        $valor = $var.'.'.$variavel[0].$variavel[1];
        return $valor;
    }
}


if(!function_exists('valorDbForm')){
    function valorDbForm($valor){
        return number_format($valor,2,",",".");
    }
}


if(!function_exists('enviarMail')){
    function enviarMail($destinatario, $assunto, $mensagem){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->setLanguage('br');
            $mail->CharSet = "utf8";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tiojoca@webpel.dev.br';
            $mail->Password = 'P&dr0Quadr0';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->FromName = "Smart Money Makers";
            $mail->From = "tiojoca@webpel.dev.br";
            $mail->IsHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;
            $mail->AddAddress($destinatario);
            $mail->Send();
        }
        catch (Exception $e) {
            $this->errorInfo = $mail->ErrorInfo;
        }
    }
}

if(!function_exists('calculaTempoOperacao')){
      function calculaTempoOperacao($dtHrEntrada, $dtHrSaida){
          $tempoSegundo = strtotime($dtHrSaida) - strtotime($dtHrEntrada);
          $tempoHoras = intdiv($tempoSegundo, 3600);
          $resto = $tempoSegundo % 3600;

          if($resto > 60){
              $tempoMinutos = intdiv($resto, 60);
          }
          else{
              $tempoMinutos = 0;
          }

          $retorno = "";

          if($tempoHoras > 0){
              $retorno .= $tempoHoras." h ";
          }

          if($tempoMinutos > 0){
              $retorno .= $tempoMinutos." min";
          }

          return $retorno;

      }
}

if(!function_exists('calculaTempoTotal')){
      function calculaTempoTotal($tempoSegundo){
          $tempoHoras = intdiv($tempoSegundo, 3600);
          $resto = $tempoSegundo % 3600;

          if($resto > 60){
              $tempoMinutos = intdiv($resto, 60);
          }
          else{
              $tempoMinutos = 0;
          }

          $retorno = "";

          if($tempoHoras > 0){
              $retorno .= $tempoHoras." h ";
          }

          if($tempoMinutos > 0){
              $retorno .= $tempoMinutos." min";
          }

          return $retorno;

      }
}

if(!function_exists('testaCorretoraAtivo')){
    function testaCorretoraAtivo($id_ativo, $id_corretora){
        $dados = [
            'id_ativo' => $id_ativo,
            'id_corretora' => $id_corretora,
        ];
        if(AtivoCorretora::where($dados)->count() > 0){
            return true;
        }
        else{
            return false;
        }

    }
}

if(!function_exists('buscaPrefixoMoeda')){
    function buscaPrefixoMoeda($moeda){
        if($moeda == "BRL"){
            return "R$";
        }
        elseif($moeda == "USD"){
            return "US$";
        }
        elseif($moeda == "EUR"){
            return "€";
        }
        elseif($moeda == "GBP"){
            return "£";
        }
        elseif($moeda == "JPY"){
            return "¥$";
        }
    }
}

?>
