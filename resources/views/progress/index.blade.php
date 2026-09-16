@extends('layouts.ecolearn')

@section('page-title', 'Mi Progreso')

@section('content')

{{-- ══ HEADER ══ --}}
<div class="rounded-4 p-4 mb-4 d-flex align-items-center gap-4 flex-wrap"
     style="background:var(--verde-surface); color:#fff; position:relative; overflow:hidden;">
  <div style="position:absolute; right:-60px; top:-60px; width:200px; height:200px; border-radius:50%; background:rgba(159,211,86,.16);"></div>
  <div class="d-flex align-items-center justify-content-center flex-shrink-0"
       style="width:60px; height:60px; border-radius:50%; background:rgba(255,255,255,.18); font-size:1.5rem; position:relative;">
    <i class="bi bi-bar-chart-fill"></i>
  </div>
  <div class="flex-grow-1" style="position:relative;">
    <h4 class="font-display fw-bold mb-1">Mi Progreso</h4>
    <p class="mb-0" style="opacity:.9; font-size:.9rem;">
      Sigue tu avance en evaluaciones y tareas
    </p>
  </div>
  @if($attempts->count())
  <div class="text-center px-4 py-2 rounded-3" style="background:rgba(255,255,255,.16); position:relative;">
    <div class="font-display fw-bold" style="font-size:1.6rem;">{{ $avgScore }}%</div>
    <div style="font-size:.72rem; opacity:.9;">Promedio general</div>
  </div>
  @endif
</div>

{{-- ══ STATS ══ --}}
<div class="row g-3 mb-4">
  @php
    $cards = [
      ['label'=>'Cursos disponibles',    'value'=>$totalCourses,     'icon'=>'bi-collection-fill',   'color'=>'var(--verde-ink)', 'bg'=>'var(--verde-pale)'],
      ['label'=>'Cursos evaluados',      'value'=>$coursesEvaluated, 'icon'=>'bi-patch-check-fill',  'color'=>'#4f46e5',          'bg'=>'rgba(79,70,229,.12)'],
      ['label'=>'Evaluaciones aprobadas','value'=>$passed,           'icon'=>'bi-trophy-fill',       'color'=>'var(--miel-ink)',  'bg'=>'rgba(244,168,44,.14)'],
      ['label'=>'Tareas completadas',    'value'=>$tasksDone,        'icon'=>'bi-check-circle-fill', 'color'=>'#0ea5e9',          'bg'=>'rgba(14,165,233,.12)'],
    ];
  @endphp
  @foreach($cards as $c)
  <div class="col-6 col-xl-3">
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:16px;">
      <div class="d-flex align-items-center gap-3">
        <div class="d-flex align-items-center justify-content-center flex-shrink-0"
             style="width:46px; height:46px; border-radius:13px; background:{{ $c['bg'] }};">
          <i class="bi {{ $c['icon'] }}" style="color:{{ $c['color'] }}; font-size:1.25rem;"></i>
        </div>
        <div>
          <div class="font-display fw-bold" style="font-size:1.5rem; line-height:1;">{{ $c['value'] }}</div>
          <div style="font-size:11.5px; color:var(--ink-soft); margin-top:3px;">{{ $c['label'] }}</div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

