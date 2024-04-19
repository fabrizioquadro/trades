<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Dompdf\Dompdf;
//use Dompdf\Options;

class ExportController extends Controller
{
    public function exportPdfOld(Request $request){
        $dados = $request->get('dados');
        $titulo = $request->get('titulo');

        $html = "
        <!doctype html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
            <style>
                .break { page-break-before: always; }
            </style>
        </head>
        <body>
            <div class='container mb-2'>
                <h5 class='mt-3 mb-3'>$titulo</h5>
                <p>Gerado em ".date('d/m/Y H:i:s')."</p>
                $dados
            </div>
        </body>
        <script>
            window.onload(
                print();
            );
        </script>
        </html>
        ";

        echo $html;

        //$options = new Options();
        //$options->set('defaultFont', 'Courier');
        //$options->set('isRemoteEnabled', true);
        //$dompdf = new Dompdf($options);
        //$dompdf->setPaper('A4', 'portrait');
        //$dompdf->loadHtml($html);
        //$dompdf->render();

        //$dompdf->stream("OnePageReport",["Attachment" => false]);

    }

    public function exportPdf(Request $request){
        $dados = $request->get('dados');
        $titulo = $request->get('titulo');

        return view('imprimir/index', compact('dados','titulo'));
    }
}
