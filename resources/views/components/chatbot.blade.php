{{-- ═══════════ ECOBOT — Asistente Conversacional Bilingüe ═══════════ --}}

<style>
  /* ── Toggle Button ── */
  #ecobot-toggle {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: linear-gradient(135deg, #006837, #00924e);
    border: none;
    box-shadow: 0 4px 20px rgba(0,104,55,.45);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1050;
    transition: transform .25s, box-shadow .25s;
  }
  #ecobot-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 28px rgba(0,104,55,.55);
  }
  #ecobot-toggle i { color:#fff; font-size:1.5rem; transition: opacity .2s; }
  #ecobot-toggle .ico-open  { display:block; }
  #ecobot-toggle .ico-close { display:none;  }
  #ecobot-toggle.is-open .ico-open  { display:none;  }
  #ecobot-toggle.is-open .ico-close { display:block; }

  /* ── Notification dot ── */
  #ecobot-dot {
    position: absolute;
    top: 2px; right: 2px;
    width: 14px; height: 14px;
    background: #f0a500;
    border: 2px solid #fff;
    border-radius: 50%;
    animation: pulse-dot 2s infinite;
  }
  @keyframes pulse-dot {
    0%,100% { transform: scale(1); }
    50%      { transform: scale(1.3); }
  }

  /* ── Chat Window ── */
  #ecobot-window {
    position: fixed;
    bottom: 100px;
    right: 28px;
    width: 360px;
    max-width: calc(100vw - 40px);
    height: 520px;
    max-height: calc(100vh - 140px);
    border-radius: 20px;
    box-shadow: 0 12px 48px rgba(0,0,0,.22);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    z-index: 1049;
    transform: scale(.85) translateY(24px);
    opacity: 0;
    pointer-events: none;
    transform-origin: bottom right;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1), opacity .25s ease;
    background: #fff;
  }
  #ecobot-window.is-open {
    transform: scale(1) translateY(0);
    opacity: 1;
    pointer-events: all;
  }

  /* ── Header ── */
  #ecobot-header {
    background: linear-gradient(135deg, #006837, #00924e);
    padding: .9rem 1rem;
    display: flex;
    align-items: center;
    gap: .7rem;
    flex-shrink: 0;
  }
  #ecobot-header .bot-avatar {
    width: 38px; height: 38px;
    background: rgba(255,255,255,.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  #ecobot-header .bot-avatar i { color:#fff; font-size:1.1rem; }
  #ecobot-header .bot-info { flex:1; }
  #ecobot-header .bot-name { color:#fff; font-weight:700; font-size:.95rem; margin:0; line-height:1.2; }
  #ecobot-header .bot-status { color:rgba(255,255,255,.75); font-size:.72rem; }
  #ecobot-lang-btn {
    background: rgba(255,255,255,.18);
    border: 1px solid rgba(255,255,255,.35);
    color: #fff;
    border-radius: 20px;
    padding: .18rem .65rem;
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .4px;
    cursor: pointer;
    transition: background .2s;
  }
  #ecobot-lang-btn:hover { background: rgba(255,255,255,.3); }

  /* ── Philosophy Banner ── */
  #ecobot-banner {
    background: linear-gradient(90deg, #fff8e6, #fffdf5);
    border-bottom: 1px solid #f0a500;
    padding: .55rem .9rem;
    font-size: .7rem;
    color: #7a5c00;
    font-style: italic;
    line-height: 1.4;
    flex-shrink: 0;
  }

  /* ── Messages ── */
  #ecobot-messages {
    flex: 1;
    overflow-y: auto;
    padding: .9rem;
    display: flex;
    flex-direction: column;
    gap: .65rem;
    scroll-behavior: smooth;
    background: #f8faf9;
  }
  #ecobot-messages::-webkit-scrollbar { width: 4px; }
  #ecobot-messages::-webkit-scrollbar-track { background: transparent; }
  #ecobot-messages::-webkit-scrollbar-thumb { background: #c8e6d0; border-radius: 4px; }

  .ecobot-msg {
    display: flex;
    align-items: flex-end;
    gap: .45rem;
    animation: msg-in .25s ease;
  }
  @keyframes msg-in {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
  }

  .ecobot-msg.bot { align-self: flex-start; }
  .ecobot-msg.user { align-self: flex-end; flex-direction: row-reverse; }

  .ecobot-msg .avatar {
    width: 28px; height: 28px;
    background: linear-gradient(135deg,#006837,#00924e);
    border-radius: 50%;
    display: flex; align-items:center; justify-content:center;
    flex-shrink: 0;
  }
  .ecobot-msg .avatar i { color:#fff; font-size:.75rem; }

  .ecobot-msg .bubble {
    max-width: 82%;
    padding: .55rem .8rem;
    border-radius: 16px;
    font-size: .82rem;
    line-height: 1.55;
    white-space: pre-wrap;
    word-break: break-word;
  }
  .ecobot-msg.bot  .bubble {
    background: #fff;
    border: 1px solid #e2ede7;
    border-bottom-left-radius: 4px;
    color: #2d3748;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
  }
  .ecobot-msg.user .bubble {
    background: linear-gradient(135deg,#006837,#00924e);
    color: #fff;
    border-bottom-right-radius: 4px;
  }
  .ecobot-msg.bot  .bubble strong { color: #005a2e; }
  .ecobot-msg.bot  .bubble em     { color: #4a6741; font-style:italic; }

  /* ── Typing indicator ── */
  #ecobot-typing {
    display: none;
    align-items: flex-end;
    gap: .45rem;
    animation: msg-in .2s ease;
  }
  #ecobot-typing .avatar {
    width: 28px; height: 28px;
    background: linear-gradient(135deg,#006837,#00924e);
    border-radius: 50%;
    display: flex; align-items:center; justify-content:center;
    flex-shrink: 0;
  }
  #ecobot-typing .avatar i { color:#fff; font-size:.75rem; }
  #ecobot-typing .dots {
    background:#fff; border:1px solid #e2ede7;
    border-radius:16px; border-bottom-left-radius:4px;
    padding: .55rem .8rem;
    display:flex; gap:4px; align-items:center;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
  }
  #ecobot-typing .dots span {
    width:7px; height:7px;
    background:#00924e; border-radius:50%;
    animation: bounce-dot .9s infinite;
  }
  #ecobot-typing .dots span:nth-child(2) { animation-delay:.15s; }
  #ecobot-typing .dots span:nth-child(3) { animation-delay:.3s;  }
  @keyframes bounce-dot {
    0%,80%,100% { transform: translateY(0); }
    40%          { transform: translateY(-6px); }
  }

  /* ── Input area ── */
  #ecobot-form {
    padding: .7rem .9rem;
    background: #fff;
    border-top: 1px solid #e8f0eb;
    display: flex;
    gap: .5rem;
    align-items: center;
    flex-shrink: 0;
  }
  #ecobot-input {
    flex: 1;
    border: 1px solid #d1e7d9;
    border-radius: 24px;
    padding: .45rem .9rem;
    font-size: .82rem;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    background: #f8faf9;
    color: #2d3748;
  }
  #ecobot-input:focus {
    border-color: #006837;
    box-shadow: 0 0 0 3px rgba(0,104,55,.12);
    background: #fff;
  }
  #ecobot-input::placeholder { color: #9cad9e; }
  #ecobot-send {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg,#006837,#00924e);
    border: none;
    display: flex; align-items:center; justify-content:center;
    cursor: pointer;
    flex-shrink: 0;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 2px 8px rgba(0,104,55,.3);
  }
  #ecobot-send:hover  { transform: scale(1.1); box-shadow: 0 4px 14px rgba(0,104,55,.4); }
  #ecobot-send:active { transform: scale(.95); }
  #ecobot-send i { color:#fff; font-size:.95rem; }
  #ecobot-send:disabled { opacity:.5; cursor:not-allowed; transform:none; }
