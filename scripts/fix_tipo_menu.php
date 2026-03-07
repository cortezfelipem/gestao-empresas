<?php
// php scripts/fix_tipo_menu.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Usuario;

// Atualiza usuarios com tipo_menu inválido (ex.: 0 ou vazio) para 'lateral'
$updated = Usuario::whereNull('tipo_menu')
    ->orWhere('tipo_menu', '')
    ->orWhere('tipo_menu', 0)
    ->orWhereRaw("tipo_menu NOT IN ('lateral','superior')")
    ->update(['tipo_menu' => 'lateral']);

echo "Atualizados: {$updated}\n";

$users = Usuario::all();
foreach($users as $u){
    echo "id={$u->id} login={$u->login} tipo_menu={$u->tipo_menu}\n";
}

echo "Pronto.\n";
