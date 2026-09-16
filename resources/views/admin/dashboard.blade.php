@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

{{-- ══ STATS ══ --}}
<div class="row g-3 mb-4">

  @php
    $cards = [
      ['label'=>'Estudiantes',   'value'=>$stats['users'],    'icon'=>'bi-people-fill',        'color'=>'#4f46e5','bg'=>'#eef2ff'],
      ['label'=>'Cursos',        'value'=>$stats['courses'],  'icon'=>'bi-book-fill',           'color'=>'var(--verde-ink)','bg'=>'var(--verde-pale)'],
      ['label'=>'Tareas',        'value'=>$stats['tasks'],    'icon'=>'bi-check2-square',       'color'=>'var(--miel-ink)','bg'=>'rgba(244,168,44,.14)'],
      ['label'=>'Evaluaciones',  'value'=>$stats['attempts'], 'icon'=>'bi-clipboard2-check-fill','color'=>'#0ea5e9','bg'=>'#e0f2fe'],
    ];
  @endphp

  @foreach($cards as $card)
  <div class="col-sm-6 col-xl-3">
    <div class="adm-card adm-stat-card p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div style="width:44px;height:44px;background:{{ $card['bg'] }};border-radius:10px;
                    display:flex;align-items:center;justify-content:center;">
          <i class="bi {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:1.25rem;"></i>
        </div>
      </div>
      <div class="font-display fw-bold" style="font-size:2rem;color:var(--ink);line-height:1;">{{ $card['value'] }}</div>
      <div class="mt-1" style="font-size:.82rem;color:var(--ink-soft);">{{ $card['label'] }}</div>
    </div>
  </div>
  @endforeach

</div>

<div class="row g-3">

  {{-- ══ ACCIONES RÁPIDAS ══ --}}
  <div class="col-xl-4">
    <div class="adm-card adm-stat-card h-100 p-4">
      <h6 class="font-display fw-bold mb-3" style="color:var(--ink);">
        <i class="bi bi-lightning-fill me-2" style="color:var(--miel-ink);"></i>Acciones rápidas
      </h6>

      <a href="{{ route('admin.courses.create') }}"
         class="btn w-100 mb-2 d-flex align-items-center gap-2"
         style="background:var(--verde-surface);color:#fff;border-radius:8px;font-size:.88rem;">
        <i class="bi bi-plus-circle-fill"></i> Crear nuevo curso
      </a>
      <a href="{{ route('admin.courses.index') }}"
         class="btn w-100 mb-2 d-flex align-items-center gap-2"
         style="background:var(--surface-2);color:var(--ink);border:1px solid var(--border);border-radius:8px;font-size:.88rem;">
        <i class="bi bi-collection"></i> Gestionar cursos
      </a>
      <a href="{{ route('admin.users.index') }}"
         class="btn w-100 mb-2 d-flex align-items-center gap-2"
         style="background:var(--surface-2);color:var(--ink);border:1px solid var(--border);border-radius:8px;font-size:.88rem;">
        <i class="bi bi-people"></i> Ver estudiantes
      </a>
      <a href="{{ route('courses.index') }}" target="_blank"
         class="btn w-100 d-flex align-items-center gap-2"
         style="background:var(--verde-pale);color:var(--verde-ink);border:1px solid var(--border);border-radius:8px;font-size:.88rem;">
        <i class="bi bi-eye"></i> Ver plataforma como alumno
      </a>
    </div>
  </div>

  {{-- ══ ÚLTIMAS EVALUACIONES ══ --}}
  <div class="col-xl-8">
    <div class="adm-card adm-stat-card h-100 p-4">
      <h6 class="font-display fw-bold mb-3" style="color:var(--ink);">
        <i class="bi bi-clipboard2-check me-2" style="color:var(--verde-ink);"></i>Últimas evaluaciones rendidas
      </h6>

      @if($recentAttempts->isEmpty())
        <p style="font-size:.85rem;color:var(--ink-soft);">Aún no hay evaluaciones rendidas.</p>
      @else
        <div class="table-responsive">
          <table class="table adm-table mb-0">
            <thead>
              <tr>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Puntaje</th>
                <th>Estado</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentAttempts as $att)
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:28px;height:28px;background:var(--verde-pale);flex-shrink:0;">
                      <i class="bi bi-person-fill" style="color:var(--verde-ink);font-size:.75rem;"></i>
                    </div>
                    {{ $att->user->name }}
                  </div>
                </td>
                <td>{{ Str::limit($att->course->title, 30) }}</td>
                <td>
                  <strong>{{ $att->score }}/{{ $att->total }}</strong>
                  <span class="ms-1" style="font-size:.8rem;color:var(--ink-soft);">({{ $att->percentage() }}%)</span>
                </td>
                <td>
                  @if($att->passed())
                    <span class="badge" style="background:var(--verde-pale);color:var(--verde-ink);">Aprobado</span>
                  @else
                    <span class="badge" style="background:rgba(201,59,49,.10);color:var(--err-ink);">No aprobado</span>
                  @endif
                </td>
                <td style="font-size:.8rem;color:var(--ink-soft);">
                  {{ $att->created_at->format('d/m/Y H:i') }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

</div>

@endsection
