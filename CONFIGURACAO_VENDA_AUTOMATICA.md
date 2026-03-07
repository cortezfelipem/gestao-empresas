# 🚀 Guia de Configuração para Venda Automática

Este guia contém todas as instruções para configurar o sistema e começar a vender automaticamente.

## ✅ O QUE FOI IMPLEMENTADO

### 1. **Webhook do Mercado Pago** ✨ NOVO
- ✅ Rota `/webhook/mercadopago` criada
- ✅ Ativação automática de licença após pagamento aprovado
- ✅ Envio de emails automáticos (aprovado/rejeitado)
- ✅ Log completo de todas as transações

### 2. **Emails Transacionais** ✨ NOVO
- ✅ Email de boas-vindas ao cadastrar
- ✅ Email de pagamento aprovado
- ✅ Email de problema com pagamento
- ✅ Design moderno e responsivo

### 3. **Landing Pages**
- ✅ Página inicial moderna (`/`)
- ✅ Página de planos renovada (`/plano`)
- ✅ Design inovador com animações

### 4. **Melhorias no Fluxo**
- ✅ Onboarding melhorado
- ✅ Período de teste configurável
- ✅ Sistema 100% automático

---

## 📋 CHECKLIST DE CONFIGURAÇÃO

### 1️⃣ Configurar Email (OBRIGATÓRIO)

Edite o arquivo `.env`:

```env
MAIL_USERNAME="seu_email@gmail.com"
MAIL_PASSWORD="sua_senha_app_gmail"
```

**Como obter senha de app do Gmail:**
1. Acesse: https://myaccount.google.com/security
2. Ative "Verificação em duas etapas"
3. Vá em "Senhas de app"
4. Gere uma senha para "Email"
5. Use essa senha no `.env`

### 2️⃣ Configurar Mercado Pago (OBRIGATÓRIO)

#### Passo 1: Obter Credenciais de Produção
1. Acesse: https://www.mercadopago.com.br/developers/panel/app
2. Crie uma aplicação
3. Copie `Public Key` e `Access Token` de **PRODUÇÃO**

Edite o `.env`:
```env
MERCADOPAGO_PUBLIC_KEY_PRODUCAO="APP_USR-sua-public-key"
MERCADOPAGO_ACCESS_TOKEN_PRODUCAO="APP_USR-seu-access-token"
MERCADOPAGO_AMBIENTE=production  # Mudar de sandbox para production
```

#### Passo 2: Configurar Webhook no Mercado Pago
1. Acesse: https://www.mercadopago.com.br/developers/panel/notifications/webhooks
2. Clique em "Adicionar endpoint"
3. URL: `https://seudominio.com.br/webhook/mercadopago`
4. Eventos: Selecione **"Pagamentos"**
5. Salve

**IMPORTANTE:** O webhook só funciona com HTTPS em produção!

### 3️⃣ Configurar Domínio

Edite o `.env`:
```env
APP_URL=https://seudominio.com.br
PATH_URL=https://seudominio.com.br
```

### 4️⃣ Ajustar Período de Teste

Edite o `.env`:
```env
PLANO_AUTOMATICO_DIAS=15  # Recomendado: 7, 14 ou 15 dias
```

### 5️⃣ Configurar Notificações (OPCIONAL)

Para receber email quando alguém se cadastrar:
```env
AVISO_EMAIL_NOVO_CADASTRO="seu_email@dominio.com"
```

---

## 🎯 COMO FUNCIONA O FLUXO AUTOMÁTICO

### Cadastro e Teste Grátis
1. Cliente acessa `/plano` ou `/`
2. Escolhe um plano
3. Preenche cadastro em `/cadastro`
4. ✉️ Recebe email de boas-vindas
5. ✅ Conta ativada automaticamente com teste grátis
6. Acessa o sistema imediatamente

### Pagamento e Ativação
1. Cliente escolhe forma de pagamento (PIX, Cartão ou Boleto)
2. Realiza o pagamento
3. 🔔 Mercado Pago notifica via webhook
4. ✅ Sistema ativa licença automaticamente
5. ✉️ Cliente recebe email de confirmação
6. Pronto! Já pode usar o sistema completo

