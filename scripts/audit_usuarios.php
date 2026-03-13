<?php
// php scripts/audit_usuarios.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$empresa = DB::table('empresas')->where('email','demo@mesafacil.demo')->first();
echo "=== Empresa: {$empresa->nome} (id={$empresa->id}) ===\n";
echo "Permissão empresa: " . $empresa->permissao . "\n\n";

$usuarios = DB::table('usuarios')->where('empresa_id', $empresa->id)->get();

foreach($usuarios as $u){
    $perms = json_decode($u->permissao, true) ?? [];
    echo "─────────────────────────────────────────\n";
    echo "Usuário : {$u->nome} ({$u->login})\n";
    echo "Rota inicial: " . ($u->rota_acesso ?: 'não definida') . "\n";
    echo "tipo_menu: {$u->tipo_menu}\n";
    echo "Permissões (" . count($perms) . "): " . implode(', ', $perms) . "\n";
}

echo "\n=== USERMASTER do .env ===\n";
echo getenv('USERMASTER') . "\n";
