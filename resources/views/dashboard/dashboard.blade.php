@extends('layouts.ecolearn')

@section('page-title', 'Inicio')

@section('content')

@php
  $user     = auth()->user();
  $name     = $user->name;
  $first    = explode(' ', trim($name))[0];
  $hour     = now()->hour;
  $greeting = $hour < 12 ? 'Buenos días' : ($hour < 19 ? 'Buenas tardes' : 'Buenas noches');

  // Gamificación derivada de datos reales
  $points   = $stats['attempts_total'] * 120 + $stats['tasks_done'] * 40;
  $level    = max(1, intdiv($points, 400) + 1);
  $inLevel  = $points % 400;
  $pctLevel = (int) round($inLevel / 400 * 100);
  $toNext   = 400 - $inLevel;
  $levelNames = [1=>'Sembrador', 2=>'Cultivador', 3=>'Cuidador del Ciclo', 4=>'Guardián del Ciclo', 5=>'Regenerador'];
  $levelName  = $levelNames[min($level, 5)] ?? 'Regenerador';
  $ringLen    = 339;
  $ringOffset = (int) round($ringLen - ($pctLevel / 100 * $ringLen));

  $moduleIcons = ['bi-laptop', 'bi-recycle', 'bi-droplet-half', 'bi-cpu', 'bi-globe-americas'];
  $pendingTasks = $recentTasks->where('is_done', false)->take(4);
@endphp

