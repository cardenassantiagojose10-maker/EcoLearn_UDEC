<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Crear cuenta — EcoLearn UDEC</title>

<script>
  try {
    var t = localStorage.getItem('ecolearn-theme');
    if (t === 'dark' || (!t && matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.setAttribute('data-theme', 'dark');
    }
  } catch (e) {}
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --verde:#0E5B3F; --verde-surface:#0E5B3F;
    --brote:#9FD356; --miel:#F4A82C;
    --bg:#F6F5F0; --surface:#FFFFFF; --surface-2:#FBFBF7;
    --ink:#142019; --ink-soft:#55655B; --border:#E3E4DA;
    --verde-ink:#0E5B3F; --err-ink:#A82F26;
    --ring:rgba(14,91,63,.12);
  }
  [data-theme="dark"] {
    --verde:#3FA173; --verde-surface:#0F4E36;
    --brote:#9FD356; --miel:#F6C36B;
    --bg:#0B1A14; --surface:#14251D; --surface-2:#1A2F24;
    --ink:#EAF2EC; --ink-soft:#9CB0A4; --border:#25392E;
    --verde-ink:#8FD3AF; --err-ink:#F29289;
    --ring:rgba(159,211,86,.18);
  }

  * { box-sizing:border-box; margin:0; padding:0; }
  body {
    font-family:'Public Sans',system-ui,sans-serif;
    background:var(--bg);
    color:var(--ink);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    position:relative;
    overflow:hidden;
    -webkit-font-smoothing:antialiased;
  }
  body::before {
    content:"";
    position:absolute;
    width:520px; height:520px; border-radius:50%;
    background:radial-gradient(circle, var(--ring), transparent 70%);
    top:-160px; right:-140px;
  }
  .font-display { font-family:'Bricolage Grotesque',sans-serif; }

  .theme-btn {
    position:absolute; top:20px; right:20px;
    width:38px; height:38px; border-radius:12px;
    border:1px solid var(--border); background:var(--surface); color:var(--ink);
    cursor:pointer; display:flex; align-items:center; justify-content:center;
    z-index:5; transition:transform .18s ease, background .2s ease;
  }
  .theme-btn:hover { transform:translateY(-1px); }

  .auth-card {
    position:relative; z-index:2;
    width:100%; max-width:920px;
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    box-shadow:0 24px 60px rgba(10,40,26,.14);
    overflow:hidden;
    display:grid;
    grid-template-columns:1fr 1fr;
    animation:fadeUp .4s ease;
  }
  @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }

  /* Panel de marca */
  .brand-panel {
    background:var(--verde-surface);
    color:#fff;
    padding:40px 36px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    overflow:hidden;
  }
  .brand-panel::after {
    content:"";
    position:absolute; right:-80px; bottom:-90px;
    width:240px; height:240px; border-radius:50%;
    background:rgba(159,211,86,.16);
  }
  .brand-lockup { display:flex; align-items:center; gap:13px; position:relative; }
  .brand-lockup .name { font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:24px; letter-spacing:-.5px; line-height:1; }
  .brand-lockup .sub  { font-size:10.5px; letter-spacing:1.6px; text-transform:uppercase; opacity:.72; margin-top:4px; }

  .brand-panel h2 {
    font-family:'Bricolage Grotesque',sans-serif;
    font-weight:800; font-size:30px; line-height:1.12; letter-spacing:-1px;
    margin:36px 0 14px; position:relative;
  }
  .brand-panel p { font-size:13.5px; line-height:1.6; color:#fff; opacity:.9; max-width:34ch; position:relative; }

  .brand-feats { list-style:none; margin-top:26px; display:flex; flex-direction:column; gap:12px; position:relative; }
  .brand-feats li { display:flex; align-items:center; gap:10px; font-size:13px; font-weight:600; }
  .brand-feats i {
    width:28px; height:28px; border-radius:9px; flex-shrink:0;
    background:rgba(255,255,255,.14); color:var(--brote);
    display:flex; align-items:center; justify-content:center; font-size:13px;
  }

  /* Panel de formulario */
  .form-panel { padding:36px 40px 30px; }
  .form-panel .eyebrow { font-size:11px; font-weight:800; letter-spacing:1.4px; text-transform:uppercase; color:var(--ink-soft); }
  .form-panel h1 {
    font-family:'Bricolage Grotesque',sans-serif;
    font-weight:800; font-size:26px; letter-spacing:-.6px;
    margin:8px 0 20px;
  }

  .field { margin-bottom:14px; }
  .field label { display:block; font-size:12.5px; font-weight:700; color:var(--ink); margin-bottom:6px; }
  .input-wrap { position:relative; }
  .input-wrap > i {
    position:absolute; left:13px; top:50%; transform:translateY(-50%);
    color:var(--ink-soft); font-size:14px;
  }
  .field input {
    width:100%;
    padding:11px 14px 11px 38px;
    border:1px solid var(--border);
    border-radius:12px;
    background:var(--surface-2);
    color:var(--ink);
    font-size:14px;
    font-family:inherit;
    transition:border-color .2s ease, box-shadow .2s ease, background .2s ease;
  }
  .field input:focus {
    outline:none;
    border-color:var(--verde);
    background:var(--surface);
    box-shadow:0 0 0 4px var(--ring);
  }
  .pw-toggle {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    width:30px; height:30px; border:none; background:transparent;
    color:var(--ink-soft); cursor:pointer; border-radius:8px;
    display:flex; align-items:center; justify-content:center;
  }
  .pw-toggle:hover { background:var(--surface-2); }

  .btn-submit {
    width:100%;
    padding:13px;
    border:none;
    border-radius:12px;
    background:var(--verde-surface);
    color:#fff;
    font-family:'Public Sans',sans-serif;
    font-size:14.5px;
    font-weight:700;
    cursor:pointer;
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:transform .18s ease, filter .2s ease;
    margin-top:6px;
  }
  .btn-submit:hover { transform:translateY(-2px); filter:brightness(1.08); }
  .btn-submit:active { transform:scale(.98); }

  .alert-box {
    border-radius:12px;
    padding:11px 14px;
    font-size:12.5px;
    line-height:1.45;
    margin-bottom:16px;
    display:flex;
    gap:9px;
  }
  .alert-box.err { background:rgba(201,59,49,.10); border:1px solid rgba(201,59,49,.3); color:var(--err-ink); }
  .alert-box p { margin:0; }

  .swap-row {
    margin-top:18px; padding-top:16px;
    border-top:1px solid var(--border);
    text-align:center;
    font-size:13px; color:var(--ink-soft);
  }
  .swap-row a { color:var(--verde-ink); font-weight:700; text-decoration:none; }
  .swap-row a:hover { text-decoration:underline; }

  .foot { text-align:center; font-size:11px; color:var(--ink-soft); margin-top:14px; }

  @media (max-width: 780px) {
    .auth-card { grid-template-columns:1fr; max-width:420px; }
    .brand-panel { padding:30px 30px 26px; }
    .brand-panel h2 { font-size:24px; margin:22px 0 10px; }
    .brand-feats { display:none; }
    .form-panel { padding:28px 30px 24px; }
  }
</style>
</head>

<body>

<button class="theme-btn" id="theme-toggle" title="Cambiar tema" type="button">
  <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
</button>

<div class="auth-card">

  {{-- ── PANEL DE MARCA ── --}}
  <div class="brand-panel">
    <div>
      <div class="brand-lockup">
        <svg width="42" height="42" viewBox="0 0 48 48" aria-hidden="true" style="flex-shrink:0;">
          <path d="M24 4c12 8 17 17 17 24a17 17 0 0 1-34 0C7 21 12 12 24 4z" fill="#fff" opacity=".16"></path>
          <path d="M24 40V17" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
          <path d="M24 27l9-8" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
          <path d="M24 33l-7-6" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round" opacity=".65"></path>
        </svg>
        <div>
          <div class="name">EcoLearn</div>
          <div class="sub">UDEC · Ubaté</div>
        </div>
      </div>

      <h2>Únete al cambio<br>ambiental</h2>
      <p>Crea tu cuenta y empieza tu ruta de aprendizaje en educación ambiental.</p>

      <ul class="brand-feats">
        <li><i class="bi bi-collection-fill"></i> Módulos y evaluaciones</li>
        <li><i class="bi bi-graph-up-arrow"></i> Seguimiento de tu progreso</li>
        <li><i class="bi bi-trophy-fill"></i> Puntos, niveles e insignias</li>
      </ul>
    </div>

    <div style="position:relative; font-size:11px; opacity:.7; letter-spacing:.4px;">
      Sistema Académico · Universidad de Cundinamarca
    </div>
  </div>

  {{-- ── PANEL DE FORMULARIO ── --}}
  <div class="form-panel">
    <div class="eyebrow">Comienza gratis</div>
    <h1>Crear cuenta</h1>

    @if ($errors->any())
      <div class="alert-box err">
        <i class="bi bi-exclamation-circle-fill"></i>
        <div>
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
      @csrf

      <div class="field">
        <label for="name">Nombre completo</label>
        <div class="input-wrap">
          <i class="bi bi-person"></i>
          <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required autofocus>
        </div>
      </div>

      <div class="field">
        <label for="email">Correo institucional</label>
        <div class="input-wrap">
          <i class="bi bi-envelope"></i>
          <input type="email" id="email" name="email" value="{{ old('email') }}"
                 placeholder="usuario@ucundinamarca.edu.co" required>
        </div>
      </div>

      <div class="field">
        <label for="password">Contraseña</label>
        <div class="input-wrap">
          <i class="bi bi-lock"></i>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
          <button type="button" class="pw-toggle" onclick="togglePassword('password','pw-icon')" title="Mostrar / ocultar">
            <i class="bi bi-eye" id="pw-icon"></i>
          </button>
        </div>
      </div>

      <div class="field">
        <label for="password_confirmation">Confirmar contraseña</label>
        <div class="input-wrap">
          <i class="bi bi-lock-fill"></i>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
          <button type="button" class="pw-toggle" onclick="togglePassword('password_confirmation','pw-icon-2')" title="Mostrar / ocultar">
            <i class="bi bi-eye" id="pw-icon-2"></i>
          </button>
        </div>
      </div>

      <button type="submit" class="btn-submit">
        <i class="bi bi-person-plus-fill"></i> Registrarse
      </button>
    </form>

    <div class="swap-row">
      ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
    </div>

    <div class="foot">EcoLearn UDEC — Educación ambiental</div>
  </div>
</div>

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

  function togglePassword(inputId, iconId) {
    var p = document.getElementById(inputId);
    var i = document.getElementById(iconId);
    var show = p.type === 'password';
    p.type = show ? 'text' : 'password';
    i.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
  }
</script>

</body>
</html>
