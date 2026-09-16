@extends('layouts.ecolearn')

@section('page-title', 'Cursos')
@section('breadcrumb', Str::limit($course->title, 45))

@section('content')

@php
  $modules    = $course->content['modules']    ?? [];
  $evaluation = $course->content['evaluation'] ?? [];
  $questions  = $evaluation['questions']       ?? [];
  $expected   = $course->content['expected_result'] ?? null;
@endphp

<div style="max-width:900px; margin:0 auto; animation:fadeUp .38s ease;">

{{-- ── BACK BUTTON ── --}}
<a href="{{ route('courses.index') }}"
   class="btn btn-sm mb-4"
   style="border:1px solid var(--border); color:var(--ink); border-radius:10px; font-size:.82rem;">
  <i class="bi bi-arrow-left me-1"></i> Volver a cursos
</a>

{{-- ══════════════════════════════════════════════
     HERO DEL CURSO
══════════════════════════════════════════════ --}}
<div class="mb-4" style="background:var(--verde-surface); border-radius:22px; padding:28px; color:#fff; position:relative; overflow:hidden;">
  <div style="position:absolute; right:-70px; top:-70px; width:220px; height:220px; border-radius:50%; background:rgba(159,211,86,.16);"></div>
  <div class="row align-items-center g-3" style="position:relative;">
    <div class="col-md-8">
      <span class="mb-2 d-inline-block" style="background:#fff; color:var(--verde-ink); font-size:.72rem; font-weight:700; padding:5px 12px; border-radius:999px;">
        <i class="bi bi-leaf-fill me-1"></i>Educación Ambiental · EcoLearn UDEC
      </span>
      <h2 class="font-display mb-2" style="font-weight:800; font-size:1.55rem; line-height:1.3; letter-spacing:-.6px;">
        {{ $course->title }}
      </h2>
      <p class="mb-3" style="opacity:.9; font-size:.92rem; line-height:1.7; color:#fff;">
        {{ $course->description }}
      </p>
      <div class="d-flex flex-wrap gap-3">
        <span class="d-flex align-items-center gap-1"
              style="background:rgba(255,255,255,.16); padding:.35rem .75rem; border-radius:999px; font-size:.78rem;">
          <i class="bi bi-grid-3x3-gap-fill"></i>
          {{ count($modules) }} módulo{{ count($modules) !== 1 ? 's' : '' }}
        </span>
        <span class="d-flex align-items-center gap-1"
              style="background:rgba(255,255,255,.16); padding:.35rem .75rem; border-radius:999px; font-size:.78rem;">
          <i class="bi bi-patch-question-fill"></i>
          {{ count($questions) }} pregunta{{ count($questions) !== 1 ? 's' : '' }} de evaluación
        </span>
        <span class="d-flex align-items-center gap-1"
              style="background:rgba(255,255,255,.16); padding:.35rem .75rem; border-radius:999px; font-size:.78rem;">
          <i class="bi bi-clock-fill"></i>
          Autodirigido
        </span>
      </div>
    </div>
    <div class="col-md-4 text-center d-none d-md-block" style="position:relative;">
      <i class="bi bi-laptop-fill" style="font-size:5rem; opacity:.25;"></i>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════
     RESULTADO ESPERADO
══════════════════════════════════════════════ --}}
@if($expected)
<div class="mb-4" style="background:var(--surface); border:1px solid var(--border); border-left:4px solid var(--miel); border-radius:16px; padding:20px;">
  <div class="d-flex align-items-start gap-3">
    <div style="width:38px; height:38px; background:rgba(244,168,44,.14); border-radius:11px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
      <i class="bi bi-trophy-fill" style="color:var(--miel-ink); font-size:1.1rem;"></i>
    </div>
    <div>
      <h6 class="font-display mb-1" style="font-weight:700;">Resultado esperado</h6>
      <p class="mb-0" style="color:var(--ink-soft); font-size:.88rem; line-height:1.6;">{{ $expected }}</p>
    </div>
  </div>
</div>
@endif

