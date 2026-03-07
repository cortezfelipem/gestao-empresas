<?php
$dbPath = __DIR__ . '/../database/database.sqlite';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$now = date('Y-m-d H:i:s');

// Insert plano
$db->exec("INSERT INTO planos (nome, valor, maximo_clientes, maximo_produtos, maximo_fornecedores, maximo_nfes, maximo_nfces, maximo_cte, maximo_mdfe, maximo_evento, maximo_usuario, armazenamento, maximo_usuario_simultaneo, delivery, perfil_id, intervalo_dias, descricao, img, visivel, api_sieg, created_at, updated_at) VALUES ('PlanoTeste', 0.00, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','',1,0, '$now', '$now')");
$planoId = $db->lastInsertId();

// Insert empresa
$db->exec("INSERT INTO empresas (nome, rua, telefone, email, numero, bairro, cidade, cnpj, permissao, status, tipo_representante, perfil_id, mensagem_bloqueio, info_contador, created_at, updated_at) VALUES ('EmpresaTeste', 'Rua Teste', '000000000', 'teste@local', '0', 'Bairro', 'Cidade', '00000000000000', '', 1, 0, 0, '', '', '$now', '$now')");
$empresaId = $db->lastInsertId();

// Insert plano_empresa
$db->exec("INSERT INTO plano_empresas (empresa_id, plano_id, expiracao, mensagem_alerta, created_at, updated_at) VALUES ($empresaId, $planoId, '2099-01-01', '', '$now', '$now')");

// Insert usuario
$senha = md5('123');
$db->exec("INSERT INTO usuarios (nome, login, adm, senha, email, img, ativo, somente_fiscal, caixa_livre, permite_desconto, permissao, empresa_id, tema, tema_menu, tipo_menu, rota_acesso, created_at, updated_at) VALUES ('Admin Local', 'admin', 1, '$senha', 'admin@local', '', 1, 0, 0, 1, '', $empresaId, 1, 1, 'lateral', '', '$now', '$now')");

echo "Seed minimal completed: plano=$planoId, empresa=$empresaId\n";
