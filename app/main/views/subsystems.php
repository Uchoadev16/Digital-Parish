<?php
require_once(__DIR__ . "/../models/Sessions.php");
require_once(__DIR__ . "/../models/SelectMain.php");

//print_r($_SESSION);

$session = new Sessions();
if (isset($_GET['logout'])) {
  $session->logout();
}

$select = new SelectMain();
$dados_usuario_paroquia = $select->selectParoquiaUsuario($_SESSION['id']);
$dados_subsistemas = $select->selectSistemas($_SESSION['id']);
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
          <img src="../assets/logo_paroquia/<?php echo htmlspecialchars($dados_usuario_paroquia['logo'] ?? ''); ?>" alt="Logo da paroquia" class="w-10 h-10 rounded-xl object-cover">

          <div>
            <span class="text-lg font-bold tracking-wider block"><?php echo htmlspecialchars($dados_usuario_paroquia['nome_paroquia'] ?? 'Digital Parish'); ?></span>
          </div>
        </div>
        <div class="flex items-center gap-4">
          <div class="text-right hidden sm:block">
            <p class="text-sm text-white/80"><?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?></p>
            <a href="./perfil.php" class="text-xs text-accent hover:text-accent-light transition-colors cursor-pointer">
              <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>
            </a>
          </div>
          <!-- Foto de Perfil Clicável -->
          <a href="./perfil.php" class="relative group cursor-pointer">
            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-accent/30 hover:border-accent transition-all duration-300 shadow-lg hover:shadow-xl">
              <img src="../assets/foto_perfil/<?= $_SESSION['foto_perfil'] ?? '' ?>"
                alt="Foto de perfil"
                class="w-full h-full object-cover"
                onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-accent/20 flex items-center justify-center\'><svg class=\'w-6 h-6 text-accent\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\' /></svg></div>'">
            </div>
            <div class="absolute inset-0 bg-accent/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </div>
          </a>
          <a href="./problemas.php" class="text-white/80 hover:text-accent transition-colors text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Reportar Problema
          </a>
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

      <?php if (isset($_SESSION['Gerenciador de Paróquias'])): ?>
        <a href="../../subsystems/gerenciador_paroquias/index.php" class="subsystem-card block">
          <div class="bg-white rounded-2xl p-6 golden-glow border border-accent/10 h-full flex flex-col">
            <!-- Icon -->
            <div class="mb-4">
              <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
              </div>
            </div>

            <!-- Content -->
            <div class="flex-1">
              <h3 class="text-xl font-serif font-semibold text-primary mb-2">
                Gerenciador de Paróquias
              </h3>
              <p class="text-sm text-primary/60 leading-relaxed">
                Gerenciamento de paróquias
              </p>
            </div>

            <!-- Arrow -->
            <div class="mt-4 flex items-center text-accent group">
              <span class="text-sm font-medium">Acessar</span>
              <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </div>
        </a>
      <?php endif; ?>

      <?php if (isset($_SESSION['Gerenciador de Usuários'])): ?>
        <a href="../../subsystems/gerenciador_usuarios/index.php" class="subsystem-card block">
          <div class="bg-white rounded-2xl p-6 golden-glow border border-accent/10 h-full flex flex-col">
            <!-- Icon -->
            <div class="mb-4">
              <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
              </div>
            </div>

            <!-- Content -->
            <div class="flex-1">
              <h3 class="text-xl font-serif font-semibold text-primary mb-2">
                Gerenciador de Usuários
              </h3>
              <p class="text-sm text-primary/60 leading-relaxed">
                Gerenciamento de usuários
              </p>
            </div>

            <!-- Arrow -->
            <div class="mt-4 flex items-center text-accent group">
              <span class="text-sm font-medium">Acessar</span>
              <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </div>
        </a>
      <?php endif; ?>

    </div>


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