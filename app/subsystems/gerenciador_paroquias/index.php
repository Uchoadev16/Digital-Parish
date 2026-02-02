<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador de Paróquias - Digital Parish</title>
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
    .card-hover {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 40px rgba(212, 165, 116, 0.15);
    }
    .golden-glow {
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.2);
    }
    .btn-primary {
      background: linear-gradient(135deg, #d4a574 0%, #b8935e 100%);
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.4);
    }
    .mobile-menu {
      transform: translateX(-100%);
      transition: transform 0.3s ease-out;
    }
    .mobile-menu.active {
      transform: translateX(0);
    }
    .modal-backdrop {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
    }
  </style>
</head>
<body class="bg-warm-gray text-primary font-sans antialiased min-h-screen">

  <?php
    $logoPath = '../../main/index.php';
    $navPath = '../../main/';
    include './components/header.php';
  ?>

  <main class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

      <!-- Título e botão Cadastrar -->
      <section id="inicio" class="mb-10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
          <div>
            <h1 class="text-4xl sm:text-5xl font-display font-bold text-primary mb-2">
              Gerenciador de Paróquias
            </h1>
            <p class="text-gray-600">
              Cadastre, edite e consulte as paróquias. Clique em <strong>Cadastrar</strong> para incluir paróquia, pároco, secretário e vigários.
            </p>
          </div>
          <a href="./views/cadastrar.php" class="btn-primary inline-flex items-center justify-center gap-2 text-white px-6 py-4 rounded-xl font-semibold text-lg shrink-0 shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Cadastrar Paróquia
          </a>
        </div>
        <div class="w-24 h-1.5 bg-accent rounded-full mt-6 golden-glow"></div>
      </section>

      <!-- Busca (procurar card da paróquia) -->
      <section class="mb-8">
        <label for="busca-paroquia" class="block text-sm font-semibold text-gray-700 mb-2">Procurar paróquia</label>
        <div class="relative max-w-xl">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </span>
          <input type="search" id="busca-paroquia" placeholder="Digite o nome ou endereço da paróquia..." class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all" />
        </div>
      </section>

      <!-- Listagem em cards -->
      <section id="listagem-paroquias">
        <h2 class="text-2xl font-display font-bold text-primary mb-6">Paróquias cadastradas</h2>

        <?php
          // Dados de exemplo conforme documentação (futuramente virão do banco)
          $paroquias = [
            [
              'id' => 1,
              'nome' => 'Paróquia São José',
              'endereco' => 'Rua Principal, 123 – Centro',
              'secretario' => 'Maria Silva',
              'paroco' => 'Pe. João Silva',
              'vigarios' => ['Pe. Carlos', 'Pe. Antônio'],
            ],
            [
              'id' => 2,
              'nome' => 'Paróquia Nossa Senhora',
              'endereco' => 'Av. das Flores, 456',
              'secretario' => 'José Santos',
              'paroco' => 'Pe. Carlos Mendes',
              'vigarios' => ['Pe. Paulo'],
            ],
            [
              'id' => 3,
              'nome' => 'Paróquia São Pedro',
              'endereco' => 'Pça. da Igreja, 789',
              'secretario' => 'Ana Oliveira',
              'paroco' => 'Pe. Pedro Costa',
              'vigarios' => [],
            ],
          ];
        ?>

        <div id="grid-paroquias" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach ($paroquias as $p): ?>
          <article class="paroquia-card bg-white rounded-2xl border-2 border-accent/20 overflow-hidden card-hover" data-nome="<?php echo htmlspecialchars($p['nome']); ?>" data-endereco="<?php echo htmlspecialchars($p['endereco']); ?>">
            <div class="h-2 bg-gradient-to-r from-accent to-accent-dark"></div>
            <div class="p-6">
              <h3 class="text-xl font-display font-bold text-primary mb-2"><?php echo htmlspecialchars($p['nome']); ?></h3>
              <p class="text-gray-600 text-sm mb-4 flex items-start gap-2">
                <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
                <?php echo htmlspecialchars($p['endereco']); ?>
              </p>
              <p class="text-gray-500 text-sm mb-1"><strong>Pároco:</strong> <?php echo htmlspecialchars($p['paroco']); ?></p>
              <p class="text-gray-500 text-sm mb-4"><strong>Secretário(a):</strong> <?php echo htmlspecialchars($p['secretario']); ?></p>

              <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-gray-100">
                <a href="./views/informacoes.php?id=<?php echo (int)$p['id']; ?>" class="text-accent hover:text-accent-dark font-semibold text-sm inline-flex items-center gap-1">
                  Informações
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                  </svg>
                </a>
                <div class="flex items-center gap-2">
                  <a href="./views/editar.php?id=<?php echo (int)$p['id']; ?>" class="p-2 rounded-lg text-gray-600 hover:bg-accent/10 hover:text-accent transition-colors" title="Editar paróquia">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </a>
                  <button type="button" class="btn-excluir p-2 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-600 transition-colors" title="Excluir paróquia" data-id="<?php echo (int)$p['id']; ?>" data-nome="<?php echo htmlspecialchars($p['nome']); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

        <p id="nenhum-resultado" class="hidden text-center text-gray-500 py-12">
          Nenhuma paróquia encontrada com o termo informado.
        </p>
      </section>
    </div>
  </main>

  <!-- Modal Excluir Paróquia (enviar código → verificar código → excluir) -->
  <div id="modal-excluir" class="fixed inset-0 z-50 hidden" aria-hidden="true">
    <div class="modal-backdrop absolute inset-0" id="fecha-modal-backdrop"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
      <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 relative">
        <h3 class="text-xl font-display font-bold text-primary mb-2">Excluir paróquia</h3>
        <p class="text-gray-600 mb-4">
          Será enviado um código para o e-mail do secretário da paróquia <strong id="modal-nome-paroquia"></strong>. Informe o código abaixo para confirmar a exclusão.
        </p>
        <form id="form-excluir" class="space-y-4">
          <input type="hidden" id="modal-id-paroquia" name="id" value="" />
          <div>
            <label for="codigo-exclusao" class="block text-sm font-semibold text-gray-700 mb-1">Código de verificação</label>
            <input type="text" id="codigo-exclusao" name="codigo" placeholder="Digite o código recebido por e-mail" maxlength="8" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" required />
            <p id="erro-codigo" class="hidden mt-2 text-sm text-red-600">Código incorreto. Tente novamente.</p>
          </div>
          <div class="flex gap-3 pt-2">
            <button type="button" id="btn-cancelar-excluir" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
              Cancelar
            </button>
            <button type="submit" class="flex-1 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition-colors">
              Excluir paróquia
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    (function () {
      var busca = document.getElementById('busca-paroquia');
      var grid = document.getElementById('grid-paroquias');
      var cards = document.querySelectorAll('.paroquia-card');
      var nenhumResultado = document.getElementById('nenhum-resultado');

      function filtrar() {
        var termo = (busca.value || '').trim().toLowerCase();
        var visiveis = 0;
        cards.forEach(function (card) {
            var nome = (card.getAttribute('data-nome') || '').toLowerCase();
            var endereco = (card.getAttribute('data-endereco') || '').toLowerCase();
            var exibir = !termo || nome.indexOf(termo) >= 0 || endereco.indexOf(termo) >= 0;
            card.style.display = exibir ? '' : 'none';
            if (exibir) visiveis++;
        });
        nenhumResultado.classList.toggle('hidden', visiveis > 0);
      }

      if (busca) {
          busca.addEventListener('input', filtrar);
          busca.addEventListener('search', filtrar);
      }

      var modal = document.getElementById('modal-excluir');
      var modalNome = document.getElementById('modal-nome-paroquia');
      var modalId = document.getElementById('modal-id-paroquia');
      var formExcluir = document.getElementById('form-excluir');
      var codigoInput = document.getElementById('codigo-exclusao');
      var erroCodigo = document.getElementById('erro-codigo');

      function abrirModal(id, nome) {
          modalNome.textContent = nome;
          modalId.value = id;
          codigoInput.value = '';
          erroCodigo.classList.add('hidden');
          modal.classList.remove('hidden');
          modal.setAttribute('aria-hidden', 'false');
          codigoInput.focus();
      }

      function fecharModal() {
          modal.classList.add('hidden');
          modal.setAttribute('aria-hidden', 'true');
      }

      document.querySelectorAll('.btn-excluir').forEach(function (btn) {
          btn.addEventListener('click', function () {
              var id = this.getAttribute('data-id');
              var nome = this.getAttribute('data-nome');
              abrirModal(id, nome);
          });
      });

      document.getElementById('fecha-modal-backdrop').addEventListener('click', fecharModal);
      document.getElementById('btn-cancelar-excluir').addEventListener('click', fecharModal);

      formExcluir.addEventListener('submit', function (e) {
          e.preventDefault();
          erroCodigo.classList.add('hidden');
          // Aqui seria a chamada ao backend: enviar código, verificar e excluir.
          // Por enquanto apenas simula sucesso (código qualquer aceito para demo).
          var codigo = codigoInput.value.trim();
          if (!codigo) {
              erroCodigo.classList.remove('hidden');
              erroCodigo.textContent = 'Informe o código de verificação.';
              return;
          }
          // Simulação: aceitar código "1234" para demonstração
          if (codigo !== '1234') {
              erroCodigo.textContent = 'Código incorreto. Tente novamente.';
              erroCodigo.classList.remove('hidden');
              return;
          }
          fecharModal();
          // Em produção: redirecionar ou remover o card da lista após exclusão no servidor
          var card = document.querySelector('.btn-excluir[data-id="' + modalId.value + '"]');
          if (card && card.closest('.paroquia-card')) {
              card.closest('.paroquia-card').remove();
          }
      });
    })();
  </script>
</body>
</html>
