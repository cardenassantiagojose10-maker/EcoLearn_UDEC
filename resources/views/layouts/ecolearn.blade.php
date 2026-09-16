<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EcoLearn UDEC — @yield('page-title', 'Plataforma')</title>
  <link rel="icon" type="image/svg+xml" href="/favicon.svg">

  {{-- Evita el parpadeo del tema oscuro --}}
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
      --ok:#1E8E5A; --err:#C93B31; --warn:#E08A0B;
      --verde-ink:#0E5B3F; --miel-ink:#8A5A00; --ok-ink:#14663F; --err-ink:#A82F26; --warn-ink:#8A5300;
      --arcilla-ink:#A8482B;
      --ring:rgba(14,91,63,.10);
    }
    [data-theme="dark"] {
      --verde:#3FA173; --verde-deep:#2C7E58; --verde-pale:#163327; --verde-surface:#0F4E36;
      --arcilla:#A8482B;
      --verde-ink:#8FD3AF; --miel-ink:#F6C36B; --ok-ink:#74D8A4; --err-ink:#F29289; --warn-ink:#F2BC5E;
      --arcilla-ink:#E9A184;
      --bg:#0B1A14; --surface:#14251D; --surface-2:#1A2F24;
      --ink:#EAF2EC; --ink-soft:#9CB0A4; --border:#25392E;
      --ring:rgba(159,211,86,.14);
    }

    * { box-sizing: border-box; }
    body {
      font-family: 'Public Sans', system-ui, sans-serif;
      background: var(--bg);
      color: var(--ink);
      -webkit-font-smoothing: antialiased;
      transition: background .35s ease, color .35s ease;
    }
    a { color: var(--verde-ink); text-decoration: none; }

    .font-display { font-family: 'Bricolage Grotesque', sans-serif; }

    /* ── SIDEBAR ── */
    #sidebar {
      width: 250px;
      flex-shrink: 0;
      background: var(--surface);
      border-right: 1px solid var(--border);
      padding: 22px 14px;
      display: flex;
      flex-direction: column;
      gap: 22px;
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      z-index: 100;
      transition: transform .3s ease, background .35s ease;
    }

    #sidebar .brand { display:flex; align-items:center; gap:11px; padding:0 8px; }
    #sidebar .brand-name { font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:18px; letter-spacing:-.4px; line-height:1; }
    #sidebar .brand-sub  { font-size:10.5px; letter-spacing:1.3px; text-transform:uppercase; color:var(--ink-soft); margin-top:3px; }

    #sidebar .nav-group {
      font-size:10px; letter-spacing:1.4px; text-transform:uppercase;
      color:var(--ink-soft); opacity:.7; padding:0 10px 6px;
    }
    #sidebar .nav-group + .nav-group { padding-top:16px; }

    #sidebar .nav-link {
      display:flex; align-items:center; gap:11px;
      padding:10px 12px; border-radius:11px;
      font-size:14px; font-weight:600;
      color:var(--ink-soft);
      transition: background .2s ease, color .2s ease, transform .18s ease;
    }
    #sidebar .nav-link i { font-size:15px; width:18px; }
    #sidebar .nav-link:hover { transform: translateX(3px); color: var(--ink); }
    #sidebar .nav-link.active { background: var(--verde-surface); color:#fff; }

    #sidebar .side-footer {
      margin-top:auto; border-top:1px solid var(--border);
      padding-top:16px; display:flex; align-items:center; gap:10px;
    }

    .avatar-box {
      width:36px; height:36px; border-radius:12px;
      background: var(--verde-surface); color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-weight:700; font-size:13px; flex-shrink:0;
    }

    /* ── MAIN ── */
    #main-wrapper { margin-left: 250px; min-height:100vh; display:flex; flex-direction:column; }

    #topbar {
      height:68px; flex-shrink:0;
      background: var(--surface);
      border-bottom:1px solid var(--border);
      display:flex; align-items:center; gap:14px;
      padding:0 26px;
      position:sticky; top:0; z-index:30;
      transition: background .35s ease;
    }
    #topbar .page-title { font-family:'Bricolage Grotesque',sans-serif; font-weight:700; font-size:17px; letter-spacing:-.3px; }
    .chip-streak {
      display:flex; align-items:center; gap:7px;
      background:var(--verde-pale); color:var(--verde-ink);
      padding:6px 12px; border-radius:999px; font-size:12px; font-weight:700;
    }
    .icon-btn {
      width:38px; height:38px; border-radius:12px;
      border:1px solid var(--border); background:var(--surface-2); color:var(--ink);
      cursor:pointer; display:flex; align-items:center; justify-content:center;
      position:relative; transition: transform .18s ease, background .2s ease;
    }
    .icon-btn:hover { background:var(--verde-pale); transform:translateY(-1px); }
    .icon-btn:active { transform:scale(.94); }
    .notif-badge {
      position:absolute; top:-4px; right:-4px;
      min-width:18px; height:18px; border-radius:9px;
      background:var(--miel); color:#3A2600;
      font-size:10.5px; font-weight:800;
      display:flex; align-items:center; justify-content:center;
      border:2px solid var(--surface);
    }
    .notif-panel {
      position:absolute; top:48px; right:0; width:330px;
      background:var(--surface); border:1px solid var(--border);
      border-radius:16px; box-shadow:0 18px 44px rgba(10,40,26,.16);
      overflow:hidden; z-index:40; animation:popIn .18s ease;
    }
    .notif-item { display:flex; gap:11px; padding:13px 16px; border-bottom:1px solid var(--border); }
    .notif-item:last-child { border-bottom:none; }

    #page-content { padding: 28px 28px 104px; flex:1; }

    @keyframes popIn { from { opacity:0; transform:scale(.94);} to { opacity:1; transform:none; } }
    @keyframes fadeUp { from { opacity:0; transform:translateY(10px);} to { opacity:1; transform:none; } }
    @keyframes flame { 0%,100% { transform:scale(1);} 50% { transform:scale(1.14);} }
    @keyframes drawRing { from { stroke-dashoffset:339; } }

    /* alertas */
    .alert-eco {
      background: rgba(30,142,90,.10);
      border:1px solid rgba(30,142,90,.30);
      color: var(--ok-ink);
      border-radius:14px;
    }

    @media (max-width: 992px) {
      #sidebar { transform: translateX(-100%); }
      #sidebar.open { transform: translateX(0); box-shadow:0 0 40px rgba(0,0,0,.3); }
      #main-wrapper { margin-left: 0; }
    }
  </style>
