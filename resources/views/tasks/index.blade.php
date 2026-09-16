@extends('layouts.ecolearn')

@section('page-title', 'Tareas')

@section('content')

<div style="max-width:900px; margin:0 auto; animation:fadeUp .38s ease;">

{{-- HEADER --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <h5 class="font-display mb-0" style="font-weight:700; letter-spacing:-.3px;">Mis tareas</h5>
    <p style="font-size:13px; color:var(--ink-soft); margin:2px 0 0;">
      {{ $tasks->count() }} tarea(s) registrada(s)
    </p>
  </div>
  <a href="{{ route('tasks.create') }}"
     class="d-flex align-items-center gap-2"
     style="background:var(--verde-surface); color:#fff; border:none; border-radius:12px; padding:10px 18px; font-size:13.5px; font-weight:700;">
    <i class="bi bi-plus-circle-fill"></i> Nueva tarea
  </a>
</div>

@if(session('success'))
  <div class="alert-eco alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="padding:12px 16px;">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
  </div>
@endif

@php
  $pending   = $tasks->where('is_done', false);
  $completed = $tasks->where('is_done', true);
  $pct       = $tasks->count() > 0 ? (int) round(($completed->count() / $tasks->count()) * 100) : 0;
@endphp

{{-- PROGRESS BAR --}}
@if($tasks->count() > 0)
<div style="background:var(--surface); border:1px solid var(--border); border-radius:18px; padding:22px; margin-bottom:20px;">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <span style="font-size:13.5px; font-weight:700;">
      Progreso general
    </span>
    <span class="font-display" style="font-weight:800; color:var(--verde-ink); font-size:15px;">{{ $pct }}%</span>
  </div>
  <div style="height:10px; border-radius:10px; background:var(--verde-pale); overflow:hidden;">
    <div style="width:{{ $pct }}%; height:100%; background:var(--miel); border-radius:10px;"
         role="progressbar" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="d-flex gap-4 mt-2">
    <span style="font-size:12px; color:var(--ink-soft);">
      <i class="bi bi-hourglass-split me-1" style="color:var(--miel-ink);"></i>
      {{ $pending->count() }} pendiente(s)
    </span>
    <span style="font-size:12px; color:var(--ink-soft);">
      <i class="bi bi-check-circle-fill me-1" style="color:var(--verde-ink);"></i>
      {{ $completed->count() }} completada(s)
    </span>
  </div>
</div>
@endif

@if($tasks->isEmpty())
  <div class="text-center py-5" style="background:var(--surface); border:1px solid var(--border); border-radius:18px;">
    <i class="bi bi-inbox" style="font-size:3.5rem; color:var(--ink-soft);"></i>
    <h6 class="font-display mt-3" style="font-weight:700;">No tienes tareas aún</h6>
    <p style="font-size:13.5px; color:var(--ink-soft); margin-bottom:16px;">Crea tu primera tarea para comenzar.</p>
    <a href="{{ route('tasks.create') }}"
       style="background:var(--verde-surface); color:#fff; border:none; border-radius:12px; padding:11px 20px; font-size:13.5px; font-weight:700; display:inline-flex; align-items:center; gap:8px;">
      <i class="bi bi-plus-circle"></i>Crear primera tarea
    </a>
  </div>
@else

  {{-- PENDIENTES --}}
  @if($pending->count())
  <h6 class="font-display mb-2" style="font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.6px; color:var(--ink-soft);">
    <i class="bi bi-hourglass-split me-1" style="color:var(--miel-ink);"></i>Pendientes ({{ $pending->count() }})
  </h6>
  <div style="background:var(--surface); border:1px solid var(--border); border-radius:18px; margin-bottom:20px; overflow:hidden;">
    @foreach($pending as $task)
    <div class="d-flex align-items-center gap-3 px-4 py-3"
         style="{{ !$loop->last ? 'border-bottom:1px solid var(--border);' : '' }}">

      {{-- Toggle done --}}
      <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="flex-shrink-0">
        @csrf @method('PUT')
        <input type="hidden" name="title"       value="{{ $task->title }}">
        <input type="hidden" name="description" value="{{ $task->description }}">
        <input type="hidden" name="is_done"     value="1">
        <button type="submit" class="btn p-0 border-0"
                style="width:28px; height:28px; border-radius:50%; background:rgba(244,168,44,.16); color:var(--miel-ink); display:flex; align-items:center; justify-content:center;"
                title="Marcar como completada">
          <i class="bi bi-circle" style="font-size:1rem;"></i>
        </button>
      </form>

      <div class="flex-grow-1" style="min-width:0;">
        <div style="font-size:14px; font-weight:600;">{{ $task->title }}</div>
        @if($task->description)
          <div style="font-size:12.5px; color:var(--ink-soft); margin-top:2px;">{{ Str::limit($task->description, 80) }}</div>
        @endif
      </div>

      <div class="d-flex gap-1 flex-shrink-0">
        <a href="{{ route('tasks.edit', $task->id) }}"
           class="btn btn-sm"
           style="background:rgba(14,91,63,.10); color:var(--verde-ink); border-radius:8px;"
           title="Editar">
          <i class="bi bi-pencil"></i>
        </a>
        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
              onsubmit="return confirm('¿Eliminar esta tarea?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm"
                  style="background:rgba(201,59,49,.10); color:var(--err-ink); border-radius:8px;"
                  title="Eliminar">
            <i class="bi bi-trash"></i>
          </button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
  @endif

  {{-- COMPLETADAS --}}
  @if($completed->count())
  <h6 class="font-display mb-2" style="font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.6px; color:var(--ink-soft);">
    <i class="bi bi-check-circle-fill me-1" style="color:var(--verde-ink);"></i>Completadas ({{ $completed->count() }})
  </h6>
  <div style="background:var(--surface); border:1px solid var(--border); border-radius:18px; overflow:hidden;">
    @foreach($completed as $task)
    <div class="d-flex align-items-center gap-3 px-4 py-3"
         style="opacity:.7; {{ !$loop->last ? 'border-bottom:1px solid var(--border);' : '' }}">

      {{-- Toggle undo --}}
      <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="flex-shrink-0">
        @csrf @method('PUT')
        <input type="hidden" name="title"       value="{{ $task->title }}">
        <input type="hidden" name="description" value="{{ $task->description }}">
        <input type="hidden" name="is_done"     value="0">
        <button type="submit" class="btn p-0 border-0"
                style="width:28px; height:28px; border-radius:50%; background:var(--verde-pale); color:var(--verde-ink); display:flex; align-items:center; justify-content:center;"
                title="Marcar como pendiente">
          <i class="bi bi-check-circle-fill" style="font-size:1rem;"></i>
        </button>
      </form>

      <div class="flex-grow-1" style="min-width:0;">
        <div style="font-size:14px; font-weight:600; text-decoration:line-through; color:var(--ink-soft);">{{ $task->title }}</div>
        @if($task->description)
          <div style="font-size:12.5px; color:var(--ink-soft); margin-top:2px;">{{ Str::limit($task->description, 80) }}</div>
        @endif
      </div>

      <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
            onsubmit="return confirm('¿Eliminar esta tarea?')" class="flex-shrink-0">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm"
                style="background:rgba(201,59,49,.10); color:var(--err-ink); border-radius:8px;">
          <i class="bi bi-trash"></i>
        </button>
      </form>
    </div>
    @endforeach
  </div>
  @endif

@endif

</div>

@endsection
