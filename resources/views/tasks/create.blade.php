@extends('layouts.ecolearn')

@section('page-title', 'Tareas')
@section('breadcrumb', 'Nueva tarea')

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-7">

    <a href="{{ route('tasks.index') }}"
       class="btn btn-sm mb-4" style="border:1px solid var(--border); color:var(--ink); border-radius:10px; font-size:12.5px;">
      <i class="bi bi-arrow-left me-1"></i> Volver a tareas
    </a>

    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:40px;">

      <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center mb-3"
             style="width:56px; height:56px; border-radius:16px; background:rgba(244,168,44,.14);">
          <i class="bi bi-plus-square-fill" style="color:var(--miel-ink); font-size:1.5rem;"></i>
        </div>
        <h5 class="font-display mb-1" style="font-weight:700;">Nueva tarea</h5>
        <p style="font-size:13.5px; color:var(--ink-soft); margin:0;">Registra una nueva tarea o actividad pendiente</p>
      </div>

      @if($errors->any())
        <div class="alert-eco-err" style="padding:12px 16px; margin-bottom:16px;">
          <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label" style="font-size:13px;">
            Título <span style="color:var(--err-ink);">*</span>
          </label>
          <input type="text" name="title"
                 class="form-control @error('title') is-invalid @enderror"
                 value="{{ old('title') }}"
                 placeholder="Ej: Investigar puntos de reciclaje en el campus"
                 autofocus required>
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-size:13px;">
            Descripción <span style="font-weight:400; color:var(--ink-soft);">(opcional)</span>
          </label>
          <textarea name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="4"
                    placeholder="Añade detalles o instrucciones sobre la tarea..."
                    style="resize:none;">{{ old('description') }}</textarea>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="flex-grow-1"
                  style="background:var(--verde-surface); color:#fff; border:none; border-radius:12px; padding:12px; font-size:14px; font-weight:700;">
            <i class="bi bi-plus-circle-fill me-2"></i>Crear tarea
          </button>
          <a href="{{ route('tasks.index') }}"
             class="d-flex align-items-center justify-content-center"
             style="border:1px solid var(--border); color:var(--ink); border-radius:12px; padding:12px 24px; font-size:14px; font-weight:600;">
            Cancelar
          </a>
        </div>
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