</head>
<body>

@php
  $u        = auth()->user();
  $initials = collect(explode(' ', $u->name))->filter()->map(fn($w) => strtoupper(mb_substr($w,0,1)))->take(2)->join('');
  $roleName = $u->isAdmin() ? 'Docente / Admin' : 'Estudiante';
@endphp

{{-- ═══════════ SIDEBAR ═══════════ --}}
<aside id="sidebar">

  <div class="brand">
    <svg width="34" height="34" viewBox="0 0 48 48" aria-hidden="true" style="flex-shrink:0;">
      <path d="M24 4c12 8 17 17 17 24a17 17 0 0 1-34 0C7 21 12 12 24 4z" fill="var(--verde)"></path>
      <path d="M24 40V17" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
      <path d="M24 27l9-8" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
      <path d="M24 33l-7-6" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round" opacity=".65"></path>
    </svg>
    <div>
      <div class="brand-name">EcoLearn</div>
      <div class="brand-sub">UDEC · Ubaté</div>
    </div>
  </div>

  <nav class="d-flex flex-column" style="gap:3px;">
    <div class="nav-group">Aprender</div>

    <a href="{{ route('dashboard.dashboard') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
      <i class="bi bi-house-heart-fill"></i> Inicio
    </a>
    <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
      <i class="bi bi-collection-fill"></i> Módulos
    </a>
    <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
      <i class="bi bi-patch-check-fill"></i> Tareas
    </a>
    <a href="{{ route('progress.index') }}" class="nav-link {{ request()->routeIs('progress.*') ? 'active' : '' }}">
      <i class="bi bi-graph-up-arrow"></i> Progreso
    </a>

    <div class="nav-group">Cuenta</div>
    <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
      <i class="bi bi-person-circle"></i> Mi perfil
    </a>

    @if($u->isAdmin())
      <div class="nav-group">Docencia</div>
      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-clipboard2-data-fill"></i> Analítica
      </a>
      <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
        <i class="bi bi-journal-richtext"></i> Gestionar módulos
      </a>
      <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Estudiantes
      </a>
    @endif
  </nav>

  <div class="side-footer">
    <div class="avatar-box">{{ $initials }}</div>
    <div class="min-w-0 flex-grow-1" style="min-width:0;">
      <div style="font-size:13px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $u->name }}</div>
      <div style="font-size:11px; color:var(--ink-soft);">{{ $roleName }}</div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Cerrar sesión" style="color:var(--ink-soft);">
        <i class="bi bi-box-arrow-right" style="font-size:15px;"></i>
      </button>
    </form>
  </div>
