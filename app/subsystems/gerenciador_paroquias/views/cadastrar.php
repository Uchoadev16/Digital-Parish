<?php
require_once(__DIR__ . "/../models/Sessions.php");
$session = new Sessions();
if (isset($_GET['logout'])) {
  $session->logout();
}
?>
<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Paróquia - Digital Parish</title>
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
    .section-card {
      transition: box-shadow 0.3s ease;
    }
    .section-card:focus-within {
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.12);
    }
    .file-zone {
      border: 2px dashed rgba(212, 165, 116, 0.4);
      transition: all 0.2s ease;
    }
    .file-zone:hover, .file-zone.has-file {
      border-color: #d4a574;
      background: rgba(212, 165, 116, 0.06);
    }
  </style>
</head>

<body class="bg-warm-gray min-h-screen font-sans text-primary antialiased">
  <main class="max-w-3xl mx-auto px-4 sm:px-6 py-10 lg:py-14">
    <div class="mb-10">
      <h1 class="text-4xl font-display font-bold text-primary mb-2">Cadastrar Paróquia</h1>
      <p class="text-gray-600">
        Ao cadastrar a paróquia são incluídos: <strong>Secretário</strong>, <strong>Pároco</strong> e <strong>Vigário(s)</strong>. O cadastro do usuário do pároco e dos vigários (se houver) faz parte do fluxo.
      </p>
      <div class="w-24 h-1.5 bg-accent rounded-full mt-4 golden-glow"></div>
    </div>

    <form class="space-y-8" method="post" action="#" id="form-cadastro" enctype="multipart/form-data">
      <!-- Dados da paróquia -->
      <div class="section-card bg-white rounded-2xl border-2 border-accent/20 p-6 sm:p-8">
        <h2 class="text-xl font-display font-bold text-primary mb-1 flex items-center gap-2">
          <span class="w-8 h-8 rounded-lg bg-accent/15 text-accent flex items-center justify-center text-sm font-sans font-bold">1</span>
          Dados da paróquia
        </h2>
        <p class="text-gray-500 text-sm mb-6 ml-10">Nome, localização, logo e telefone.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div class="sm:col-span-2">
            <label for="nome" class="block text-sm font-semibold text-gray-700 mb-1.5">Nome da paróquia</label>
            <input id="nome" type="text" name="nome" required
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400"
              placeholder="Ex: Paróquia São José" />
          </div>
          <div class="sm:col-span-2">
            <label for="endereco" class="block text-sm font-semibold text-gray-700 mb-1.5">Endereço</label>
            <input id="endereco" type="text" name="endereco"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400"
              placeholder="Rua, número, bairro, cidade" />
          </div>
          <div>
            <label for="telefone" class="block text-sm font-semibold text-gray-700 mb-1.5">Telefone da paróquia</label>
            <input id="telefone" type="text" name="telefone"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400"
              placeholder="(00) 0000-0000 ou (00) 00000-0000" />
          </div>
          <div>
            <span class="block text-sm font-semibold text-gray-700 mb-1.5">Logo da paróquia</span>
            <label for="logo" class="file-zone flex flex-col items-center justify-center w-full h-32 rounded-xl cursor-pointer bg-warm-gray/80">
              <input id="logo" type="file" name="logo" accept="image/*" class="hidden" />
              <span id="logo-label" class="text-sm text-gray-500 text-center px-2">Clique ou arraste uma imagem</span>
              <span class="text-xs text-gray-400 mt-1">PNG, JPG ou WEBP</span>
            </label>
          </div>
        </div>
      </div>

      <!-- Secretário -->
      <div class="section-card bg-white rounded-2xl border-2 border-accent/20 p-6 sm:p-8">
        <h2 class="text-xl font-display font-bold text-primary mb-1 flex items-center gap-2">
          <span class="w-8 h-8 rounded-lg bg-accent/15 text-accent flex items-center justify-center text-sm font-sans font-bold">2</span>
          Secretário
        </h2>
        <p class="text-gray-500 text-sm mb-6 ml-10">Dados do secretário da paróquia.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="secretario_nome" class="block text-sm font-semibold text-gray-700 mb-1.5">Nome</label>
            <input id="secretario_nome" type="text" name="secretario_nome"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400" />
          </div>
          <div>
            <label for="secretario_cpf" class="block text-sm font-semibold text-gray-700 mb-1.5">CPF</label>
            <input id="secretario_cpf" type="text" name="secretario_cpf" maxlength="14"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400"
              placeholder="000.000.000-00" />
          </div>
          <div class="sm:col-span-2">
            <label for="secretario_email" class="block text-sm font-semibold text-gray-700 mb-1.5">E-mail</label>
            <input id="secretario_email" type="email" name="secretario_email"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400" />
          </div>
        </div>
      </div>

      <!-- Pároco -->
      <div class="section-card bg-white rounded-2xl border-2 border-accent/20 p-6 sm:p-8">
        <h2 class="text-xl font-display font-bold text-primary mb-1 flex items-center gap-2">
          <span class="w-8 h-8 rounded-lg bg-accent/15 text-accent flex items-center justify-center text-sm font-sans font-bold">3</span>
          Pároco
        </h2>
        <p class="text-gray-500 text-sm mb-6 ml-10">Nome e e-mail (usuário do pároco).</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="paroco_nome" class="block text-sm font-semibold text-gray-700 mb-1.5">Nome</label>
            <input id="paroco_nome" type="text" name="paroco_nome"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400"
              placeholder="Ex: Pe. João Silva" />
          </div>
          <div>
            <label for="paroco_cpf" class="block text-sm font-semibold text-gray-700 mb-1.5">CPF</label>
            <input id="paroco_cpf" type="text" name="paroco_cpf" maxlength="14"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400"
              placeholder="000.000.000-00" />
          </div>
          <div class="sm:col-span-2">
            <label for="paroco_email" class="block text-sm font-semibold text-gray-700 mb-1.5">E-mail (usuário do pároco)</label>
            <input id="paroco_email" type="email" name="paroco_email"
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all placeholder-gray-400" />
          </div>
        </div>
      </div>

      <!-- Vigários -->
      <div class="section-card bg-white rounded-2xl border-2 border-accent/20 p-6 sm:p-8">
        <h2 class="text-xl font-display font-bold text-primary mb-1 flex items-center gap-2">
          <span class="w-8 h-8 rounded-lg bg-accent/15 text-accent flex items-center justify-center text-sm font-sans font-bold">4</span>
          Vigário(s)
        </h2>
        <p class="text-gray-500 text-sm mb-4 ml-10">Se houver vigários, inclua os dados. O sistema pode solicitar verificação de código conforme o caso de uso.</p>
        <div id="vigarios-container" class="space-y-4 ml-10">
          <div class="vigario-item flex flex-wrap gap-3 items-end">
            <input type="text" name="vigario_nome[]" class="flex-1 min-w-[140px] px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" placeholder="Nome do vigário" />
            <input type="text" name="vigario_cpf[]" maxlength="14" class="w-36 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" placeholder="CPF" />
            <input type="email" name="vigario_email[]" class="flex-1 min-w-[140px] px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" placeholder="E-mail" />
            <button type="button" class="btn-remove-vigario p-2.5 text-red-600 hover:bg-red-50 rounded-xl transition-colors shrink-0 hidden" title="Remover vigário">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </div>
        </div>
        <div class="ml-10 mt-4">
          <button type="button" id="add-vigario" class="inline-flex items-center gap-2 text-accent font-semibold hover:text-accent-dark transition-colors py-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Adicionar vigário
          </button>
        </div>
      </div>

      <!-- Ações -->
      <div class="flex flex-wrap gap-4 pt-2">
        <a href="../index.php" class="px-6 py-3.5 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition-colors inline-flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Voltar
        </a>
        <button type="submit" class="btn-primary px-8 py-3.5 rounded-xl text-white font-semibold shadow-lg inline-flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          Cadastrar paróquia
        </button>
      </div>
    </form>
  </main>

  <script>
    (function() {
      var form = document.getElementById('form-cadastro');
      var logoInput = document.getElementById('logo');
      var logoLabel = document.getElementById('logo-label');

      if (logoInput && logoLabel) {
        logoInput.addEventListener('change', function() {
          var file = this.files[0];
          var zone = this.closest('.file-zone');
          if (file) {
            logoLabel.textContent = file.name;
            if (zone) zone.classList.add('has-file');
          } else {
            logoLabel.textContent = 'Clique ou arraste uma imagem';
            if (zone) zone.classList.remove('has-file');
          }
        });
      }

      function atualizarBotoesRemover() {
        var items = document.querySelectorAll('.vigario-item');
        items.forEach(function(el) {
          var btn = el.querySelector('.btn-remove-vigario');
          if (btn) btn.classList.toggle('hidden', items.length <= 1);
        });
      }

      document.querySelectorAll('.btn-remove-vigario').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var item = this.closest('.vigario-item');
          if (item && document.querySelectorAll('.vigario-item').length > 1) {
            item.remove();
            atualizarBotoesRemover();
          }
        });
      });

      document.getElementById('add-vigario').addEventListener('click', function() {
        var container = document.getElementById('vigarios-container');
        var div = document.createElement('div');
        div.className = 'vigario-item flex flex-wrap gap-3 items-end';
        div.innerHTML = '<input type="text" name="vigario_nome[]" class="flex-1 min-w-[140px] px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" placeholder="Nome do vigário" /><input type="text" name="vigario_cpf[]" maxlength="14" class="w-36 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" placeholder="CPF" /><input type="email" name="vigario_email[]" class="flex-1 min-w-[140px] px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none" placeholder="E-mail" /><button type="button" class="btn-remove-vigario p-2.5 text-red-600 hover:bg-red-50 rounded-xl transition-colors shrink-0" title="Remover vigário"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>';
        container.appendChild(div);
        div.querySelector('.btn-remove-vigario').addEventListener('click', function() {
          div.remove();
          atualizarBotoesRemover();
        });
        atualizarBotoesRemover();
      });

      atualizarBotoesRemover();

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Cadastro será processado pelo backend. Por ora esta é apenas a tela conforme documentação.');
      });
    })();
  </script>
</body>

</html>
