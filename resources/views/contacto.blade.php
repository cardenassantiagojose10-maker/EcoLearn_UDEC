<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contacto — EcoLearn UDEC</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<script>
  try {
    var t = localStorage.getItem('ecolearn-theme');
    if (t === 'dark' || (!t && matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.setAttribute('data-theme', 'dark');
    }
  } catch (e) {}
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --verde:#0E5B3F; --verde-deep:#0A4630; --verde-pale:#E4EFE6; --verde-surface:#0E5B3F;
    --brote:#9FD356; --miel:#F4A82C;
    --bg:#F6F5F0; --surface:#FFFFFF; --surface-2:#FBFBF7;
    --ink:#142019; --ink-soft:#55655B; --border:#E3E4DA;
    --verde-ink:#0E5B3F; --err-ink:#A82F26; --ok-ink:#14663F;
    --ring:rgba(14,91,63,.12);
  }
  [data-theme="dark"] {
    --verde:#3FA173; --verde-deep:#2C7E58; --verde-pale:#163327; --verde-surface:#0F4E36;
    --brote:#9FD356; --miel:#F6C36B;
    --bg:#0B1A14; --surface:#14251D; --surface-2:#1A2F24;
    --ink:#EAF2EC; --ink-soft:#9CB0A4; --border:#25392E;
    --verde-ink:#8FD3AF; --err-ink:#F29289; --ok-ink:#74D8A4;
    --ring:rgba(159,211,86,.18);
  }

  * { box-sizing:border-box; }
  body {
    font-family:'Public Sans', system-ui, sans-serif;
    background:var(--bg);
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
    transition:background .35s ease, color .35s ease;
    min-height:100vh;
    display:flex;
    flex-direction:column;
  }
  a { text-decoration:none; }
  .font-display { font-family:'Bricolage Grotesque', sans-serif; }

  /* ── NAVBAR ── */
  .nav-eco {
    background:var(--surface);
    border-bottom:1px solid var(--border);
    padding:14px 0;
  }
  .nav-eco .brand-lockup { display:flex; align-items:center; gap:11px; }
  .nav-eco .name { font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:19px; letter-spacing:-.4px; color:var(--ink); line-height:1; }
  .nav-eco .sub { font-size:10.5px; letter-spacing:1.3px; text-transform:uppercase; color:var(--ink-soft); margin-top:2px; }
  .theme-btn {
    width:38px; height:38px; border-radius:12px;
    border:1px solid var(--border); background:var(--surface-2); color:var(--ink);
    cursor:pointer; display:flex; align-items:center; justify-content:center;
    transition:transform .18s ease, background .2s ease;
  }
  .theme-btn:hover { background:var(--verde-pale); transform:translateY(-1px); }
  .btn-ghost {
    border:1px solid var(--border); border-radius:12px; padding:9px 16px;
    font-size:13.5px; font-weight:700; color:var(--ink);
  }

  /* ── CONTENIDO ── */
  .contact-wrap { flex:1; display:flex; align-items:center; justify-content:center; padding:48px 20px; }
  .contact-card {
    width:100%; max-width:960px;
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    box-shadow:0 24px 60px rgba(10,40,26,.10);
    overflow:hidden;
    display:grid;
    grid-template-columns:0.85fr 1.15fr;
    animation:fadeUp .4s ease;
  }
  @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }

  .info-panel {
    background:var(--verde-surface); color:#fff;
    padding:40px 34px; position:relative; overflow:hidden;
    display:flex; flex-direction:column; justify-content:space-between;
  }
  .info-panel::after {
    content:""; position:absolute; right:-70px; bottom:-90px;
    width:230px; height:230px; border-radius:50%;
    background:rgba(159,211,86,.16);
  }
  .info-panel h2 {
    font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:26px;
    letter-spacing:-.7px; margin:22px 0 12px; position:relative;
  }
  .info-panel p { font-size:13.5px; line-height:1.6; opacity:.9; position:relative; max-width:32ch; }
  .info-list { list-style:none; margin-top:26px; display:flex; flex-direction:column; gap:14px; position:relative; padding:0; }
  .info-list li { display:flex; align-items:flex-start; gap:11px; font-size:13px; }
  .info-list i {
    width:30px; height:30px; border-radius:9px; flex-shrink:0;
    background:rgba(255,255,255,.14); color:var(--brote);
    display:flex; align-items:center; justify-content:center; font-size:13px;
  }

  .form-panel { padding:40px 40px 34px; }
  .form-panel .eyebrow { font-size:11px; font-weight:800; letter-spacing:1.4px; text-transform:uppercase; color:var(--ink-soft); }
  .form-panel h1 {
    font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:26px;
    letter-spacing:-.6px; margin:8px 0 22px;
  }

  .field { margin-bottom:16px; }
  .field label { display:block; font-size:12.5px; font-weight:700; color:var(--ink); margin-bottom:6px; }
  .field input, .field textarea {
    width:100%;
    padding:12px 14px;
    border:1px solid var(--border);
    border-radius:12px;
    background:var(--surface-2);
    color:var(--ink);
    font-size:14px;
    font-family:inherit;
    transition:border-color .2s ease, box-shadow .2s ease, background .2s ease;
  }
  .field textarea { min-height:130px; resize:vertical; }
  .field input:focus, .field textarea:focus {
    outline:none;
    border-color:var(--verde);
    background:var(--surface);
    box-shadow:0 0 0 4px var(--ring);
  }
  .field-error { color:var(--err-ink); font-size:12px; margin-top:5px; }

  .btn-submit {
    width:100%;
    padding:13px;
    border:none;
    border-radius:12px;
    background:var(--verde-surface);
    color:#fff;
    font-size:14.5px;
    font-weight:700;
    cursor:pointer;
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:transform .18s ease, filter .2s ease;
  }
  .btn-submit:hover { transform:translateY(-2px); filter:brightness(1.08); }
  .btn-submit:active { transform:scale(.98); }

  .alert-box.ok {
    background:rgba(30,142,90,.10); border:1px solid rgba(30,142,90,.3); color:var(--ok-ink);
    border-radius:12px; padding:11px 14px; font-size:12.5px; margin-bottom:18px; display:flex; gap:9px;
  }

  .footer-eco {
    background:var(--surface); border-top:1px solid var(--border);
    padding:22px 0; color:var(--ink-soft); font-size:13px; text-align:center;
  }

  @media (max-width: 780px) {
    .contact-card { grid-template-columns:1fr; max-width:440px; }
    .info-panel { padding:30px 30px 26px; }
    .info-list { display:none; }
    .form-panel { padding:30px 30px 26px; }
  }
