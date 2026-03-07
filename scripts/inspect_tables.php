<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = ['config_notas', 'empresas', 'usuarios', 'delivery_configs', 'mesas', 'forma_pagamentos', 'produto_deliveries', 'categoria_produto_deliveries', 'planos'];
foreach($tables as $t){
    echo "=== $t ===\n";
    $cols = DB::select("PRAGMA table_info($t)");
    foreach($cols as $c){
        echo "  {$c->name} ({$c->type})\n";
    }
    echo "\n";
}
