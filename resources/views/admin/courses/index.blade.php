@extends('layouts.admin')

@section('page-title', 'Cursos')
@section('breadcrumb', 'Gestión de cursos')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h5 class="font-display fw-bold mb-0" style="color:var(--ink);">Cursos publicados</h5>
    <p class="mb-0" style="font-size:.82rem;color:var(--ink-soft);">{{ $courses->count() }} curso(s) en la plataforma</p>
  </div>
  <a href="{{ route('admin.courses.create') }}"
     class="btn d-flex align-items-center gap-2"
     style="background:var(--verde-surface);color:#fff;border-radius:8px;font-size:.88rem;">
    <i class="bi bi-plus-circle-fill"></i> Nuevo curso
  </a>
</div>

@if($courses->isEmpty())
  <div class="text-center py-5">
    <i class="bi bi-book" style="font-size:3rem;color:var(--ink-soft);"></i>
    <p class="mt-3" style="color:var(--ink-soft);">No hay cursos. Crea el primero.</p>
  </div>
@else
  <div class="adm-card adm-stat-card">
    <div class="table-responsive">
      <table class="table adm-table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Título</th>
            <th>Módulos</th>
            <th>Preguntas</th>
            <th>Creado</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($courses as $course)
          @php
            $mods  = count($course->content['modules']    ?? []);
            $qs    = count($course->content['evaluation']['questions'] ?? []);
          @endphp
          <tr>
            <td style="font-size:.8rem;color:var(--ink-soft);">{{ $course->id }}</td>
            <td>
              <div class="fw-semibold" style="font-size:.88rem;color:var(--ink);">
                {{ $course->title }}
              </div>
              <div style="font-size:.78rem;color:var(--ink-soft);">
                {{ Str::limit($course->description, 60) }}
              </div>
            </td>
            <td>
              <span class="badge" style="background:var(--verde-pale);color:var(--verde-ink);">
                {{ $mods }} módulo{{ $mods !== 1 ? 's' : '' }}
              </span>
            </td>
            <td>
              <span class="badge" style="background:rgba(244,168,44,.14);color:var(--miel-ink);">
                {{ $qs }} pregunta{{ $qs !== 1 ? 's' : '' }}
              </span>
            </td>
            <td style="font-size:.8rem;color:var(--ink-soft);">
              {{ $course->created_at->format('d/m/Y') }}
            </td>
            <td class="text-end">
              <a href="{{ route('courses.show', $course->id) }}" target="_blank"
                 class="btn btn-sm me-1"
                 style="background:var(--verde-pale);color:var(--verde-ink);border-radius:6px;"
                 title="Ver como alumno">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.courses.edit', $course->id) }}"
                 class="btn btn-sm me-1"
                 style="background:#e0f2fe;color:#0ea5e9;border-radius:6px;"
                 title="Editar">
                <i class="bi bi-pencil"></i>
              </a>
              <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}"
                    class="d-inline"
                    onsubmit="return confirm('¿Eliminar este curso? Esta acción no se puede deshacer.')">
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