{{-- ══════════════════════════════════════════════
     MÓDULOS
══════════════════════════════════════════════ --}}
<h5 class="font-display mb-3" style="font-weight:700;">
  <i class="bi bi-grid-3x3-gap-fill me-2" style="color:var(--verde-ink);"></i>
  Contenido del curso
</h5>

@foreach($modules as $module)
<div class="mb-4" style="background:var(--surface); border:1px solid var(--border); border-radius:18px; overflow:hidden;">
  <div class="d-flex align-items-center gap-3 py-3 px-4"
       style="background:var(--surface-2); border-bottom:1px solid var(--border);">
    <div style="width:34px; height:34px; border-radius:11px; background:var(--verde-surface); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:.85rem; flex-shrink:0;">
      {{ $module['number'] }}
    </div>
    <div>
      <h6 class="font-display mb-0" style="font-weight:700; font-size:.95rem;">
        <i class="bi {{ $module['icon'] ?? 'bi-bookmark-fill' }} me-2" style="color:var(--verde-ink);"></i>
        {{ $module['title'] }}
      </h6>
    </div>
    <span class="ms-auto" style="background:var(--verde-pale); color:var(--verde-ink); font-size:.72rem; font-weight:700; padding:5px 11px; border-radius:999px;">
      Módulo {{ $module['number'] }}
    </span>
  </div>

  <div class="px-4 py-3">

    {{-- Contenido principal --}}
    <p class="mb-3" style="color:var(--ink); font-size:.9rem; line-height:1.75;">
      {{ $module['content'] }}
    </p>

    {{-- Puntos clave --}}
    @if(!empty($module['key_points']))
      <div class="mb-3 p-3"
           style="background:var(--verde-pale); border-radius:12px; border:1px solid var(--border);">
        <p class="fw-semibold mb-2" style="color:var(--verde-ink); font-size:.82rem;">
          <i class="bi bi-lightbulb-fill me-1"></i> Puntos clave
        </p>
        <ul class="mb-0 ps-3" style="font-size:.85rem; color:var(--ink);">
          @foreach($module['key_points'] as $point)
            <li class="mb-1">{{ $point }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Actividad --}}
    @if(!empty($module['activity']))
      @php $act = $module['activity']; @endphp
      <div class="mt-2 p-3" style="background:rgba(244,168,44,.10); border:1px solid rgba(244,168,44,.3); border-radius:12px;">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi {{ $act['icon'] ?? 'bi-pencil-square' }}" style="color:var(--miel-ink); font-size:1rem;"></i>
          <span class="fw-semibold" style="color:var(--miel-ink); font-size:.82rem;">
            Actividad · {{ $act['type'] }}
          </span>
        </div>
        <p class="mb-0" style="font-size:.86rem; color:var(--ink); line-height:1.65;">
          {{ $act['description'] }}
        </p>
      </div>
    @endif

  </div>
</div>
@endforeach

{{-- ══════════════════════════════════════════════
     EVALUACIÓN INTERACTIVA
══════════════════════════════════════════════ --}}
@if(!empty($questions))

<div class="mt-5 mb-3">
  <div class="d-flex align-items-center gap-2 mb-1">
    <i class="bi bi-clipboard2-check-fill fs-5" style="color:var(--verde-ink);"></i>
    <h5 class="font-display mb-0" style="font-weight:700;">
      {{ $evaluation['title'] ?? 'Evaluación final' }}
    </h5>
  </div>
  @if(!empty($evaluation['description']))
    <p class="mb-1" style="color:var(--ink-soft); font-size:.87rem; padding-left:1.85rem;">
      {{ $evaluation['description'] }}
    </p>
  @endif
  <p class="mb-4" style="color:var(--ink-soft); font-size:.8rem; padding-left:1.85rem;">
    <i class="bi bi-info-circle me-1"></i>
    Selecciona una opción por pregunta y presiona <strong>Enviar evaluación</strong>.
    Necesitas responder al menos el <strong>60%</strong> correctamente para aprobar.
  </p>
</div>