<div style="max-width:1180px; margin:0 auto; display:flex; flex-direction:column; gap:20px; animation:fadeUp .38s ease;">

  {{-- ══ FILA HERO + NIVEL ══ --}}
  <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(360px,1fr)); gap:20px;">

    {{-- HERO --}}
    <div style="background:var(--verde-surface); border-radius:22px; padding:28px; color:#fff; position:relative; overflow:hidden; display:flex; flex-direction:column; justify-content:space-between; min-height:230px;">
      <div style="position:absolute; right:-70px; top:-70px; width:240px; height:240px; border-radius:50%; background:rgba(159,211,86,.16);"></div>
      <div style="position:relative;">
        <div style="font-size:12.5px; letter-spacing:1.4px; text-transform:uppercase; opacity:.75;">EcoLearn UDEC · Educación ambiental</div>
        <h1 class="font-display" style="font-weight:800; font-size:34px; line-height:1.08; letter-spacing:-1.1px; margin:12px 0 10px;">{{ $greeting }},<br>{{ $first }} <i class="bi bi-emoji-smile-fill" style="color:var(--brote); font-size:.8em;"></i></h1>
        <p style="margin:0; font-size:14.5px; line-height:1.5; max-width:44ch; color:#fff;">
          @if($stats['courses_total'] > 0)
            Tienes <strong style="color:var(--brote);">{{ $stats['courses_total'] }} módulos</strong> disponibles y <strong style="color:var(--brote);">{{ $stats['tasks_pending'] }} tareas</strong> por completar.
          @else
            Aún no hay módulos publicados. Vuelve pronto para empezar tu ruta.
          @endif
        </p>
      </div>
      <div style="position:relative; display:flex; gap:10px; margin-top:22px; flex-wrap:wrap;">
        <a href="{{ $recentCourses->first() ? route('courses.show', $recentCourses->first()->id) : route('courses.index') }}"
           style="background:var(--brote); color:#12301C; border:none; border-radius:12px; padding:12px 18px; font-size:13.5px; font-weight:700; display:flex; align-items:center; gap:8px;">
          <i class="bi bi-play-fill" style="font-size:15px;"></i> Continuar aprendiendo
        </a>
        <a href="{{ route('progress.index') }}"
           style="background:rgba(255,255,255,.14); color:#fff; border:1px solid rgba(255,255,255,.3); border-radius:12px; padding:12px 18px; font-size:13.5px; font-weight:600;">
          Ver mi progreso
        </a>
      </div>
    </div>

    {{-- NIVEL / PUNTOS --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:24px;">
      <div style="display:flex; align-items:center; gap:22px; flex-wrap:wrap;">
        <div style="position:relative; width:118px; height:118px; flex-shrink:0;">
          <svg width="118" height="118" viewBox="0 0 120 120">
            <circle cx="60" cy="60" r="54" fill="none" stroke="var(--verde-pale)" stroke-width="11"></circle>
            <circle cx="60" cy="60" r="54" fill="none" stroke="var(--miel)" stroke-width="11" stroke-linecap="round"
                    stroke-dasharray="{{ $ringLen }}" stroke-dashoffset="{{ $ringOffset }}"
                    transform="rotate(-90 60 60)" style="animation:drawRing 1.1s ease-out;"></circle>
          </svg>
          <div style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <div class="font-display" style="font-weight:800; font-size:24px; letter-spacing:-1px; line-height:1;">{{ number_format($points, 0, ',', '.') }}</div>
            <div style="font-size:10.5px; letter-spacing:1.2px; text-transform:uppercase; color:var(--ink-soft); margin-top:3px;">puntos</div>
          </div>
        </div>
        <div style="min-width:0;">
          <div style="display:inline-flex; align-items:center; gap:7px; background:var(--verde-pale); color:var(--verde-ink); padding:5px 11px; border-radius:999px; font-size:11.5px; font-weight:800; letter-spacing:.3px;">
            <i class="bi bi-shield-fill-check"></i> NIVEL {{ $level }}
          </div>
          <div class="font-display" style="font-weight:700; font-size:20px; letter-spacing:-.5px; margin:9px 0 6px;">{{ $levelName }}</div>
          <div style="font-size:12.5px; color:var(--ink-soft); line-height:1.45;">{{ number_format($toNext, 0, ',', '.') }} pts para el siguiente nivel</div>
          <div style="height:7px; border-radius:99px; background:var(--verde-pale); margin-top:11px; overflow:hidden;">
            <div style="width:{{ $pctLevel }}%; height:100%; border-radius:99px; background:var(--miel);"></div>
          </div>
        </div>
      </div>

      <div style="border-top:1px solid var(--border); margin-top:20px; padding-top:16px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
          <span style="font-size:12px; font-weight:700; letter-spacing:.4px; text-transform:uppercase; color:var(--ink-soft);">Insignias</span>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(84px,1fr)); gap:10px;">
          @php
            $badges = [
              ['bi-recycle', 'Primeras 3R', $stats['attempts_total'] >= 1],
              ['bi-lightning-charge-fill', 'Constante', $stats['tasks_done'] >= 3],
              ['bi-award-fill', 'Buen ritmo', $stats['attempts_total'] >= 3],
              ['bi-trophy-fill', 'Nivel 5', $level >= 5],
            ];
          @endphp
          @foreach($badges as [$icon, $label, $earned])
            <div style="background:var(--surface-2); border:1px {{ $earned ? 'solid' : 'dashed' }} var(--border); border-radius:14px; padding:11px 8px; text-align:center; {{ $earned ? '' : 'opacity:.5;' }}">
              <i class="bi {{ $earned ? $icon : 'bi-lock-fill' }}" style="font-size:20px; color:{{ $earned ? 'var(--verde-ink)' : 'var(--ink-soft)' }};"></i>
              <div style="font-size:10.5px; font-weight:700; margin-top:6px; line-height:1.25; {{ $earned ? '' : 'color:var(--ink-soft);' }}">{{ $label }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- ══ ACCESOS RÁPIDOS ══ --}}
  <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px;">
    @php
      $quick = [
        ['bi-collection-fill', 'Módulos educativos', $stats['courses_total'].' módulos disponibles', route('courses.index'), 'var(--verde)'],
        ['bi-patch-question-fill', 'Evaluaciones', $stats['attempts_total'].' evaluaciones rendidas', route('courses.index'), 'var(--miel)'],
        ['bi-check2-square', 'Tareas', $stats['tasks_pending'].' pendientes · '.$stats['tasks_done'].' hechas', route('tasks.index'), 'var(--brote)'],
      ];
    @endphp
    @foreach($quick as [$icon, $title, $sub, $url, $accent])
      <a href="{{ $url }}" style="background:var(--surface); border:1px solid var(--border); border-radius:18px; padding:20px; display:block; color:var(--ink);">
        <div style="width:42px; height:42px; border-radius:13px; background:var(--verde-pale); color:var(--verde-ink); display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
          <i class="bi {{ $icon }}" style="font-size:18px;"></i>
        </div>
        <div class="font-display" style="font-weight:700; font-size:17px; letter-spacing:-.4px;">{{ $title }}</div>
        <div style="font-size:13px; color:var(--ink-soft); margin-top:5px;">{{ $sub }}</div>
        <div style="display:flex; align-items:center; gap:6px; margin-top:14px; font-size:12.5px; font-weight:700; color:var(--verde-ink);">Explorar <i class="bi bi-arrow-right"></i></div>
      </a>
    @endforeach
  </div>

  {{-- ══ DOS COLUMNAS ══ --}}
  <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(330px,1fr)); gap:20px; align-items:start;">

    {{-- CONTINÚA DONDE QUEDASTE --}}
    <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:22px;">
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div class="font-display" style="font-weight:700; font-size:17px; letter-spacing:-.4px;">Continúa donde quedaste</div>
        <a href="{{ route('courses.index') }}" style="font-size:12.5px; font-weight:700; color:var(--verde-ink);">Todos los módulos →</a>
      </div>

      <div style="display:flex; flex-direction:column; gap:10px;">
        @forelse($recentCourses as $course)
          <a href="{{ route('courses.show', $course->id) }}"
             style="display:flex; align-items:center; gap:14px; padding:14px; border-radius:15px; background:var(--surface-2); border:1px solid var(--border); color:var(--ink);">
            <div style="width:44px; height:44px; flex-shrink:0; border-radius:14px; background:var(--verde-surface); color:#fff; display:flex; align-items:center; justify-content:center;">
              <i class="bi {{ $moduleIcons[$loop->index % count($moduleIcons)] }}" style="font-size:1.1rem;"></i>
            </div>
            <div style="flex:1; min-width:0;">
              <div style="font-size:14px; font-weight:700; line-height:1.3; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $course->title }}</div>
              <div style="font-size:12px; color:var(--ink-soft); margin-top:3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Str::limit($course->description, 64) }}</div>
            </div>
            <span style="flex-shrink:0; font-size:11.5px; font-weight:800; color:var(--miel-ink); white-space:nowrap;"><i class="bi bi-star-fill"></i> +120</span>
          </a>
        @empty
          <p style="font-size:.9rem; color:var(--ink-soft); margin:0;">No hay módulos disponibles aún.</p>
        @endforelse
      </div>

      @if($lastAttempt)
        <div style="margin-top:16px; display:flex; align-items:center; gap:14px; padding:16px; border-radius:16px; background:rgba(30,142,90,.08); border:1px solid rgba(30,142,90,.28);">
          <i class="bi bi-patch-check-fill" style="font-size:24px; color:var(--ok-ink); flex-shrink:0;"></i>
          <div style="flex:1; min-width:0;">
            <div style="font-size:13.5px; font-weight:700;">Última evaluación: {{ optional($lastAttempt->course)->title ?? 'Módulo' }}</div>
            <div style="font-size:12px; color:var(--ink-soft); margin-top:2px;">Resultado {{ $lastAttempt->percentage() }}% · {{ $lastAttempt->created_at->diffForHumans() }}</div>
          </div>
          <a href="{{ route('courses.result', ['courseId' => $lastAttempt->course_id, 'attemptId' => $lastAttempt->id]) }}"
             style="flex-shrink:0; background:var(--verde-surface); color:#fff; border:none; border-radius:11px; padding:10px 15px; font-size:12.5px; font-weight:700;">Ver detalle</a>
        </div>
      @endif
    </div>

    {{-- COLUMNA DERECHA --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

      {{-- IMPACTO --}}
      <div style="background:var(--arcilla); border-radius:20px; padding:22px; color:#fff; position:relative; overflow:hidden;">
        <div style="position:absolute; right:-40px; bottom:-50px; width:150px; height:150px; border-radius:50%; background:rgba(255,255,255,.12);"></div>
        <div style="position:relative;">
          <div style="display:inline-flex; align-items:center; gap:7px; background:rgba(255,255,255,.18); padding:5px 11px; border-radius:999px; font-size:11px; font-weight:800; letter-spacing:.6px; text-transform:uppercase;"><i class="bi bi-recycle"></i> Tu actividad</div>
          <div class="font-display" style="font-weight:800; font-size:30px; letter-spacing:-1px; margin:14px 0 3px;">{{ $stats['tasks_done'] }} tareas</div>
          <div style="font-size:13px; color:#fff;">completadas este semestre</div>
          <div style="display:flex; gap:8px; margin:16px 0 18px;">
            <div style="flex:1; background:rgba(255,255,255,.16); border-radius:11px; padding:9px 10px;">
              <div style="font-size:15px; font-weight:800;">{{ $stats['attempts_total'] }}</div>
              <div style="font-size:10.5px;">Evaluaciones</div>
            </div>
            <div style="flex:1; background:rgba(255,255,255,.16); border-radius:11px; padding:9px 10px;">
              <div style="font-size:15px; font-weight:800;">{{ $stats['tasks_pending'] }}</div>
              <div style="font-size:10.5px;">Pendientes</div>
            </div>
            <div style="flex:1; background:rgba(255,255,255,.16); border-radius:11px; padding:9px 10px;">
              <div style="font-size:15px; font-weight:800;">{{ $stats['courses_total'] }}</div>
              <div style="font-size:10.5px;">Módulos</div>
            </div>
          </div>
          <a href="{{ route('tasks.create') }}" style="display:flex; width:100%; background:#fff; color:var(--arcilla); border:none; border-radius:12px; padding:12px; font-size:13.5px; font-weight:800; align-items:center; justify-content:center; gap:8px;">
            <i class="bi bi-plus-circle-fill"></i> Nueva tarea
          </a>
        </div>
      </div>

      {{-- TAREAS PENDIENTES --}}
      <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:22px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
          <div class="font-display" style="font-weight:700; font-size:16px; letter-spacing:-.3px;">Tareas pendientes</div>
          <a href="{{ route('tasks.index') }}" style="font-size:12px; font-weight:700; color:var(--verde-ink);">Ver todas →</a>
        </div>
        <div style="display:flex; flex-direction:column; gap:11px;">
          @forelse($pendingTasks as $task)
            <a href="{{ route('tasks.edit', $task->id) }}" style="display:flex; align-items:center; gap:11px; color:var(--ink);">
              <span style="width:20px; height:20px; border-radius:7px; border:2px solid var(--border); flex-shrink:0;"></span>
              <span style="flex:1; font-size:13px; font-weight:600; line-height:1.35; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $task->title }}</span>
              @if($task->due_date ?? false)
                <span style="font-size:11px; font-weight:700; color:var(--warn-ink); flex-shrink:0;">{{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }}</span>
              @endif
            </a>
          @empty
            <p style="font-size:.85rem; color:var(--ink-soft); margin:0;">No tienes tareas pendientes. <i class="bi bi-stars" style="color:var(--verde-ink);"></i></p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
