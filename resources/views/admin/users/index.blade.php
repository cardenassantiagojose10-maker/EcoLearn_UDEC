@extends('layouts.admin')

@section('page-title', 'Estudiantes')
@section('breadcrumb', 'Gestión de estudiantes')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h5 class="font-display fw-bold mb-0" style="color:var(--ink);">Estudiantes registrados</h5>
    <p class="mb-0" style="font-size:.82rem;color:var(--ink-soft);">{{ $users->count() }} estudiante(s) en la plataforma</p>
  </div>
</div>

@if(session('error'))
  <div class="alert alert-eco-err alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
  </div>
@endif

@if($users->isEmpty())
  <div class="text-center py-5">
    <i class="bi bi-people" style="font-size:3rem;color:var(--ink-soft);"></i>
    <p class="mt-3" style="color:var(--ink-soft);">No hay estudiantes registrados.</p>
  </div>
@else
  <div class="adm-card adm-stat-card">
    <div class="table-responsive">
      <table class="table adm-table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tareas</th>
            <th>Evaluaciones</th>
            <th>Registro</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td style="font-size:.8rem;color:var(--ink-soft);">{{ $user->id }}</td>
            <td>
              <div class="d-flex align-items-center gap-2">
                @php
                  $initials = collect(explode(' ', $user->name))
                    ->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('');
                @endphp
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                     style="width:32px;height:32px;background:var(--verde-pale);color:var(--verde-ink);font-size:.75rem;">
                  {{ $initials }}
                </div>
                <span class="fw-semibold" style="font-size:.88rem;color:var(--ink);">{{ $user->name }}</span>
              </div>
            </td>
            <td style="font-size:.85rem;color:var(--ink-soft);">{{ $user->email }}</td>
            <td>
              <span class="badge" style="background:rgba(244,168,44,.14);color:var(--miel-ink);">
                {{ $user->tasks_count }}
              </span>
            </td>
            <td>
              <span class="badge" style="background:#eef2ff;color:#4f46e5;">
                {{ $user->evaluation_attempts_count }}
              </span>
            </td>
            <td style="font-size:.8rem;color:var(--ink-soft);">
              {{ $user->created_at->format('d/m/Y') }}
            </td>
            <td class="text-end">
              <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                    class="d-inline"
                    onsubmit="return confirm('¿Eliminar al estudiante {{ addslashes($user->name) }}? Esta acción no se puede deshacer.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm"
                        style="background:rgba(201,59,49,.10);color:var(--err-ink);border-radius:6px;"
                        title="Eliminar">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif

@endsection
