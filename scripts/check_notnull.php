<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Check cities
$cids = DB::table('cidades')->select('id','nome','uf')->limit(3)->get();
echo "=== CIDADES ===\n";
foreach($cids as $c){ echo "ID:{$c->id} {$c->nome}/{$c->uf}\n"; }

// Check NOT NULL of delivery_configs
echo "\n=== delivery_configs NOT NULL ===\n";
$cols = DB::select("PRAGMA table_info(delivery_configs)");
foreach($cols as $c){ if($c->notnull) echo "  {$c->name} notnull={$c->notnull} default={$c->dflt_value}\n"; }

// Check plano_empresas
echo "\n=== plano_empresas NOT NULL ===\n";
$cols = DB::select("PRAGMA table_info(plano_empresas)");
foreach($cols as $c){ if($c->notnull) echo "  {$c->name} notnull={$c->notnull} default={$c->dflt_value}\n"; }
