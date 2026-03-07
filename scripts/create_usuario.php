<?php
// php scripts/create_usuario.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Usuario;

$login = $argv[1] ?? 'usuario';
$senha = $argv[2] ?? '123';
$nome = $argv[3] ?? 'Usuário Teste';

// company id default 1
$empresaId = 1;

$u = Usuario::where('login', $login)->first();
if($u){
    echo "Usuário '$login' já existe (id={$u->id}).\n";
    exit(0);
}

$perms = [
    '/categorias',
    '/produtos',
    '/clientes',
    '/vendas',
    '/caixa'
];

$new = Usuario::create([
    'nome' => $nome,
    'login' => $login,
    'senha' => md5($senha),
    'adm' => 0,
    'ativo' => 1,
    'empresa_id' => $empresaId,
    'permissao' => json_encode($perms),
    'email' => $login . '@local',
    'somente_fiscal' => 0,
    'rota_acesso' => '',
    'caixa_livre' => 0,
    'permite_desconto' => 0,
    'tipo_menu' => 0
]);

if($new){
    echo "Criado usuário '{$login}' id={$new->id} senha={$senha}\n";
}else{
    echo "Falha ao criar usuário\n";
}
