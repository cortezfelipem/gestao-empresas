<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Menu;

/**
 * MesaFacil Demo Seeder
 * 
 * Popula o banco com dados realistas para demonstração do produto MesaFacil.
 * Execute com: php artisan db:seed --class=MesaFacilDemoSeeder
 * 
 * Empresa:   MesaFacil Demo
 * Segmento:  Restaurante / Lanchonete
 * Admin:     admin@mesafacil.demo / 12345678
 * Garçom:    garcom@mesafacil.demo / 12345678
 * Caixa:     caixa@mesafacil.demo / 12345678
 * Cozinha:   cozinha@mesafacil.demo / 12345678
 */
class MesaFacilDemoSeeder extends Seeder
{
    private $now;
    private $empresaId;
    private $cidadeId;
    private $cidadeGeralId;

    public function run()
    {
        $this->now = Carbon::now();

        $this->command->info('🍽️  Iniciando seed do MesaFacil Demo...');
        $this->criarCidade();        $this->criarPlano();
        $this->criarEmpresa();
        $this->criarConfigNota();
        $this->criarUsuarios();
        $this->criarFormasPagamento();
        $this->criarDeliveryConfig();
        $this->criarCategorias();
        $this->criarProdutos();
        $this->criarMesas();
        $this->criarClientes();

        $this->command->info('✅  MesaFacil Demo pronto!');
        $this->command->info('👤  Login: admin@mesafacil.demo  |  Senha: 12345678');
        $this->command->info('🌐  Acesse: http://localhost:8000/login');
    }

    // -------------------- CIDADE --------------------

    private function criarCidade()
    {
        $this->command->info('   Criando cidade demo...');

        // cidade para o módulo de cidades geral
        DB::table('cidades')->updateOrInsert(
            ['codigo' => '3550308'],
            [
                'codigo'     => '3550308',
                'nome'       => 'São Paulo',
                'uf'         => 'SP',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ]
        );

        // cidade_deliveries: tabela usada pelo módulo de delivery
        DB::table('cidade_deliveries')->updateOrInsert(
            ['nome' => 'São Paulo', 'cep' => '01310-100'],
            [
                'nome'       => 'São Paulo',
                'cep'        => '01310-100',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ]
        );

        $this->cidadeId = DB::table('cidade_deliveries')
            ->where('nome', 'São Paulo')
            ->value('id');

        $this->cidadeGeralId = DB::table('cidades')
            ->where('codigo', '3550308')
            ->value('id');
    }

    // -------------------- PLANO --------------------

    private function criarPlano()
    {
        $this->command->info('   Criando plano MesaFacil...');

        DB::table('planos')->updateOrInsert(
            ['nome' => 'MesaFacil'],
            [
                'nome'                    => 'MesaFacil',
                'valor'                   => 149.90,
                'maximo_clientes'         => 999999,
                'maximo_produtos'         => 999999,
                'maximo_fornecedores'     => 999999,
                'maximo_nfes'             => 0,
                'maximo_nfces'            => 0,
                'maximo_cte'              => 0,
                'maximo_mdfe'             => 0,
                'maximo_evento'           => 0,
                'maximo_usuario'          => 10,
                'armazenamento'           => 1024,
                'maximo_usuario_simultaneo' => 5,
                'delivery'                => 1,
                'perfil_id'               => 0,
                'intervalo_dias'          => 30,
                'descricao'               => 'Plano completo para restaurantes, lanchonetes e pizzarias',
                'img'                     => '',
                'visivel'                 => 1,
                'api_sieg'                => 0,
                'created_at'              => $this->now,
                'updated_at'              => $this->now,
            ]
        );
    }

    // -------------------- EMPRESA --------------------

