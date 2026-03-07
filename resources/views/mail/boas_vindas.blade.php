<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao {{getenv('APP_NAME')}}</title>
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
            font-size: 32px;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome-icon {
            text-align: center;
            margin-bottom: 30px;
            font-size: 80px;
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
        .steps {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .step {
            padding: 15px;
            margin: 10px 0;
            background: white;
            border-radius: 5px;
            border-left: 4px solid #1BC5BD;
        }
        .step h3 {
            margin: 0 0 5px 0;
            color: #1BC5BD;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Bem-vindo!</h1>
            <p>Sua conta foi criada com sucesso</p>
        </div>
        
        <div class="content">
            <div class="welcome-icon">👋</div>

            <p>Olá <strong>{{$empresa->nome}}</strong>,</p>
            
            <p>Ficamos muito felizes em ter você conosco! Sua conta no <strong>{{getenv('APP_NAME')}}</strong> foi criada com sucesso.</p>

            <div style="background: #e7f3ff; padding: 20px; border-radius: 10px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: #3699FF;">🎁 Seu período de teste está ativo!</h3>
                <p style="margin: 0;">Aproveite <strong>{{getenv('PLANO_AUTOMATICO_DIAS')}} dia(s) grátis</strong> para explorar todos os recursos da plataforma.</p>
            </div>

            <h3>Primeiros Passos:</h3>
            
            <div class="steps">
                <div class="step">
                    <h3>1️⃣ Configure seu Emitente</h3>
                    <p>Informe os dados da sua empresa para começar a emitir notas fiscais.</p>
                </div>

                <div class="step">
                    <h3>2️⃣ Upload do Certificado Digital</h3>
                    <p>Envie seu certificado A1 para autenticar as notas fiscais.</p>
                </div>

                <div class="step">
                    <h3>3️⃣ Cadastre Produtos e Clientes</h3>
                    <p>Comece a organizar seu negócio na plataforma.</p>
                </div>

                <div class="step">
                    <h3>4️⃣ Emita sua Primeira Nota</h3>
                    <p>Teste a emissão de NF-e ou NFC-e e veja como é fácil!</p>
                </div>
            </div>

            <center>
                <a href="{{getenv('APP_URL')}}/login" class="button">Acessar Minha Conta</a>
            </center>

            <div style="margin-top: 30px; padding: 20px; background: #fff3cd; border-radius: 5px;">
                <p style="margin: 0; color: #856404;"><strong>📞 Precisa de Ajuda?</strong></p>
                <p style="margin: 5px 0 0 0; color: #856404;">Nossa equipe está disponível via WhatsApp: <strong>{{getenv('CONTATO_SUPORTE')}}</strong></p>
            </div>
        </div>

        <div class="footer">
            <p>Este é um email automático. Por favor, não responda.</p>
            <p>WhatsApp: {{getenv('CONTATO_SUPORTE')}} | Site: {{getenv('SITE_SUPORTE')}}</p>
            <p style="margin-top: 20px;">&copy; {{ date('Y') }} {{getenv('APP_NAME')}}. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
