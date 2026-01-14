<?php
session_start();

// Verifica se há GET verificado e sessão com CPF e email
$showPasswordForm = false;
if (isset($_GET['verificado']) && isset($_SESSION['cpf']) && isset($_SESSION['email']) && !empty($_SESSION['cpf']) && !empty($_SESSION['email'])) {
  $showPasswordForm = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Conta - Digital Parish</title>
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

    .form-container {
      transition: all 0.3s ease;
      opacity: 1;
      visibility: visible;
    }

    .form-container.hidden {
      opacity: 0;
      visibility: hidden;
      position: absolute;
    }

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
</head>

<body class="min-h-screen font-sans bg-warm-gray">
  <div class="min-h-screen flex flex-col lg:flex-row">

    <div class="hidden lg:flex lg:w-1/2 bg-primary p-12 lg:p-16 flex-col items-center justify-center relative overflow-hidden">
      <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 0L35 10H25L30 0ZM30 60L25 50H35L30 60ZM0 30L10 25V35L0 30ZM60 30L50 35V25L60 30Z\' fill=\'%23d4a574\'/%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
      </div>

      <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="100" cy="100" r="80" stroke="#d4a574" stroke-width="1" />
          <circle cx="100" cy="100" r="60" stroke="#d4a574" stroke-width="1" />
          <circle cx="100" cy="100" r="40" stroke="#d4a574" stroke-width="1" />
          <path d="M100 20V180M20 100H180" stroke="#d4a574" stroke-width="1" />
        </svg>
      </div>

      <div class="absolute top-12 left-16 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-accent/20 border border-accent/30 flex items-center justify-center">
          <svg class="w-6 h-6 text-accent" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L13.09 8.26L19 7L14.74 11.27L21 12L14.74 12.73L19 17L13.09 15.74L12 22L10.91 15.74L5 17L9.26 12.73L3 12L9.26 11.27L5 7L10.91 8.26L12 2Z" />
          </svg>
        </div>
        <div>
          <span class="text-lg font-bold text-white tracking-wider block">DIGITAL</span>
          <span class="text-xs text-accent tracking-widest">PARISH</span>
        </div>
      </div>

      <div class="max-w-lg text-center">
        <h1 class="text-4xl lg:text-5xl font-serif font-bold text-white mb-6 leading-snug">
          Gerencie sua <span class="text-accent">paróquia</span> com simplicidade
        </h1>
        <p class="text-white/50 text-lg mb-10">
          Sistema integrado para administração de missas, eventos e comunidades católicas.
        </p>

        <div class="flex justify-center gap-6 text-white/60 text-sm">
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
            </svg>
            Agenda de missas
          </span>
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
            </svg>
            Gestão de fiéis
          </span>
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
            </svg>
            Relatórios
          </span>
        </div>
      </div>

      <p class="absolute bottom-12 text-white/30 text-sm">© 2026 Digital Parish</p>

      <div class="absolute bottom-0 left-0 w-48 h-48 opacity-10">
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 200L200 0M0 150L150 0M0 100L100 0M0 50L50 0" stroke="#d4a574" stroke-width="1" />
        </svg>
      </div>
    </div>

    <div class="w-full lg:w-1/2 min-h-screen flex items-center justify-center p-6 lg:p-12 bg-primary lg:bg-warm-gray">
      <div class="w-full max-w-md relative">
        <div class="flex items-center justify-center gap-3 mb-8 lg:hidden">
          <div class="w-12 h-12 rounded-xl bg-accent/20 border border-accent/30 flex items-center justify-center">
            <svg class="w-7 h-7 text-accent" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L13.09 8.26L19 7L14.74 11.27L21 12L14.74 12.73L19 17L13.09 15.74L12 22L10.91 15.74L5 17L9.26 12.73L3 12L9.26 11.27L5 7L10.91 8.26L12 2Z" />
            </svg>
          </div>
          <div>
            <span class="text-xl font-bold text-white tracking-wider block">DIGITAL</span>
            <span class="text-xs text-accent tracking-widest">PARISH</span>
          </div>
        </div>

        <div id="form1" class="form-container <?php echo $showPasswordForm ? 'hidden' : ''; ?>">
          <div class="bg-white rounded-2xl p-8 golden-glow border border-accent/10">
            <div class="text-center mb-8">
              <h2 class="text-3xl font-serif font-semibold text-primary mb-2">Criar Conta</h2>
              <p class="text-primary/50">Preencha seus dados para começar</p>
            </div>

            <form method="post" action="../controllers/controller_auth.php" id="EmailCPF" class="space-y-5">
              <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-primary">E-mail</label>
                <div class="relative">
                  <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </span>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="seu@email.com"
                    required
                    class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30">
                </div>
              </div>

              <div class="space-y-2">
                <label for="cpf" class="block text-sm font-medium text-primary">CPF</label>
                <div class="relative">
                  <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0" />
                    </svg>
                  </span>
                  <input
                    type="text"
                    id="cpf"
                    name="cpf"
                    placeholder="000.000.000-00"
                    required
                    maxlength="14"
                    class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30">
                </div>
                <p class="text-xs text-primary/50">Digite seu CPF com ou sem pontuação</p>
              </div>

              <button
                type="submit"
                class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold active:scale-[0.98]">
                Verificar e Continuar
              </button>
            </form>

            <div class="text-center mt-6 pt-6 border-t border-gray-100">
              <p class="text-sm text-primary/60">Já tem uma conta? <a href="login.php" class="text-accent-dark hover:text-accent transition-colors font-medium">Faça login</a></p>
            </div>
          </div>
        </div>

        <div id="form2" class="form-container <?php echo $showPasswordForm ? '' : 'hidden'; ?>">
          <div class="bg-white rounded-2xl p-8 golden-glow border border-accent/10">
            <button
              type="button"
              onclick="goBackToForm1()"
              class="text-primary/60 hover:text-accent transition-colors text-sm inline-flex items-center gap-2 mb-4">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Voltar
            </button>

            <div class="text-center mb-8">
              <h2 class="text-3xl font-serif font-semibold text-primary mb-2">Defina sua Senha</h2>
              <p class="text-primary/50">Crie uma senha forte para sua conta</p>
            </div>
            <form method="post" action="../controllers/controller_auth.php" id="formSenhas" class="space-y-5">
              <input type="hidden" id="emailHidden" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
              <input type="hidden" id="cpfHidden" name="cpf" value="<?php echo isset($_SESSION['cpf']) ? htmlspecialchars($_SESSION['cpf']) : ''; ?>">

              <div class="space-y-2">
                <label for="senha" class="block text-sm font-medium text-primary">Senha</label>
                <div class="relative">
                  <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </span>
                  <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="••••••••"
                    required
                    class="input-field w-full pl-12 pr-12 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30"
                    oninput="checkPasswordStrength()">
                  <button
                    type="submit"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-primary/40 hover:text-primary transition-colors"
                    onclick="togglePasswordVisibility('senha')">
                    <svg class="togglePasswordIcon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                </div>
                <div class="password-strength mt-2" id="passwordStrengthBar"></div>
                <p class="text-xs text-primary/50 mt-1" id="passwordStrengthText">Mínimo 8 caracteres</p>
              </div>

              <div class="space-y-2">
                <label for="senhaConfirm" class="block text-sm font-medium text-primary">Confirmar Senha</label>
                <div class="relative">
                  <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </span>
                  <input
                    type="password"
                    id="senhaConfirm"
                    name="confirmar_senha"
                    placeholder="••••••••"
                    required
                    class="input-field w-full pl-12 pr-12 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30"
                    oninput="checkPasswordMatch()">
                  <button
                    type="button"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-primary/40 hover:text-primary transition-colors"
                    onclick="togglePasswordVisibility('senhaConfirm')">
                    <svg class="togglePasswordIcon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                </div>
                <p class="text-xs text-primary/50" id="matchText">As senhas devem ser iguais</p>
              </div>

              <button
                type="submit"
                class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed"
                id="submitBtn"
                disabled>
                Criar Minha Conta
              </button>
            </form>

            <div class="text-center mt-6 pt-6 border-t border-gray-100">
              <a href="login.php" class="text-accent-dark hover:text-accent transition-colors font-medium text-sm">
                Voltar para login
              </a>
            </div>
          </div>
        </div>

        <div class="text-center mt-6">
          <a href="../index.php" class="text-white/50 lg:text-primary/50 hover:text-accent transition-colors text-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar para o início
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  let cpfLastValue = '';

  function formatCPF(value) {
    value = value.replace(/\D/g, '');
    if (value.length > 11) value = value.slice(0, 11);
    if (value.length > 9) {
      value = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6, 9) + '-' + value.slice(9);
    } else if (value.length > 6) {
      value = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6);
    } else if (value.length > 3) {
      value = value.slice(0, 3) + '.' + value.slice(3);
    }
    return value;
  }

  const cpfInput = document.getElementById('cpf');

  cpfInput.addEventListener('input', function(e) {
    let cursorPos = e.target.selectionStart;
    let inputValue = e.target.value;
    let numericValue = inputValue.replace(/\D/g, '');
    let lastNumericValue = cpfLastValue.replace(/\D/g, '');

    if (numericValue.length < lastNumericValue.length) {
      e.target.value = formatCPF(numericValue);
      if (cursorPos > 0) {
        if ([3, 7, 11].includes(cursorPos - 1)) {
          cursorPos--;
        }
      }
    } else {
      e.target.value = formatCPF(numericValue);
    }

    cpfLastValue = e.target.value;
  });

  // Preenche os campos hidden se vierem da sessão
  <?php if ($showPasswordForm): ?>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('emailHidden').value = '<?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES); ?>';
      document.getElementById('cpfHidden').value = '<?php echo htmlspecialchars($_SESSION['cpf'], ENT_QUOTES); ?>';
    });
  <?php endif; ?>

  document.getElementById('EmailCPF').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const cpf = document.getElementById('cpf').value;

    document.getElementById('emailHidden').value = email;
    document.getElementById('cpfHidden').value = cpf;

    document.getElementById('form1').classList.add('hidden');
    document.getElementById('form2').classList.remove('hidden');
  });

  function goBackToForm1() {
    document.getElementById('form2').classList.add('hidden');
    document.getElementById('form1').classList.remove('hidden');
  }

  function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.parentElement.querySelector('.togglePasswordIcon');

    if (input.type === 'password') {
      input.type = 'text';
      icon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
        `;
    } else {
      input.type = 'password';
      icon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
  }

  function checkPasswordStrength() {
    const password = document.getElementById('senha').value;
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
    const senha = document.getElementById('senha').value;
    const senhaConfirm = document.getElementById('senhaConfirm').value;
    const matchText = document.getElementById('matchText');
    const submitBtn = document.getElementById('submitBtn');

    if (senhaConfirm.length === 0) {
      matchText.textContent = 'As senhas devem ser iguais';
      matchText.className = 'text-xs text-primary/50';
      submitBtn.disabled = true;
    } else if (senha !== senhaConfirm) {
      matchText.textContent = 'As senhas não coincidem';
      matchText.className = 'text-xs text-red-500';
      submitBtn.disabled = true;
    } else {
      matchText.textContent = 'Senhas coincidem';
      matchText.className = 'text-xs text-emerald-500';
      submitBtn.disabled = senha.length < 8;
    }
  }

  document.getElementById('formSenhas').addEventListener('submit', function(e) {
    // Não prevenir o submit padrão, deixar o formulário ser enviado normalmente
    // O controller irá processar e redirecionar
  });
</script>

</html>