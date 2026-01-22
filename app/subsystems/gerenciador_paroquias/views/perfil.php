<?php
require_once(__DIR__ . "/../models/Sessions.php");
require_once(__DIR__ . "/../models/SelectMain.php");
require_once(__DIR__ . "/../models/User.php");

$session = new Sessions();
$select = new SelectMain();
$user = new User();
$dados_usuario = $select->selectDadosUsuario($_SESSION['id']);
$dados_usuario_paroquia = $select->selectParoquiaUsuario($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Digital Parish</title>
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

        /* Estilos para a seção de foto de perfil */
        #fotoPreviewContainer {
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

        label[for="foto_perfil"]:hover,
        label[for="fotoInput"]:hover {
            transform: scale(1.05);
        }

        label[for="foto_perfil"]:active,
        label[for="fotoInput"]:active {
            transform: scale(0.95);
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


        <!-- Profile Header -->
        <div class="bg-white rounded-2xl p-8 golden-glow border border-accent/10 mb-6">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <!-- Foto de Perfil -->
                <div class="relative flex-shrink-0">
                    <div class="relative w-40 h-40 rounded-full overflow-hidden border-4 border-accent/20 shadow-lg">
                        <img id="fotoPerfilAtual" src="../assets/foto_perfil/<?= $_SESSION['foto_perfil'] ?? '' ?>" alt="Foto de perfil" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-accent/20 flex items-center justify-center\'><svg class=\'w-20 h-20 text-accent\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\' /></svg></div>'">
                    </div>
                    <!-- Botão de Editar Foto -->
                    <label for="foto_perfil" class="absolute bottom-0 right-0 w-12 h-12 bg-accent rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-accent-dark transition-all duration-300 transform hover:scale-110 border-4 border-white">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input type="file" 
                               id="foto_perfil" 
                               name="foto_perfil" 
                               class="hidden" 
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               onchange="handleImageSelect(event)">
                    </label>
                </div>

                <!-- Formulário de Upload de Foto -->
                <div class="flex-1 w-full">
                    <form id="formFotoPerfil" method="post" action="../controllers/controller_auth.php" enctype="multipart/form-data">
                        <input type="hidden" name="id_usuario" value="<?=$_SESSION['id']?>">
                        <input type="hidden" name="alterar_foto" value="1">
                        <input type="file" id="fotoInput" name="foto_perfil" accept="image/jpeg,image/png,image/gif,image/webp" class="hidden" onchange="previewFoto(this)">
                        
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-primary mb-2">Foto de Perfil</h3>
                                <p class="text-sm text-primary/60">Atualize sua foto de perfil para personalizar sua conta</p>
                            </div>
                            
                            <!-- Preview e Botão de Enviar -->
                            <div id="fotoPreviewContainer" class="hidden">
                                <div class="bg-gradient-to-br from-accent/10 to-accent/5 rounded-xl p-6 border-2 border-accent/20">
                                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                                        <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-accent/30 flex-shrink-0 shadow-md">
                                            <img id="fotoPreview" src="" alt="Preview" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 w-full">
                                            <div class="mb-4">
                                                <p class="text-sm font-medium text-primary/80 mb-1">Arquivo selecionado:</p>
                                                <p id="nomeArquivo" class="text-sm font-semibold text-accent-dark break-all"></p>
                                                <p class="text-xs text-primary/50 mt-2">Formatos aceitos: JPG, PNG, GIF, WEBP • Máximo: 5MB</p>
                                            </div>
                                            <div class="flex flex-col sm:flex-row gap-3">
                                                <button type="button" onclick="enviarFoto()" class="btn-primary text-white px-6 py-3 rounded-xl font-semibold text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Confirmar e Enviar
                                                </button>
                                                <button type="button" onclick="cancelarFoto()" class="px-6 py-3 rounded-xl font-semibold text-sm border-2 border-gray-200 text-primary hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 flex items-center justify-center gap-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botão alternativo para selecionar foto (quando não há preview) -->
                            <div id="fotoSelectButton" class="flex items-center gap-4">
                                <label for="fotoInput" class="btn-primary text-white px-6 py-3 rounded-xl font-semibold text-sm cursor-pointer flex items-center gap-2 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Selecionar Nova Foto
                                </label>
                                <span class="text-sm text-primary/50">ou clique no ícone da câmera na foto</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cards de Informações -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Card Nome -->
            <div class="bg-white rounded-2xl p-6 golden-glow border border-accent/10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-primary/60">Nome</h3>
                </div>
                <p class="text-xl font-serif font-semibold text-primary">
                    <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?>
                </p>
            </div>

            <!-- Card Email -->
            <div class="bg-white rounded-2xl p-6 golden-glow border border-accent/10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-primary/60">Email</h3>
                </div>
                <p class="text-xl font-serif font-semibold text-primary">
                    <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>
                </p>
            </div>

            <!-- Card CPF -->
            <div class="bg-white rounded-2xl p-6 golden-glow border border-accent/10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-primary/60">CPF</h3>
                </div>
                <p class="text-xl font-serif font-semibold text-primary">
                    <?php echo htmlspecialchars($_SESSION['cpf'] ?? ''); ?>
                </p>
            </div>

            <!-- Card Telefone -->
            <div class="bg-white rounded-2xl p-6 golden-glow border border-accent/10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-primary/60">Telefone</h3>
                    </div>
                    <button onclick="toggleEditTelefone()" class="text-accent hover:text-accent-dark transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>
                <div id="telefoneDisplay">
                    <p class="text-xl font-serif font-semibold text-primary">
                        <?php echo !empty($dados_usuario['telefone']) ? htmlspecialchars($dados_usuario['telefone']) : 'Não informado'; ?>
                    </p>
                </div>
                <div id="telefoneEdit" class="hidden">
                    <form action="../controllers/controller_auth.php" method="post" class="space-y-3">
                        <input type="hidden" name="alterar_telefone" value="1">
                        <input
                            type="tel"
                            id="telefoneInput"
                            name="telefone"
                            value="<?php echo htmlspecialchars($dados_usuario['telefone'] ?? ''); ?>"
                            placeholder="(00) 00000-0000"
                            class="input-field w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary"
                            maxlength="15"
                            oninput="formatTelefone(this)"
                            required>
                        <div class="flex gap-2">
                            <button type="submit" class="btn-primary text-white px-4 py-2 rounded-xl font-semibold text-sm flex-1">
                                Salvar
                            </button>
                            <button type="button" onclick="toggleEditTelefone()" class="px-4 py-2 rounded-xl font-semibold text-sm border-2 border-gray-200 text-primary hover:bg-gray-50">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <style>
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .password-strength.weak {
            background-color: #ef4444;
            width: 33%;
        }

        .password-strength.medium {
            background-color: #f59e0b;
            width: 66%;
        }

        .password-strength.strong {
            background-color: #10b981;
            width: 100%;
        }
    </style>

    <script>
        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validar tamanho do arquivo (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('O arquivo é muito grande. Tamanho máximo: 5MB');
                    input.value = '';
                    return;
                }

                // Validar tipo de arquivo
                if (!file.type.startsWith('image/')) {
                    alert('Por favor, selecione apenas arquivos de imagem.');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('fotoPreview').src = e.target.result;
                    document.getElementById('nomeArquivo').textContent = file.name;
                    document.getElementById('fotoPreviewContainer').classList.remove('hidden');
                    document.getElementById('fotoSelectButton').classList.add('hidden');
                };

                reader.readAsDataURL(file);
            }
        }

        function handleImageSelect(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validar tamanho do arquivo (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('O arquivo é muito grande. Tamanho máximo: 5MB');
                event.target.value = '';
                return;
            }

            // Validar tipo de arquivo
            if (!file.type.startsWith('image/')) {
                alert('Por favor, selecione apenas arquivos de imagem.');
                event.target.value = '';
                return;
            }

            // Atualizar o input do formulário e mostrar preview
            const fotoInput = document.getElementById('fotoInput');
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fotoInput.files = dataTransfer.files;
            
            // Disparar o evento change para mostrar o preview
            previewFoto(fotoInput);
        }

        function enviarFoto() {
            const fotoInput = document.getElementById('fotoInput');
            if (!fotoInput.files || !fotoInput.files[0]) {
                alert('Por favor, selecione uma foto primeiro.');
                return;
            }
            document.getElementById('formFotoPerfil').submit();
        }

        function cancelarFoto() {
            document.getElementById('fotoInput').value = '';
            document.getElementById('foto_perfil').value = '';
            document.getElementById('fotoPreviewContainer').classList.add('hidden');
            document.getElementById('fotoSelectButton').classList.remove('hidden');
            document.getElementById('fotoPreview').src = '';
            document.getElementById('nomeArquivo').textContent = '';
        }
        function formatTelefone(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length <= 10) {
                // Telefone fixo: (00) 0000-0000
                if (value.length > 6) {
                    value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
                } else if (value.length > 2) {
                    value = value.replace(/(\d{2})(\d{0,4})/, '($1) $2');
                } else if (value.length > 0) {
                    value = '(' + value;
                }
            } else {
                // Celular: (00) 00000-0000
                value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
            }

            input.value = value;
        }

        function toggleEditTelefone() {
            const display = document.getElementById('telefoneDisplay');
            const edit = document.getElementById('telefoneEdit');

            if (display.classList.contains('hidden')) {
                display.classList.remove('hidden');
                edit.classList.add('hidden');
            } else {
                display.classList.add('hidden');
                edit.classList.remove('hidden');
                // Foca no input quando abrir o modo de edição
                setTimeout(() => {
                    document.getElementById('telefoneInput').focus();
                }, 100);
            }
        }


        function checkPasswordStrength() {
            const password = document.getElementById('nova_senha').value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            strengthBar.className = 'password-strength mt-2';

            if (password.length === 0) {
                strengthBar.style.width = '0';
                strengthText.textContent = 'Mínimo 8 caracteres';
                strengthText.className = 'text-xs text-primary/50 mt-1';
            } else if (password.length < 6) {
                strengthBar.classList.add('weak');
                strengthText.textContent = 'Senha fraca';
                strengthText.className = 'text-xs text-red-500 mt-1';
            } else if (password.length < 8 || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
                strengthBar.classList.add('medium');
                strengthText.textContent = 'Senha média';
                strengthText.className = 'text-xs text-amber-500 mt-1';
            } else {
                strengthBar.classList.add('strong');
                strengthText.textContent = 'Senha forte';
                strengthText.className = 'text-xs text-emerald-500 mt-1';
            }

            checkPasswordMatch();
        }

        function checkPasswordMatch() {
            const senha = document.getElementById('nova_senha').value;
            const senhaConfirm = document.getElementById('confirmar_senha').value;
            const matchText = document.getElementById('matchText');

            if (senhaConfirm.length === 0) {
                matchText.textContent = 'As senhas devem ser iguais';
                matchText.className = 'text-xs text-primary/50';
            } else if (senha !== senhaConfirm) {
                matchText.textContent = 'As senhas não coincidem';
                matchText.className = 'text-xs text-red-500';
            } else {
                matchText.textContent = 'Senhas coincidem';
                matchText.className = 'text-xs text-emerald-500';
            }
        }
    </script>
</body>

</html>