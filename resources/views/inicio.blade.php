<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EcoLearn UDEC — Educación ambiental</title>

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
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,600;12..96,700;12..96,800&family=Public+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

<style>
  :root {
    --verde:#0E5B3F; --verde-deep:#0A4630; --verde-pale:#E4EFE6; --verde-surface:#0E5B3F;
    --brote:#9FD356; --miel:#F4A82C; --arcilla:#A8482B;
    --bg:#F6F5F0; --surface:#FFFFFF; --surface-2:#FBFBF7;
    --ink:#142019; --ink-soft:#55655B; --border:#E3E4DA;
    --verde-ink:#0E5B3F; --miel-ink:#8A5A00;
    --ring:rgba(14,91,63,.10);
  }
  [data-theme="dark"] {
    --verde:#3FA173; --verde-deep:#2C7E58; --verde-pale:#163327; --verde-surface:#0F4E36;
    --arcilla:#A8482B;
    --verde-ink:#8FD3AF; --miel-ink:#F6C36B;
    --bg:#0B1A14; --surface:#14251D; --surface-2:#1A2F24;
    --ink:#EAF2EC; --ink-soft:#9CB0A4; --border:#25392E;
    --ring:rgba(159,211,86,.14);
  }

  * { box-sizing:border-box; }
  body {
    font-family:'Public Sans', system-ui, sans-serif;
    background:var(--bg);
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
    transition:background .35s ease, color .35s ease;
  }
  a { text-decoration:none; }
  .font-display { font-family:'Bricolage Grotesque', sans-serif; }

  /* ── NAVBAR ── */
  .nav-eco {
    position:sticky; top:0; z-index:50;
    background:var(--surface);
    border-bottom:1px solid var(--border);
    padding:14px 0;
    transition:background .35s ease;
  }
  .nav-eco .brand-lockup { display:flex; align-items:center; gap:11px; }
  .nav-eco .name { font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:19px; letter-spacing:-.4px; color:var(--ink); line-height:1; }
  .nav-eco .sub { font-size:10.5px; letter-spacing:1.3px; text-transform:uppercase; color:var(--ink-soft); margin-top:2px; }
  .nav-eco .nav-link {
    font-size:14px; font-weight:600; color:var(--ink-soft); padding:8px 6px;
    transition:color .18s ease;
  }
  .nav-eco .nav-link:hover { color:var(--ink); }

  #navMenu.collapse:not(.show) { display:none; }
  @media (max-width: 991.98px) {
    #navMenu {
      position:absolute; top:100%; left:0; right:0;
      background:var(--surface); border-bottom:1px solid var(--border);
      box-shadow:0 18px 40px rgba(10,40,26,.12);
      padding:8px 20px 20px;
      z-index:60;
    }
    #navMenu .navbar-nav { gap:2px !important; }
    #navMenu .nav-link { padding:10px 4px; border-bottom:1px solid var(--border); }
    #navMenu .nav-actions {
      display:flex; flex-direction:column; gap:10px; margin-top:14px;
    }
    #navMenu .nav-actions .theme-btn { align-self:flex-start; }
  }
  .theme-btn {
    width:38px; height:38px; border-radius:12px;
    border:1px solid var(--border); background:var(--surface-2); color:var(--ink);
    cursor:pointer; display:flex; align-items:center; justify-content:center;
    transition:transform .18s ease, background .2s ease;
  }
  .theme-btn:hover { background:var(--verde-pale); transform:translateY(-1px); }

  .btn-ghost {
    border:1px solid var(--border); border-radius:12px; padding:9px 18px;
    font-size:13.5px; font-weight:700; color:var(--ink);
  }
  .btn-solid {
    background:var(--verde-surface); border:none; border-radius:12px; padding:10px 18px;
    font-size:13.5px; font-weight:700; color:#fff; display:inline-flex; align-items:center; gap:7px;
    transition:transform .18s ease, filter .2s ease;
  }
  .btn-solid:hover { transform:translateY(-2px); filter:brightness(1.08); color:#fff; }

  /* ── HERO ── */
  .hero {
    position:relative; overflow:hidden;
    background:var(--verde-surface);
    color:#fff;
    padding:90px 0 100px;
  }
  .hero::before {
    content:""; position:absolute; right:-120px; top:-140px;
    width:420px; height:420px; border-radius:50%;
    background:rgba(159,211,86,.16);
  }
  .hero::after {
    content:""; position:absolute; left:-100px; bottom:-160px;
    width:360px; height:360px; border-radius:50%;
    background:rgba(244,168,44,.10);
  }
  .hero .eyebrow {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(255,255,255,.14); border:1px solid rgba(255,255,255,.22);
    padding:6px 14px; border-radius:999px;
    font-size:12px; font-weight:700; letter-spacing:.4px;
  }
  .hero h1 {
    font-weight:800; font-size:48px; line-height:1.08; letter-spacing:-1.4px;
    margin:22px 0 16px;
  }
  .hero p.lead-eco {
    font-size:16px; line-height:1.6; color:#fff; opacity:.92; max-width:52ch; margin:0 auto 30px;
  }
  .hero-stats {
    display:flex; gap:34px; justify-content:center; flex-wrap:wrap; margin-top:44px;
    position:relative;
  }
  .hero-stats .num { font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:26px; letter-spacing:-.6px; color:var(--brote); }
  .hero-stats .lbl { font-size:12px; color:#fff; opacity:.85; margin-top:2px; }

  /* ── SECCIONES ── */
  .section-eyebrow {
    display:inline-flex; align-items:center; gap:7px;
    background:var(--verde-pale); color:var(--verde-ink);
    padding:6px 13px; border-radius:999px; font-size:11.5px; font-weight:800; letter-spacing:.5px; text-transform:uppercase;
  }
  .section-title { font-weight:800; font-size:32px; letter-spacing:-1px; margin:14px 0 10px; }
  .section-sub { font-size:15px; color:var(--ink-soft); max-width:60ch; }

  .feature-card {
    background:var(--surface); border:1px solid var(--border); border-radius:20px;
    padding:26px; height:100%;
    transition:transform .2s ease, box-shadow .2s ease;
  }
  .feature-card:hover { transform:translateY(-4px); box-shadow:0 18px 40px rgba(10,40,26,.10); }
  .feature-icon-box {
    width:48px; height:48px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-size:21px; margin-bottom:16px;
  }

  .step-card { display:flex; gap:16px; align-items:flex-start; }
  .step-num {
    width:38px; height:38px; flex-shrink:0; border-radius:12px;
    background:var(--verde-surface); color:#fff;
    display:flex; align-items:center; justify-content:center;
    font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:15px;
  }

  .cta-band {
    background:var(--verde-deep); color:#fff; border-radius:26px;
    padding:56px 40px; text-align:center; position:relative; overflow:hidden;
  }
  .cta-band::before {
    content:""; position:absolute; right:-60px; bottom:-90px;
    width:260px; height:260px; border-radius:50%;
    background:rgba(159,211,86,.14);
  }

  .footer-eco {
    background:var(--surface); border-top:1px solid var(--border);
    padding:34px 0; color:var(--ink-soft); font-size:13px;
    transition:background .35s ease;
  }
  .footer-eco a { color:var(--ink-soft); }
  .footer-eco a:hover { color:var(--verde-ink); }

  @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }
  .fade-up { animation:fadeUp .5s ease; }

  @media (max-width:768px) {
    .hero h1 { font-size:34px; }
    .hero { padding:64px 0 72px; }
    .section-title { font-size:26px; }
  }
</style>
</head>

<body>

{{-- ═══════════ NAVBAR ═══════════ --}}
<nav class="nav-eco">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="brand-lockup">
      <svg width="34" height="34" viewBox="0 0 48 48" aria-hidden="true" style="flex-shrink:0;">
        <path d="M24 4c12 8 17 17 17 24a17 17 0 0 1-34 0C7 21 12 12 24 4z" fill="var(--verde)"></path>
        <path d="M24 40V17" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
        <path d="M24 27l9-8" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
        <path d="M24 33l-7-6" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round" opacity=".65"></path>
      </svg>
      <div>
        <div class="name">EcoLearn</div>
        <div class="sub">UDEC · Ubaté</div>
      </div>
    </div>

    <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-expanded="false" aria-controls="navMenu">
      <i class="bi bi-list" style="font-size:26px; color:var(--ink);"></i>
    </button>

    <div class="collapse navbar-collapse d-lg-flex align-items-lg-center" id="navMenu">
      <ul class="navbar-nav d-lg-flex flex-row gap-lg-3 mt-3 mt-lg-0 me-lg-4">
        <li class="nav-item"><a class="nav-link" href="#modulos">Módulos</a></li>
        <li class="nav-item"><a class="nav-link" href="#como-funciona">Cómo funciona</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contacto.index') }}">Contacto</a></li>
      </ul>

      <div class="nav-actions d-lg-none">
        <button class="theme-btn" id="theme-toggle-mobile" title="Cambiar tema" type="button">
          <i class="bi bi-moon-stars-fill" id="theme-icon-mobile"></i>
        </button>
        <a href="{{ route('login') }}" class="btn-ghost text-center">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="btn-solid justify-content-center"><i class="bi bi-arrow-right-circle"></i> Crear cuenta</a>
      </div>
    </div>

    <div class="d-none d-lg-flex align-items-center gap-2">
      <button class="theme-btn" id="theme-toggle" title="Cambiar tema" type="button">
        <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
      </button>
      <a href="{{ route('login') }}" class="btn-ghost">Iniciar sesión</a>
      <a href="{{ route('register') }}" class="btn-solid"><i class="bi bi-arrow-right-circle"></i> Crear cuenta</a>
    </div>
  </div>
</nav>

{{-- ═══════════ HERO ═══════════ --}}
<section class="hero text-center">
  <div class="container fade-up" style="position:relative;">

    <span class="eyebrow"><i class="bi bi-leaf-fill"></i> Educación ambiental · Universidad de Cundinamarca</span>

    <h1 class="font-display">Aprende, actúa,<br>cierra el ciclo</h1>

    <p class="lead-eco mx-auto">
      Módulos, evaluaciones y seguimiento de progreso para fortalecer la cultura
      ambiental de la comunidad universitaria de la UDEC.
    </p>

    <div class="d-flex gap-2 justify-content-center flex-wrap">
      <a href="{{ route('register') }}" class="btn btn-lg" style="background:var(--brote); color:#12301C; border:none; border-radius:12px; font-weight:700; padding:13px 26px;">
        Crear cuenta gratis
      </a>
      <a href="{{ route('login') }}" class="btn btn-lg" style="background:rgba(255,255,255,.14); color:#fff; border:1px solid rgba(255,255,255,.3); border-radius:12px; font-weight:600; padding:13px 26px;">
        Iniciar sesión
      </a>
    </div>

    <div class="hero-stats">
      <div><div class="num">+12</div><div class="lbl">Módulos educativos</div></div>
      <div><div class="num">100%</div><div class="lbl">Gratuito para la comunidad UDEC</div></div>
      <div><div class="num">3R</div><div class="lbl">Reducir · Reutilizar · Reciclar</div></div>
    </div>
  </div>
</section>

{{-- ═══════════ MÓDULOS / FEATURES ═══════════ --}}
<section class="container py-5 my-4" id="modulos">
  <div class="text-center mx-auto mb-5" style="max-width:640px;">
    <span class="section-eyebrow"><i class="bi bi-stars"></i> Qué encuentras aquí</span>
    <h2 class="font-display section-title">Todo lo que necesitas para aprender sostenibilidad</h2>
    <p class="section-sub mx-auto">Contenidos prácticos pensados para estudiantes y docentes de la Universidad de Cundinamarca.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="feature-card">
        <div class="feature-icon-box" style="background:var(--verde-pale); color:var(--verde-ink);">
          <i class="bi bi-book"></i>
        </div>
        <h4 class="font-display" style="font-size:18px; font-weight:700; letter-spacing:-.3px;">Aprendizaje</h4>
        <p style="color:var(--ink-soft); font-size:14px; margin-top:8px; margin-bottom:0;">
          Accede a módulos educativos sobre sostenibilidad, reciclaje y gestión de residuos.
        </p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="feature-card">
        <div class="feature-icon-box" style="background:rgba(244,168,44,.14); color:var(--miel-ink);">
          <i class="bi bi-bar-chart"></i>
        </div>
        <h4 class="font-display" style="font-size:18px; font-weight:700; letter-spacing:-.3px;">Evaluaciones</h4>
        <p style="color:var(--ink-soft); font-size:14px; margin-top:8px; margin-bottom:0;">
          Realiza cuestionarios para evaluar tus conocimientos sobre educación ambiental.
        </p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="feature-card">
        <div class="feature-icon-box" style="background:var(--verde-pale); color:var(--verde-ink);">
          <i class="bi bi-globe"></i>
        </div>
        <h4 class="font-display" style="font-size:18px; font-weight:700; letter-spacing:-.3px;">Sostenibilidad</h4>
        <p style="color:var(--ink-soft); font-size:14px; margin-top:8px; margin-bottom:0;">
          Promovemos prácticas responsables para cuidar el medio ambiente.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════ CÓMO FUNCIONA ═══════════ --}}
