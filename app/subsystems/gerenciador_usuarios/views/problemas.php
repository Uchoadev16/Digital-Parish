<?php
require_once(__DIR__ . "/../models/Sessions.php");
require_once(__DIR__ . "/../models/SelectMain.php");

$session = new Sessions();
$select = new SelectMain();
$dados_usuario_paroquia = $select->selectParoquiaUsuario($_SESSION['id']);
$reclamacoes = $select->selectProblemasUsers($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Problema - Digital Parish</title>
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

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.2);
        }

        .problema-card {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                    <a href="./subsystems.php" class="text-white/80 hover:text-accent transition-colors text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Título da Página -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-serif font-bold text-primary mb-4">
                Reportar <span class="text-accent">Problema</span>
            </h1>
            <p class="text-lg text-primary/60">
                Descreva o problema encontrado e nossa equipe irá analisar
            </p>
            <div class="w-24 h-1.5 bg-accent rounded-full mx-auto mt-6 golden-glow"></div>
        </div>

        <!-- Formulário de Reclamação -->
        <div class="bg-white rounded-2xl p-8 golden-glow border border-accent/10 mb-8">
            <form id="formProblema" method="post" action="../controllers/controller_auth.php" class="space-y-6">
                
                <div>
                    <label for="problema" class="block text-sm font-semibold text-primary mb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Descreva o problema
                        </div>
                    </label>
                    <textarea 
                        id="problema" 
                        name="problema" 
                        rows="6" 
                        class="input-field w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary resize-none"
                        placeholder="Descreva detalhadamente o problema que você encontrou. Quanto mais informações, melhor poderemos ajudá-lo..."
                        required></textarea>
                    <p class="text-xs text-primary/50 mt-2">Mínimo de 10 caracteres</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary text-white px-8 py-3 rounded-xl font-semibold text-sm flex items-center gap-2 flex-1 justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Enviar Reclamação
                    </button>
                    <button type="reset" class="px-6 py-3 rounded-xl font-semibold text-sm border-2 border-gray-200 text-primary hover:bg-gray-50 transition-all duration-200">
                        Limpar
                    </button>
                </div>
            </form>
        </div>

        <!-- Seção de Reclamações Anteriores -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-serif font-semibold text-primary flex items-center gap-3">
                    <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Minhas Reclamações
                </h2>
                <span class="text-sm text-primary/60 bg-accent/10 px-4 py-2 rounded-full font-medium" id="totalReclamacoes">
                    <!-- Total será preenchido pelo backend -->
                </span>
            </div>

            <!-- Lista de Reclamações -->
            <div id="listaReclamacoes" class="space-y-4">
                
                Exemplo de uso PHP:
                <?php foreach ($reclamacoes as $recl): ?>
                    <div class="problema-card bg-white rounded-2xl p-6 golden-glow border border-accent/10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-primary">Problema #<?= str_pad($recl['id'], 3, '0', STR_PAD_LEFT) ?></h3>
                                    <p class="text-xs text-primary/50">Enviado em <?= date('d/m/Y \à\s H:i', strtotime($recl['data_envio'])) ?></p>
                                </div>
                            </div>
                            <?php
                            $statusClasses = [
                                'pendente' => 'bg-gray-100 text-gray-800',
                                'em_analise' => 'bg-yellow-100 text-yellow-800',
                                'resolvido' => 'bg-green-100 text-green-800',
                                'rejeitado' => 'bg-red-100 text-red-800'
                            ];
                            $statusText = [
                                'pendente' => 'Pendente',
                                'em_analise' => 'Em Análise',
                                'resolvido' => 'Resolvido',
                                'rejeitado' => 'Rejeitado'
                            ];
                            $status = $recl['status'] ?? 'pendente';
                            ?>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $statusClasses[$status] ?? $statusClasses['pendente'] ?>">
                                <?= $statusText[$status] ?? 'Pendente' ?>
                            </span>
                        </div>
                        <p class="text-primary/80 leading-relaxed mb-4 whitespace-pre-wrap">
                            <?= htmlspecialchars($recl['texto']) ?>
                        </p>
                        <?php if (!empty($recl['data_atualizacao'])): ?>
                        <div class="flex items-center gap-2 text-xs text-primary/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Última atualização: <?= date('d/m/Y \à\s H:i', strtotime($recl['data_atualizacao'])) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <!-- Estado vazio (quando não houver reclamações) -->
                <div id="emptyState" class="text-center py-12 bg-white rounded-2xl border border-accent/10">
                    <svg class="w-20 h-20 text-primary/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-serif font-semibold text-primary mb-2">Nenhuma reclamação ainda</h3>
                    <p class="text-primary/60">Suas reclamações aparecerão aqui após serem enviadas.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Validação do formulário
        document.getElementById('formProblema').addEventListener('submit', function(e) {
            const problema = document.getElementById('problema').value.trim();
            
            if (problema.length < 10) {
                e.preventDefault();
                alert('Por favor, descreva o problema com pelo menos 10 caracteres.');
                return false;
            }
        });

        // Contador de caracteres (opcional)
        document.getElementById('problema').addEventListener('input', function() {
            const length = this.value.length;
            const minLength = 10;
            const counter = this.nextElementSibling;
            
            if (length < minLength) {
                counter.textContent = `Mínimo de ${minLength} caracteres (${length}/${minLength})`;
                counter.className = 'text-xs text-red-500 mt-2';
            } else {
                counter.textContent = `${length} caracteres`;
                counter.className = 'text-xs text-primary/50 mt-2';
            }
        });
    </script>
</body>

</html>
