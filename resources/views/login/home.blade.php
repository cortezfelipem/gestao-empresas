<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>{{getenv("APP_NAME")}} - {{getenv("APP_DESC")}}</title>
	<meta name="description" content="Sistema completo de gestão empresarial com emissão de NF-e, NFC-e, CT-e, PDV, Delivery e muito mais!">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
	<link href="/metronic/css/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="shortcut icon" href="/imgs/slym.png" />
	
	<style>
		:root {
			--primary: #3699FF;
			--secondary: #1BC5BD;
			--accent: #8950FC;
			--dark: #181C32;
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', sans-serif;
			color: #333;
			overflow-x: hidden;
		}

		/* Navigation */
		nav {
			position: fixed;
			top: 0;
			width: 100%;
			background: rgba(255, 255, 255, 0.98);
			backdrop-filter: blur(10px);
			box-shadow: 0 2px 20px rgba(0,0,0,0.1);
			z-index: 1000;
			padding: 20px 0;
		}

		.nav-container {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 0 20px;
		}

		.logo {
			font-size: 1.8rem;
			font-weight: 900;
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.nav-links {
			display: flex;
			gap: 30px;
			align-items: center;
		}

		.nav-links a {
			text-decoration: none;
			color: #333;
			font-weight: 500;
			transition: color 0.3s;
		}

		.nav-links a:hover {
			color: var(--primary);
		}

		.btn-nav {
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			color: white !important;
			padding: 12px 30px;
			border-radius: 50px;
			font-weight: 600;
		}

		/* Hero Section */
		.hero {
			margin-top: 80px;
			min-height: 90vh;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			display: flex;
			align-items: center;
			position: relative;
			overflow: hidden;
		}

		.hero::before {
			content: '';
			position: absolute;
			width: 100%;
			height: 100%;
			background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,165.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') bottom;
			background-size: cover;
		}

		.hero-container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 60px 20px;
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 60px;
			align-items: center;
			position: relative;
			z-index: 1;
		}

		.hero-content h1 {
			font-size: 3.5rem;
			font-weight: 900;
			color: white;
			line-height: 1.2;
			margin-bottom: 20px;
		}

		.hero-content p {
			font-size: 1.3rem;
			color: rgba(255,255,255,0.95);
			margin-bottom: 30px;
			line-height: 1.6;
		}

		.hero-buttons {
			display: flex;
			gap: 20px;
			flex-wrap: wrap;
		}

		.btn-hero {
			padding: 18px 40px;
			font-size: 1.1rem;
			font-weight: 700;
			border-radius: 50px;
			text-decoration: none;
			transition: all 0.3s;
			display: inline-block;
		}

		.btn-primary {
			background: white;
			color: var(--primary);
		}

		.btn-primary:hover {
			transform: translateY(-3px);
			box-shadow: 0 15px 40px rgba(0,0,0,0.3);
		}

		.btn-secondary {
			background: rgba(255,255,255,0.2);
			color: white;
			border: 2px solid white;
		}

		.btn-secondary:hover {
			background: white;
			color: var(--primary);
		}

		.hero-image {
			position: relative;
		}

		.hero-image img {
			width: 100%;
			border-radius: 20px;
			box-shadow: 0 30px 60px rgba(0,0,0,0.3);
		}

		/* Stats Section */
		.stats {
			padding: 80px 20px;
			background: white;
		}

		.stats-container {
			max-width: 1200px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 40px;
			text-align: center;
		}

		.stat-item h3 {
			font-size: 3rem;
			font-weight: 900;
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			margin-bottom: 10px;
		}

		.stat-item p {
			color: #666;
			font-size: 1.1rem;
		}

		/* Features Section */
		.features {
			padding: 100px 20px;
			background: #f8f9fa;
		}

		.section-header {
			text-align: center;
			max-width: 800px;
			margin: 0 auto 60px;
		}

		.section-header h2 {
			font-size: 2.8rem;
			font-weight: 900;
			color: var(--dark);
			margin-bottom: 20px;
		}

		.section-header p {
			font-size: 1.2rem;
			color: #666;
		}

		.features-grid {
			max-width: 1200px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 40px;
		}

		.feature-card {
			background: white;
			padding: 40px;
			border-radius: 20px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.05);
			transition: all 0.3s;
		}

		.feature-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 20px 60px rgba(0,0,0,0.1);
		}

		.feature-icon {
			width: 70px;
			height: 70px;
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			border-radius: 15px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 25px;
		}

		.feature-icon i {
			font-size: 2rem;
			color: white;
		}

		.feature-card h3 {
			font-size: 1.5rem;
			font-weight: 700;
			color: var(--dark);
			margin-bottom: 15px;
		}

		.feature-card p {
			color: #666;
			line-height: 1.6;
		}

		/* Pricing Section */
		.pricing {
			padding: 100px 20px;
			background: white;
		}

		/* CTA Section */
		.cta {
			padding: 100px 20px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			text-align: center;
			color: white;
		}

		.cta h2 {
			font-size: 3rem;
			font-weight: 900;
			margin-bottom: 20px;
		}

		.cta p {
			font-size: 1.3rem;
			margin-bottom: 40px;
			opacity: 0.95;
		}

		/* Footer */
		footer {
			background: var(--dark);
			color: white;
			padding: 60px 20px 30px;
		}

		.footer-content {
			max-width: 1200px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: 2fr 1fr 1fr 1fr;
			gap: 40px;
			margin-bottom: 40px;
		}

		.footer-section h3 {
			margin-bottom: 20px;
		}

		.footer-section a {
			display: block;
			color: rgba(255,255,255,0.7);
			text-decoration: none;
			margin-bottom: 10px;
			transition: color 0.3s;
		}

		.footer-section a:hover {
			color: white;
		}

		.footer-bottom {
			text-align: center;
			padding-top: 30px;
			border-top: 1px solid rgba(255,255,255,0.1);
			color: rgba(255,255,255,0.5);
		}

		/* Responsive */
		@media (max-width: 968px) {
			.hero-container,
			.features-grid,
			.stats-container,
			.footer-content {
				grid-template-columns: 1fr;
			}

			.hero-content h1 {
				font-size: 2.5rem;
			}

			.nav-links {
				display: none;
			}
		}
	</style>
