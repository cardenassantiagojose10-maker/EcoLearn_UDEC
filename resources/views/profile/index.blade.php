@extends('layouts.ecolearn')

@section('page-title', 'Mi Perfil')

@section('content')

@php
  $name     = auth()->user()->name;
  $initials = collect(explode(' ', $name))->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('');
@endphp

<div class="row g-4">

  {{-- ══ COLUMNA AVATAR + INFO ══ --}}
  <div class="col-lg-4">
    <div class="text-center" style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:28px;">
      {{-- Avatar con iniciales --}}
      <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
           style="width:90px; height:90px; border-radius:50%; background:var(--verde-surface);
                  color:#fff; font-size:1.8rem; font-weight:700; letter-spacing:1px;">
        {{ $initials }}
      </div>

      <h5 class="font-display mb-0" style="font-weight:700;">{{ $user->name }}</h5>
      <p style="font-size:13px; color:var(--ink-soft); margin:2px 0 12px;">{{ $user->email }}</p>

      <span style="display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:999px; margin-bottom:16px; font-size:11.5px; font-weight:700;
                   background:{{ $user->isAdmin() ? 'rgba(79,70,229,.12)' : 'var(--verde-pale)' }};
                   color:{{ $user->isAdmin() ? '#4f46e5' : 'var(--verde-ink)' }};">
        <i class="bi {{ $user->isAdmin() ? 'bi-shield-fill-check' : 'bi-mortarboard-fill' }}"></i>
        {{ $user->isAdmin() ? 'Administrador' : 'Estudiante' }}
      </span>

      <hr style="border-color:var(--border);">

      <div class="text-start">
        <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid var(--border);">
          <span style="font-size:12.5px; color:var(--ink-soft);">Miembro desde</span>
          <span style="font-size:12.5px; font-weight:700;">
            {{ $user->created_at->format('M Y') }}
          </span>
        </div>
        <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid var(--border);">
          <span style="font-size:12.5px; color:var(--ink-soft);">Tareas creadas</span>
          <span style="font-size:12.5px; font-weight:700;">
            {{ $user->tasks()->count() }}
          </span>
        </div>
        <div class="d-flex justify-content-between py-2">
          <span style="font-size:12.5px; color:var(--ink-soft);">Evaluaciones</span>
          <span style="font-size:12.5px; font-weight:700;">
            {{ $user->evaluationAttempts()->count() }}
          </span>
        </div>
      </div>
    </div>
  </div>

  {{-- ══ COLUMNA FORMULARIOS ══ --}}
  <div class="col-lg-8">

    {{-- Mensajes flash --}}
    @if(session('success'))
      <div class="alert-eco alert-dismissible fade show d-flex align-items-center" role="alert" style="padding:12px 16px; margin-bottom:16px;">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- ── DATOS PERSONALES ── --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px; margin-bottom:18px;">
      <h6 class="font-display mb-4" style="font-weight:700;">
        <i class="bi bi-person-fill me-2" style="color:var(--verde-ink);"></i>Datos personales
      </h6>

      <form method="POST" action="{{ route('profile.update') }}">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label" style="font-size:13px;">
            Nombre completo
          </label>
          <input type="text" name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $user->name) }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-size:13px;">
            Correo electrónico
          </label>
          <input type="email" name="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email', $user->email) }}">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" style="background:var(--verde-surface); color:#fff; border:none; border-radius:12px; padding:11px 22px; font-size:13.5px; font-weight:700;">
          <i class="bi bi-check2 me-1"></i> Guardar cambios
        </button>
      </form>
    </div>

    {{-- ── CAMBIAR CONTRASEÑA ── --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;">
      <h6 class="font-display mb-4" style="font-weight:700;">
        <i class="bi bi-lock-fill me-2" style="color:var(--miel-ink);"></i>Cambiar contraseña
      </h6>

      <form method="POST" action="{{ route('profile.password') }}">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label" style="font-size:13px;">
            Contraseña actual
          </label>
          <input type="password" name="current_password"
                 class="form-control @error('current_password') is-invalid @enderror"
                 placeholder="Tu contraseña actual">
          @error('current_password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" style="font-size:13px;">
            Nueva contraseña
          </label>
          <input type="password" name="password"
                 class="form-control @error('password') is-invalid @enderror"
                 placeholder="Mínimo 8 caracteres">
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-size:13px;">
            Confirmar nueva contraseña
          </label>
          <input type="password" name="password_confirmation"
                 class="form-control"
                 placeholder="Repite la nueva contraseña">
        </div>

        <button type="submit" style="background:var(--miel); color:#3A2600; border:none; border-radius:12px; padding:11px 22px; font-size:13.5px; font-weight:700;">
          <i class="bi bi-key-fill me-1"></i> Actualizar contraseña
        </button>
      </form>
    </div>

  </div>
</div>

<style>
  .form-control { background:var(--surface-2); border:1px solid var(--border); color:var(--ink); border-radius:10px; padding:.75rem 1rem; }
  .form-control:focus { background:var(--surface); border-color:var(--verde); color:var(--ink); box-shadow:0 0 0 4px var(--ring); }
  .form-control.is-invalid { border-color:var(--err-ink); }
</style>

@endsection
