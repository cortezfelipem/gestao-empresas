<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== EMPRESAS ===\n";
$empresas = DB::table('empresas')->select('id','nome','email','status')->get();
foreach($empresas as $e){
    echo "ID: {$e->id} | Nome: {$e->nome} | Email: {$e->email} | Status: {$e->status}\n";
}

echo "\n=== USUÁRIOS ===\n";
$usuarios = DB::table('usuarios')->select('id','nome','login','empresa_id','adm','ativo')->get();
foreach($usuarios as $u){
    echo "ID: {$u->id} | Nome: {$u->nome} | Login: {$u->login} | EmpID: {$u->empresa_id} | Adm: {$u->adm}\n";
}

echo "\n=== PLANOS ===\n";
$planos = DB::table('planos')->get();
foreach($planos as $p){
    echo "ID: {$p->id} | Nome: {$p->nome}\n";
}

echo "\n=== PLANO_EMPRESAS ===\n";
$pes = DB::table('plano_empresas')->get();
foreach($pes as $pe){
    echo "ID: {$pe->id} | Empresa: {$pe->empresa_id} | Plano: {$pe->plano_id} | Exp: {$pe->expiracao}\n";
}

echo "\n=== MESAS ===\n";
$mesas = DB::table('mesas')->select('id','nome','empresa_id','status')->limit(10)->get();
foreach($mesas as $m){
    echo "ID: {$m->id} | Nome: {$m->nome} | EmpID: {$m->empresa_id} | Status: {$m->status}\n";
}

echo "\n=== PEDIDOS (últimos 5) ===\n";
$pedidos = DB::table('pedidos')->select('id','empresa_id','status','created_at')->orderBy('id','desc')->limit(5)->get();
foreach($pedidos as $p){
    echo "ID: {$p->id} | EmpID: {$p->empresa_id} | Status: {$p->status} | Data: {$p->created_at}\n";
}

echo "\n=== CATEGORIAS (primeiras 10) ===\n";
$cats = DB::table('categorias')->select('id','nome','empresa_id')->limit(10)->get();
foreach($cats as $c){
    echo "ID: {$c->id} | Nome: {$c->nome} | EmpID: {$c->empresa_id}\n";
}

echo "\n=== PRODUTOS (primeiros 10) ===\n";
$prods = DB::table('produtos')->select('id','nome','empresa_id','preco','ativo')->limit(10)->get();
foreach($prods as $p){
    echo "ID: {$p->id} | Nome: {$p->nome} | EmpID: {$p->empresa_id} | Preço: {$p->preco}\n";
}

echo "\n=== DELIVERY_CONFIGS ===\n";
$dcs = DB::table('delivery_configs')->select('id','empresa_id','nome')->limit(5)->get();
foreach($dcs as $dc){
    echo "ID: {$dc->id} | EmpID: {$dc->empresa_id} | Nome: {$dc->nome}\n";
}

echo "\n=== FORMA_PAGAMENTOS (primeiras 5) ===\n";
$fps = DB::table('forma_pagamentos')->select('id','nome','empresa_id')->limit(5)->get();
foreach($fps as $fp){
    echo "ID: {$fp->id} | Nome: {$fp->nome} | EmpID: {$fp->empresa_id}\n";
}
