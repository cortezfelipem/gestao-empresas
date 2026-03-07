<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema com Pagamento</title>
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
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
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
        .warning-icon {
            text-align: center;
            margin-bottom: 30px;
        }
        .warning-icon svg {
            width: 80px;
            height: 80px;
        }
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #FFA800;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #856404;
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
        .help-box {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Problema com Pagamento</h1>
        </div>
        
        <div class="content">
            <div class="warning-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FFA800">
                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                </svg>
            </div>

            <p>Olá <strong>{{$empresa->nome}}</strong>,</p>
            
            <p>Identificamos um problema com o processamento do seu pagamento.</p>

            <div class="info-box">
                <h3>Detalhes</h3>
                <p><strong>Valor:</strong> R$ {{number_format($payment->valor, 2, ',', '.')}}</p>
                <p><strong>Status:</strong> {{$payment->status}}</p>
                @if($motivo)
                <p><strong>Motivo:</strong> {{$motivo}}</p>
                @endif
            </div>

            <h3>O que fazer agora?</h3>
            
            <div class="help-box">
                <p><strong>1. Verifique seus dados:</strong> Confirme se os dados do cartão ou forma de pagamento estão corretos.</p>
                <p><strong>2. Tente novamente:</strong> Acesse sua conta e tente realizar o pagamento novamente.</p>
                <p><strong>3. Escolha outra forma:</strong> Se preferir, utilize outra forma de pagamento (PIX é instantâneo!).</p>
            </div>

            <center>
                <a href="{{getenv('APP_URL')}}/payment" class="button">Tentar Novamente</a>
            </center>

            <p style="margin-top: 30px;">Ainda tem dúvidas? Nossa equipe está pronta para ajudar!</p>
        </div>

        <div class="footer">
            <p><strong>Suporte:</strong></p>
            <p>WhatsApp: {{getenv('CONTATO_SUPORTE')}} | Site: {{getenv('SITE_SUPORTE')}}</p>
            <p style="margin-top: 20px;">&copy; {{ date('Y') }} {{getenv('APP_NAME')}}. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