</style>
</head>

<body>

{{-- ═══════════ NAVBAR ═══════════ --}}
<nav class="nav-eco">
  <div class="container d-flex align-items-center justify-content-between">
    <a href="{{ route('inicio') }}" class="brand-lockup">
      <svg width="32" height="32" viewBox="0 0 48 48" aria-hidden="true" style="flex-shrink:0;">
        <path d="M24 4c12 8 17 17 17 24a17 17 0 0 1-34 0C7 21 12 12 24 4z" fill="var(--verde)"></path>
        <path d="M24 40V17" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
        <path d="M24 27l9-8" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
        <path d="M24 33l-7-6" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round" opacity=".65"></path>
      </svg>
      <div>
        <div class="name">EcoLearn</div>
        <div class="sub">UDEC · Ubaté</div>
      </div>
    </a>

    <div class="d-flex align-items-center gap-2">
      <button class="theme-btn" id="theme-toggle" title="Cambiar tema" type="button">
        <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
      </button>
      <a href="{{ route('login') }}" class="btn-ghost d-none d-sm-inline-block">Iniciar sesión</a>
    </div>
  </div>
</nav>

{{-- ═══════════ CONTACTO ═══════════ --}}
<div class="contact-wrap">
  <div class="contact-card">

    <div class="info-panel">
      <div>
        <span style="display:inline-flex; align-items:center; gap:7px; background:rgba(255,255,255,.14); border:1px solid rgba(255,255,255,.22); padding:6px 13px; border-radius:999px; font-size:11.5px; font-weight:700;">
          <i class="bi bi-chat-dots-fill"></i> Contacto
        </span>
        <h2>Hablemos de<br>educación ambiental</h2>
        <p>¿Tienes dudas, sugerencias o quieres colaborar con EcoLearn? Escríbenos.</p>

        <ul class="info-list">
          <li><i class="bi bi-envelope-fill"></i> ecolearn@ucundinamarca.edu.co</li>
          <li><i class="bi bi-geo-alt-fill"></i> Universidad de Cundinamarca · Sede Ubaté</li>
          <li><i class="bi bi-clock-fill"></i> Respuesta en 1-2 días hábiles</li>
        </ul>
      </div>

      <div style="position:relative; font-size:11px; opacity:.7; letter-spacing:.4px;">
        Sistema Académico · Universidad de Cundinamarca
      </div>
    </div>

    <div class="form-panel">
      <div class="eyebrow">Escríbenos</div>
      <h1>Formulario de contacto</h1>

      @if (session('success'))
        <div class="alert-box ok">
          <i class="bi bi-check-circle-fill"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <form action="{{ route('contacto.store') }}" method="POST">
        @csrf

        <div class="field">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre completo" required>
          @error('nombre') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="tucorreo@ejemplo.com" required>
          @error('email') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="mensaje">Mensaje</label>
          <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje..." required>{{ old('mensaje') }}</textarea>
          @error('mensaje') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-submit">
          <i class="bi bi-send-fill"></i> Enviar mensaje
        </button>
      </form>
    </div>
  </div>
</div>

<footer class="footer-eco">
  Sistema EcoLearn UDEC · Universidad de Cundinamarca
</footer>

<script>
  (function () {
    var root = document.documentElement;
    var btn  = document.getElementById('theme-toggle');
    var icon = document.getElementById('theme-icon');

    function sync() {
      var dark = root.getAttribute('data-theme') === 'dark';
      icon.className = dark ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
    }
    sync();

    btn.addEventListener('click', function () {
      var dark = root.getAttribute('data-theme') === 'dark';
      root.setAttribute('data-theme', dark ? 'light' : 'dark');
      try { localStorage.setItem('ecolearn-theme', dark ? 'light' : 'dark'); } catch (e) {}
      sync();
    });
  }());
</script>

</body>
</html>