    private function criarEmpresa()
    {
        $this->command->info('   Criando empresa demo...');

        // Rotas que o perfil MesaFacil deve ter acesso
        $rotasMesaFacil = Menu::rotasMesaFacil();

        DB::table('empresas')->updateOrInsert(
            ['email' => 'demo@mesafacil.demo'],
            [
                'nome'              => 'MesaFacil Demo',
                'rua'               => 'Rua do Restaurante',
                'numero'            => '100',
                'bairro'            => 'Centro',
                'cidade'            => 'São Paulo',
                'telefone'          => '(11) 99999-0001',
                'email'             => 'demo@mesafacil.demo',
                'cnpj'              => '00.000.000/0001-00',
                'status'            => 1,
                'permissao'         => json_encode($rotasMesaFacil),
                'tipo_representante'=> 0,
                'perfil_id'         => 0,
                'mensagem_bloqueio' => '',
                'info_contador'     => '',
                'created_at'        => $this->now,
                'updated_at'        => $this->now,
            ]
        );

        $this->empresaId = DB::table('empresas')->where('email', 'demo@mesafacil.demo')->value('id');

        // Vincular plano
        $planoId = DB::table('planos')->where('nome', 'MesaFacil')->value('id');

        DB::table('plano_empresas')->updateOrInsert(
            ['empresa_id' => $this->empresaId],
            [
                'empresa_id'      => $this->empresaId,
                'plano_id'        => $planoId,
                'expiracao'       => '2099-12-31',
                'mensagem_alerta' => '',
                'created_at'      => $this->now,
                'updated_at'      => $this->now,
            ]
        );
    }

    // -------------------- CONFIG NOTA (obrigatória para login) --------------------

    private function criarConfigNota()
    {
        $this->command->info('   Criando configuração de emitente...');

        DB::table('config_notas')->updateOrInsert(
            ['empresa_id' => $this->empresaId],
            [
                'empresa_id'       => $this->empresaId,
                'razao_social'     => 'MesaFacil Demo Restaurante LTDA',
                'nome_fantasia'    => 'MesaFacil Demo',
                'cnpj'             => '00000000000100',
                'ie'               => 'ISENTO',
                'logradouro'       => 'Rua do Restaurante',
                'complemento'      => '',
                'numero'           => '100',
                'bairro'           => 'Centro',
                'fone'             => '11999990001',
                'cep'              => '01310100',
                'pais'             => 'Brasil',
                'email'            => 'demo@mesafacil.demo',
                'municipio'        => 'São Paulo',
                'codPais'          => 1058,
                'codMun'           => 3550308,
                'UF'               => 'SP',
                'CST_CSOSN_padrao' => '102',
                'CST_COFINS_padrao'=> '07',
                'CST_PIS_padrao'   => '07',
                'CST_IPI_padrao'   => '99',
                'frete_padrao'     => 9,
                'tipo_pagamento_padrao' => '01',
                'nat_op_padrao'    => 0,
                'ambiente'         => 2, // Homologação
                'cUF'              => '35',
                'numero_serie_nfe' => '001',
                'numero_serie_nfce'=> '001',
                'numero_serie_cte' => '001',
                'numero_serie_mdfe'=> '001',
                'ultimo_numero_nfe'=> 0,
                'ultimo_numero_nfce'=> 0,
                'ultimo_numero_cte'=> 0,
                'ultimo_numero_mdfe'=> 0,
                'csc'              => '',
                'csc_id'           => '',
                'certificado_a3'   => 0,
                'inscricao_municipal'=> '',
                'aut_xml'          => '',
                'logo'             => '',
                'casas_decimais'   => 2,
                'campo_obs_nfe'    => '',
                'senha_remover'    => '',
                'percentual_lucro_padrao' => 0,
                'sobrescrita_csonn_consumidor_final' => '',
                'created_at'       => $this->now,
                'updated_at'       => $this->now,
            ]
        );
    }

    // -------------------- USUÁRIOS --------------------

