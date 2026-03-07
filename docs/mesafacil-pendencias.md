# Mesa Fácil — Pendências e Melhorias

## 🔴 Críticas (antes de ir para produção)

| # | Pendência | Detalhe |
|---|-----------|---------|
| 1 | **Logo real** | Substituir `public/imgs/mesafacil.png` pelo logo definitivo (120×40px para navbar) |
| 2 | **Banco MySQL** | Migrar de SQLite para MySQL em produção |
| 3 | **APP_KEY segura** | Regenerar `APP_KEY` com `php artisan key:generate` em cada instalação |
| 4 | **Senha padrão** | Forçar troca de senha no primeiro acesso (admin) |
| 5 | **Config fiscal real** | `/configNF` com dados reais do cliente antes de emitir NF-e |
| 6 | **Limpar dados demo** | Criar comando para remover empresa demo em produção |

---

## 🟡 Importantes (curto prazo)

| # | Pendência | Detalhe |
|---|-----------|---------|
| 7 | **Página de login branded** | Logo Mesa Fácil na tela de login (arquivo: `resources/views/default/login.blade.php`) |
| 8 | **E-mail SMTP** | Configurar `.env` com dados SMTP reais para envio de notificações |
| 9 | **Artisan command setup** | Criar `php artisan mesafacil:setup` que roda seeder e gera estrutura inicial |
| 10 | **Testes de fumaça** | Verificar rotas: `/mesas`, `/caixa`, `/controleCozinha/selecionar`, `/deliveryConfig` |

---

## 🟢 Melhorias (médio prazo)

| # | Melhoria | Detalhe |
|----|----------|---------|
| 11 | **App garçom (PWA)** | Versão mobile para garçons no salão |
| 12 | **Integração iFood** | Webhook para pedidos automáticos via delivery |
| 13 | **QR Code mesa** | Gerar QR Code por mesa para cardápio digital |
| 14 | **Dashboard restaurante** | Gráfico de ocupação de mesas, ticket médio, top pratos |
| 15 | **Multi-tenant** | Cada cliente restaurante = empresa separada no banco |
| 16 | **Produto Oficina Fácil** | Adicionar `getMenuMecanica()` em `Menu.php` com OS, peças, orçamento |

---

## Arquivos-chave para futuras customizações

| Arquivo | Finalidade |
|---------|-----------|
| `app/Helpers/Menu.php` | Menus por produto (adicionar `getMenuMecanica()` aqui) |
| `.env` → `PRODUTO_TIPO` | Chave que seleciona o produto ativo |
| `database/seeders/MesaFacilDemoSeeder.php` | Seed de demonstração |
| `resources/views/default/menu_lateral.blade.php` | Layout principal (logo, header) |
