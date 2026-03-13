<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrosAppController extends Controller
{
    public function index(Request $request)
    {
        // Apenas super usuários podem ver os erros
        $session = session('user_logged');
        if (!$session || !$session['super']) {
            return redirect('/error');
        }

        $logPath = storage_path('logs/erros_app.log');
        $erros   = [];

        if (file_exists($logPath)) {
            $linhas = array_filter(explode(PHP_EOL, file_get_contents($logPath)));
            foreach (array_reverse($linhas) as $linha) {
                $decoded = json_decode($linha, true);
                if ($decoded) {
                    $erros[] = $decoded;
                }
            }
        }

        // Filtros
        $busca = $request->get('busca', '');
        if ($busca) {
            $erros = array_filter($erros, function ($e) use ($busca) {
                return stripos($e['mensagem'] ?? '', $busca) !== false
                    || stripos($e['url'] ?? '', $busca) !== false
                    || stripos($e['tipo'] ?? '', $busca) !== false;
            });
        }

        $total  = count($erros);
        $erros  = array_slice(array_values($erros), 0, 200); // máx 200

        return view('erros_app.index', compact('erros', 'total', 'busca'));
    }

    public function limpar()
    {
        $session = session('user_logged');
        if (!$session || !$session['super']) {
            return redirect('/error');
        }

        $logPath = storage_path('logs/erros_app.log');
        if (file_exists($logPath)) {
            file_put_contents($logPath, '');
        }

        return redirect('/erros')->with('msg', 'Log de erros limpo com sucesso.');
    }
}
