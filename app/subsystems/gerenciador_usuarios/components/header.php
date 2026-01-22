
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20 pl-4">
      <a href="<?php echo isset($logoPath) ? $logoPath : './index.php'; ?>" class="flex items-center group">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center golden-glow">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <div class="flex flex-col">
            <span class="text-xl font-bold text-primary tracking-tight">DIGITAL</span>
            <span class="text-sm text-accent font-medium -mt-1">PARISH</span>
          </div>
        </div>
      </a>

      <div class="hidden md:flex items-center gap-8">
        <a href="<?php echo isset($navPath) ? $navPath . 'index.php#inicio' : '#inicio'; ?>" class="nav-link text-base font-semibold text-gray-700 hover:text-accent transition-colors py-2 relative group">
          Início
          <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="<?php echo isset($navPath) ? $navPath . 'index.php#programacoes' : '#programacoes'; ?>" class="nav-link text-base font-semibold text-gray-700 hover:text-accent transition-colors py-2 relative group">
          Programações
          <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="<?php echo isset($navPath) ? $navPath . 'index.php#parcerias' : '#parcerias'; ?>" class="nav-link text-base font-semibold text-gray-700 hover:text-accent transition-colors py-2 relative group">
          Parcerias
          <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="<?php echo isset($navPath) ? $navPath . 'index.php#sobre' : '#sobre'; ?>" class="nav-link text-base font-semibold text-gray-700 hover:text-accent transition-colors py-2 relative group">
          Sobre
          <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="<?php echo isset($navPath) ? $navPath . 'views/login.php' : './views/login.php'; ?>" class="text-base font-semibold text-white bg-accent hover:bg-accent-dark px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
          Login
        </a>
      </div>

      <button id="mobileMenuBtn" class="md:hidden p-2 text-primary hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <div id="mobileMenu" class="mobile-menu fixed top-20 left-0 bottom-0 w-64 bg-white shadow-2xl md:hidden z-40">
    <nav class="p-6 space-y-4">
      <a href="<?php echo isset($navPath) ? $navPath . 'index.php#inicio' : '#inicio'; ?>" class="block text-lg font-semibold text-primary hover:text-accent transition-colors">Início</a>
      <a href="<?php echo isset($navPath) ? $navPath . 'index.php#programacoes' : '#programacoes'; ?>" class="block text-lg font-semibold text-gray-700 hover:text-accent transition-colors">Programações</a>
      <a href="<?php echo isset($navPath) ? $navPath . 'index.php#parcerias' : '#parcerias'; ?>" class="block text-lg font-semibold text-gray-700 hover:text-accent transition-colors">Parcerias</a>
      <a href="<?php echo isset($navPath) ? $navPath . 'index.php#sobre' : '#sobre'; ?>" class="block text-lg font-semibold text-gray-700 hover:text-accent transition-colors">Sobre</a>
      <a href="<?php echo isset($navPath) ? $navPath . 'views/login.php' : './views/login.php'; ?>" class="block text-lg font-semibold text-white bg-accent hover:bg-accent-dark px-4 py-2 rounded-lg transition-colors mt-4">Login</a>
    </nav>
  </div>
</nav>
