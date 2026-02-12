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

  <section id="inicio" class="min-h-screen flex items-center justify-center pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-deep-blue/90 via-primary/85 to-wine/80 relative">
    <div class="absolute inset-0 opacity-20" style="background-image: url('./assets/inicio.jpg'); background-size: cover; background-position: center 10%; background-repeat: no-repeat;"></div>
    <div class="max-w-5xl mx-auto w-full relative z-10">
      <div class="text-center mb-12">
        <span class="ornament text-accent text-sm tracking-[0.3em] uppercase font-medium">Área Administrativa</span>
        <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white leading-tight">
          Gerenciador de <span class="text-accent">Usuários</span>
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
          Centralize o acesso aos <span class="font-semibold text-accent-light">usuários</span>, 
          <span class="font-semibold text-accent-light">perfis</span> e 
          <span class="font-semibold text-accent-light">permissões</span> do sistema em um só lugar.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Usuários -->
        <a href="./views/usuario.php" class="bg-white/95 rounded-2xl p-6 md:p-7 card-hover border border-accent/30 golden-border-glow block">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-display font-bold text-primary">Usuários</h2>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-accent text-white shadow-md">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </span>
          </div>
          <p class="text-gray-600 mb-4">
            Acesse o cadastro, listagem e controle de todos os usuários do sistema.
          </p>
          <div class="flex items-center justify-between pt-3 border-t border-accent/20 text-sm text-accent">
            <span class="font-semibold">Gerenciar usuários</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </div>
        </a>

        <!-- Perfis -->
        <a href="./views/perfil.php" class="bg-white/95 rounded-2xl p-6 md:p-7 card-hover border border-accent/30 golden-border-glow block">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-display font-bold text-primary">Perfis</h2>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-deep-blue text-white shadow-md">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
            </span>
          </div>
          <p class="text-gray-600 mb-4">
            Organize funções e responsabilidades através de perfis personalizados.
          </p>
          <div class="flex items-center justify-between pt-3 border-t border-accent/20 text-sm text-accent">
            <span class="font-semibold">Configurar perfis</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </div>
        </a>

        <!-- Permissões -->
        <a href="./views/permissao.php" class="bg-white/95 rounded-2xl p-6 md:p-7 card-hover border border-accent/30 golden-border-glow block">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-display font-bold text-primary">Permissões</h2>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-wine text-white shadow-md">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
              </svg>
            </span>
          </div>
          <p class="text-gray-600 mb-4">
            Defina o que cada perfil e usuário pode acessar dentro do sistema.
          </p>
          <div class="flex items-center justify-between pt-3 border-t border-accent/20 text-sm text-accent">
            <span class="font-semibold">Controlar permissões</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </div>
        </a>
      </div>
    </div>
  </section>

  <section id="programacoes" class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="text-3xl sm:text-4xl font-display font-bold text-primary mb-4">
        Como funciona este módulo
      </h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Utilize os atalhos acima para navegar entre as áreas de 
        <span class="font-semibold text-accent">Usuários</span>, 
        <span class="font-semibold text-accent">Perfis</span> e 
        <span class="font-semibold text-accent">Permissões</span>. 
        Aqui você poderá configurar quem acessa o quê dentro do sistema.
      </p>
    </div>
  </section>

  <section id="parcerias" class="py-12 px-4 sm:px-6 lg:px-8 bg-warm-gray">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="text-2xl sm:text-3xl font-display font-bold text-primary mb-3">
        Integração com outros módulos
      </h2>
      <p class="text-gray-600">
        As configurações de usuários, perfis e permissões podem ser utilizadas por outros
        subsistemas da sua paróquia, garantindo um controle centralizado de acesso.
      </p>
    </div>
  </section>

  <section id="sobre" class="py-12 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-2xl sm:text-3xl font-display font-bold text-primary mb-3">
        Sobre o Gerenciador de Usuários
      </h2>
      <p class="text-gray-600">
        Este módulo foi criado para oferecer uma administração simples e elegante dos acessos
        ao sistema, mantendo a identidade visual do projeto Digital Parish.
      </p>
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
