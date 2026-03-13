<?php
// php scripts/fix_permissoes_mesafacil.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Permissões por perfil
$perfis = [
    'admin@mesafacil.demo' => [
        // Acesso total ao Mesa Fácil (+ USERMASTER no .env) 
        '/graficos','/mesas','/pedidos','/pedidos/controleComandas',
        '/controleCozinha/selecionar',
        '/deliveryCategoria','/deliveryProduto','/deliveryComplemento',
        '/tamanhosPizza','/pedidosDelivery','/pedidosDelivery/frente',
        '/clientesDelivery','/codigoDesconto','/bairrosDelivery',
        '/configDelivery','/funcionamentoDelivery',
        '/caixa','/contasPagar','/contasReceber','/fluxoCaixa',
        '/clientes','/categorias','/produtos',
        '/formasPagamento','/usuarios','/relatorios','/configNF','/tickets',
    ],
    'garcom@mesafacil.demo' => [
        // Garçom: mesas, pedidos, comanda, cozinha
        '/graficos','/mesas','/pedidos','/pedidos/controleComandas',
        '/controleCozinha/selecionar',
    ],
    'caixa@mesafacil.demo' => [
        // Caixa: tudo financeiro + mesas + clientes + categorias/produtos (consulta) + relatorios
        '/graficos','/mesas','/pedidos','/pedidos/controleComandas',
        '/caixa','/contasPagar','/contasReceber','/fluxoCaixa',
        '/clientes','/categorias','/produtos',
        '/formasPagamento','/relatorios',
    ],
    'cozinha@mesafacil.demo' => [
        // Cozinha: apenas controle KDS
        '/graficos','/controleCozinha/selecionar',
    ],
];

foreach($perfis as $login => $perms){
    $usuario = DB::table('usuarios')->where('login', $login)->first();
    if(!$usuario){
        echo "⚠️  Usuário não encontrado: $login\n";
        continue;
    }
    DB::table('usuarios')
        ->where('login', $login)
        ->update(['permissao' => json_encode($perms)]);
    echo "✅  $login → " . count($perms) . " permissões\n";
}

// Atualiza também a permissão da empresa
$empresa = DB::table('empresas')->where('email','demo@mesafacil.demo')->first();
if($empresa){
    $todosPerms = $perfis['admin@mesafacil.demo'];
    DB::table('empresas')
        ->where('id', $empresa->id)
        ->update(['permissao' => json_encode($todosPerms)]);
    echo "✅  Empresa MesaFacil Demo → " . count($todosPerms) . " permissões\n";
}

echo "\nFinalizado!\n";
