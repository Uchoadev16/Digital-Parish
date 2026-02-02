<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$titulo_pagina = 'Informações da Paróquia';
$breadcrumb = [['label' => 'Gerenciador de Paróquias', 'url' => '../index.php'], ['label' => 'Informações', 'url' => '']];
include '_layout_view.php';

$paroquias = [
  1 => ['nome' => 'Paróquia São José', 'endereco' => 'Rua Principal, 123 – Centro', 'secretario' => 'Maria Silva', 'paroco' => 'Pe. João Silva', 'vigarios' => ['Pe. Carlos', 'Pe. Antônio']],
  2 => ['nome' => 'Paróquia Nossa Senhora', 'endereco' => 'Av. das Flores, 456', 'secretario' => 'José Santos', 'paroco' => 'Pe. Carlos Mendes', 'vigarios' => ['Pe. Paulo']],
  3 => ['nome' => 'Paróquia São Pedro', 'endereco' => 'Pça. da Igreja, 789', 'secretario' => 'Ana Oliveira', 'paroco' => 'Pe. Pedro Costa', 'vigarios' => []],
];
$p = isset($paroquias[$id]) ? $paroquias[$id] : null;
?>
<section class="mb-8">
  <?php if ($p): ?>
  <div class="bg-white rounded-2xl border-2 border-accent/20 overflow-hidden max-w-3xl">
    <div class="h-2 bg-gradient-to-r from-accent to-accent-dark"></div>
    <div class="p-8">
      <h2 class="text-2xl font-display font-bold text-primary mb-6"><?php echo htmlspecialchars($p['nome']); ?></h2>
      <dl class="space-y-4">
        <div>
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Endereço</dt>
          <dd class="text-gray-800 mt-1"><?php echo htmlspecialchars($p['endereco']); ?></dd>
        </div>
        <div>
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pároco</dt>
          <dd class="text-gray-800 mt-1"><?php echo htmlspecialchars($p['paroco']); ?></dd>
        </div>
        <div>
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Secretário(a)</dt>
          <dd class="text-gray-800 mt-1"><?php echo htmlspecialchars($p['secretario']); ?></dd>
        </div>
        <div>
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Vigário(s)</dt>
          <dd class="text-gray-800 mt-1"><?php echo count($p['vigarios']) ? implode(', ', array_map('htmlspecialchars', $p['vigarios'])) : '—'; ?></dd>
        </div>
      </dl>
      <div class="mt-8 pt-6 border-t border-gray-100 flex gap-4">
        <a href="editar.php?id=<?php echo $id; ?>" class="btn-primary px-6 py-3 rounded-xl text-white font-semibold inline-flex items-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
          Editar paróquia
        </a>
        <a href="../index.php" class="px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:bg-gray-50">Voltar à listagem</a>
      </div>
    </div>
  </div>
  <?php else: ?>
  <p class="text-gray-600">Paróquia não encontrada.</p>
  <a href="../index.php" class="inline-block mt-4 text-accent font-semibold hover:text-accent-dark">Voltar à listagem</a>
  <?php endif; ?>
</section>
</div></main></body></html>
