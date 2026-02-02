<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' - ' : ''; ?>Gerenciador de Paróquias - Digital Parish</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Playfair Display', 'serif'] },
          colors: {
            primary: '#1a1a1a', accent: '#d4a574', 'accent-dark': '#b8935e',
            'warm-gray': '#fafaf9', 'deep-blue': '#1e3a5f', 'wine': '#722f37',
          },
        },
      },
    }
  </script>
  <style>
    .golden-glow { box-shadow: 0 10px 30px rgba(212, 165, 116, 0.2); }
    .btn-primary { background: linear-gradient(135deg, #d4a574 0%, #b8935e 100%); transition: all 0.3s ease; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(212, 165, 116, 0.4); }
    .mobile-menu { transform: translateX(-100%); transition: transform 0.3s ease-out; }
    .mobile-menu.active { transform: translateX(0); }
  </style>
</head>
<body class="bg-warm-gray text-primary font-sans antialiased min-h-screen">
  <?php
    $logoPath = '../../main/index.php';
    $navPath = '../../main/';
    include '../components/header.php';
  ?>
  <main class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <?php if (!empty($breadcrumb)): ?>
      <nav class="mb-6 text-sm text-gray-600">
        <?php foreach ($breadcrumb as $i => $item): ?>
          <?php if (!empty($item['url'])): ?>
            <a href="<?php echo htmlspecialchars($item['url']); ?>" class="text-accent hover:text-accent-dark"><?php echo htmlspecialchars($item['label']); ?></a>
          <?php else: ?>
            <span class="text-primary font-semibold"><?php echo htmlspecialchars($item['label']); ?></span>
          <?php endif; ?>
          <?php if ($i < count($breadcrumb) - 1): ?> <span class="mx-2">/</span> <?php endif; ?>
        <?php endforeach; ?>
      </nav>
      <?php endif; ?>
      <h1 class="text-4xl font-display font-bold text-primary mb-8"><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) : 'Gerenciador'; ?></h1>
      <div class="w-24 h-1.5 bg-accent rounded-full golden-glow mb-8"></div>
