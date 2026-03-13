<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $this->salvarErroLog($e);
        });
    }

    private function salvarErroLog(Throwable $e): void
    {
        try {
            $request = request();
            $session = session('user_logged');

            $entry = [
                'timestamp'   => now()->toDateTimeString(),
                'tipo'        => get_class($e),
                'mensagem'    => $e->getMessage(),
                'arquivo'     => str_replace(base_path(), '', $e->getFile()),
                'linha'       => $e->getLine(),
                'url'         => $request ? $request->fullUrl() : '-',
                'method'      => $request ? $request->method() : '-',
                'usuario_id'  => $session['id'] ?? null,
                'usuario'     => $session['nome'] ?? null,
                'empresa_id'  => $session['empresa'] ?? null,
                'ip'          => $request ? $request->ip() : '-',
            ];

            $logPath = storage_path('logs/erros_app.log');
            file_put_contents(
                $logPath,
                json_encode($entry, JSON_UNESCAPED_UNICODE) . PHP_EOL,
                FILE_APPEND | LOCK_EX
            );
        } catch (\Throwable $ignore) {
            // nunca deixar o log quebrar a app
        }
    }

    public function render($request, Throwable $exception)
    {
        if (!env('APP_DEBUG', false)) {
            if($request->ajax()){
                return "Erro";
            } else{
                return response()->view("errors.500");
            }
        } else {
            return parent::render($request, $exception);
        }
    }
}

