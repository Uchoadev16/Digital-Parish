<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Parish - Portal Paroquial</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            display: ['Playfair Display', 'serif'],
          },
          colors: {
            primary: '#1a1a1a',
            secondary: '#f5f5f5',
            accent: '#d4a574',
            'accent-dark': '#b8935e',
            'accent-light': '#e8c9a6',
            'warm-gray': '#fafaf9',
            'deep-blue': '#1e3a5f',
            'wine': '#722f37',
          },
        },
      },
    }
  </script>
  <style>
    * {
      scroll-behavior: smooth;
    }

    body {
      overflow-x: hidden;
    }

    .nav-link.active {
      color: #d4a574;
    }
    
    .nav-link.active span {
      width: 100%;
    }

    .section-enter {
      opacity: 0;
      transform: translateY(30px);
      animation: sectionFadeIn 0.8s ease-out forwards;
    }

    @keyframes sectionFadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card-hover {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-hover:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(212, 165, 116, 0.15);
    }

    .mobile-menu {
      transform: translateX(-100%);
      transition: transform 0.3s ease-out;
    }

    .mobile-menu.active {
      transform: translateX(0);
    }

    .golden-glow {
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.2);
    }
    
    .golden-border-glow:hover {
      box-shadow: 0 0 0 2px #d4a574;
    }

    .ornament::before,
    .ornament::after {
      content: '';
      display: inline-block;
      width: 60px;
      height: 1px;
      background: linear-gradient(to right, transparent, #d4a574, transparent);
      vertical-align: middle;
      margin: 0 16px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #d4a574 0%, #b8935e 100%);
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.4);
    }
  </style>
