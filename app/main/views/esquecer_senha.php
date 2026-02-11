<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha - Digital Parish</title>
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

    .code-input:focus {
      border-color: #d4a574;
      box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.2);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 50;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      animation: fadeIn 0.3s ease;
    }

    .modal.active {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background-color: white;
      padding: 2rem;
      border-radius: 1.5rem;
      border: 1px solid rgba(212, 165, 116, 0.1);
      box-shadow: 0 10px 30px rgba(212, 165, 116, 0.15);
      max-width: 400px;
      text-align: center;
      animation: slideUp 0.3s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes slideUp {
      from {
        transform: translateY(30px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
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
      <div class="w-full max-w-md">
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

        <div class="bg-white rounded-2xl p-8 golden-glow border border-accent/10">

          <?php if (isset($_GET['codigo_enviado'])) { ?>

            <?php if (isset($_GET['erro_codigo'])) { ?>
              <div>
                <p>codigo errado</p>
              </div>
            <?php } ?>
            <div class="text-center mb-8">
              <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <h2 class="text-3xl font-serif font-semibold text-primary mb-2">Verifique seu e-mail</h2>
              <p class="text-primary/50">Digite o código de 6 dígitos enviado para</p>
              <p id="emailDisplay" class="text-accent font-medium mt-1"></p>
            </div>

            <form method="post" action="../controllers/controller_auth.php" class="space-y-6">
              <input type="number" name="codigo">

              <button type="submit" class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold active:scale-[0.98]">
                Verificar código
              </button>

              <p class="text-center text-sm text-primary/50">
                Não recebeu o código?
                <button type="submit" name="reenviar_codigo" class="text-accent-dark hover:text-accent font-medium transition-colors">
                  Reenviar
                </button>
              </p>
            </form>

          <?php } else if (isset($_GET['rec_senha'])) { ?>

            <div id="stepResetPassword">
              <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.21 0-4 1.79-4 4v2h8v-2c0-2.21-1.79-4-4-4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 10h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z" />
                  </svg>
                </div>
                <h2 class="text-3xl font-serif font-semibold text-primary mb-2">Redefinir senha</h2>
                <p class="text-primary/60 text-sm">Crie uma nova senha segura para sua conta</p>
              </div>

              <form method="post" action="../controllers/controller_auth.php" class="space-y-6">
                <input type="hidden" name="action" value="reset_password">

                <div class="space-y-2">
                  <label for="new_password" class="block text-sm font-medium text-primary">Nova senha</label>
                  <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2m4 0c0-1.1-.9-2-2-2s-2 .9-2 2m8 0c0-1.1-.9-2-2-2s-2 .9-2 2m-4 5c-1.1 0-2 .9-2 2s.9 2 2 2h8c1.1 0 2-.9 2-2s-.9-2-2-2h-8z" />
                      </svg>
                    </span>
                    <input
                      type="password"
                      id="new_password"
                      name="new_password"
                      required
                      minlength="8"
                      placeholder="Mínimo 8 caracteres"
                      class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30">
                  </div>
                </div>

                <div class="space-y-2">
                  <label for="confirm_password" class="block text-sm font-medium text-primary">Confirmar senha</label>
                  <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2m4 0c0-1.1-.9-2-2-2s-2 .9-2 2m8 0c0-1.1-.9-2-2-2s-2 .9-2 2m-4 5c-1.1 0-2 .9-2 2s.9 2 2 2h8c1.1 0 2-.9 2-2s-.9-2-2-2h-8z" />
                      </svg>
                    </span>
                    <input
                      type="password"
                      id="confirm_password"
                      name="confirm_password"
                      required
                      minlength="8"
                      placeholder="Digite novamente"
                      class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30">
                  </div>
                </div>

                <button type="submit" class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold active:scale-[0.98] mt-2">
                  Redefinir senha
                </button>
              </form>

              <p class="text-center mt-6 text-sm text-primary/50">
                Lembrou sua senha?
                <a href="./login.php" class="text-accent hover:text-accent-dark font-medium">Voltar ao login</a>
              </p>
            </div>

          <?php } else { ?>
            <div id="stepEmail">
              <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
                <h2 class="text-3xl font-serif font-semibold text-primary mb-2">Recuperar senha</h2>
                <p class="text-primary/50">Digite seu e-mail para receber o código de verificação</p>
              </div>

              <form method="post" action="../controllers/controller_auth.php" class="space-y-5">
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

                <button type="submit" class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold active:scale-[0.98]">
                  Enviar código
                </button>
              </form>
            </div>
          <?php } ?>
        </div>

        <div class="text-center mt-6">
          <a href="./login.php" class="text-white/50 lg:text-primary/50 hover:text-accent transition-colors text-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar para o login
          </a>
        </div>
      </div>
    </div>
  </div>

  <div id="resendModal" class="modal">
    <div class="modal-content">
      <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <h3 class="text-2xl font-serif font-semibold text-primary mb-2">Código reenviado!</h3>
      <p class="text-primary/50 mb-6">Verifique seu e-mail para o novo código de verificação. Pode levar alguns minutos para chegar.</p>
      <button onclick="closeResendModal()" class="btn-primary w-full text-white py-2.5 rounded-xl font-semibold active:scale-[0.98]">
        Entendi
      </button>
    </div>
  </div>
</body>

<script>
  const formEmail = document.getElementById('formEmail');
  const formCode = document.getElementById('formCode');
  const stepEmail = document.getElementById('stepEmail');
  const stepCode = document.getElementById('stepCode');
  const emailDisplay = document.getElementById('emailDisplay');
  const codeInputs = document.querySelectorAll('.code-input');

  formEmail.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    emailDisplay.textContent = email;
    stepEmail.classList.add('hidden');
    stepCode.classList.remove('hidden');
    codeInputs[0].focus();
  });

  codeInputs.forEach((input, index) => {
    input.addEventListener('input', function(e) {
      const value = e.target.value;
      if (value.length === 1 && index < codeInputs.length - 1) {
        codeInputs[index + 1].focus();
      }
    });

    input.addEventListener('keydown', function(e) {
      if (e.key === 'Backspace' && !e.target.value && index > 0) {
        codeInputs[index - 1].focus();
      }
    });

    input.addEventListener('paste', function(e) {
      e.preventDefault();
      const pastedData = e.clipboardData.getData('text').slice(0, 6);
      pastedData.split('').forEach((char, i) => {
        if (codeInputs[i]) {
          codeInputs[i].value = char;
        }
      });
      if (pastedData.length > 0) {
        codeInputs[Math.min(pastedData.length, 5)].focus();
      }
    });
  });

  formCode.addEventListener('submit', function(e) {
    e.preventDefault();
    let code = '';
    codeInputs.forEach(input => code += input.value);
    if (code.length === 6) {
      alert('Código verificado: ' + code);
    }
  });

  document.getElementById('resendCode').addEventListener('click', function() {
    openResendModal();
  });

  function openResendModal() {
    document.getElementById('resendModal').classList.add('active');
  }

  function closeResendModal() {
    document.getElementById('resendModal').classList.remove('active');
  }

  document.getElementById('resendModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeResendModal();
    }
  });
</script>

</html>