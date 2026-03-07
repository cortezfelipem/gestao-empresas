<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>{{getenv("APP_NAME")}} - Planos e Preços</title>
	<meta name="description" content="Sistema completo de gestão empresarial - NF-e, NFC-e, CT-e, PDV e muito mais!">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
	<link href="/metronic/css/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="/metronic/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="shortcut icon" href="/imgs/slym.png" />
	
	<style>
		:root {
			--primary-color: #3699FF;
			--secondary-color: #1BC5BD;
			--accent-color: #8950FC;
			--dark-color: #181C32;
			--gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			--gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
			--gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
			--gradient-primary: linear-gradient(135deg, #3699FF 0%, #1BC5BD 100%);
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			overflow-x: hidden;
		}

		/* Animated Background */
		.animated-bg {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 0;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			overflow: hidden;
		}

		.animated-bg::before {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 200%;
			height: 200%;
			background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
			background-size: 50px 50px;
			animation: moveBackground 20s linear infinite;
		}

		@keyframes moveBackground {
			0% { transform: translate(0, 0); }
			100% { transform: translate(50px, 50px); }
		}

		/* Floating particles */
		.particle {
			position: absolute;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.1);
			animation: float 15s infinite;
		}

		@keyframes float {
			0%, 100% { transform: translateY(0) rotate(0deg); }
			50% { transform: translateY(-100px) rotate(180deg); }
		}

		/* Header */
		.header {
			position: relative;
			z-index: 10;
			padding: 30px 0;
			text-align: center;
		}

		.logo {
			font-size: 2.5rem;
			font-weight: 900;
			color: white;
			text-shadow: 0 4px 20px rgba(0,0,0,0.3);
			margin-bottom: 10px;
		}

		.tagline {
			font-size: 1.2rem;
			color: rgba(255,255,255,0.9);
			font-weight: 300;
		}

		/* Main Container */
		.main-container {
			position: relative;
			z-index: 10;
			max-width: 1400px;
			margin: 0 auto;
			padding: 40px 20px;
		}

		/* Hero Section */
		.hero-section {
			text-align: center;
			margin-bottom: 60px;
			animation: fadeInDown 1s ease;
		}

		@keyframes fadeInDown {
			from {
				opacity: 0;
				transform: translateY(-30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.hero-title {
			font-size: 3.5rem;
			font-weight: 900;
			color: white;
			margin-bottom: 20px;
			line-height: 1.2;
			text-shadow: 0 4px 30px rgba(0,0,0,0.3);
		}

		.hero-subtitle {
			font-size: 1.4rem;
			color: rgba(255,255,255,0.95);
			margin-bottom: 15px;
			font-weight: 400;
		}

		.hero-badge {
			display: inline-block;
			background: rgba(255,255,255,0.2);
			backdrop-filter: blur(10px);
			padding: 12px 30px;
			border-radius: 50px;
			color: white;
			font-weight: 600;
			font-size: 1.1rem;
			margin-top: 10px;
			box-shadow: 0 8px 32px rgba(0,0,0,0.2);
		}

		.hero-badge i {
			margin-right: 8px;
			color: #FFD700;
		}

		/* Features Grid */
		.features-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
			margin-bottom: 60px;
			animation: fadeInUp 1s ease 0.3s both;
		}

		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.feature-card {
			background: rgba(255,255,255,0.15);
			backdrop-filter: blur(10px);
			border-radius: 20px;
			padding: 30px;
			text-align: center;
			border: 1px solid rgba(255,255,255,0.2);
			transition: all 0.3s ease;
		}

		.feature-card:hover {
			transform: translateY(-5px);
			background: rgba(255,255,255,0.25);
			box-shadow: 0 15px 40px rgba(0,0,0,0.3);
		}

		.feature-icon {
			font-size: 3rem;
			margin-bottom: 15px;
			background: linear-gradient(135deg, #FFD700, #FFA500);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.feature-title {
			font-size: 1.2rem;
			font-weight: 700;
			color: white;
			margin-bottom: 10px;
		}

		.feature-desc {
			font-size: 0.95rem;
			color: rgba(255,255,255,0.8);
			line-height: 1.6;
		}

		/* Pricing Section */
		.pricing-section {
			margin-bottom: 60px;
		}

		.section-title {
			text-align: center;
			font-size: 2.5rem;
			font-weight: 800;
			color: white;
			margin-bottom: 40px;
			text-shadow: 0 4px 20px rgba(0,0,0,0.3);
		}

		.pricing-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
			gap: 30px;
			animation: fadeInUp 1s ease 0.5s both;
		}

		.pricing-card {
			background: white;
			border-radius: 25px;
			padding: 40px 30px;
			position: relative;
			overflow: hidden;
			transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
			box-shadow: 0 20px 60px rgba(0,0,0,0.3);
		}

		.pricing-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 6px;
			background: var(--gradient-primary);
		}

		.pricing-card:hover {
			transform: translateY(-10px) scale(1.02);
			box-shadow: 0 30px 80px rgba(0,0,0,0.4);
		}

		.pricing-card.featured {
			border: 3px solid #FFD700;
			transform: scale(1.05);
		}

		.featured-badge {
			position: absolute;
			top: 20px;
			right: -35px;
			background: linear-gradient(135deg, #FFD700, #FFA500);
			color: white;
			padding: 8px 45px;
			transform: rotate(45deg);
			font-weight: 700;
			font-size: 0.85rem;
			box-shadow: 0 4px 15px rgba(0,0,0,0.3);
		}

		.plan-icon {
			width: 80px;
			height: 80px;
			margin: 0 auto 20px;
			background: var(--gradient-primary);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 10px 30px rgba(54, 153, 255, 0.3);
		}

		.plan-icon img {
			width: 60%;
			height: 60%;
			object-fit: contain;
			filter: brightness(0) invert(1);
		}

		.plan-name {
			font-size: 2rem;
			font-weight: 800;
			color: var(--dark-color);
			margin-bottom: 15px;
			text-align: center;
		}

		.plan-price {
			text-align: center;
			margin-bottom: 25px;
		}

		.price-value {
			font-size: 3.5rem;
			font-weight: 900;
			color: var(--primary-color);
			line-height: 1;
		}

		.price-period {
			font-size: 1rem;
			color: #6c757d;
			font-weight: 500;
		}

		.plan-description {
			text-align: center;
			color: #6c757d;
			margin-bottom: 30px;
			line-height: 1.6;
			min-height: 60px;
		}

		.plan-features {
			list-style: none;
			margin-bottom: 30px;
		}

		.plan-features li {
			padding: 12px 0;
			color: #495057;
			font-size: 0.95rem;
			display: flex;
			align-items: center;
			border-bottom: 1px solid #f0f0f0;
		}

		.plan-features li:last-child {
			border-bottom: none;
		}

		.plan-features i {
			color: var(--secondary-color);
			margin-right: 12px;
			font-size: 1.1rem;
		}

		.plan-cta {
			display: block;
			width: 100%;
			padding: 18px;
			background: var(--gradient-primary);
			color: white;
			text-align: center;
			border: none;
			border-radius: 50px;
			font-size: 1.1rem;
			font-weight: 700;
			text-decoration: none;
			transition: all 0.3s ease;
			box-shadow: 0 10px 30px rgba(54, 153, 255, 0.3);
			cursor: pointer;
		}

		.plan-cta:hover {
			transform: translateY(-3px);
			box-shadow: 0 15px 40px rgba(54, 153, 255, 0.5);
			color: white;
			text-decoration: none;
		}

		/* Footer */
		.footer {
			text-align: center;
			padding: 40px 20px;
			color: rgba(255,255,255,0.8);
			position: relative;
			z-index: 10;
		}

		.footer-links {
			margin-bottom: 20px;
		}

		.footer-links a {
			color: rgba(255,255,255,0.9);
			text-decoration: none;
			margin: 0 15px;
			transition: color 0.3s;
		}

		.footer-links a:hover {
			color: white;
		}

		/* Responsive */
		@media (max-width: 768px) {
			.hero-title {
				font-size: 2.5rem;
			}

			.hero-subtitle {
				font-size: 1.1rem;
			}

			.pricing-grid {
				grid-template-columns: 1fr;
			}

			.pricing-card.featured {
				transform: scale(1);
			}
		}
	</style>
</head>


<body>
	<!-- Animated Background -->
	<div class="animated-bg">
		<div class="particle" style="width: 100px; height: 100px; top: 10%; left: 10%; animation-delay: 0s;"></div>
		<div class="particle" style="width: 60px; height: 60px; top: 60%; left: 80%; animation-delay: 2s;"></div>
		<div class="particle" style="width: 80px; height: 80px; top: 80%; left: 20%; animation-delay: 4s;"></div>
		<div class="particle" style="width: 120px; height: 120px; top: 30%; left: 70%; animation-delay: 1s;"></div>
	</div>

	<!-- Header -->
	<div class="header">
		<div class="logo">{{getenv("APP_NAME")}}</div>
		<div class="tagline">{{getenv("APP_DESC")}}</div>
	</div>

	<!-- Main Container -->
	<div class="main-container">
		<!-- Hero Section -->
		<div class="hero-section">
			<h1 class="hero-title">{!! getenv("TITUO_PLANO") !!}</h1>
			<p class="hero-subtitle">{!! getenv("MENSAGEM_PLANO") !!}</p>
			@if(getenv("PLANO_AUTOMATICO_DIAS") > 0)
			<div class="hero-badge">
				<i class="fas fa-gift"></i>
				Teste GRÁTIS por {{getenv("PLANO_AUTOMATICO_DIAS")}} dia(s) - Sem compromisso!
			</div>
			@endif
		</div>

		<!-- Features Grid -->
		<div class="features-grid">
			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-file-invoice"></i>
				</div>
				<h3 class="feature-title">Emissão de Notas</h3>
				<p class="feature-desc">NF-e, NFC-e, CT-e e MDF-e totalmente integrado com SEFAZ</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-chart-line"></i>
				</div>
				<h3 class="feature-title">Gestão Completa</h3>
				<p class="feature-desc">Vendas, compras, estoque, financeiro e muito mais</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-mobile-alt"></i>
				</div>
				<h3 class="feature-title">100% Online</h3>
				<p class="feature-desc">Acesse de qualquer lugar, a qualquer momento</p>
			</div>

			<div class="feature-card">
				<div class="feature-icon">
					<i class="fas fa-shield-alt"></i>
				</div>
				<h3 class="feature-title">Seguro e Confiável</h3>
				<p class="feature-desc">Seus dados protegidos com a melhor tecnologia</p>
			</div>
		</div>

		<!-- Pricing Section -->
		<div class="pricing-section">
			<h2 class="section-title">Escolha o Melhor Plano para Você</h2>
			
			<div class="pricing-grid">
				@foreach($planos as $index => $p)
				<div class="pricing-card {{ $index == 1 ? 'featured' : '' }}">
					@if($index == 1)
					<div class="featured-badge">POPULAR</div>
					@endif

					<div class="plan-icon">
						@if($p->img != '')
						<img src="/imgs_planos/{{$p->img}}" alt="{{$p->nome}}">
						@else
						<i class="fas fa-rocket" style="font-size: 2.5rem; color: white;"></i>
						@endif
					</div>

					<h3 class="plan-name">{{$p->nome}}</h3>

					<div class="plan-price">
						<div class="price-value">R$ {{number_format($p->valor, 2, ',', '.')}}</div>
						<div class="price-period">/mês</div>
					</div>

					<div class="plan-description">
						{!! $p->descricao !!}
					</div>

					<ul class="plan-features">
						@if($p->maximo_clientes > 0)
						<li><i class="fas fa-check-circle"></i> Até {{number_format($p->maximo_clientes, 0, ',', '.')}} clientes</li>
						@else
						<li><i class="fas fa-check-circle"></i> Clientes ilimitados</li>
						@endif

						@if($p->maximo_produtos > 0)
						<li><i class="fas fa-check-circle"></i> Até {{number_format($p->maximo_produtos, 0, ',', '.')}} produtos</li>
						@else
						<li><i class="fas fa-check-circle"></i> Produtos ilimitados</li>
						@endif

						@if($p->maximo_nfes > 0)
						<li><i class="fas fa-check-circle"></i> {{number_format($p->maximo_nfes, 0, ',', '.')}} NF-e/mês</li>
						@else
						<li><i class="fas fa-check-circle"></i> NF-e ilimitadas</li>
						@endif

						@if($p->maximo_nfces > 0)
						<li><i class="fas fa-check-circle"></i> {{number_format($p->maximo_nfces, 0, ',', '.')}} NFC-e/mês</li>
						@else
						<li><i class="fas fa-check-circle"></i> NFC-e ilimitadas</li>
						@endif

						@if($p->maximo_usuario > 0)
						<li><i class="fas fa-check-circle"></i> Até {{$p->maximo_usuario}} usuários</li>
						@else
						<li><i class="fas fa-check-circle"></i> Usuários ilimitados</li>
						@endif

						@if($p->delivery)
						<li><i class="fas fa-check-circle"></i> Módulo Delivery</li>
						@endif

						@if($p->maximo_cte > 0)
						<li><i class="fas fa-check-circle"></i> CT-e incluído</li>
						@endif

						@if($p->maximo_mdfe > 0)
						<li><i class="fas fa-check-circle"></i> MDF-e incluído</li>
						@endif

						@if($p->armazenamento > 0)
						<li><i class="fas fa-check-circle"></i> {{$p->armazenamento}}GB de armazenamento</li>
						@endif

						<li><i class="fas fa-check-circle"></i> Suporte técnico</li>
						<li><i class="fas fa-check-circle"></i> Atualizações gratuitas</li>
					</ul>

					<a href="/cadastro?plano={{$p->id}}" class="plan-cta">
						<i class="fas fa-rocket"></i> Começar Agora
					</a>
				</div>
				@endforeach
			</div>
		</div>

		<!-- Footer -->
		<div class="footer">
			<div class="footer-links">
				<a href="/login"><i class="fas fa-sign-in-alt"></i> Já tenho conta</a>
				<a href="https://wa.me/{{getenv('CONTATO_SUPORTE')}}"><i class="fab fa-whatsapp"></i> Suporte WhatsApp</a>
				<a href="http://{{getenv('SITE_SUPORTE')}}"><i class="fas fa-globe"></i> Site</a>
			</div>
			<p>&copy; {{ date('Y') }} {{getenv("APP_NAME")}}. Todos os direitos reservados.</p>
		</div>
	</div>

	<script src="/metronic/js/plugins.bundle.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script>
		// Smooth scroll animation
		document.querySelectorAll('a[href^="#"]').forEach(anchor => {
			anchor.addEventListener('click', function (e) {
				e.preventDefault();
				const target = document.querySelector(this.getAttribute('href'));
				if (target) {
					target.scrollIntoView({
						behavior: 'smooth',
						block: 'start'
					});
				}
			});
		});

		// Add entrance animation on scroll
		const observerOptions = {
			threshold: 0.1,
			rootMargin: '0px 0px -50px 0px'
		};

		const observer = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.style.opacity = '1';
					entry.target.style.transform = 'translateY(0)';
				}
			});
		}, observerOptions);

		// Observe pricing cards
		document.querySelectorAll('.pricing-card').forEach(card => {
			card.style.opacity = '0';
			card.style.transform = 'translateY(30px)';
			card.style.transition = 'all 0.6s ease';
			observer.observe(card);
		});
	</script>
</body>
</html>