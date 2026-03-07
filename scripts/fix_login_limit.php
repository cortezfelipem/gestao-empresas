<?php
// scripts/fix_login_limit.php
// Usa PDO sqlite para ajustar plano e limpar acessos do dia para permitir login de teste
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    echo "ERR: database file not found: $dbPath\n";
    exit(1);
}
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // localizar usuário admin
    $stmt = $pdo->prepare("SELECT id, empresa_id FROM usuarios WHERE login = :login LIMIT 1");
    $stmt->execute([':login' => 'admin']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        echo "User 'admin' not found.\n";
        exit(0);
    }
    $empresa_id = $user['empresa_id'];
    echo "Found admin -> empresa_id = $empresa_id\n";

    // localizar plano_empresa
    $stmt = $pdo->prepare("SELECT plano_id FROM plano_empresas WHERE empresa_id = :eid LIMIT 1");
    $stmt->execute([':eid' => $empresa_id]);
    $pe = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($pe && isset($pe['plano_id'])) {
        $plano_id = $pe['plano_id'];
        echo "Found plano_empresa -> plano_id = $plano_id\n";
        // atualizar plano para maximo_usuario_simultaneo = -1 (ilimitado)
        $u = $pdo->prepare("UPDATE planos SET maximo_usuario_simultaneo = -1 WHERE id = :pid");
        $u->execute([':pid' => $plano_id]);
        echo "Set planos.id=$plano_id maximo_usuario_simultaneo = -1\n";
    } else {
        echo "No plano_empresa record found for empresa_id=$empresa_id\n";
    }

    // deletar acessos ativos do dia (status = 0) para a empresa
    $del = $pdo->prepare(
        "DELETE FROM usuario_acessos WHERE status = 0 AND usuario_id IN (SELECT id FROM usuarios WHERE empresa_id = :eid) AND date(created_at) = date('now')"
    );
    $del->execute([':eid' => $empresa_id]);
    $count = $del->rowCount();
    echo "Deleted $count active usuario_acessos for empresa_id=$empresa_id today.\n";

    echo "Done. You can retry login (admin / 123).\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
