<?php
// php scripts/test_seed_produtos.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$empresaId = DB::table('empresas')->where('email','demo@mesafacil.demo')->value('id');
echo "Empresa ID: $empresaId\n";

$getCatGeral = function($nome) use ($empresaId){
    $id = DB::table('categorias')
        ->where('empresa_id', $empresaId)
        ->where('nome', $nome)
        ->value('id');
    echo "  cat geral '$nome' = $id\n";
    return $id;
};

$getCatDelivery = function($nome) use ($empresaId){
    return DB::table('categoria_produto_deliveries')
        ->where('empresa_id', $empresaId)
        ->where('nome', $nome)
        ->value('id');
};

$produtos = [
    ['cat' => 'Entradas', 'nome' => 'Porção de Batata Frita',   'desc' => 'Batata frita crocante (300g)', 'valor' => 22.90],
    ['cat' => 'Entradas', 'nome' => 'Porção de Mandioca Frita', 'desc' => 'Mandioca frita com manteiga', 'valor' => 20.90],
    ['cat' => 'Entradas', 'nome' => 'Bolinho de Queijo (6 un)', 'desc' => 'Bolinhos de queijo crocantes', 'valor' => 18.90],
    ['cat' => 'Lanches',  'nome' => 'X-Burguer Clássico',       'desc' => 'Hambúrguer, queijo, alface e tomate', 'valor' => 28.90],
    ['cat' => 'Lanches',  'nome' => 'X-Bacon Especial',         'desc' => 'Hambúrguer duplo, bacon e queijo cheddar', 'valor' => 36.90],
    ['cat' => 'Lanches',  'nome' => 'X-Frango Grelhado',        'desc' => 'Frango grelhado, queijo e molho especial', 'valor' => 26.90],
    ['cat' => 'Pratos',   'nome' => 'Frango à Parmegiana',      'desc' => 'Frango empanado com molho de tomate', 'valor' => 42.90],
    ['cat' => 'Pratos',   'nome' => 'Filé à Pimenta',           'desc' => 'Filé mignon ao molho de pimenta', 'valor' => 64.90],
    ['cat' => 'Pratos',   'nome' => 'Risoto de Camarão',        'desc' => 'Risoto cremoso com camarão', 'valor' => 58.90],
    ['cat' => 'Pizzas',   'nome' => 'Pizza Margherita',         'desc' => 'Molho de tomate, muçarela e manjericão', 'valor' => 45.90],
    ['cat' => 'Pizzas',   'nome' => 'Pizza Calabresa',          'desc' => 'Calabresa fatiada, cebola e azeitona', 'valor' => 48.90],
    ['cat' => 'Pizzas',   'nome' => 'Pizza Portuguesa',         'desc' => 'Presunto, ovos, ervilha e cebola', 'valor' => 52.90],
    ['cat' => 'Bebidas',  'nome' => 'Refrigerante Lata',        'desc' => 'Coca-Cola, Guaraná, Sprite (350ml)', 'valor' => 7.00],
    ['cat' => 'Bebidas',  'nome' => 'Suco Natural',             'desc' => 'Laranja, limão ou maracujá', 'valor' => 12.00],
    ['cat' => 'Bebidas',  'nome' => 'Água Mineral',             'desc' => 'Sem gás ou com gás (500ml)', 'valor' => 5.00],
    ['cat' => 'Bebidas',  'nome' => 'Cerveja Long Neck',        'desc' => 'Skol, Brahma ou Itaipava (355ml)', 'valor' => 10.00],
    ['cat' => 'Sobremesas','nome'=> 'Pudim de Leite',           'desc' => 'Pudim caseiro com calda de caramelo', 'valor' => 14.90],
    ['cat' => 'Sobremesas','nome'=> 'Petit Gâteau',             'desc' => 'Bolo quente de chocolate com sorvete', 'valor' => 22.90],
];

$now = now()->toDateTimeString();

foreach($produtos as $p){
    try {
        $catGeralId   = $getCatGeral($p['cat']);
        $catDeliverId = $getCatDelivery($p['cat']);

        DB::table('produtos')->updateOrInsert(
            ['empresa_id' => $empresaId, 'nome' => $p['nome']],
            [
                'empresa_id'                => $empresaId,
                'categoria_id'              => $catGeralId,
                'nome'                      => $p['nome'],
                'cor'                       => '',
                'valor_venda'               => $p['valor'],
                'valor_compra'              => 0,
                'unidade_compra'            => 'UN',
                'unidade_venda'             => 'UN',
                'valor_livre'               => 0,
                'cListServ'                 => '',
                'CFOP_saida_estadual'       => '',
                'CFOP_saida_inter_estadual' => '',
                'codigo_anp'               => '',
                'descricao_anp'             => '',
                'imagem'                    => '',
                'alerta_vencimento'         => 0,
                'gerenciar_estoque'         => 0,
                'inativo'                   => 0,
                'created_at'                => $now,
                'updated_at'                => $now,
            ]
        );

        $produtoId = DB::table('produtos')
            ->where('empresa_id', $empresaId)
            ->where('nome', $p['nome'])
            ->value('id');
        echo "  produto_id=$produtoId catDeliverId=$catDeliverId\n";

        DB::table('produto_deliveries')->updateOrInsert(
            ['empresa_id' => $empresaId, 'produto_id' => $produtoId],
            [
                'empresa_id'    => $empresaId,
                'produto_id'    => $produtoId,
                'categoria_id'  => $catDeliverId,
                'descricao'     => $p['desc'],
                'ingredientes'  => '',
                'valor'         => $p['valor'],
                'valor_anterior'=> 0,
                'status'        => 1,
                'destaque'      => 0,
                'limite_diario' => 0,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]
        );

        echo "  ✅ {$p['nome']}\n";
    } catch (\Throwable $e) {
        echo "  ❌ {$p['nome']}: " . $e->getMessage() . "\n";
        echo "  SQL: " . (method_exists($e,'getSql') ? $e->getSql() : 'n/a') . "\n";
        break;
    }
}
echo "Pronto.\n";