</head>
<body>
	<!-- Navigation -->
	<nav>
		<div class="nav-container">
			<div class="logo">{{getenv("APP_NAME")}}</div>
			<div class="nav-links">
				<a href="#features">Recursos</a>
				<a href="#pricing">Preços</a>
				<a href="/login">Login</a>
				<a href="/plano" class="btn-nav">Começar Grátis</a>
			</div>
		</div>
	</nav>

	<!-- Hero Section -->
	<section class="hero">
		<div class="hero-container">
			<div class="hero-content">
				<h1>Gestão Empresarial Completa em um Só Lugar</h1>
				<p>Emita notas fiscais, controle estoque, gerencie vendas e muito mais. Tudo na nuvem, simples e acessível.</p>
				<div class="hero-buttons">
					<a href="/plano" class="btn-hero btn-primary">
						<i class="fas fa-rocket"></i> Testar {{getenv("PLANO_AUTOMATICO_DIAS")}} Dias Grátis
					</a>
					<a href="#features" class="btn-hero btn-secondary">
						<i class="fas fa-play-circle"></i> Ver Como Funciona
					</a>
				</div>
			</div>
			<div class="hero-image">
				<img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop" alt="Dashboard">
			</div>
		</div>
	</section>

	<!-- Stats Section -->
	<section class="stats">
		<div class="stats-container">
			<div class="stat-item">
				<h3>10k+</h3>
				<p>Empresas Ativas</p>
			</div>
			<div class="stat-item">
				<h3>99.9%</h3>
				<p>Disponibilidade</p>
			</div>
			<div class="stat-item">
				<h3>1M+</h3>
				<p>Notas Emitidas</p>
			</div>
			<div class="stat-item">
				<h3>24/7</h3>
				<p>Suporte</p>
			</div>
		</div>
	</section>

	<!-- Features Section -->
	<section class="features" id="features">
		<div class="section-header">
			<h2>Tudo que Sua Empresa Precisa</h2>
			<p>Uma solução completa para simplificar a gestão do seu negócio</p>
		</div>
		<div class="features-grid">
			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-file-invoice"></i>
				</div>
				<h3>Notas Fiscais</h3>
				<p>Emita NF-e, NFC-e, CT-e e MDF-e com integração direta com a SEFAZ. Rápido, fácil e seguro.</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-boxes"></i>
				</div>
				<h3>Controle de Estoque</h3>
				<p>Gerencie seus produtos com facilidade. Acompanhe entradas, saídas e inventários em tempo real.</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-cash-register"></i>
				</div>
				<h3>PDV Completo</h3>
				<p>Sistema de frente de caixa moderno e intuitivo. Agilize suas vendas e melhore a experiência do cliente.</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-chart-line"></i>
				</div>
				<h3>Relatórios Gerenciais</h3>
				<p>Dashboards completos com todas as informações que você precisa para tomar decisões estratégicas.</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-motorcycle"></i>
				</div>
				<h3>Delivery</h3>
				<p>Sistema completo para delivery com controle de pedidos, entregadores e rastreamento em tempo real.</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-mobile-alt"></i>
				</div>
				<h3>100% Online</h3>
				<p>Acesse de qualquer lugar, a qualquer hora. Funciona em desktop, tablet e smartphone.</p>
			</div>
		</div>
	</section>

	<!-- Pricing Section -->
	<section class="pricing" id="pricing">
		<div class="section-header">
			<h2>Planos para Todos os Tamanhos de Negócio</h2>
			<p>Escolha o plano ideal para sua empresa</p>
		</div>
		<center>
			<a href="/plano" class="btn-hero btn-primary" style="margin-top: 20px;">
				<i class="fas fa-eye"></i> Ver Todos os Planos
			</a>
		</center>
	</section>

	<!-- CTA Section -->
	<section class="cta">
		<h2>Pronto para Transformar sua Gestão?</h2>
		<p>Comece hoje mesmo com {{getenv("PLANO_AUTOMATICO_DIAS")}} dias grátis. Sem compromisso, sem cartão de crédito.</p>
		<a href="/plano" class="btn-hero btn-primary">
			<i class="fas fa-rocket"></i> Começar Agora
		</a>
	</section>

	<!-- Footer -->
	<footer>
		<div class="footer-content">
			<div class="footer-section">
				<h3>{{getenv("APP_NAME")}}</h3>
				<p>{{getenv("APP_DESC")}}</p>
				<p style="margin-top: 20px;">Simplificando a gestão empresarial desde 2020.</p>
			</div>
			<div class="footer-section">
				<h3>Produto</h3>
				<a href="#features">Recursos</a>
				<a href="/plano">Preços</a>
				<a href="#">Atualizações</a>
			</div>
			<div class="footer-section">
				<h3>Suporte</h3>
				<a href="https://wa.me/{{getenv('CONTATO_SUPORTE')}}">WhatsApp</a>
				<a href="#">Central de Ajuda</a>
				<a href="#">Status</a>
			</div>
			<div class="footer-section">
				<h3>Empresa</h3>
				<a href="#">Sobre</a>
				<a href="/login">Login</a>
				<a href="/cadastro">Cadastrar</a>
			</div>
		</div>
		<div class="footer-bottom">
			<p>&copy; {{ date('Y') }} {{getenv("APP_NAME")}}. Todos os direitos reservados.</p>
		</div>
	</footer>

	<script src="/metronic/js/plugins.bundle.js"></script>
</body>
</html>