</style>

{{-- ── Toggle Button ── --}}
<button id="ecobot-toggle" onclick="ecobotToggle()" title="Abrir EcoBot">
  <span id="ecobot-dot"></span>
  <i class="bi bi-chat-dots-fill ico-open"></i>
  <i class="bi bi-x-lg ico-close"></i>
</button>

{{-- ── Chat Window ── --}}
<div id="ecobot-window" role="dialog" aria-label="EcoBot Chat">

  {{-- Header --}}
  <div id="ecobot-header">
    <div class="bot-avatar"><i class="bi bi-robot"></i></div>
    <div class="bot-info">
      <p class="bot-name">🌱 EcoBot</p>
      <span class="bot-status" id="ecobot-status-text">En línea · EcoLearn UDEC</span>
    </div>
    <button id="ecobot-lang-btn" onclick="ecobotSwitchLang()" title="Cambiar idioma / Switch language">
      ES
    </button>
  </div>

  {{-- Philosophy Banner --}}
  <div id="ecobot-banner">
    "Soy LIBRE, AUTÓNOMO Y RESPONSABLE a través del diálogo y la construcción, como ideal regulativo."
  </div>

  {{-- Messages --}}
  <div id="ecobot-messages">
    {{-- Initial greeting injected by JS --}}
    <div id="ecobot-typing">
      <div class="avatar"><i class="bi bi-robot"></i></div>
      <div class="dots">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>

  {{-- Input --}}
  <form id="ecobot-form" onsubmit="ecobotSend(event)">
    <input
      id="ecobot-input"
      type="text"
      maxlength="300"
      placeholder="Escribe tu mensaje…"
      autocomplete="off"
      aria-label="Mensaje para EcoBot"
    >
    <button id="ecobot-send" type="submit" title="Enviar">
      <i class="bi bi-send-fill"></i>
    </button>
  </form>

</div>

