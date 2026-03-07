<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Aprovado</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 40px 30px;
        }
        .success-icon {
            text-align: center;
            margin-bottom: 30px;
        }
        .success-icon svg {
            width: 80px;
            height: 80px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #1BC5BD;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #1BC5BD;
        }
        .info-box p {
            margin: 5px 0;
            color: #555;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 50px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }
        .list-features {
            list-style: none;
            padding: 0;
        }
        .list-features li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .list-features li:before {
            content: "✓";
            color: #1BC5BD;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Pagamento Aprovado!</h1>
            <p>Bem-vindo ao {{getenv('APP_NAME')}}</p>
        </div>
        
        <div class="content">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1BC5BD">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>

            <p>Olá <strong>{{$empresa->nome}}</strong>,</p>
            
            <p>Ótimas notícias! Seu pagamento foi aprovado com sucesso e sua conta já está ativa.</p>

            <div class="info-box">
                <h3>Detalhes do Seu Plano</h3>
                <p><strong>Plano:</strong> {{$plano->nome}}</p>
                <p><strong>Valor:</strong> R$ {{number_format($payment->valor, 2, ',', '.')}}</p>
                <p><strong>Válido até:</strong> {{\Carbon\Carbon::parse($expiracao)->format('d/m/Y')}}</p>
                <p><strong>Forma de pagamento:</strong> {{$payment->forma_pagamento}}</p>
            </div>

            <h3>O que você pode fazer agora:</h3>
            <ul class="list-features">
                <li>Emitir suas notas fiscais (NF-e, NFC-e)</li>
                <li>Gerenciar produtos e estoque</li>
                <li>Controlar vendas e compras</li>
                <li>Acompanhar o financeiro</li>
                <li>E muito mais!</li>
            </ul>

            <center>
                <a href="{{getenv('APP_URL')}}/login" class="button">Acessar Minha Conta</a>
            </center>

            <div style="margin-top: 30px; padding: 20px; background: #fff3cd; border-radius: 5px;">
                <p style="margin: 0; color: #856404;"><strong>💡 Dica:</strong> Complete a configuração do seu emitente para começar a emitir notas fiscais imediatamente!</p>
            </div>
        </div>

        <div class="footer">
            <p>Precisa de ajuda? Entre em contato conosco:</p>
            <p>WhatsApp: {{getenv('CONTATO_SUPORTE')}} | Site: {{getenv('SITE_SUPORTE')}}</p>
            <p style="margin-top: 20px;">&copy; {{ date('Y') }} {{getenv('APP_NAME')}}. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