<form method="POST" action="{{ route('courses.evaluate', $course->id) }}" id="eval-form">
  @csrf

  @foreach($questions as $q)
  <div class="mb-3 px-4 py-4" id="q-{{ $q['number'] }}" style="background:var(--surface); border:1px solid var(--border); border-radius:16px;">
    <div class="d-flex align-items-start gap-3 mb-3">
      <div style="width:32px; height:32px; font-size:.8rem; flex-shrink:0; border-radius:10px; background:var(--verde-surface); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700;">
        {{ $q['number'] }}
      </div>
      <p class="fw-semibold mb-0" style="color:var(--ink); font-size:.92rem; line-height:1.55;">
        {{ $q['question'] }}
      </p>
    </div>

    <div class="ps-5">
      @foreach($q['options'] as $letter => $text)
        <label class="d-flex align-items-center gap-2 mb-2"
               style="cursor:pointer; padding:9px 12px; border-radius:12px; background:var(--surface-2); border:1px solid var(--border); transition:background .2s ease;"
               onmouseover="this.style.background='var(--verde-pale)'"
               onmouseout="this.style.background='var(--surface-2)'">
          <input type="radio"
                 name="answers[{{ $q['number'] }}]"
                 value="{{ $letter }}"
                 class="form-check-input m-0 flex-shrink-0"
                 style="accent-color:var(--verde); width:1.1rem; height:1.1rem;">
          <span style="width:24px; height:24px; border-radius:999px; background:var(--verde-pale); color:var(--verde-ink); font-weight:700; font-size:.76rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">{{ $letter }}</span>
          <span style="font-size:.9rem; color:var(--ink);">{{ $text }}</span>
        </label>
      @endforeach
    </div>
  </div>
  @endforeach

  {{-- SUBMIT --}}
  <div class="p-4 mt-2" style="background:var(--verde-pale); border-radius:18px;">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
      <div>
        <p class="fw-semibold mb-0" style="color:var(--ink);">
          <i class="bi bi-send-check-fill me-2" style="color:var(--verde-ink);"></i>
          ¿Respondiste todas las preguntas?
        </p>
        <p class="mb-0" style="color:var(--ink-soft); font-size:.82rem;">
          {{ count($questions) }} pregunta(s) en total · El resultado se muestra inmediatamente.
        </p>
      </div>
      <button type="submit" id="submit-btn"
              class="btn fw-semibold px-4"
              style="background:var(--verde-surface); color:#fff; border-radius:12px; font-size:.92rem; border:none;">
        <i class="bi bi-send-fill me-2"></i>Enviar evaluación
      </button>
    </div>
  </div>
</form>

<script>
document.getElementById('eval-form').addEventListener('submit', function(e) {
  const total   = {{ count($questions) }};
  const answered = document.querySelectorAll('#eval-form input[type="radio"]:checked').length;
  if (answered < total) {
    e.preventDefault();
    const missing = total - answered;
    alert(`Aún tienes ${missing} pregunta(s) sin responder. Por favor respóndelas todas antes de enviar.`);
    return;
  }
  const btn = document.getElementById('submit-btn');
  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';
});
</script>

@endif

{{-- ── FOOTER CTA ── --}}
<div class="text-center mt-5 py-4 px-3" style="background:var(--verde-pale); border-radius:18px;">
  <i class="bi bi-patch-check-fill fs-2 mb-2" style="color:var(--verde-ink);"></i>
  <h6 class="font-display fw-bold" style="color:var(--ink);">¿Listo para seguir aprendiendo?</h6>
  <p class="mb-3" style="color:var(--ink-soft); font-size:.85rem;">
    Explora más cursos sobre sostenibilidad y amplía tu impacto positivo.
  </p>
  <a href="{{ route('courses.index') }}"
     class="btn fw-semibold px-4"
     style="background:var(--verde-surface); color:#fff; border-radius:12px; border:none;">
    <i class="bi bi-collection-fill me-2"></i>Ver todos los cursos
  </a>
</div>

</div>

@endsection
