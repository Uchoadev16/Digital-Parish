<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$titulo_pagina = 'Editar Paróquia';
$breadcrumb = [['label' => 'Gerenciador de Paróquias', 'url' => '../index.php'], ['label' => 'Editar', 'url' => '']];
include '_layout_view.php';
?>
<section class="mb-8">
  <p class="text-gray-600 mb-6">Altere as informações da paróquia conforme necessário. (Paróquia #<?php echo $id; ?> – dados carregados do backend.)</p>

  <form class="space-y-8 max-w-3xl" method="post" action="#">
    <div class="bg-white rounded-2xl border-2 border-accent/20 p-6">
      <h2 class="text-xl font-display font-bold text-primary mb-4">Dados da paróquia</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="sm:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-1">Nome da paróquia</label>
          <input type="text" name="nome" value="" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Ex: Paróquia São José" />
        </div>
        <div class="sm:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-1">Endereço</label>
          <input type="text" name="endereco" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent outline-none" placeholder="Rua, número, bairro, cidade" />
        </div>
      </div>
    </div>

    <div class="flex gap-4">
      <a href="../index.php" class="px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:bg-gray-50">Voltar</a>
      <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-white font-semibold">Salvar alterações</button>
    </div>
  </form>
</section>
</div></main></body></html>
