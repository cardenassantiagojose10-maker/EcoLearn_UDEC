@extends('layouts.ecolearn')

@section('page-title', 'Resultado')
@section('breadcrumb', 'Evaluación · ' . Str::limit($course->title, 35))

@section('content')

@php
  $pct    = $attempt->percentage();
  $passed = $attempt->passed();
  $color     = $passed ? 'var(--verde)' : 'var(--err)';
  $colorInk  = $passed ? 'var(--verde-ink)' : 'var(--err-ink)';
  $bgPale    = $passed ? 'var(--verde-pale)' : 'rgba(201,59,49,.10)';
  $icon   = $passed ? 'bi-patch-check-fill' : 'bi-x-circle-fill';
  $label  = $passed ? 'Aprobado' : 'No aprobado';
@endphp

<div style="max-width:900px; margin:0 auto; animation:fadeUp .38s ease;">

{{-- Back --}}
<a href="{{ route('courses.show', $course->id) }}"
   class="btn btn-sm mb-4" style="border:1px solid var(--border); color:var(--ink); border-radius:10px; font-size:.82rem;">
  <i class="bi bi-arrow-left me-1"></i> Volver al curso
</a>

{{-- ══ RESULTADO CARD ══ --}}
<div class="mb-4" style="background:var(--surface); border:1px solid var(--border); border-radius:20px; overflow:hidden;">
  <div style="background:{{ $color }}; padding:2rem 2.5rem;">
    <div class="d-flex align-items-center gap-4 flex-wrap">
      <i class="bi {{ $icon }}" style="font-size:3.5rem; color:#fff;"></i>
      <div style="color:#fff;">
        <h3 class="font-display fw-bold mb-1">{{ $label }}</h3>
        <p class="mb-0" style="opacity:.9; font-size:.92rem;">
          {{ $course->title }}
        </p>
      </div>
      <div class="ms-auto text-center" style="color:#fff;">
        <div class="font-display fw-bold" style="font-size:3rem; line-height:1;">{{ $pct }}%</div>
        <div style="font-size:.82rem; opacity:.85;">
          {{ $attempt->score }} de {{ $attempt->total }} correctas
        </div>
      </div>
    </div>
  </div>

  {{-- Barra de progreso --}}
  <div style="background:var(--surface-2); padding:.9rem 2.5rem;">
    <div class="progress" style="height:10px; border-radius:10px; background:var(--border);">
      <div class="progress-bar" role="progressbar"
           style="width:{{ $pct }}%; background:{{ $color }}; border-radius:10px;"
           aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100">
      </div>
    </div>
    <div class="d-flex justify-content-between mt-1">
      <small style="font-size:.74rem; color:var(--ink-soft);">0%</small>
      <small style="font-size:.74rem; color:var(--ink-soft);">Mínimo aprobatorio: 60%</small>
      <small style="font-size:.74rem; color:var(--ink-soft);">100%</small>
    </div>
  </div>
</div>

{{-- ══ DETALLE POR PREGUNTA ══ --}}
<h6 class="font-display mb-3" style="font-weight:700;">
  <i class="bi bi-list-check me-2" style="color:var(--verde-ink);"></i>Revisión pregunta por pregunta
</h6>

