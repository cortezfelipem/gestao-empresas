<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Listar todas as tabelas
$tables = DB::select('SELECT name FROM sqlite_master WHERE type="table" ORDER BY name');
foreach($tables as $t){
    echo $t->name . PHP_EOL;
}
