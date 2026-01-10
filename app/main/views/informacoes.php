<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informações da Missa - Digital Parish</title>
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
            'warm-gray': '#fafaf9',
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
    .golden-glow {
      box-shadow: 0 0 20px rgba(212, 165, 116, 0.3);
    }
  </style>
</head>
<body class="bg-white text-primary font-sans antialiased">
  
  <?php
    $logoPath = '../index.php';
    $logoSrc = '../assets/logo.svg';
    $navPath = '../';
    include '../components/header.php';
  ?>

  <!-- Main Content -->
  <main class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
      <a href="../index.php#programacoes" class="inline-flex items-center gap-2 text-accent hover:text-accent-dark transition-colors mb-8 font-semibold">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Voltar às Programações
      </a>

      <?php
        $missas = [
          'missa1' => [
            'titulo' => 'Missa Dominical',
            'dia' => 'Domingo',
            'hora' => '08:00',
            'paroquia' => 'Paróquia São José',
            'endereco' => 'Rua Principal, 123 - Centro',
            'sacerdote' => 'Pe. João Silva',
            'responsavel' => 'Pe. João Silva',
            'coroinhas' => ['Gabriel Lima', 'Lucas Martins', 'Pedro Santos'],
            'acenista' => 'Maria da Silva',
            'coordenador' => 'Carlos Roberto',
            'participantes' => 45,
            'descricao' => 'Celebração dominical com participação da comunidade. Todos são bem-vindos. Uma oportunidade especial para fortalecer os laços comunitários e a fé.',
            'participantes_lista' => [
              ['nome' => 'Gabriel Lima', 'status' => 'Confirmado'],
              ['nome' => 'Paula Mendes', 'status' => 'Confirmado'],
              ['nome' => 'Rafael Nunes', 'status' => 'Confirmado'],
              ['nome' => 'Fernanda Costa', 'status' => 'Confirmado'],
              ['nome' => 'Bruno Silva', 'status' => 'Confirmado'],
              ['nome' => 'Juliana Santos', 'status' => 'Confirmado'],
              ['nome' => 'Ricardo Oliveira', 'status' => 'Confirmado'],
              ['nome' => 'Amanda Rocha', 'status' => 'Confirmado'],
            ]
          ],
          'missa2' => [
            'titulo' => 'Missa das Famílias',
            'dia' => 'Domingo',
            'hora' => '10:00',
            'paroquia' => 'Paróquia São José',
            'endereco' => 'Rua Principal, 123 - Centro',
            'sacerdote' => 'Pe. João Silva',
            'responsavel' => 'Pe. João Silva',
            'coroinhas' => ['Gabriel Lima', 'Lucas Martins', 'Pedro Santos', 'João Pedro'],
            'acenista' => 'Maria da Silva',
            'catequista' => 'Professora Carla',
            'coordenador' => 'Francisco Santos',
            'participantes' => 67,
            'descricao' => 'Missa especial para famílias com atividades para crianças. Ambiente acolhedor para todos. Inclui momento de interação e comunhão familiar.',
            'participantes_lista' => [
              ['nome' => 'Família Silva', 'status' => 'Confirmado'],
              ['nome' => 'Família Costa', 'status' => 'Confirmado'],
              ['nome' => 'Família Pereira', 'status' => 'Confirmado'],
              ['nome' => 'Família Martins', 'status' => 'Confirmado'],
              ['nome' => 'Família Santos', 'status' => 'Confirmado'],
              ['nome' => 'Família Oliveira', 'status' => 'Confirmado'],
            ]
          ],
          'missa3' => [
            'titulo' => 'Missa Vespertina',
            'dia' => 'Domingo',
            'hora' => '18:00',
            'paroquia' => 'Paróquia São José',
            'endereco' => 'Rua Principal, 123 - Centro',
            'sacerdote' => 'Pe. João Silva',
            'responsavel' => 'Pe. João Silva',
            'coroinhas' => ['Pedro Santos', 'João Pedro', 'Mateus Silva'],
            'acenista' => 'José da Silva',
            'coordenador' => 'Antônio Carlos',
            'participantes' => 38,
            'descricao' => 'Celebração solene no final do dia. Momento de reflexão e comunhão em família.',
            'participantes_lista' => [
              ['nome' => 'Antônio Silva', 'status' => 'Confirmado'],
              ['nome' => 'Beatriz Costa', 'status' => 'Confirmado'],
              ['nome' => 'Carlos Mendes', 'status' => 'Confirmado'],
              ['nome' => 'Diana Rocha', 'status' => 'Confirmado'],
              ['nome' => 'Elvira Santos', 'status' => 'Confirmado'],
            ]
          ],
          'missa4' => [
            'titulo' => 'Missa de Sábado',
            'dia' => 'Sábado',
            'hora' => '19:00',
            'paroquia' => 'Paróquia Nossa Senhora',
            'endereco' => 'Av. das Flores, 456 - Vila Nova',
            'sacerdote' => 'Pe. Carlos Mendes',
            'responsavel' => 'Pe. Carlos Mendes',
            'coroinhas' => ['Mateus Silva', 'João Pedro', 'Daniel Costa'],
            'acenista' => 'Antonio das Flores',
            'coordenador' => 'Vicente Luiz',
            'participantes' => 52,
            'descricao' => 'Missa solene de sábado à noite para preparação do Domingo. Comunidade acolhedora.',
            'participantes_lista' => [
              ['nome' => 'Felipe Alves', 'status' => 'Confirmado'],
              ['nome' => 'Gisele Martins', 'status' => 'Confirmado'],
              ['nome' => 'Henrique Nunes', 'status' => 'Confirmado'],
              ['nome' => 'Iris Pereira', 'status' => 'Confirmado'],
              ['nome' => 'Janete Silva', 'status' => 'Confirmado'],
            ]
          ],
          'missa5' => [
            'titulo' => 'Missa Solene',
            'dia' => 'Domingo',
            'hora' => '09:30',
            'paroquia' => 'Paróquia Nossa Senhora',
            'endereco' => 'Av. das Flores, 456 - Vila Nova',
            'sacerdote' => 'Pe. Carlos Mendes',
            'responsavel' => 'Pe. Carlos Mendes',
            'coroinhas' => ['Daniel Costa', 'Mateus Silva', 'João Pedro', 'Lucas Martins'],
            'acenista' => 'Padre Assistente',
            'coral' => 'Coral Paroquial',
            'coordenador' => 'Deácono Paulo',
            'participantes' => 71,
            'descricao' => 'Celebração dominical principal com canto coral e participação comunitária especial. Grande participação da comunidade.',
            'participantes_lista' => [
              ['nome' => 'Karol Silva', 'status' => 'Confirmado'],
              ['nome' => 'Leonardo Costa', 'status' => 'Confirmado'],
              ['nome' => 'Mariana Santos', 'status' => 'Confirmado'],
              ['nome' => 'Norberto Alves', 'status' => 'Confirmado'],
              ['nome' => 'Olivia Rocha', 'status' => 'Confirmado'],
            ]
          ]
        ];

        $missaId = $_GET['missa'] ?? 'missa1';
        $missa = $missas[$missaId] ?? $missas['missa1'];
      ?>

      <div class="bg-gradient-to-br from-accent/10 to-accent/5 rounded-2xl p-8 mb-8 border-2 border-accent/30">
        <h1 class="text-5xl font-display font-bold text-primary mb-4"><?php echo $missa['titulo']; ?></h1>
        <p class="text-lg text-gray-600 leading-relaxed"><?php echo $missa['descricao']; ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white border-2 border-accent/30 rounded-xl p-6">
          <h2 class="text-2xl font-display font-bold text-primary mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Horário e Local
          </h2>
          <div class="space-y-4">
            <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
              <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <p class="text-sm text-gray-600 font-medium">Hora</p>
                <p class="text-xl font-bold text-primary"><?php echo $missa['dia'] . ", " . $missa['hora']; ?></p>
              </div>
            </div>
            <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
              <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <div>
                <p class="text-sm text-gray-600 font-medium">Local</p>
                <p class="text-lg font-semibold text-primary"><?php echo $missa['paroquia']; ?></p>
                <p class="text-sm text-gray-500"><?php echo $missa['endereco']; ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white border-2 border-accent/30 rounded-xl p-6">
          <h2 class="text-2xl font-display font-bold text-primary mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Responsáveis
          </h2>
          <div class="space-y-3">
            <div class="p-3 bg-accent/5 rounded-lg border border-accent/20">
              <p class="text-xs text-gray-600 font-medium">Sacerdote Celebrante</p>
              <p class="font-semibold text-primary"><?php echo $missa['sacerdote']; ?></p>
            </div>
            <div class="p-3 bg-accent/5 rounded-lg border border-accent/20">
              <p class="text-xs text-gray-600 font-medium">Coordenador</p>
              <p class="font-semibold text-primary"><?php echo $missa['coordenador']; ?></p>
            </div>
            <div class="p-3 bg-accent/5 rounded-lg border border-accent/20">
              <p class="text-xs text-gray-600 font-medium">Acenista</p>
              <p class="font-semibold text-primary"><?php echo $missa['acenista']; ?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white border-2 border-accent/30 rounded-xl p-6 mb-8">
        <h2 class="text-2xl font-display font-bold text-primary mb-6 flex items-center gap-2">
          <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          Coroinhas
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <?php foreach ($missa['coroinhas'] as $coroinha): ?>
            <div class="p-4 bg-accent/5 rounded-lg border border-accent/20 flex items-center gap-3">
              <div class="w-12 h-12 rounded-full bg-accent flex items-center justify-center text-white font-bold">
                <?php echo strtoupper(substr($coroinha, 0, 1)); ?>
              </div>
              <div>
                <p class="font-semibold text-primary"><?php echo $coroinha; ?></p>
                <p class="text-xs text-gray-600">Coroinha</p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="bg-white border-2 border-accent/30 rounded-xl p-6">
        <h2 class="text-2xl font-display font-bold text-primary mb-2 flex items-center gap-2">
          <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Participantes Confirmados (<?php echo $missa['participantes']; ?>)
        </h2>
        <p class="text-sm text-gray-600 mb-6">Fiéis que confirmaram presença</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto">
          <?php foreach (array_slice($missa['participantes_lista'], 0, 8) as $participante): ?>
            <div class="p-4 bg-accent/5 rounded-lg border border-accent/20 flex items-center gap-3 hover:bg-accent/10 transition-colors">
              <div class="w-10 h-10 rounded-full bg-accent flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                <?php echo strtoupper(substr($participante['nome'], 0, 1)); ?>
              </div>
              <div class="flex-1">
                <p class="font-semibold text-primary text-sm"><?php echo $participante['nome']; ?></p>
                <p class="text-xs text-accent bg-accent/10 w-fit px-2 py-1 rounded"><?php echo $participante['status']; ?></p>
              </div>
            </div>
          <?php endforeach; ?>
          <?php if (count($missa['participantes_lista']) > 8): ?>
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center col-span-full">
              <p class="text-gray-600 font-medium">+ <?php echo count($missa['participantes_lista']) - 8; ?> participantes</p>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="mt-12 flex justify-between">
        <a href="../index.php#programacoes" class="inline-flex items-center gap-2 text-accent hover:text-accent-dark transition-colors font-semibold">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Voltar às Programações
        </a>
        <a href="../index.php" class="inline-flex items-center gap-2 text-accent hover:text-accent-dark transition-colors font-semibold">
          Ir para Página Principal
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>
    </div>
  </main>

  <footer class="bg-primary text-white py-12 px-4 sm:px-6 lg:px-8 mt-20">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div>
          <h4 class="text-lg font-bold mb-4">Digital Parish</h4>
          <p class="text-gray-400 text-sm">Sistema integrado de gerenciamento paroquial</p>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4">Links Rápidos</h4>
          <ul class="space-y-2 text-sm text-gray-400">
            <li><a href="../index.php#inicio" class="hover:text-accent transition-colors">Início</a></li>
            <li><a href="../index.php#programacoes" class="hover:text-accent transition-colors">Programações</a></li>
            <li><a href="../index.php#parcerias" class="hover:text-accent transition-colors">Parcerias</a></li>
            <li><a href="../index.php#sobre" class="hover:text-accent transition-colors">Sobre</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4">Contato</h4>
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
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', () => {
        if (mobileMenu) {
          mobileMenu.classList.toggle('active');
        }
      });
    }
  </script>
</body>
</html>
