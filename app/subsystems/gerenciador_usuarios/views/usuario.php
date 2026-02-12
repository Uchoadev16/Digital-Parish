<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Parish - Usuários</title>
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
</head>
<body class="bg-warm-gray text-primary font-sans antialiased">


  <main class="pt-28 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
      <div class="flex items-center justify-between mb-10">
        <div>
          <h1 class="text-3xl sm:text-4xl font-display font-bold text-primary">Usuários</h1>
          <p class="mt-2 text-gray-600">
            Aqui você poderá listar, cadastrar e gerenciar os usuários do sistema.
          </p>
        </div>
        <a href="../index.php#inicio" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-accent hover:text-accent-dark">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Voltar ao painel
        </a>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-accent/20 p-6 sm:p-8">
        <p class="text-gray-500 text-sm">
          Área de gerenciamento de usuários ainda não implementada. 
          Utilize esta página para montar a listagem, filtros e formulários de cadastro.
        </p>
      </div>
    </div>
  </main>

</body>
</html>