### Em Caso de Problema
1. Pagamento é rejeitado
2. 🔔 Webhook notifica
3. ✉️ Cliente recebe email explicativo
4. Pode tentar novamente

---

## 🔧 TESTES ANTES DE IR PARA PRODUÇÃO

### 1. Testar Email
Execute no terminal:
```bash
php artisan tinker
```
```php
Mail::raw('Teste de email', function($m){
    $m->to('seu_email@teste.com');
    $m->subject('Teste');
});
```

### 2. Testar Cadastro
1. Acesse `http://localhost:8000/`
2. Clique em "Começar Grátis"
3. Complete o cadastro
4. Verifique se recebeu email

### 3. Testar Webhook (Ambiente de Teste)
1. Mantenha `MERCADOPAGO_AMBIENTE=sandbox`
2. Use credenciais de teste
3. Faça um pagamento teste
4. Verifique nos logs: `storage/logs/laravel.log`

---

## 📊 MONITORAMENTO

### Logs Importantes
Todos os webhooks são registrados em `storage/logs/laravel.log`:

```bash
# Ver últimos logs
tail -f storage/logs/laravel.log
```

Procure por:
- `Webhook Mercado Pago recebido`
- `Licença ativada automaticamente`
- `Erro ao processar webhook`

### Verificar Pagamentos
Acesse o banco de dados:
```sql
SELECT * FROM payments ORDER BY id DESC LIMIT 10;
```

---

## 🚨 SOLUÇÃO DE PROBLEMAS

### Webhook não está funcionando
- ✅ Verifique se a URL está correta no painel Mercado Pago
- ✅ Confirme que está usando HTTPS (obrigatório em produção)
- ✅ Verifique os logs em `storage/logs/laravel.log`
- ✅ Teste manualmente: `POST https://seudominio.com.br/webhook/mercadopago`

### Emails não estão chegando
- ✅ Verifique credenciais do Gmail
- ✅ Confirme que usou senha de app (não a senha normal)
- ✅ Verifique caixa de spam
- ✅ Teste com outro email

### Pagamento não ativa licença
- ✅ Verifique logs do webhook
- ✅ Confirme que o status é "approved"
- ✅ Verifique tabela `payments` no banco

---

## 🎨 PERSONALIZAÇÃO

### Alterar Cores da Landing Page
Edite `resources/views/login/home.blade.php` e `plano.blade.php`:
```css
:root {
    --primary: #3699FF;      /* Cor primária */
    --secondary: #1BC5BD;    /* Cor secundária */
    --accent: #8950FC;       /* Cor de destaque */
}
```

### Alterar Textos
Edite o `.env`:
```env
APP_NAME="Seu Sistema"
APP_DESC="Sua Descrição"
TITUO_PLANO="Escolha Seu Plano"
MENSAGEM_PLANO="Comece hoje mesmo!"
```

---

## 📈 PRÓXIMAS MELHORIAS (BACKLOG)

1. **API SIEG para NFS-e**
   - Integração com múltiplas prefeituras
   - NFS-e automática

2. **Controle de Menus por Plano**
   - Liberar módulos conforme plano
   - Upsell inteligente

3. **Analytics Avançado**
   - Dashboard de vendas
   - Métricas de conversão

4. **Sistema de Cupons**
   - Descontos promocionais
   - Programas de afiliados

---

## 🆘 SUPORTE

- **WhatsApp:** {{getenv('CONTATO_SUPORTE')}}
- **Site:** {{getenv('SITE_SUPORTE')}}
- **Logs:** `storage/logs/laravel.log`

---

## ✨ ESTÁ PRONTO PARA VENDER!

Com todas as configurações acima, seu sistema estará 100% automático:
- ✅ Cadastro automático
- ✅ Teste grátis automático
- ✅ Pagamento automático
- ✅ Ativação automática
- ✅ Emails automáticos

**Boas vendas! 🚀**
