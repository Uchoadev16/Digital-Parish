<?php
require_once(__DIR__ . "/../models/Sessions.php");
$session = new Sessions();
if (isset($_GET['logout'])){
    $session->logout();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subsistemas - Digital Parish</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            serif: ['Playfair Display', 'serif'],
          },
          colors: {
            primary: '#1a1a1a',
            secondary: '#f5f5f5',
            accent: '#d4a574',
            'accent-dark': '#b8935e',
            'accent-light': '#e8c9a6',
            'warm-gray': '#fafaf9',
          },
        },
      },
    }
  </script>
  <style>
    .golden-glow {
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.15);
    }

    .btn-primary {
      background: linear-gradient(135deg, #d4a574 0%, #b8935e 100%);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.4);
    }

    .subsystem-card {
      transition: all 0.3s ease;
    }

    .subsystem-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="min-h-screen font-sans bg-warm-gray">
  <!-- Header -->
  <header class="bg-primary text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-accent/20 border border-accent/30 flex items-center justify-center">
            <svg class="w-6 h-6 text-accent" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L13.09 8.26L19 7L14.74 11.27L21 12L14.74 12.73L19 17L13.09 15.74L12 22L10.91 15.74L5 17L9.26 12.73L3 12L9.26 11.27L5 7L10.91 8.26L12 2Z" />
            </svg>
          </div>
          <div>
            <span class="text-lg font-bold tracking-wider block">DIGITAL</span>
            <span class="text-xs text-accent tracking-widest">PARISH</span>
          </div>
        </div>
        <div class="flex items-center gap-4">
          <div class="text-right">
            <p class="text-sm text-white/80"><?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?></p>
            <p class="text-xs text-accent"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></p>
          </div>
          <a href="./subsystems.php?logout" class="text-white/80 hover:text-accent transition-colors text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Sair
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Section -->
    <div class="text-center mb-12">
      <h1 class="text-4xl sm:text-5xl font-serif font-bold text-primary mb-4">
        Bem-vindo, <span class="text-accent"><?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?></span>
      </h1>
      <p class="text-xl text-primary/60 max-w-2xl mx-auto">
        Selecione o subsistema que deseja acessar
      </p>
      <div class="w-24 h-1.5 bg-accent rounded-full mx-auto mt-6 golden-glow"></div>
    </div>

    <!-- Subsistemas Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      
    </div>

    <!-- Empty State (caso não haja subsistemas) -->
    <?php if (empty($subsistemasDisponiveis)): ?>
      <div class="text-center py-12">
        <svg class="w-24 h-24 text-primary/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <h3 class="text-2xl font-serif font-semibold text-primary mb-2">Nenhum subsistema disponível</h3>
        <p class="text-primary/60">Entre em contato com o administrador para obter acesso aos subsistemas.</p>
      </div>
    <?php endif; ?>
  </main>

  <!-- Footer -->
  <footer class="bg-primary text-white/60 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="text-center">
        <p class="text-sm">© <?php echo date('Y'); ?> Digital Parish - Sistema de Gestão Paroquial</p>
      </div>
    </div>
  </footer>
</body>

</html>