<div class="row g-3">

  {{-- ══ HISTORIAL DE EVALUACIONES ══ --}}
  <div class="col-lg-8">
    <div class="h-100" style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;">
      <h6 class="font-display fw-bold mb-4">
        <i class="bi bi-clipboard2-data-fill me-2" style="color:var(--verde-ink);"></i>Historial de evaluaciones
      </h6>

      @forelse($attempts as $attempt)
      @php $pct = $attempt->percentage(); $ok = $attempt->passed(); @endphp
      <div class="p-3 rounded-3 mb-3" style="background:var(--surface-2); border:1px solid var(--border);">
        <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
          <div>
            <div style="font-size:14px; font-weight:600;">
              {{ $attempt->course->title ?? 'Curso eliminado' }}
            </div>
            <div style="font-size:11.5px; color:var(--ink-soft);">
              {{ $attempt->created_at->format('d M Y, H:i') }}
            </div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <span style="padding:5px 13px; border-radius:999px; font-size:12px; font-weight:700;
                         background:{{ $ok ? 'var(--verde-pale)' : 'rgba(201,59,49,.10)' }};
                         color:{{ $ok ? 'var(--verde-ink)' : 'var(--err-ink)' }};">
              <i class="bi {{ $ok ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
              {{ $ok ? 'Aprobado' : 'Reprobado' }}
            </span>
            <span class="font-display fw-bold" style="font-size:1.1rem; color:{{ $ok ? 'var(--verde-ink)' : 'var(--err-ink)' }};">
              {{ $pct }}%
            </span>
          </div>
        </div>
        {{-- Barra de progreso --}}
        <div style="height:8px; border-radius:10px; background:var(--border); overflow:hidden;">
          <div style="width:{{ $pct }}%; height:100%; border-radius:10px;
                      background:{{ $pct >= 80 ? 'var(--verde)' : ($pct >= 60 ? 'var(--miel)' : 'var(--err)') }};
                      transition:width .6s ease;">
          </div>
        </div>
        <div class="d-flex justify-content-between mt-1">
          <span style="font-size:11.5px; color:var(--ink-soft);">{{ $attempt->score }} / {{ $attempt->total }} correctas</span>
          <a href="{{ route('courses.result', [$attempt->course_id, $attempt->id]) }}"
             style="font-size:11.5px; color:var(--verde-ink); font-weight:700;">
            Ver detalle <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
      @empty
      <div class="text-center py-5">
        <i class="bi bi-clipboard2-x" style="font-size:2.5rem; color:var(--ink-soft);"></i>
        <p style="font-size:14px; color:var(--ink-soft); margin:12px 0 4px;">Aún no has rendido ninguna evaluación.</p>
        <a href="{{ route('courses.index') }}"
           style="display:inline-block; margin-top:8px; background:var(--verde-surface); color:#fff; border-radius:10px; padding:8px 16px; font-size:12.5px; font-weight:700;">
          Explorar cursos
        </a>
      </div>
      @endforelse
    </div>
  </div>

  {{-- ══ RESUMEN LATERAL ══ --}}
  <div class="col-lg-4">

    {{-- Progreso de cursos --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:22px; margin-bottom:16px;">
      <h6 class="font-display fw-bold mb-3">
        <i class="bi bi-collection me-2" style="color:var(--verde-ink);"></i>Cursos
      </h6>
      <div class="mb-2 d-flex justify-content-between" style="font-size:12.5px;">
        <span style="color:var(--ink-soft);">Evaluados</span>
        <span style="font-weight:700;">{{ $coursesEvaluated }} / {{ $totalCourses }}</span>
      </div>
      @php $coursesPct = $totalCourses > 0 ? (int)round($coursesEvaluated / $totalCourses * 100) : 0; @endphp
      <div class="mb-3" style="height:10px; border-radius:10px; background:var(--verde-pale); overflow:hidden;">
        <div style="width:{{ $coursesPct }}%; height:100%; border-radius:10px; background:var(--verde);"></div>
      </div>
      <div class="text-center" style="font-size:12px; color:var(--verde-ink); font-weight:700;">{{ $coursesPct }}% completado</div>
    </div>

    {{-- Resumen tareas --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:22px; margin-bottom:16px;">
      <h6 class="font-display fw-bold mb-3">
        <i class="bi bi-check2-square me-2" style="color:var(--miel-ink);"></i>Tareas
      </h6>
      @php $total = $tasksDone + $tasksPending; $taskPct = $total > 0 ? (int)round($tasksDone / $total * 100) : 0; @endphp
      <div class="mb-2 d-flex justify-content-between" style="font-size:12.5px;">
        <span style="color:var(--ink-soft);">Completadas</span>
        <span style="font-weight:700;">{{ $tasksDone }} / {{ $total }}</span>
      </div>
      <div class="mb-3" style="height:10px; border-radius:10px; background:rgba(244,168,44,.16); overflow:hidden;">
        <div style="width:{{ $taskPct }}%; height:100%; border-radius:10px; background:var(--miel);"></div>
      </div>
      <div class="d-flex gap-2 mt-2">
        <div class="flex-fill text-center rounded-3 p-2" style="background:rgba(244,168,44,.14);">
          <div class="font-display fw-bold" style="color:var(--miel-ink); font-size:1.1rem;">{{ $tasksPending }}</div>
          <div style="font-size:11px; color:var(--miel-ink);">Pendientes</div>
        </div>
        <div class="flex-fill text-center rounded-3 p-2" style="background:var(--verde-pale);">
          <div class="font-display fw-bold" style="color:var(--verde-ink); font-size:1.1rem;">{{ $tasksDone }}</div>
          <div style="font-size:11px; color:var(--verde-ink);">Completadas</div>
        </div>
      </div>
    </div>

    {{-- Accesos rápidos --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:22px;">
      <h6 class="font-display fw-bold mb-3">
        <i class="bi bi-lightning-fill me-2" style="color:var(--miel-ink);"></i>Accesos rápidos
      </h6>
      <div class="d-flex flex-column gap-2">
        <a href="{{ route('courses.index') }}"
           class="d-flex align-items-center gap-3 p-3 rounded-3"
           style="background:var(--verde-pale);">
          <i class="bi bi-book-fill" style="color:var(--verde-ink); font-size:1.1rem;"></i>
          <span style="font-size:12.5px; color:var(--verde-ink); font-weight:700;">Explorar cursos</span>
        </a>
        <a href="{{ route('tasks.index') }}"
           class="d-flex align-items-center gap-3 p-3 rounded-3"
           style="background:rgba(244,168,44,.14);">
          <i class="bi bi-check2-square" style="color:var(--miel-ink); font-size:1.1rem;"></i>
          <span style="font-size:12.5px; color:var(--miel-ink); font-weight:700;">Mis tareas</span>
        </a>
      </div>
    </div>

  </div>
</div>

@endsection
