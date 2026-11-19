{{-- Estilos del módulo de contratos: texto del contrato + modo oscuro --}}
<style>
    /* ---------- Texto del contrato ---------- */
    /* Títulos en "em" para que crezcan junto con el tamaño de letra elegido */
    .contract-body h1 { font-size: 1.5em; font-weight: 700; text-align: center; margin-bottom: 1rem; }
    .contract-body h2 { font-size: 1.15em; font-weight: 700; margin: 1.25rem 0 .5rem; }

    /* Tamaños de letra del contrato (botones A / A+ / A++) */
    .contract-body { line-height: 1.6; transition: font-size .15s ease; }
    .contract-body.text-size-1 { font-size: 1rem; }
    .contract-body.text-size-2 { font-size: 1.25rem; }
    .contract-body.text-size-3 { font-size: 1.5rem; line-height: 1.7; }
    .contract-body p { margin-bottom: .75rem; text-align: justify; }
    .contract-body ul { list-style: disc; padding-left: 1.5rem; margin-bottom: .75rem; }
    .contract-body li { margin-bottom: .25rem; }
    .contract-body blockquote { border-left: 4px solid #f59e0b; background: rgba(245, 158, 11, .1); padding: .5rem .75rem; margin-bottom: .75rem; }
    .contract-body blockquote p { margin: 0; }

    /* ---------- Modo oscuro ----------
       AdminLTE agrega la clase .dark-mode al <body>. Las tarjetas, botones,
       alertas y form-control de AdminLTE ya se adaptan solos; aquí se ajustan
       las clases de Tailwind / Jetstream que usan colores fijos. */
    body.dark-mode {
        --c-bg: #1f2937;        /* fondo de tablas y modales */
        --c-bg-soft: #2a3441;   /* encabezados, hover */
        --c-border: #4b5563;
        --c-text: #cbd0d6;      /* blanco suavizado (antes #e5e7eb) */
        --c-muted: #959ba5;
    }

    /* Texto general del módulo: AdminLTE usa blanco puro, aquí un tono más suave */
    body.dark-mode .contracts-module,
    body.dark-mode .contracts-module .card,
    body.dark-mode .contracts-module .card-header,
    body.dark-mode .contracts-module .card-body,
    body.dark-mode .contracts-module .contract-body,
    body.dark-mode .contracts-module table,
    body.dark-mode .jetstream-modal { color: var(--c-text); }
    body.dark-mode .content-header h1 { color: var(--c-text); }

    /* Fondo gris claro del layout interno */
    body.dark-mode .min-h-screen.bg-gray-100 { background-color: transparent !important; }

    body.dark-mode .contracts-module .bg-white,
    body.dark-mode .jetstream-modal .bg-white { background-color: var(--c-bg) !important; }

    body.dark-mode .contracts-module .bg-gray-50,
    body.dark-mode .contracts-module .bg-gray-100,
    body.dark-mode .jetstream-modal .bg-gray-100 { background-color: var(--c-bg-soft) !important; }

    body.dark-mode .contracts-module .hover\:bg-gray-100:hover { background-color: var(--c-bg-soft) !important; }

    body.dark-mode .contracts-module .text-gray-900,
    body.dark-mode .contracts-module .text-gray-700,
    body.dark-mode .contracts-module .text-gray-600,
    body.dark-mode .jetstream-modal .text-gray-900,
    body.dark-mode .jetstream-modal .text-gray-600,
    body.dark-mode .contracts-module label,
    body.dark-mode .jetstream-modal label { color: var(--c-text) !important; }

    body.dark-mode .contracts-module .text-gray-500 { color: var(--c-muted) !important; }

    body.dark-mode .contracts-module .text-indigo-600 { color: #a5b4fc !important; }
    body.dark-mode .contracts-module .text-blue-600 { color: #93c5fd !important; }
    body.dark-mode .contracts-module .text-red-600 { color: #fca5a5 !important; }

    body.dark-mode .contracts-module .border,
    body.dark-mode .contracts-module .border-gray-200,
    body.dark-mode .contracts-module .border-gray-300,
    body.dark-mode .contracts-module .divide-y > * ,
    body.dark-mode .contracts-module .divide-gray-200 > * { border-color: var(--c-border) !important; }

    /* Campos de formulario de Jetstream (x-input) y textarea/select */
    body.dark-mode .contracts-module input:not([type=checkbox]):not([type=radio]),
    body.dark-mode .contracts-module textarea,
    body.dark-mode .contracts-module select,
    body.dark-mode .jetstream-modal textarea,
    body.dark-mode .jetstream-modal input {
        background-color: #111827 !important;
        color: var(--c-text) !important;
        border-color: var(--c-border) !important;
    }
    body.dark-mode .contracts-module input::placeholder,
    body.dark-mode .contracts-module textarea::placeholder { color: #6b7280; }
    /* Icono del calendario / reloj visible en oscuro */
    body.dark-mode .contracts-module input[type=date],
    body.dark-mode .contracts-module input[type=time] { color-scheme: dark; }

    /* Botón secundario de Jetstream dentro de los modales */
    body.dark-mode .jetstream-modal button.bg-white {
        background-color: var(--c-bg-soft) !important;
        color: var(--c-text) !important;
        border-color: var(--c-border) !important;
    }

    body.dark-mode .contracts-module code { background: #111827; color: #fbbf24; padding: 0 .25rem; border-radius: .25rem; }

    /* Etiquetas de estado: fondo translúcido y texto claro */
    body.dark-mode .contracts-module .bg-gray-100.text-gray-800  { background: rgba(156,163,175,.2) !important; color: #e5e7eb !important; }
    body.dark-mode .contracts-module .bg-blue-100    { background: rgba(59,130,246,.2) !important;  color: #93c5fd !important; }
    body.dark-mode .contracts-module .bg-indigo-100  { background: rgba(99,102,241,.2) !important;  color: #a5b4fc !important; }
    body.dark-mode .contracts-module .bg-green-100   { background: rgba(34,197,94,.2) !important;   color: #86efac !important; }
    body.dark-mode .contracts-module .bg-emerald-100 { background: rgba(16,185,129,.2) !important;  color: #6ee7b7 !important; }
    body.dark-mode .contracts-module .bg-teal-100    { background: rgba(20,184,166,.2) !important;  color: #5eead4 !important; }
    body.dark-mode .contracts-module .bg-slate-200   { background: rgba(148,163,184,.25) !important; color: #cbd5e1 !important; }
    body.dark-mode .contracts-module .bg-red-100     { background: rgba(239,68,68,.2) !important;   color: #fca5a5 !important; }
    body.dark-mode .contracts-module .bg-amber-100   { background: rgba(245,158,11,.2) !important;  color: #fcd34d !important; }
    body.dark-mode .contracts-module .ring-gray-500  { --tw-ring-color: #d1d5db !important; --tw-ring-offset-color: #343a40 !important; }

    /* Historial */
    body.dark-mode .contracts-module .border-l-2 { border-color: var(--c-border) !important; }
</style>