</head>
<body class="bg-white text-primary font-sans antialiased">
  
  <?php
    $logoPath = '#inicio';
    $logoSrc = './assets/logo.svg';
    $navPath = '';
    include './components/header.php';
  ?>

  <section id="inicio" class="min-h-screen flex items-center justify-center pt-20 px-4 sm:px-6 lg:px-8 relative" style="background-image: url('./assets/inicio.jpg'); background-size: cover; background-position: center 10%; background-repeat: no-repeat; background-attachment: fixed;">
    <div class="absolute inset-0 bg-gradient-to-br from-deep-blue/80 via-primary/70 to-wine/60"></div>
    <div class="max-w-4xl mx-auto w-full section-enter relative z-10">
      <div class="text-center">
        <div class="mb-6">
          <span class="ornament text-accent text-sm tracking-[0.3em] uppercase font-medium">Bem-vindo</span>
        </div>

        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
          Portal <span class="text-accent">Paroquial</span>
        </h1>
        <p class="text-xl sm:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto leading-relaxed font-light">
          Sistema integrado de gerenciamento de missas e comunidades católicas
        </p>
        
        <a href="./views/informacoes.php" class="btn-primary inline-flex items-center gap-3 text-white px-8 py-4 rounded-full font-semibold text-lg">
          Explorar Programações
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </a>

        <div class="mt-16 animate-bounce">
          <a href="#programacoes" class="inline-block p-2 text-white/60 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="programacoes" class="min-h-screen py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-20">
        <h2 class="text-5xl sm:text-6xl font-display font-bold text-primary mb-6">Programações</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Confira os horários das missas e celebrações</p>
        <div class="w-24 h-1.5 bg-accent rounded-full mx-auto mt-8 golden-glow"></div>
      </div>

      <div class="mb-20">
        <div class="flex items-center gap-4 mb-8">
          <div class="w-2 h-14 bg-accent rounded-full golden-glow"></div>
          <h3 class="text-3xl font-display font-bold text-primary">Paróquia São José</h3>
          <span class="ml-auto text-sm font-semibold text-accent bg-accent/10 px-4 py-2 rounded-full border border-accent/30">6 Missas</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <a href="./views/informacoes.php?missa=missa1" class="bg-white border-2 border-accent/30 rounded-xl p-6 card-hover cursor-pointer hover:border-accent hover:shadow-[0_8px_30px_rgba(212,165,116,0.25)] block transition-all">
            <div class="flex items-center justify-between mb-4">
              <span class="text-xs font-bold text-accent bg-accent/10 px-3 py-1.5 rounded-full border border-accent/30">DOMINGO</span>
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <p class="text-4xl font-bold text-accent mb-2">08:00</p>
            <p class="text-gray-600 font-medium mb-4">Missa Dominical</p>
            <div class="pt-4 border-t border-accent/20 flex items-center gap-2 text-sm text-gray-500">
              <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span>Pe. João Silva</span>
            </div>
          </a>

          <a href="./views/informacoes.php?missa=missa2" class="bg-white border-2 border-accent/30 rounded-xl p-6 card-hover cursor-pointer hover:border-accent hover:shadow-[0_8px_30px_rgba(212,165,116,0.25)] block transition-all">
            <div class="flex items-center justify-between mb-4">
              <span class="text-xs font-bold text-accent bg-accent/10 px-3 py-1.5 rounded-full border border-accent/30">DOMINGO</span>
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <p class="text-4xl font-bold text-accent mb-2">10:00</p>
            <p class="text-gray-600 font-medium mb-4">Missa das Famílias</p>
            <div class="pt-4 border-t border-accent/20 flex items-center gap-2 text-sm text-gray-500">
              <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span>Pe. João Silva</span>
            </div>
          </a>

          <a href="./views/informacoes.php?missa=missa3" class="bg-white border-2 border-accent/30 rounded-xl p-6 card-hover cursor-pointer hover:border-accent hover:shadow-[0_8px_30px_rgba(212,165,116,0.25)] block transition-all">
            <div class="flex items-center justify-between mb-4">
              <span class="text-xs font-bold text-accent bg-accent/10 px-3 py-1.5 rounded-full border border-accent/30">DOMINGO</span>
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <p class="text-4xl font-bold text-accent mb-2">18:00</p>
            <p class="text-gray-600 font-medium mb-4">Missa Vespertina</p>
            <div class="pt-4 border-t border-accent/20 flex items-center gap-2 text-sm text-gray-500">
              <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span>Pe. João Silva</span>
            </div>
          </a>
        </div>
      </div>

      <div class="mb-20">
        <div class="flex items-center gap-4 mb-8">
          <div class="w-2 h-14 bg-accent-dark rounded-full"></div>
          <h3 class="text-3xl font-display font-bold text-primary">Paróquia Nossa Senhora</h3>
          <span class="ml-auto text-sm font-semibold text-accent bg-accent/10 px-4 py-2 rounded-full border border-accent/30">4 Missas</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <a href="./views/informacoes.php?missa=missa4" class="bg-white border-2 border-accent/30 rounded-xl p-6 card-hover cursor-pointer hover:border-accent hover:shadow-[0_8px_30px_rgba(212,165,116,0.25)] block transition-all">
            <div class="flex items-center justify-between mb-4">
              <span class="text-xs font-bold text-accent bg-accent/10 px-3 py-1.5 rounded-full border border-accent/30">SÁBADO</span>
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <p class="text-4xl font-bold text-accent mb-2">19:00</p>
            <p class="text-gray-600 font-medium mb-4">Missa de Sábado</p>
            <div class="pt-4 border-t border-accent/20 flex items-center gap-2 text-sm text-gray-500">
              <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span>Pe. Carlos Mendes</span>
            </div>
          </a>

          <a href="./views/informacoes.php?missa=missa5" class="bg-white border-2 border-accent/30 rounded-xl p-6 card-hover cursor-pointer hover:border-accent hover:shadow-[0_8px_30px_rgba(212,165,116,0.25)] block transition-all">
            <div class="flex items-center justify-between mb-4">
              <span class="text-xs font-bold text-accent bg-accent/10 px-3 py-1.5 rounded-full border border-accent/30">DOMINGO</span>
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <p class="text-4xl font-bold text-accent mb-2">09:30</p>
            <p class="text-gray-600 font-medium mb-4">Missa Solene</p>
            <div class="pt-4 border-t border-accent/20 flex items-center gap-2 text-sm text-gray-500">
              <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span>Pe. Carlos Mendes</span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="parcerias" class="min-h-screen py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-accent-light/10 via-white to-accent/5">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-20">
        <h2 class="text-5xl sm:text-6xl font-display font-bold text-primary mb-6">Parcerias</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Nossas paróquias parceiras</p>
        <div class="w-24 h-1.5 bg-accent rounded-full mx-auto mt-8 golden-glow"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover border-2 border-accent/20">
          <div class="h-48 bg-gradient-to-br from-accent to-accent-dark relative">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-display font-bold text-primary mb-3">Paróquia São José</h3>
            <p class="text-gray-600 mb-4">Centro da cidade, atendendo a comunidade há mais de 50 anos.</p>
            <div class="flex items-center gap-2 text-sm text-accent">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Rua Principal, 123</span>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover border-2 border-accent/20">
          <div class="h-48 bg-gradient-to-br from-accent-dark to-primary relative">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-display font-bold text-primary mb-3">Paróquia N. Senhora</h3>
            <p class="text-gray-600 mb-4">Comunidade acolhedora com forte presença de jovens e famílias.</p>
            <div class="flex items-center gap-2 text-sm text-accent">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Av. das Flores, 456</span>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover border-2 border-accent/20">
          <div class="h-48 bg-gradient-to-br from-accent-light to-accent relative">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-display font-bold text-primary mb-3">Paróquia São Pedro</h3>
            <p class="text-gray-600 mb-4">Tradição e modernidade em harmonia, servindo a comunidade local.</p>
            <div class="flex items-center gap-2 text-sm text-accent">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Pça. da Igreja, 789</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="sobre" class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-20">
        <h2 class="text-5xl sm:text-6xl font-display font-bold text-primary mb-6">Sobre o Projeto</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Nossa missão e valores</p>
        <div class="w-24 h-1.5 bg-accent rounded-full mx-auto mt-8 golden-glow"></div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
        <div>
          <h3 class="text-3xl font-display font-bold text-primary mb-6">Nossa Missão</h3>
          <p class="text-lg text-gray-600 leading-relaxed mb-6">
            O Digital Parish nasceu com o propósito de facilitar a comunicação entre paróquias e fiéis, 
            tornando mais acessível a informação sobre horários de missas e eventos religiosos.
          </p>
          <p class="text-lg text-gray-600 leading-relaxed">
            Acreditamos que a tecnologia pode ser uma ferramenta poderosa para fortalecer os laços 
            comunitários e aproximar as pessoas de sua fé.
          </p>
        </div>
        <div class="bg-gradient-to-br from-accent-light/30 to-accent/20 rounded-2xl p-8 lg:p-12 border-2 border-accent/30">
          <div class="space-y-6">
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center flex-shrink-0 golden-glow">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <div>
                <h4 class="text-xl font-bold text-accent mb-2">Acessibilidade</h4>
                <p class="text-gray-600">Informação clara e disponível para todos</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center flex-shrink-0 golden-glow">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <div>
                <h4 class="text-xl font-bold text-accent mb-2">Comunidade</h4>
                <p class="text-gray-600">Fortalecendo laços entre paróquias e fiéis</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center flex-shrink-0 golden-glow">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <div>
                <h4 class="text-xl font-bold text-accent mb-2">Inovação</h4>
                <p class="text-gray-600">Tecnologia a serviço da fé</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-gradient-to-br from-accent to-accent-dark text-white rounded-2xl p-12 text-center golden-glow mb-12">
        <h3 class="text-3xl font-display font-bold mb-6">Entre em Contato</h3>
        <p class="text-lg text-accent-light mb-8 max-w-2xl mx-auto">
          Quer cadastrar sua paróquia ou tem alguma dúvida? Estamos aqui para ajudar.
        </p>
        <a href="mailto:contato@digitalparish.com" class="inline-flex items-center gap-2 bg-white hover:bg-accent-light text-accent px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          Enviar E-mail
        </a>
      </div>

      <div class="text-center pt-12 border-t-2 border-accent/20">
        <h4 class="text-xl font-display font-bold text-primary mb-4">Desenvolvido por</h4>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 sm:gap-12">
          <div class="text-center">
            <p class="text-lg font-semibold text-accent mb-2">Matheus Felix</p>
           
          </div>
          <div class="hidden sm:block w-px h-8 bg-accent/20"></div>
          <div class="text-center">
            <p class="text-lg font-semibold text-accent">Pedro Uchoa</p>
         
          </div>
        </div>
      </div>
         
        </a>
      </div>
    </div>
  </section>

  <footer class="bg-primary text-white py-12 px-4 sm:px-6 lg:px-8 border-t-4 border-accent">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div>
          <h4 class="text-lg font-bold mb-4 text-accent">Digital Parish</h4>
          <p class="text-gray-400 text-sm">Sistema integrado de gerenciamento paroquial</p>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4 text-accent">Links Rápidos</h4>
          <ul class="space-y-2 text-sm text-gray-400">
            <li><a href="#inicio" class="hover:text-accent transition-colors">Início</a></li>
            <li><a href="#programacoes" class="hover:text-accent transition-colors">Programações</a></li>
            <li><a href="#parcerias" class="hover:text-accent transition-colors">Parcerias</a></li>
            <li><a href="#sobre" class="hover:text-accent transition-colors">Sobre</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4 text-accent">Contato</h4>
          <ul class="space-y-2 text-sm text-gray-400">
            <li>contato@digitalparish.com</li>
            <li>(11) 9999-9999</li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
        <p>&copy; 2025 Digital Parish. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <script>
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id]');

    function updateActiveNav() {
      const scrollY = window.pageYOffset;
      
      sections.forEach(section => {
        const sectionHeight = section.offsetHeight;
        const sectionTop = section.offsetTop - 100;
        const sectionId = section.getAttribute('id');
        
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
          navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${sectionId}` || link.getAttribute('href').includes(`#${sectionId}`)) {
              link.classList.add('active');
            }
          });
        }
      });
    }

    window.addEventListener('scroll', updateActiveNav);
    updateActiveNav();

    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
      });

      const mobileNavLinks = mobileMenu.querySelectorAll('a');
      mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
          mobileMenu.classList.remove('active');
        });
      });

      document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
          mobileMenu.classList.remove('active');
        }
      });
    }

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

    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('section-enter');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    sections.forEach(section => {
      observer.observe(section);
    });
  </script>
</body>
</html>