    private function criarUsuarios()
    {
        $this->command->info('   Criando usuários demo...');

        $senha = md5('12345678');
        $rotasMesaFacil = json_encode(Menu::rotasMesaFacil());

        // Rotas restritas para garçom (sem financeiro nem configurações sensíveis)
        $rotasGarcom = json_encode([
            '/graficos', '/mesas', '/pedidos', '/pedidos/controleComandas',
            '/controleCozinha/selecionar',
        ]);

        // Rotas restritas para caixa
        $rotasCaixa = json_encode([
            '/graficos', '/mesas', '/pedidos', '/pedidos/controleComandas',
            '/caixa', '/contasPagar', '/contasReceber', '/fluxoCaixa',
            '/clientes', '/formasPagamento',
        ]);

        // Rotas da cozinha (apenas visualização de produção)
        $rotasCozinha = json_encode([
            '/graficos', '/controleCozinha/selecionar',
        ]);

        $usuarios = [
            [
                'nome'            => 'Admin MesaFacil',
                'login'           => 'admin@mesafacil.demo',
                'email'           => 'admin@mesafacil.demo',
                'adm'             => 1,
                'permissao'       => $rotasMesaFacil,
                'rota_acesso'     => '/graficos',
            ],
            [
                'nome'            => 'Garçom Demo',
                'login'           => 'garcom@mesafacil.demo',
                'email'           => 'garcom@mesafacil.demo',
                'adm'             => 0,
                'permissao'       => $rotasGarcom,
                'rota_acesso'     => '/mesas',
            ],
            [
                'nome'            => 'Caixa Demo',
                'login'           => 'caixa@mesafacil.demo',
                'email'           => 'caixa@mesafacil.demo',
                'adm'             => 0,
                'permissao'       => $rotasCaixa,
                'rota_acesso'     => '/caixa',
            ],
            [
                'nome'            => 'Cozinha Demo',
                'login'           => 'cozinha@mesafacil.demo',
                'email'           => 'cozinha@mesafacil.demo',
                'adm'             => 0,
                'permissao'       => $rotasCozinha,
                'rota_acesso'     => '/controleCozinha/selecionar',
            ],
        ];

        foreach($usuarios as $u){
            DB::table('usuarios')->updateOrInsert(
                ['login' => $u['login'], 'empresa_id' => $this->empresaId],
                [
                    'nome'             => $u['nome'],
                    'login'            => $u['login'],
                    'email'            => $u['email'],
                    'senha'            => $senha,
                    'adm'              => $u['adm'],
                    'ativo'            => 1,
                    'somente_fiscal'   => 0,
                    'caixa_livre'      => 1,
                    'permite_desconto' => 1,
                    'permissao'        => $u['permissao'],
                    'empresa_id'       => $this->empresaId,
                    'tema'             => 1,
                    'tema_menu'        => 1,
                    'tipo_menu'        => 'admin',
                    'rota_acesso'      => $u['rota_acesso'],
                    'created_at'       => $this->now,
                    'updated_at'       => $this->now,
                ]
            );
        }
    }

    // -------------------- FORMAS DE PAGAMENTO --------------------

    private function criarFormasPagamento()
    {
        $this->command->info('   Criando formas de pagamento...');

        $formas = [
            ['nome' => 'Dinheiro',        'chave' => '01', 'taxa' => 0, 'tipo_taxa' => '%'],
            ['nome' => 'Cartão Crédito',  'chave' => '03', 'taxa' => 0, 'tipo_taxa' => '%'],
            ['nome' => 'Cartão Débito',   'chave' => '04', 'taxa' => 0, 'tipo_taxa' => '%'],
            ['nome' => 'Pix',             'chave' => '17', 'taxa' => 0, 'tipo_taxa' => '%'],
            ['nome' => 'Vale Refeição',   'chave' => '10', 'taxa' => 0, 'tipo_taxa' => '%'],
        ];

        foreach($formas as $f){
            DB::table('forma_pagamentos')->updateOrInsert(
                ['empresa_id' => $this->empresaId, 'nome' => $f['nome']],
                array_merge($f, [
                    'empresa_id'  => $this->empresaId,
                    'prazo_dias'  => 0,
                    'status'      => 1,
                    'created_at'  => $this->now,
                    'updated_at'  => $this->now,
                ])
            );
        }
    }

