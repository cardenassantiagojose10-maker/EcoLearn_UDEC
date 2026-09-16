@extends('layouts.ecolearn')

@section('page-title', 'Tareas')
@section('breadcrumb', 'Editar tarea')

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
             style="width:56px; height:56px; border-radius:16px; background:rgba(14,91,63,.10);">
          <i class="bi bi-pencil-fill" style="color:var(--verde-ink); font-size:1.4rem;"></i>
        </div>
        <h5 class="font-display mb-1" style="font-weight:700;">Editar tarea</h5>
        <p style="font-size:13.5px; color:var(--ink-soft); margin:0;">Modifica los datos de tu tarea</p>
      </div>

      @if(session('success'))
        <div class="alert-eco d-flex align-items-center gap-2" style="padding:12px 16px; margin-bottom:16px;">
          <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert-eco-err" style="padding:12px 16px; margin-bottom:16px;">
          <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label" style="font-size:13px;">
            Título <span style="color:var(--err-ink);">*</span>
          </label>
          <input type="text" name="title"
                 class="form-control @error('title') is-invalid @enderror"
                 value="{{ old('title', $task->title) }}"
                 required autofocus>
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" style="font-size:13px;">
            Descripción
          </label>
          <textarea name="description"
                    class="form-control"
                    rows="4"
                    style="resize:none;">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-4">
          <div class="form-check form-switch ps-0 d-flex align-items-center gap-3 p-3"
               style="background:var(--surface-2); border:1px solid var(--border); border-radius:14px;">
            <input class="form-check-input m-0 flex-shrink-0" type="checkbox"
                   name="is_done" value="1" id="isDone"
                   style="width:2.5rem; height:1.3rem; cursor:pointer;"
                   {{ old('is_done', $task->is_done) ? 'checked' : '' }}>
            <label class="form-check-label" for="isDone"
                   style="font-size:13.5px; font-weight:600; color:var(--ink); cursor:pointer;">
              <i class="bi bi-check-circle-fill me-1" style="color:var(--verde-ink);"></i>
              Marcar como completada
            </label>
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="flex-grow-1"
                  style="background:var(--verde-surface); color:#fff; border:none; border-radius:12px; padding:12px; font-size:14px; font-weight:700;">
            <i class="bi bi-check2-circle me-2"></i>Guardar cambios
          </button>
          <a href="{{ route('tasks.index') }}"
             class="d-flex align-items-center justify-content-center"
             style="border:1px solid var(--border); color:var(--ink); border-radius:12px; padding:12px 24px; font-size:14px; font-weight:600;">
            Cancelar
          </a>
        </div>
      </form>

      <div class="mt-3 pt-3" style="border-top:1px solid var(--border);">
        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
              onsubmit="return confirm('¿Eliminar esta tarea permanentemente?')">
          @csrf @method('DELETE')
          <button type="submit" class="w-100"
                  style="background:rgba(201,59,49,.10); color:var(--err-ink); border:none; border-radius:10px; padding:10px; font-size:12.5px; font-weight:700;">
            <i class="bi bi-trash me-1"></i> Eliminar tarea
          </button>
        </form>
      </div>

    </div>

  </div>
</div>

<style>
  .form-control { background:var(--surface-2); border:1px solid var(--border); color:var(--ink); border-radius:10px; padding:.75rem 1rem; }
  .form-control:focus { background:var(--surface); border-color:var(--verde); color:var(--ink); box-shadow:0 0 0 4px var(--ring); }
  .form-control.is-invalid { border-color:var(--err-ink); }
</style>

@endsection
