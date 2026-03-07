<?php
// php scripts/list_users.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Usuario;

$users = Usuario::all(['id','login','nome','email']);
foreach($users as $u){
    echo "id={$u->id} login={$u->login} nome={$u->nome} email={$u->email}\n";
}
