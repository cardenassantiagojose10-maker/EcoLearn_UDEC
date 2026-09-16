<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin · EcoLearn UDEC — @yield('page-title','Panel')</title>
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
      --adm-dark:#102019; --adm-dark-2:#0B1712;
    }
    [data-theme="dark"] {
      --verde:#3FA173; --verde-deep:#2C7E58; --verde-pale:#163327; --verde-surface:#0F4E36;
      --arcilla:#A8482B;
      --verde-ink:#8FD3AF; --miel-ink:#F6C36B; --ok-ink:#74D8A4; --err-ink:#F29289; --warn-ink:#F2BC5E;
      --arcilla-ink:#E9A184;
      --bg:#0B1A14; --surface:#14251D; --surface-2:#1A2F24;
      --ink:#EAF2EC; --ink-soft:#9CB0A4; --border:#25392E;
      --ring:rgba(159,211,86,.14);
      --adm-dark:#0A1712; --adm-dark-2:#060F0B;
    }

    * { box-sizing:border-box; }
    body {
      font-family:'Public Sans', system-ui, sans-serif;
      background:var(--bg);
      color:var(--ink);
      -webkit-font-smoothing:antialiased;
      transition:background .35s ease, color .35s ease;
    }
    a { color:var(--verde-ink); text-decoration:none; }
    .font-display { font-family:'Bricolage Grotesque', sans-serif; }

    /* ── SIDEBAR ── */
    #adm-sidebar {
      width:250px; flex-shrink:0; min-height:100vh;
      background:var(--adm-dark);
      position:fixed; top:0; left:0; display:flex; flex-direction:column;
      z-index:100; padding:22px 14px; gap:8px;
      transition:transform .3s ease;
    }
    #adm-sidebar .brand { display:flex; align-items:center; gap:11px; padding:0 8px 18px; border-bottom:1px solid rgba(255,255,255,.1); margin-bottom:10px; }
    #adm-sidebar .brand-name { font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:17px; letter-spacing:-.3px; color:#fff; line-height:1; }
    #adm-sidebar .brand-sub { font-size:10px; letter-spacing:1.2px; text-transform:uppercase; color:rgba(255,255,255,.45); margin-top:3px; }

    #adm-sidebar .nav-group {
      font-size:10px; letter-spacing:1.4px; text-transform:uppercase;
      color:rgba(255,255,255,.35); padding:14px 10px 6px;
    }
    #adm-sidebar .nav-link {
      display:flex; align-items:center; gap:11px;
      padding:10px 12px; border-radius:11px;
      font-size:14px; font-weight:600;
      color:rgba(255,255,255,.7);
      transition:background .2s ease, color .2s ease, transform .18s ease;
    }
    #adm-sidebar .nav-link i { font-size:15px; width:18px; }
    #adm-sidebar .nav-link:hover { color:#fff; transform:translateX(3px); }
    #adm-sidebar .nav-link.active { background:var(--verde-surface); color:#fff; }

    .adm-sidebar-footer {
      margin-top:auto; border-top:1px solid rgba(255,255,255,.1);
      padding-top:16px; display:flex; align-items:center; gap:10px;
    }
    .adm-avatar {
      width:34px; height:34px; border-radius:11px; flex-shrink:0;
      background:var(--verde-surface); color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-weight:700; font-size:13px;
    }

    /* ── MAIN ── */
    #adm-main { margin-left:250px; min-height:100vh; display:flex; flex-direction:column; }

    #adm-topbar {
      height:64px; flex-shrink:0;
      background:var(--surface);
      border-bottom:1px solid var(--border);
      display:flex; align-items:center; gap:14px;
      padding:0 26px;
      position:sticky; top:0; z-index:30;
      transition:background .35s ease;
    }
    #adm-topbar .page-title { font-family:'Bricolage Grotesque',sans-serif; font-weight:700; font-size:16px; letter-spacing:-.3px; }

    .icon-btn {
      width:38px; height:38px; border-radius:12px;
      border:1px solid var(--border); background:var(--surface-2); color:var(--ink);
      cursor:pointer; display:flex; align-items:center; justify-content:center;
      transition:transform .18s ease, background .2s ease;
    }
    .icon-btn:hover { background:var(--verde-pale); transform:translateY(-1px); }

    .badge-admin {
      background:var(--verde-pale); color:var(--verde-ink);
      font-size:11.5px; font-weight:700; padding:6px 12px; border-radius:999px;
      display:inline-flex; align-items:center; gap:6px;
    }

    #adm-content { padding:28px 28px 90px; flex:1; }

    /* ── COMPONENTES REUTILIZABLES ── */
    .adm-card {
      background:var(--surface); border:1px solid var(--border); border-radius:18px;
      transition:transform .2s ease, box-shadow .2s ease;
    }
    .adm-stat-card:hover { transform:translateY(-2px); box-shadow:0 14px 30px rgba(10,40,26,.10); }

    .adm-table {
      --bs-table-bg: transparent;
      --bs-table-color: var(--ink);
      --bs-table-border-color: var(--border);
      --bs-table-striped-bg: var(--surface-2);
      --bs-table-striped-color: var(--ink);
      --bs-table-hover-bg: var(--surface-2);
      --bs-table-hover-color: var(--ink);
      background:transparent;
      color:var(--ink);
    }
    .adm-table thead { background:var(--surface-2); font-size:11.5px; letter-spacing:.4px; text-transform:uppercase; color:var(--ink-soft); }
    .adm-table tbody tr { font-size:13.5px; border-color:var(--border) !important; }
    .adm-table tbody tr:hover { background:var(--surface-2); }
    .adm-table td, .adm-table th { border-color:var(--border) !important; background:transparent; }

    .form-label { font-size:13px; font-weight:700; color:var(--ink); }
    .form-control, .form-select {
      font-size:13.5px; border-radius:10px;
      background:var(--surface-2); border:1px solid var(--border); color:var(--ink);
    }
    .form-control:focus, .form-select:focus {
      border-color:var(--verde); box-shadow:0 0 0 4px var(--ring);
      background:var(--surface); color:var(--ink);
    }

    .module-form-card, .question-form-card {
      border:1px solid var(--border); border-radius:14px; padding:20px;
      background:var(--surface-2); margin-bottom:16px; position:relative;
    }
    .remove-btn {
      position:absolute; top:12px; right:12px;
      width:28px; height:28px; border-radius:50%;
      background:rgba(201,59,49,.12); border:none; color:var(--err-ink);
      display:flex; align-items:center; justify-content:center; cursor:pointer;
      font-size:14px; transition:background .2s ease;
    }
    .remove-btn:hover { background:rgba(201,59,49,.22); }

    .alert-eco {
      background:rgba(30,142,90,.10); border:1px solid rgba(30,142,90,.30);
      color:var(--ok-ink); border-radius:14px;
    }
    .alert-eco-err {
      background:rgba(201,59,49,.10); border:1px solid rgba(201,59,49,.3);
      color:var(--err-ink); border-radius:14px;
    }

    @media (max-width: 768px) {
      #adm-sidebar { transform:translateX(-100%); }
      #adm-sidebar.open { transform:translateX(0); box-shadow:0 0 40px rgba(0,0,0,.3); }
      #adm-main { margin-left:0; }
    }
  </style>