@foreach($attempt->answers as $num => $detail)
  @php
    $right     = $detail['is_correct'];
    $border    = $right ? 'var(--verde)' : 'var(--err)';
    $icon2     = $right ? 'bi-check-circle-fill' : 'bi-x-circle-fill';
    $iconColor = $right ? 'var(--verde-ink)' : 'var(--err-ink)';
  @endphp

  <div class="mb-3"
       style="background:var(--surface); border:1px solid var(--border); border-left:4px solid {{ $border }}; border-radius:16px;">
    <div class="px-4 py-3">

      {{-- Header pregunta --}}
      <div class="d-flex align-items-start gap-3 mb-3">
        <div style="width:30px; height:30px; font-size:.78rem; flex-shrink:0; border-radius:10px; background:var(--verde-surface); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700;">
          {{ $num }}
        </div>
        <p class="fw-semibold mb-0" style="color:var(--ink); font-size:.92rem; line-height:1.5; flex:1;">
          {{ $detail['question'] }}
        </p>
        <i class="bi {{ $icon2 }}" style="color:{{ $iconColor }}; font-size:1.3rem; flex-shrink:0;"></i>
      </div>

      <div class="ps-5">
        {{-- Opciones --}}
        @foreach($detail['options'] as $letter => $text)
          @php
            $isGiven   = strtoupper($letter) === $detail['given'];
            $isCorrect = strtoupper($letter) === $detail['correct'];
            $bg = 'var(--surface-2)';
            $fw = '';
            $extra = 'border:1px solid var(--border);';
            $badgeBg = 'var(--border)';
            $badgeColor = 'var(--ink)';
            if ($isCorrect) { $bg = 'var(--verde-pale)'; $fw = 'fw-semibold'; $extra = 'border:1px solid var(--verde);'; $badgeBg = 'var(--verde-surface)'; $badgeColor = '#fff'; }
            if ($isGiven && !$isCorrect) { $bg = 'rgba(201,59,49,.10)'; $fw = 'fw-semibold'; $extra = 'border:1px solid var(--err);'; $badgeBg = 'var(--err)'; $badgeColor = '#fff'; }
          @endphp
          <div class="d-flex align-items-center gap-2 mb-1 px-3 py-2 rounded"
               style="background:{{ $bg }};{{ $extra }}">
            <span style="width:22px; height:22px; border-radius:999px; font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; background:{{ $badgeBg }}; color:{{ $badgeColor }};">
              {{ $letter }}
            </span>
            <span class="{{ $fw }}" style="font-size:.87rem; color:var(--ink);">{{ $text }}</span>
            @if($isCorrect)
              <i class="bi bi-check2 ms-auto" style="color:var(--verde-ink); font-weight:700;"></i>
            @elseif($isGiven && !$isCorrect)
              <i class="bi bi-x ms-auto" style="color:var(--err-ink); font-weight:700;"></i>
            @endif
          </div>
        @endforeach

        {{-- Tu respuesta --}}
        @if($detail['given'])
          <p class="mt-2 mb-1" style="font-size:.8rem; color:var(--ink-soft);">
            Tu respuesta: <strong>{{ $detail['given'] }}</strong>
            @if(!$right)
              · Respuesta correcta: <strong style="color:var(--verde-ink);">{{ $detail['correct'] }}</strong>
            @endif
          </p>
        @else
          <p class="mt-2 mb-1" style="font-size:.8rem; color:var(--err-ink);">
            Sin respuesta · Respuesta correcta: <strong>{{ $detail['correct'] }}</strong>
          </p>
        @endif

        {{-- Explicación --}}
        @if(!empty($detail['explanation']))
          <div class="mt-2 p-2 rounded"
               style="background:var(--verde-pale); border:1px solid var(--border); font-size:.81rem; color:var(--verde-ink);">
            <i class="bi bi-info-circle-fill me-1"></i>
            {{ $detail['explanation'] }}
          </div>
        @endif
      </div>

    </div>
  </div>
@endforeach

{{-- ══ CTA FINAL ══ --}}
<div class="text-center mt-4 py-4 px-3" style="background:var(--verde-pale); border-radius:18px;">
  @if($passed)
    <i class="bi bi-award-fill fs-2 mb-2" style="color:var(--miel-ink);"></i>
    <h6 class="font-display fw-bold" style="color:var(--ink);">¡Felicitaciones, aprobaste el curso!</h6>
    <p class="mb-3" style="color:var(--ink-soft); font-size:.85rem;">
      Sigue aprendiendo y expandiendo tu impacto ambiental positivo.
    </p>
  @else
    <i class="bi bi-book-fill fs-2 mb-2" style="color:var(--verde-ink);"></i>
    <h6 class="font-display fw-bold" style="color:var(--ink);">¡Sigue practicando!</h6>
    <p class="mb-3" style="color:var(--ink-soft); font-size:.85rem;">
      Revisa los módulos del curso e intenta la evaluación nuevamente.
    </p>
  @endif

  <div class="d-flex justify-content-center gap-2 flex-wrap">
    <a href="{{ route('courses.show', $course->id) }}"
       class="btn fw-semibold px-4"
       style="background:var(--verde-surface); color:#fff; border-radius:12px; border:none;">
      <i class="bi bi-arrow-repeat me-2"></i>Volver al curso
    </a>
    <a href="{{ route('courses.index') }}"
       class="btn fw-semibold px-4" style="border:1px solid var(--border); color:var(--ink); border-radius:12px;">
      <i class="bi bi-collection me-2"></i>Ver más cursos
    </a>
  </div>
</div>

</div>

@endsection