<section class="container py-5 my-3" id="como-funciona">
  <div class="text-center mx-auto mb-5" style="max-width:640px;">
    <span class="section-eyebrow"><i class="bi bi-signpost-split"></i> Ruta de aprendizaje</span>
    <h2 class="font-display section-title">Cómo funciona EcoLearn</h2>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="step-card">
        <div class="step-num">1</div>
        <div>
          <div class="font-display" style="font-weight:700; font-size:16px;">Crea tu cuenta</div>
          <p style="color:var(--ink-soft); font-size:13.5px; margin:6px 0 0;">Regístrate con tu correo institucional en menos de un minuto.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="step-card">
        <div class="step-num">2</div>
        <div>
          <div class="font-display" style="font-weight:700; font-size:16px;">Explora los módulos</div>
          <p style="color:var(--ink-soft); font-size:13.5px; margin:6px 0 0;">Avanza a tu ritmo por contenidos de sostenibilidad y reciclaje.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="step-card">
        <div class="step-num">3</div>
        <div>
          <div class="font-display" style="font-weight:700; font-size:16px;">Gana puntos e insignias</div>
          <p style="color:var(--ink-soft); font-size:13.5px; margin:6px 0 0;">Completa tareas y evaluaciones para subir de nivel.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════ CTA ═══════════ --}}