    // -------------------- DELIVERY CONFIG --------------------

    private function criarDeliveryConfig()
    {
        $this->command->info('   Criando configuração de delivery...');

        DB::table('delivery_configs')->updateOrInsert(
            ['empresa_id' => $this->empresaId],
            [
                'empresa_id'               => $this->empresaId,
                'cidade_id'                => $this->cidadeId,
                'link_face'                => '',
                'link_twiteer'             => '',
                'link_google'              => '',
                'link_instagram'           => '',
                'telefone'                 => '(11) 99999-0001',
                'endereco'                 => 'Rua do Restaurante, 100 - Centro',
                'tempo_medio_entrega'      => '30',
                'tempo_maximo_cancelamento'=> '10',
                'valor_entrega'            => 5.00,
                'nome_exibicao_web'        => 'MesaFacil Demo',
                'latitude'                 => '-23.5505',
                'longitude'                => '-46.6333',
                'politica_privacidade'     => '',
                'valor_km'                 => 2.00,
                'entrega_gratis_ate'       => 0,
                'maximo_km_entrega'        => 10,
                'usar_bairros'             => 0,
                'maximo_adicionais'        => 5,
                'maximo_adicionais_pizza'  => 3,
                'created_at'               => $this->now,
                'updated_at'               => $this->now,
            ]
        );
    }

    // -------------------- CATEGORIAS DE CARDÁPIO --------------------

    private function criarCategorias()
    {
        $this->command->info('   Criando categorias do cardápio...');

        $categorias = [
            ['nome' => 'Entradas',     'descricao' => 'Porções e entradas'],
            ['nome' => 'Lanches',      'descricao' => 'Hambúrgueres e sanduíches'],
            ['nome' => 'Pratos',       'descricao' => 'Pratos executivos e à la carte'],
            ['nome' => 'Pizzas',       'descricao' => 'Pizzas tradicionais e especiais'],
            ['nome' => 'Bebidas',      'descricao' => 'Refrigerantes, sucos e água'],
            ['nome' => 'Sobremesas',   'descricao' => 'Doces e sobremesas'],
        ];

        foreach($categorias as $cat){
            // Tabela geral de categorias (usada pelos produtos principais)
            DB::table('categorias')->updateOrInsert(
                ['empresa_id' => $this->empresaId, 'nome' => $cat['nome']],
                [
                    'empresa_id'  => $this->empresaId,
                    'nome'        => $cat['nome'],
                    'created_at'  => $this->now,
                    'updated_at'  => $this->now,
                ]
            );

            // Tabela de categorias do cardápio delivery
            DB::table('categoria_produto_deliveries')->updateOrInsert(
                ['empresa_id' => $this->empresaId, 'nome' => $cat['nome']],
                [
                    'empresa_id'  => $this->empresaId,
                    'nome'        => $cat['nome'],
                    'descricao'   => $cat['descricao'],
                    'path'        => '',
                    'created_at'  => $this->now,
                    'updated_at'  => $this->now,
                ]
            );
        }
    }

    // -------------------- PRODUTOS --------------------

