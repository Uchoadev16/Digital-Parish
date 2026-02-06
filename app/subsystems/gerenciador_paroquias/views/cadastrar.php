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
  </style>
</head>

<body class="bg-warm-gray min-h-screen font-sans text-primary">
  <main class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-display font-bold text-primary mb-8">Cadastrar Paróquia</h1>
    <section class="mb-8">
      <p class="text-gray-600 mb-6">Conforme o caso de uso, ao cadastrar a paróquia são incluídos: <strong>Secretário</strong>, <strong>Pároco</strong> e <strong>Vigário(s)</strong>. O cadastro do usuário do pároco e dos vigários (se houver) faz parte do fluxo.</p>

      <form class="space-y-8 max-w-3xl" method="post" action="#" id="form-cadastro">
        <div class="bg-white rounded-2xl border-2 border-accent/20 p-6">
          <h2 class="text-xl font-display font-bold text-primary mb-4">Dados da paróquia</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
              <section class="mb-8">
                <p class="text-gray-600 mb-6">Conforme o caso de uso, ao cadastrar a paróquia são incluídos: <strong>Secretário</strong>, <strong>Pároco</strong> e <strong>Vigário(s)</strong>. O cadastro do usuário do pároco e dos vigários (se houver) faz parte do fluxo.</p>

                <form class="space-y-8 max-w-3xl" method="post" action="#" id="form-cadastro">
                  <div class="bg-white rounded-2xl border-2 border-accent/20 p-6">
                    <h2 class="text-xl font-display font-bold text-primary mb-4">Dados da paróquia</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nome da paróquia</label>
                        <input type="text" name="nome" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Ex: Paróquia São José" />
                      </div>
                      <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Endereço</label>
                        <input type="text" name="endereco" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Rua, número, bairro, cidade" />
                      </div>
                    </div>
                  </div>

                  <div class="bg-white rounded-2xl border-2 border-accent/20 p-6">
                    <h2 class="text-xl font-display font-bold text-primary mb-4">Cadastrar Secretário</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nome</label>
                        <input type="text" name="secretario_nome" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" />
                      </div>
                      <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail</label>
                        <input type="email" name="secretario_email" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" />
                      </div>
                    </div>
                  </div>

                  <div class="bg-white rounded-2xl border-2 border-accent/20 p-6">
                    <h2 class="text-xl font-display font-bold text-primary mb-4">Cadastrar Pároco</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nome</label>
                        <input type="text" name="paroco_nome" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Ex: Pe. João Silva" />
                      </div>
                      <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail (usuário do pároco)</label>
                        <input type="email" name="paroco_email" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" />
                      </div>
                    </div>
                  </div>

                  <div class="bg-white rounded-2xl border-2 border-accent/20 p-6">
                    <h2 class="text-xl font-display font-bold text-primary mb-4">Cadastrar Vigário(s)</h2>
                    <p class="text-gray-600 text-sm mb-4">Se houver vigários, inclua os dados. O sistema pode solicitar verificação de código conforme o caso de uso.</p>
                    <div id="vigarios-container" class="space-y-4">
                      <div class="vigario-item flex gap-4 items-end">
                        <input type="text" name="vigario_nome[]" class="flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Nome do vigário" />
                        <input type="email" name="vigario_email[]" class="flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="E-mail" />
                        <button type="button" class="btn-remove-vigario p-2 text-red-600 hover:bg-red-50 rounded-lg hidden">Remover</button>
                      </div>
                    </div>
                    <button type="button" id="add-vigario" class="mt-4 text-accent font-semibold hover:text-accent-dark inline-flex items-center gap-1">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                      Adicionar vigário
                    </button>
                  </div>

                  <div class="flex gap-4">
                    <a href="../index.php" class="px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:bg-gray-50">Voltar</a>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-white font-semibold">Cadastrar paróquia</button>
                  </div>
                </form>
              </section>
              <script>
                document.getElementById('add-vigario').addEventListener('click', function() {
                  var container = document.getElementById('vigarios-container');
                  var div = document.createElement('div');
                  div.className = 'vigario-item flex gap-4 items-end';
                  div.innerHTML = '<input type="text" name="vigario_nome[]" class="flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Nome do vigário" /><input type="email" name="vigario_email[]" class="flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="E-mail" /><button type="button" class="btn-remove-vigario p-2 text-red-600 hover:bg-red-50 rounded-lg">Remover</button>';
                  container.appendChild(div);
                  div.querySelector('.btn-remove-vigario').addEventListener('click', function() {
                    div.remove();
                  });
                });
                document.querySelectorAll('.btn-remove-vigario').forEach(function(btn) {
                  btn.addEventListener('click', function() {
                    this.closest('.vigario-item').remove();
                  });
                });
                document.getElementById('form-cadastro').addEventListener('submit', function(e) {
                  e.preventDefault();
                  alert('Cadastro será processado pelo backend. Por ora esta é apenas a tela conforme documentação.');
                });
              </script>
            </div>
  </main>
</body>

</html>