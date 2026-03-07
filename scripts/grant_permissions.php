<?php
// Uso: php scripts/grant_permissions.php usuario
require __DIR__ . '/../vendor/autoload.php';

// carrega laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Usuario;

$login = $argv[1] ?? 'usuario';

$u = Usuario::where('login', $login)->first();
if(!$u){
    echo "Usuário '$login' não encontrado\n";
    exit(1);
}

// permissões de exemplo — ajuste conforme necessário
$perms = [
    '/categorias',
    '/produtos',
    '/clientes',
    '/vendas',
    '/caixa'
];

$u->permissao = json_encode($perms);
$u->save();

echo "Permissões atribuídas para user '{$u->login}': " . implode(', ', $perms) . "\n";