</aside>

{{-- ═══════════ MAIN WRAPPER ═══════════ --}}
<div id="main-wrapper">

  <header id="topbar">
    <button class="btn btn-sm d-lg-none p-0 border-0" style="color:var(--ink);"
            onclick="document.getElementById('sidebar').classList.toggle('open')">
      <i class="bi bi-list fs-4"></i>
    </button>

    <div class="page-title">@yield('page-title', 'Panel')</div>

    <div class="chip-streak d-none d-md-flex">
      <i class="bi bi-fire" style="animation:flame 2.4s ease-in-out infinite;"></i> Racha 7 días
    </div>

    <div class="ms-auto d-flex align-items-center gap-2">
      <button class="icon-btn" id="theme-toggle" title="Cambiar tema">
        <i class="bi bi-moon-stars-fill" id="theme-icon" style="font-size:15px;"></i>
      </button>

      <div style="position:relative;">
        <button class="icon-btn" id="notif-toggle" title="Notificaciones">
          <i class="bi bi-bell-fill" style="font-size:15px;"></i>
          <span class="notif-badge">3</span>
        </button>
        <div class="notif-panel" id="notif-panel" hidden>
          <div style="padding:13px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between;">
            <span style="font-weight:700; font-size:13.5px;">Notificaciones</span>
            <span style="font-size:11.5px; color:var(--verde-ink); font-weight:600;">Marcar leídas</span>
          </div>
          <div class="notif-item">
            <i class="bi bi-hourglass-split" style="color:var(--miel-ink); font-size:15px; margin-top:2px;"></i>
            <div>
              <div style="font-size:13px; font-weight:600; line-height:1.35;">Tienes tareas pendientes por revisar</div>
              <div style="font-size:11px; color:var(--ink-soft); margin-top:3px;">Hace 2 horas</div>
            </div>
          </div>
          <div class="notif-item">
            <i class="bi bi-stars" style="color:var(--verde-ink); font-size:15px; margin-top:2px;"></i>
            <div>
              <div style="font-size:13px; font-weight:600; line-height:1.35;">Nuevo módulo disponible en el catálogo</div>
              <div style="font-size:11px; color:var(--ink-soft); margin-top:3px;">Ayer</div>
            </div>
          </div>
          <div class="notif-item">
            <i class="bi bi-award-fill" style="color:var(--arcilla-ink); font-size:15px; margin-top:2px;"></i>
            <div>
              <div style="font-size:13px; font-weight:600; line-height:1.35;">Sigue sumando puntos completando evaluaciones</div>
              <div style="font-size:11px; color:var(--ink-soft); margin-top:3px;">Hace 3 días</div>
            </div>
          </div>
        </div>
      </div>

      <div class="avatar-box" style="border-radius:12px;">{{ $initials }}</div>
    </div>
  </header>

  <main id="page-content">
    @if(session('success'))
      <div class="alert alert-eco alert-dismissible fade show d-flex align-items-center" role="alert" style="border:1px solid rgba(30,142,90,.3);">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @yield('content')
  </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  (function () {
    var root  = document.documentElement;
    var btn   = document.getElementById('theme-toggle');
    var icon  = document.getElementById('theme-icon');

    function syncIcon() {
      var dark = root.getAttribute('data-theme') === 'dark';
      icon.className = dark ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
    }
    syncIcon();

    btn.addEventListener('click', function () {
      var dark = root.getAttribute('data-theme') === 'dark';
      root.setAttribute('data-theme', dark ? 'light' : 'dark');
      try { localStorage.setItem('ecolearn-theme', dark ? 'light' : 'dark'); } catch (e) {}
      syncIcon();
    });

    var nt = document.getElementById('notif-toggle');
    var np = document.getElementById('notif-panel');
    nt.addEventListener('click', function (e) {
      e.stopPropagation();
      np.hidden = !np.hidden;
    });
    document.addEventListener('click', function (e) {
      if (!np.hidden && !np.contains(e.target)) np.hidden = true;
    });
  }());
</script>

@include('components.chatbot')
</body>
</html>