    private function criarProdutos()
    {
        $this->command->info('   Criando produtos do cardápio...');

        // Helper: busca ID de categoria geral
        $getCatGeral = function($nome){
            return DB::table('categorias')
                ->where('empresa_id', $this->empresaId)
                ->where('nome', $nome)
                ->value('id');
        };

        // Helper: busca ID de categoria delivery
        $getCatDelivery = function($nome){
            return DB::table('categoria_produto_deliveries')
                ->where('empresa_id', $this->empresaId)
                ->where('nome', $nome)
                ->value('id');
        };

        $produtos = [
            // Entradas
            ['cat' => 'Entradas', 'nome' => 'Porção de Batata Frita',    'desc' => 'Batata frita crocante (300g)', 'valor' => 22.90],
            ['cat' => 'Entradas', 'nome' => 'Porção de Mandioca Frita',  'desc' => 'Mandioca frita com manteiga de garrafa', 'valor' => 20.90],
            ['cat' => 'Entradas', 'nome' => 'Bolinho de Queijo (6 un)',   'desc' => 'Bolinhos de queijo crocantes', 'valor' => 18.90],
            // Lanches
            ['cat' => 'Lanches',  'nome' => 'X-Burguer Clássico',        'desc' => 'Hambúrguer, queijo, alface e tomate', 'valor' => 28.90],
            ['cat' => 'Lanches',  'nome' => 'X-Bacon Especial',          'desc' => 'Hambúrguer duplo, bacon e queijo cheddar', 'valor' => 36.90],
            ['cat' => 'Lanches',  'nome' => 'X-Frango Grelhado',         'desc' => 'Frango grelhado, queijo e molho especial', 'valor' => 26.90],
            // Pratos
            ['cat' => 'Pratos',   'nome' => 'Frango à Parmegiana',       'desc' => 'Frango empanado com molho de tomate e gratinado', 'valor' => 42.90],
            ['cat' => 'Pratos',   'nome' => 'Filé à Pimenta',            'desc' => 'Filé mignon ao molho de pimenta com fritas', 'valor' => 64.90],
            ['cat' => 'Pratos',   'nome' => 'Risoto de Camarão',         'desc' => 'Risoto cremoso ao parmesão com camarão', 'valor' => 58.90],
            // Pizzas
            ['cat' => 'Pizzas',   'nome' => 'Pizza Margherita',          'desc' => 'Molho de tomate, muçarela e manjericão', 'valor' => 45.90],
            ['cat' => 'Pizzas',   'nome' => 'Pizza Calabresa',           'desc' => 'Calabresa fatiada, cebola e azeitona', 'valor' => 48.90],
            ['cat' => 'Pizzas',   'nome' => 'Pizza Portuguesa',          'desc' => 'Presunto, ovos, ervilha e cebola', 'valor' => 52.90],
            // Bebidas
            ['cat' => 'Bebidas',  'nome' => 'Refrigerante Lata',         'desc' => 'Coca-Cola, Pepsi, Guaraná, Sprite (350ml)', 'valor' => 7.00],
            ['cat' => 'Bebidas',  'nome' => 'Suco Natural',              'desc' => 'Laranja, limão, maracujá ou abacaxi', 'valor' => 12.00],
            ['cat' => 'Bebidas',  'nome' => 'Água Mineral',              'desc' => 'Sem gás ou com gás (500ml)', 'valor' => 5.00],
            ['cat' => 'Bebidas',  'nome' => 'Cerveja Long Neck',         'desc' => 'Skol, Brahma ou Itaipava (355ml)', 'valor' => 10.00],
            // Sobremesas
            ['cat' => 'Sobremesas','nome'=> 'Pudim de Leite',            'desc' => 'Pudim caseiro com calda de caramelo', 'valor' => 14.90],
            ['cat' => 'Sobremesas','nome'=> 'Petit Gâteau',              'desc' => 'Bolo quente de chocolate com sorvete', 'valor' => 22.90],
        ];

        foreach($produtos as $p){
            $catGeralId   = $getCatGeral($p['cat']);
            $catDeliverId = $getCatDelivery($p['cat']);

            // Insere na tabela de produtos (geral) se não existe
            DB::table('produtos')->updateOrInsert(
                ['empresa_id' => $this->empresaId, 'nome' => $p['nome']],
                [
                    'empresa_id'                    => $this->empresaId,
                    'categoria_id'                  => $catGeralId,
                    'nome'                          => $p['nome'],
                    'cor'                           => '',
                    'valor_venda'                   => $p['valor'],
                    'valor_compra'                  => 0,
                    'unidade_compra'                => 'UN',
                    'unidade_venda'                 => 'UN',
                    'valor_livre'                   => 0,
                    'cListServ'                     => '',
                    'CFOP_saida_estadual'           => '',
                    'CFOP_saida_inter_estadual'     => '',
                    'codigo_anp'                    => '',
                    'descricao_anp'                 => '',
                    'imagem'                        => '',
                    'alerta_vencimento'             => 0,
                    'gerenciar_estoque'             => 0,
                    'inativo'                       => 0,
                    'created_at'                    => $this->now,
                    'updated_at'                    => $this->now,
                ]
            );

            $produtoId = DB::table('produtos')
                ->where('empresa_id', $this->empresaId)
                ->where('nome', $p['nome'])
                ->value('id');

            // Insere no cardápio delivery
            DB::table('produto_deliveries')->updateOrInsert(
                ['empresa_id' => $this->empresaId, 'produto_id' => $produtoId],
                [
                    'empresa_id'    => $this->empresaId,
                    'produto_id'    => $produtoId,
                    'categoria_id'  => $catDeliverId,
                    'descricao'     => $p['desc'],
                    'ingredientes'  => '',
                    'valor'         => $p['valor'],
                    'valor_anterior'=> 0,
                    'status'        => 1,
                    'destaque'      => 0,
                    'limite_diario' => 0,
                    'created_at'    => $this->now,
                    'updated_at'    => $this->now,
                ]
            );
        }
    }

