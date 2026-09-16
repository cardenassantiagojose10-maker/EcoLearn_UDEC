@extends('layouts.ecolearn')

@section('page-title', 'Cursos')

@section('content')

<div style="max-width:1180px; margin:0 auto; animation:fadeUp .38s ease;">

  {{-- ── HEADER ── --}}
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h4 class="font-display" style="font-weight:800; letter-spacing:-.5px; margin-bottom:4px;">Cursos disponibles</h4>
      <p style="color:var(--ink-soft); font-size:.88rem; margin-bottom:0;">
        Explora el catálogo de formación en sostenibilidad y educación ambiental
      </p>
    </div>
    <span style="background:var(--verde-pale); color:var(--verde-ink); font-size:.82rem; font-weight:700; padding:8px 16px; border-radius:999px;">
      <i class="bi bi-collection-fill me-1"></i>{{ $courses->count() }} curso{{ $courses->count() !== 1 ? 's' : '' }}
    </span>
  </div>

  {{-- ── GRID DE CURSOS ── --}}
  @if($courses->isEmpty())
    <div class="text-center py-5">
      <i class="bi bi-book-half" style="font-size:3rem; color:var(--ink-soft);"></i>
      <p style="color:var(--ink-soft); margin-top:1rem;">Aún no hay cursos disponibles.</p>
    </div>
  @else
    <div class="row g-4">
      @foreach($courses as $course)

        {{-- Ícono según índice --}}
        @php
          $icons  = ['bi-laptop','bi-recycle','bi-droplet-half','bi-sun','bi-tree'];
          $accents = ['var(--verde)', 'var(--verde-deep)', 'var(--verde-surface)', 'var(--arcilla)', 'var(--verde)'];
          $idx    = ($loop->index) % count($icons);
          $moduleCount = count($course->content['modules'] ?? []);
          $questionCount = count($course->content['evaluation']['questions'] ?? []);
        @endphp

        <div class="col-md-6 col-xl-4">
          <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; height:100%; display:flex; flex-direction:column; overflow:hidden; transition:transform .2s ease, box-shadow .2s ease;">

            {{-- Banner superior --}}
            <div style="height:130px; display:flex; align-items:center; justify-content:center; background:{{ $accents[$idx] }};">
              <i class="bi {{ $icons[$idx] }}" style="font-size:3rem; opacity:.9; color:#fff;"></i>
            </div>

            <div class="d-flex flex-column p-4" style="flex:1;">

              {{-- Badge categoría --}}
              <span class="align-self-start mb-2" style="background:var(--verde-pale); color:var(--verde-ink); font-size:.72rem; font-weight:700; padding:5px 11px; border-radius:999px;">
                <i class="bi bi-leaf-fill me-1"></i>Educación Ambiental
              </span>

              <h5 class="font-display" style="font-weight:700; font-size:1rem; line-height:1.4; letter-spacing:-.3px; margin-bottom:8px;">
                {{ $course->title }}
              </h5>

              <p style="color:var(--ink-soft); font-size:.85rem; line-height:1.6; flex-grow:1; margin-bottom:14px;">
                {{ Str::limit($course->description, 130) }}
              </p>

              {{-- Meta info --}}
              <div class="d-flex gap-3 mb-3">
                <span class="d-flex align-items-center gap-1" style="font-size:.78rem; color:var(--ink-soft);">
                  <i class="bi bi-grid-3x3-gap-fill" style="color:var(--verde-ink);"></i>
                  {{ $moduleCount }} módulo{{ $moduleCount !== 1 ? 's' : '' }}
                </span>
                <span class="d-flex align-items-center gap-1" style="font-size:.78rem; color:var(--ink-soft);">
                  <i class="bi bi-patch-question-fill" style="color:var(--miel-ink);"></i>
                  {{ $questionCount }} pregunta{{ $questionCount !== 1 ? 's' : '' }}
                </span>
              </div>

              {{-- CTA --}}
              <a href="{{ route('courses.show', $course->id) }}"
                 class="w-100 fw-semibold text-center"
                 style="background:var(--verde-surface); color:#fff; border-radius:12px; font-size:.88rem; padding:11px; display:block;">
                <i class="bi bi-play-circle-fill me-2"></i>Ver curso
              </a>

            </div>

          </div>
        </div>

      @endforeach
    </div>
  @endif

</div>

@endsection