</head>
<body>

{{-- ═══════════ SIDEBAR ═══════════ --}}
<aside id="adm-sidebar">
  <div class="brand">
    <svg width="30" height="30" viewBox="0 0 48 48" aria-hidden="true" style="flex-shrink:0;">
      <path d="M24 4c12 8 17 17 17 24a17 17 0 0 1-34 0C7 21 12 12 24 4z" fill="var(--verde)"></path>
      <path d="M24 40V17" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
      <path d="M24 27l9-8" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round"></path>
      <path d="M24 33l-7-6" stroke="var(--brote)" stroke-width="3.4" stroke-linecap="round" opacity=".65"></path>
    </svg>
    <div>
      <div class="brand-name">EcoLearn Admin</div>
      <div class="brand-sub">Panel · UDEC</div>
    </div>
  </div>

  <nav class="d-flex flex-column" style="gap:3px;">
    <div class="nav-group">Principal</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="nav-group">Contenido</div>
    <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
      <i class="bi bi-journal-richtext"></i> Cursos
    </a>
    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
      <i class="bi bi-people-fill"></i> Estudiantes
    </a>

    <div class="nav-group">Plataforma</div>
    <a href="{{ route('courses.index') }}" class="nav-link" target="_blank">
      <i class="bi bi-eye-fill"></i> Ver plataforma
    </a>
    <a href="{{ route('dashboard.dashboard') }}" class="nav-link">
      <i class="bi bi-house-heart-fill"></i> Dashboard alumno
    </a>
  </nav>

  <div class="adm-sidebar-footer">
    <div class="adm-avatar"><i class="bi bi-person-fill"></i></div>
    <div class="min-w-0 flex-grow-1" style="min-width:0;">
      <div style="font-size:13px; font-weight:600; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
        {{ auth()->user()->name }}
      </div>
      <div style="font-size:11px; color:rgba(255,255,255,.45);">Administrador</div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Cerrar sesión" style="color:rgba(255,255,255,.6);">
        <i class="bi bi-box-arrow-right" style="font-size:15px;"></i>
      </button>
    </form>
  </div>
</aside>

{{-- ═══════════ MAIN ═══════════ --}}
<div id="adm-main">
  <header id="adm-topbar">
    <button class="btn btn-sm d-md-none p-0 border-0" style="color:var(--ink);"
            onclick="document.getElementById('adm-sidebar').classList.toggle('open')">
      <i class="bi bi-list fs-4"></i>
    </button>

    <div>
      <span class="page-title">@yield('page-title','Panel')</span>
      @hasSection('breadcrumb')
        <span style="color:var(--ink-soft); margin:0 8px; font-size:13px;">/</span>
        <span style="color:var(--ink-soft); font-size:13px;">@yield('breadcrumb')</span>
      @endif
    </div>

    <div class="ms-auto d-flex align-items-center gap-2">
      <button class="icon-btn" id="theme-toggle" title="Cambiar tema">
        <i class="bi bi-moon-stars-fill" id="theme-icon" style="font-size:15px;"></i>
      </button>
      <span class="badge-admin"><i class="bi bi-shield-check"></i> Admin</span>
    </div>
  </header>

  <main id="adm-content">
    @if(session('success'))
      <div class="alert alert-eco alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-eco-err alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-1 ps-3">
          @foreach($errors->all() as $e)
            <li style="font-size:13px;">{{ $e }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @yield('content')
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
@stack('scripts')
</body>
</html>