<script>
(function () {
  const ROUTE  = '{{ route("chatbot.respond") }}';
  const CSRF   = '{{ csrf_token() }}';

  let lang     = 'es';
  let firstOpen = true;

  const $toggle   = document.getElementById('ecobot-toggle');
  const $window   = document.getElementById('ecobot-window');
  const $msgs     = document.getElementById('ecobot-messages');
  const $input    = document.getElementById('ecobot-input');
  const $send     = document.getElementById('ecobot-send');
  const $typing   = document.getElementById('ecobot-typing');
  const $langBtn  = document.getElementById('ecobot-lang-btn');
  const $banner   = document.getElementById('ecobot-banner');
  const $status   = document.getElementById('ecobot-status-text');
  const $dot      = document.getElementById('ecobot-dot');

  const banners = {
    es: '"Soy LIBRE, AUTÓNOMO Y RESPONSABLE a través del diálogo y la construcción, como ideal regulativo."',
    en: '"I am FREE, AUTONOMOUS AND RESPONSIBLE through dialogue and construction, as a regulative ideal."',
  };

  const welcomes = {
    es: '¡Hola! Soy **EcoBot**, tu asistente en EcoLearn UDEC. 🌱\n\n*"Soy LIBRE, AUTÓNOMO Y RESPONSABLE a través del diálogo y la construcción, como ideal regulativo; me dirijo, controlo y dicto mis propias leyes."*\n\nEscribe **ayuda** para ver mis temas, o pregúntame lo que necesites.',
    en: 'Hello! I\'m **EcoBot**, your assistant at EcoLearn UDEC. 🌱\n\n*"I am FREE, AUTONOMOUS AND RESPONSIBLE through dialogue and construction, as a regulative ideal; I lead, control and dictate my own laws."*\n\nType **help** to see my topics, or ask me anything.',
  };

  // ── Render markdown-lite (bold + italic + newlines)
  function renderMarkdown(text) {
    return text
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
      .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
      .replace(/\*(.+?)\*/g, '<em>$1</em>')
      .replace(/\n/g, '<br>');
  }

  function addMessage(text, role) {
    const wrap = document.createElement('div');
    wrap.className = 'ecobot-msg ' + role;

    if (role === 'bot') {
      wrap.innerHTML =
        '<div class="avatar"><i class="bi bi-robot"></i></div>' +
        '<div class="bubble">' + renderMarkdown(text) + '</div>';
    } else {
      wrap.innerHTML =
        '<div class="avatar" style="background:linear-gradient(135deg,#2d3748,#4a5568)"><i class="bi bi-person-fill"></i></div>' +
        '<div class="bubble">' + renderMarkdown(text) + '</div>';
    }

    $msgs.insertBefore(wrap, $typing);
    $msgs.scrollTop = $msgs.scrollHeight;
  }

  function setTyping(show) {
    $typing.style.display = show ? 'flex' : 'none';
    if (show) $msgs.scrollTop = $msgs.scrollHeight;
    $send.disabled = show;
  }

  function setLang(newLang) {
    lang = newLang;
    $langBtn.textContent = newLang.toUpperCase();
    $banner.textContent  = banners[newLang];
    $input.placeholder   = newLang === 'es' ? 'Escribe tu mensaje…' : 'Type your message…';
    $status.textContent  = newLang === 'es' ? 'En línea · EcoLearn UDEC' : 'Online · EcoLearn UDEC';
  }

  window.ecobotToggle = function () {
    const open = $window.classList.toggle('is-open');
    $toggle.classList.toggle('is-open', open);

    if (open) {
      $dot.style.display = 'none';
      $input.focus();

      if (firstOpen) {
        firstOpen = false;
        setTyping(true);
        setTimeout(function () {
          setTyping(false);
          addMessage(welcomes[lang], 'bot');
        }, 900);
      }
    }
  };

  window.ecobotSwitchLang = function () {
    const next = lang === 'es' ? 'en' : 'es';
    setLang(next);

    const msg = next === 'en'
      ? '🌐 Switched to English! Ask me anything or type **help**.'
      : '🌐 ¡Cambiado al español! Pregúntame lo que quieras o escribe **ayuda**.';
    addMessage(msg, 'bot');
  };

  window.ecobotSend = async function (e) {
    e.preventDefault();
    const text = $input.value.trim();
    if (!text) return;

    addMessage(text, 'user');
    $input.value = '';
    setTyping(true);

    try {
      const res = await fetch(ROUTE, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json',
        },
        body: JSON.stringify({ message: text, lang }),
      });

      const data = await res.json();

      // Simulate a short thinking delay
      await new Promise(r => setTimeout(r, 400 + Math.random() * 300));

      setTyping(false);

      if (data.lang && data.lang !== lang) {
        setLang(data.lang);
      }

      addMessage(data.text || data.message || '…', 'bot');

    } catch {
      setTyping(false);
      addMessage(lang === 'es'
        ? '⚠️ Error de conexión. Por favor, inténtalo de nuevo.'
        : '⚠️ Connection error. Please try again.',
        'bot'
      );
    }
  };

  // Allow Enter to send
  $input.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      ecobotSend(e);
    }
  });

  // Show notification dot after 3s if not opened yet
  setTimeout(function () {
    if (firstOpen) $dot.style.display = 'block';
  }, 3000);
}());
</script>
