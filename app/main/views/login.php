<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Parish</title>
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
      .feature-icon {
        transition: all 0.3s ease;
      }
      .feature-item:hover .feature-icon {
        transform: scale(1.1);
        background: #d4a574;
      }
      .feature-item:hover .feature-icon svg {
        color: white;
      }
    </style>
  </head>
  
  <body class="min-h-screen font-sans bg-warm-gray">
    <div class="min-h-screen flex flex-col lg:flex-row">
      
      <div class="hidden lg:flex lg:w-1/2 bg-primary p-8 lg:p-16 flex-col items-center justify-center relative overflow-hidden">
          <div class="absolute inset-0 opacity-5">
          <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 0L35 10H25L30 0ZM30 60L25 50H35L30 60ZM0 30L10 25V35L0 30ZM60 30L50 35V25L60 30Z\' fill=\'%23d4a574\'/%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
        </div>

        <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
          <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" stroke="#d4a574" stroke-width="1"/>
            <circle cx="100" cy="100" r="60" stroke="#d4a574" stroke-width="1"/>
            <circle cx="100" cy="100" r="40" stroke="#d4a574" stroke-width="1"/>
            <path d="M100 20V180M20 100H180" stroke="#d4a574" stroke-width="1"/>
          </svg>
        </div>
        
        <div class="relative z-10 max-w-lg text-center">
          <div class="flex items-center justify-center gap-3 mb-12">
            <div class="w-14 h-14 rounded-xl bg-accent/20 border border-accent/30 flex items-center justify-center">
              <svg class="w-8 h-8 text-accent" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L13.09 8.26L19 7L14.74 11.27L21 12L14.74 12.73L19 17L13.09 15.74L12 22L10.91 15.74L5 17L9.26 12.73L3 12L9.26 11.27L5 7L10.91 8.26L12 2Z"/>
              </svg>
            </div>
            <div class="text-left">
              <span class="text-2xl font-bold text-white tracking-wider block">DIGITAL</span>
              <span class="text-sm text-accent tracking-widest">PARISH</span>
            </div>
          </div>

          <div class="mb-12">
            <h1 class="text-4xl lg:text-5xl font-serif text-white mb-6 leading-tight">
              Gerencie sua
              <span class="text-accent"> paróquia </span>
              com simplicidade
            </h1>
            <p class="text-white/60 text-lg">
              Sistema integrado para administração de missas, eventos e comunidades católicas.
            </p>
          </div>

          <div class="space-y-4 inline-block text-left">
            <div class="feature-item flex items-center gap-4 group cursor-default">
              <div class="feature-icon w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <span class="text-white/80">Agenda de missas e eventos</span>
            </div>
            <div class="feature-item flex items-center gap-4 group cursor-default">
              <div class="feature-icon w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <span class="text-white/80">Gestão de comunidades</span>
            </div>
            <div class="feature-item flex items-center gap-4 group cursor-default">
              <div class="feature-icon w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <span class="text-white/80">Relatórios e estatísticas</span>
            </div>
          </div>

          <div class="mt-12">
            <p class="text-white/40 text-sm">© 2026 Digital Parish. Todos os direitos reservados.</p>
          </div>
        </div>

        <div class="absolute bottom-0 left-0 w-48 h-48 opacity-10">
          <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 200L200 0M0 150L150 0M0 100L100 0M0 50L50 0" stroke="#d4a574" stroke-width="1"/>
          </svg>
        </div>
      </div>

      <div class="w-full lg:w-1/2 min-h-screen flex items-center justify-center p-6 lg:p-12 bg-primary lg:bg-warm-gray">
        <div class="w-full max-w-md">
          <div class="flex items-center justify-center gap-3 mb-8 lg:hidden">
            <div class="w-12 h-12 rounded-xl bg-accent/20 border border-accent/30 flex items-center justify-center">
              <svg class="w-7 h-7 text-accent" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L13.09 8.26L19 7L14.74 11.27L21 12L14.74 12.73L19 17L13.09 15.74L12 22L10.91 15.74L5 17L9.26 12.73L3 12L9.26 11.27L5 7L10.91 8.26L12 2Z"/>
              </svg>
            </div>
            <div>
              <span class="text-xl font-bold text-white tracking-wider block">DIGITAL</span>
              <span class="text-xs text-accent tracking-widest">PARISH</span>
            </div>
          </div>

          <div class="text-center mb-8">
            <h2 class="text-3xl font-serif font-semibold text-white lg:text-primary mb-2">Bem-vindo de volta</h2>
            <p class="text-white/60 lg:text-primary/60">Acesse sua conta para continuar</p>
          </div>

          <div class="bg-white rounded-2xl p-8 golden-glow border border-accent/10">
            <form method="POST" action="" class="space-y-5">
              <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-primary">E-mail</label>
                <div class="relative">
                  <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                  </span>
                  <input 
                    type="email" 
                    id="email"
                    name="email"
                    placeholder="seu@email.com"
                    required
                    class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30"
                  >
                </div>
              </div>

              <div class="space-y-2">
                <label for="senha" class="block text-sm font-medium text-primary">Senha</label>
                <div class="relative">
                  <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                  </span>
                  <input 
                    type="password" 
                    id="senha"
                    name="senha"
                    placeholder="••••••••"
                    required
                    class="input-field w-full pl-12 pr-12 py-3.5 rounded-xl border-2 border-gray-200 focus:border-accent focus:outline-none text-primary placeholder-gray-400 bg-secondary/30"
                  >
                  <button 
                    type="button" 
                    id="toggleSenha"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-primary/40 hover:text-primary transition-colors"
                    onclick="togglePasswordVisibility()"
                  >
                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                </div>
              </div>

              <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-primary/70 cursor-pointer group">
                  <input type="checkbox" name="lembrar" class="w-4 h-4 rounded border-gray-300 text-accent focus:ring-accent accent-accent">
                  <span class="group-hover:text-primary transition-colors">Manter conectado</span>
                </label>
                <a href="#" class="text-accent-dark hover:text-accent transition-colors font-medium text-sm">Esqueceu a senha?</a>
              </div>

              <button type="submit" class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold active:scale-[0.98]">
                Entrar
              </button>
            </form>

            <div class="relative my-6">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-400">ou</span>
              </div>
            </div>

            <div class="text-center">
              <p class="text-sm text-primary/60 mb-3">Primeira vez por aqui?</p>
              <button onclick="window.location.href='primeiro_acesso.php'" type="button" class="w-full border-2 border-accent text-primary py-3 rounded-xl font-semibold hover:bg-accent hover:text-white transition-all duration-300">
                Criar minha conta
              </button>
            </div>
          </div>

          <div class="text-center mt-6">
            <a href="../index.php" class="text-white/50 lg:text-primary/50 hover:text-accent transition-colors text-sm inline-flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
              </svg>
              Voltar para o início
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
  
  <script>
    function togglePasswordVisibility() {
      const senhaInput = document.getElementById('senha');
      const eyeIcon = document.getElementById('eyeIcon');
      
      if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.91m1.699-2.533A9.869 9.869 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path>';
      } else {
        senhaInput.type = 'password';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
      }
    }
  </script>
</html>