    // -------------------- MESAS --------------------

    private function criarMesas()
    {
        $this->command->info('   Criando mesas e balcão...');

        $mesas = [];
        // 10 mesas numeradas
        for($i = 1; $i <= 10; $i++){
            $mesas[] = "Mesa {$i}";
        }
        // 3 posições de balcão
        $mesas[] = 'Balcão 1';
        $mesas[] = 'Balcão 2';
        $mesas[] = 'Balcão 3';

        foreach($mesas as $nome){
            DB::table('mesas')->updateOrInsert(
                ['empresa_id' => $this->empresaId, 'nome' => $nome],
                [
                    'empresa_id'  => $this->empresaId,
                    'nome'        => $nome,
                    'created_at'  => $this->now,
                    'updated_at'  => $this->now,
                ]
            );
        }
    }

    // -------------------- CLIENTES --------------------

    private function criarClientes()
    {
        $this->command->info('   Criando clientes de exemplo...');

        $clientes = [
            ['nome' => 'João Silva',    'fone' => '(11) 99999-1001', 'cpf' => '00000000100'],
            ['nome' => 'Maria Santos',  'fone' => '(11) 99999-1002', 'cpf' => '00000000200'],
            ['nome' => 'Pedro Costa',   'fone' => '(11) 99999-1003', 'cpf' => '00000000300'],
            ['nome' => 'Ana Oliveira',  'fone' => '(11) 99999-1004', 'cpf' => '00000000400'],
            ['nome' => 'Carlos Mendes', 'fone' => '(11) 99999-1005', 'cpf' => '00000000500'],
        ];

        foreach($clientes as $c){
            $existe = DB::table('clientes')
                ->where('empresa_id', $this->empresaId)
                ->where('razao_social', $c['nome'])
                ->exists();

            if(!$existe){
                DB::table('clientes')->insert([
                    'empresa_id'          => $this->empresaId,
                    'razao_social'        => $c['nome'],
                    'nome_fantasia'       => $c['nome'],
                    'cpf_cnpj'            => $c['cpf'],
                    'telefone'            => $c['fone'],
                    'celular'             => '',
                    'email'               => '',
                    'rua'                 => '',
                    'numero'              => '',
                    'bairro'              => '',
                    'complemento'         => '',
                    'cep'                 => '',
                    'ie_rg'               => '',
                    'id_estrangeiro'      => '',
                    'observacao'          => '',
                    'data_aniversario'    => '',
                    'cidade_id'           => $this->cidadeGeralId,
                    'rua_cobranca'        => '',
                    'numero_cobranca'     => '',
                    'bairro_cobranca'     => '',
                    'cep_cobranca'        => '',
                    'consumidor_final'    => 1,
                    'contribuinte'        => 9,
                    'created_at'          => $this->now,
                    'updated_at'          => $this->now,
                ]);
            }
        }
    }
}