<section class="container pb-5 mb-4">
  <div class="cta-band">
    <div style="position:relative;">
      <h2 class="font-display" style="font-weight:800; font-size:30px; letter-spacing:-.8px; margin-bottom:12px;">
        Empieza tu ruta ambiental hoy
      </h2>
      <p style="opacity:.88; max-width:52ch; margin:0 auto 26px; font-size:14.5px;">
        Únete a la comunidad de EcoLearn UDEC y forma parte del cambio hacia una universidad más sostenible.
      </p>
      <a href="{{ route('register') }}" class="btn btn-lg" style="background:var(--brote); color:#12301C; border:none; border-radius:12px; font-weight:700; padding:13px 28px;">
        Crear cuenta gratis
      </a>
    </div>
  </div>
</section>

{{-- ═══════════ FOOTER ═══════════ --}}
<footer class="footer-eco">
  <div class="container d-flex flex-wrap align-items-center justify-content-between gap-2">
    <div>Sistema EcoLearn UDEC · Universidad de Cundinamarca</div>
    <div class="d-flex gap-3">
      <a href="{{ route('contacto.index') }}">Contacto</a>
      <a href="{{ route('login') }}">Iniciar sesión</a>
      <a href="{{ route('register') }}">Registro</a>
    </div>
  </div>
</footer>

<script>
  (function () {
    var root  = document.documentElement;
    var icons = [document.getElementById('theme-icon'), document.getElementById('theme-icon-mobile')];
    var btns  = [document.getElementById('theme-toggle'), document.getElementById('theme-toggle-mobile')];

    function sync() {
      var dark = root.getAttribute('data-theme') === 'dark';
      icons.forEach(function (icon) {
        if (icon) icon.className = dark ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
      });
    }
    sync();

    btns.forEach(function (btn) {
      if (!btn) return;
      btn.addEventListener('click', function () {
        var dark = root.getAttribute('data-theme') === 'dark';
        root.setAttribute('data-theme', dark ? 'light' : 'dark');
        try { localStorage.setItem('ecolearn-theme', dark ? 'light' : 'dark'); } catch (e) {}
        sync();
      });
    });
  }());
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
