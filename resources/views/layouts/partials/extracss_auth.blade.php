<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="{{ asset('css/tailwind/app.css') }}" rel="stylesheet">
<style type="text/css">
    /* Pattern lock css */
    .patt-wrap { z-index: 10; }
    .patt-circ.hovered { background-color: #cde2f2; border: none; }
    .patt-circ.hovered .patt-dots { display: none; }
    .patt-circ.dir { background-image: url("{{ asset('img/pattern-directionicon-arrow.png') }}"); background-position: center; background-repeat: no-repeat; }
    .patt-circ.e { transform: rotate(0); }
    .patt-circ.s-e { transform: rotate(45deg); }
    .patt-circ.s { transform: rotate(90deg); }
    .patt-circ.s-w { transform: rotate(135deg); }
    .patt-circ.w { transform: rotate(180deg); }
    .patt-circ.n-w { transform: rotate(225deg); }
    .patt-circ.n { transform: rotate(270deg); }
    .patt-circ.n-e { transform: rotate(315deg); }
    .action-link { cursor: pointer; }
</style>
<style>
    *, *::before, *::after { box-sizing: border-box; }

    html {
        background: #f0f4f8 !important;
        min-height: 100%;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f0f4f8 !important;
        color: #1e293b !important;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    h1, h2, h3, h4 { color: #0f172a; }

    /* ─── Auth Shell ─── */
    .auth-shell { position: relative; z-index: 1; }
    .auth-viewport { min-height: 100vh; }

    /* ═══════════════════════════════════════
       SIDE-BY-SIDE SPLIT LAYOUT
       ═══════════════════════════════════════ */
    .auth-split {
        display: flex;
        min-height: calc(100vh - 76px);
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 40px -8px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.03);
        max-width: 1060px;
        margin: 0 auto;
    }
    .auth-split-form {
        flex: 1;
        padding: 48px 44px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }
    .auth-split-image {
        width: 480px;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: stretch;
    }
    .auth-split-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .auth-split-image .image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(99,102,241,0.55) 0%, rgba(79,70,229,0.45) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 40px 32px;
    }
    .auth-split-image .image-overlay h2 {
        color: #fff;
        font-size: 26px;
        font-weight: 700;
        margin: 0 0 8px;
        line-height: 1.3;
        letter-spacing: -0.02em;
    }
    .auth-split-image .image-overlay p {
        color: rgba(255,255,255,0.85);
        font-size: 14px;
        font-weight: 400;
        margin: 0;
        line-height: 1.6;
    }

    @media (max-width: 900px) {
        .auth-split { flex-direction: column; border-radius: 16px; }
        .auth-split-image { width: 100%; height: 200px; }
        .auth-split-form { padding: 32px 24px; }
        .auth-split-image .image-overlay h2 { font-size: 20px; }
    }
    @media (max-width: 600px) {
        .auth-split-image { display: none; }
        .auth-split { box-shadow: none; background: transparent; }
        .auth-split-form { padding: 24px 16px; }
    }

    /* ─── Card (for register & other non-split pages) ─── */
    .auth-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 40px 36px;
        box-shadow: 0 4px 40px -8px rgba(0,0,0,0.07), 0 0 0 1px rgba(0,0,0,0.02);
    }

    @media (max-width: 768px) {
        .auth-card { padding: 28px 20px; border-radius: 16px; }
    }

    /* ─── Form Inputs ─── */
    .auth-input {
        width: 100%;
        height: 48px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0 16px;
        font-size: 14px;
        font-weight: 500;
        color: #0f172a;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .auth-input::placeholder { color: #94a3b8; font-weight: 400; }
    .auth-input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: #fff;
    }

    .auth-input-icon { position: relative; }
    .auth-input-icon .input-icon-left {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 15px;
        pointer-events: none;
    }
    .auth-input-icon .auth-input { padding-left: 42px; }

    /* ─── Labels ─── */
    .auth-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        letter-spacing: 0.01em;
    }
    .auth-label .text-danger { color: #ef4444; }

    /* ─── Buttons ─── */
    .auth-btn-primary {
        width: 100%;
        height: 48px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
        box-shadow: 0 4px 14px -3px rgba(99, 102, 241, 0.4);
        transition: transform 0.15s, box-shadow 0.15s;
        letter-spacing: 0.01em;
    }
    .auth-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px -4px rgba(99, 102, 241, 0.45);
    }
    .auth-btn-primary:active { transform: translateY(0); }

    .auth-btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 38px;
        padding: 0 18px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        background: transparent;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s, color 0.2s;
    }
    .auth-btn-outline:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: #1e293b;
        text-decoration: none;
    }

    /* ─── Links ─── */
    .auth-link {
        color: #6366f1;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.15s;
    }
    .auth-link:hover { color: #4f46e5; text-decoration: none; }

    /* ─── Topbar ─── */
    .auth-topbar-modern {
        position: sticky;
        top: 0;
        z-index: 50;
        padding: 14px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid #e2e8f0;
    }
    .auth-topbar-modern .topbar-logo {
        width: 42px; height: 42px;
        border-radius: 12px;
        object-fit: cover;
    }
    .auth-topbar-modern .topbar-nav {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .auth-topbar-modern .topbar-nav a {
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.15s;
    }
    .auth-topbar-modern .topbar-nav a:hover { color: #1e293b; }

    /* ─── Title Section ─── */
    .auth-title {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px;
        letter-spacing: -0.025em;
    }
    .auth-subtitle {
        font-size: 14px;
        color: #64748b;
        font-weight: 400;
        margin: 0;
    }

    /* ─── Divider ─── */
    .auth-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 20px 0;
    }

    /* ─── Error Overrides ─── */
    .has-error .auth-input { border-color: #fca5a5; }
    .help-block { font-size: 12px; color: #ef4444; margin-top: 4px; }

    /* ─── Register Form Overrides ─── */
    .auth-card .form-group { margin-bottom: 18px; }
    .auth-card .form-control {
        height: 48px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0 16px;
        font-size: 14px;
        font-weight: 500;
        color: #0f172a;
        box-shadow: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .auth-card .form-control::placeholder { color: #94a3b8; }
    .auth-card .form-control:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: #fff;
    }
    .auth-card select.form-control { appearance: auto; }
    .auth-card label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }
    .auth-card .input-group-addon {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-right: none;
        color: #94a3b8;
        border-radius: 12px 0 0 12px;
    }
    .auth-card .input-group .form-control {
        border-radius: 0 12px 12px 0;
    }
    .auth-card .input-group .input-group-addon + .form-control {
        border-left: none;
    }
    .auth-card legend {
        color: #4f46e5;
        font-size: 16px;
        font-weight: 700;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .auth-card fieldset { margin-bottom: 8px; }
    .auth-card hr { border-color: #e2e8f0; }
    .auth-card .btn-primary,
    .auth-card .btn-success {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
        border: none;
        border-radius: 12px;
        height: 48px;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        box-shadow: 0 4px 14px -3px rgba(99, 102, 241, 0.4);
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .auth-card .btn-primary:hover,
    .auth-card .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px -4px rgba(99, 102, 241, 0.45);
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
    }

    /* alert overrides */
    .auth-card .alert, .auth-split .alert {
        border-radius: 12px;
        font-size: 14px;
    }
    .auth-card .alert-danger, .auth-split .alert-danger {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .auth-card .alert-success, .auth-split .alert-success {
        background: #f0fdf4;
        color: #16a34a;
        border-color: #bbf7d0;
    }
    .auth-card .alert-info, .auth-split .alert-info {
        background: #eff6ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }
    .auth-card .text-muted { color: #94a3b8 !important; }

    /* ─── Checkbox ─── */
    .auth-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .auth-checkbox input[type="checkbox"] {
        width: 18px; height: 18px;
        accent-color: #6366f1;
        border-radius: 4px;
        cursor: pointer;
    }
    .auth-checkbox span { font-size: 13px; color: #64748b; font-weight: 500; }

    /* ─── Language Dropdown ─── */
    .auth-topbar-modern .tw-dw-dropdown summary {
        color: #64748b;
        font-size: 14px;
    }
    .auth-topbar-modern .tw-dw-dropdown .tw-dw-menu {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.1);
    }
    .auth-topbar-modern .tw-dw-dropdown .tw-dw-menu a {
        color: #475569;
        padding: 8px 14px;
        border-radius: 8px;
    }
    .auth-topbar-modern .tw-dw-dropdown .tw-dw-menu a:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    /* ─── select2 overrides ─── */
    .auth-card .select2-container--default .select2-selection--single {
        height: 48px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0 12px 12px 0;
    }
    .auth-card .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 48px;
        color: #0f172a;
        padding-left: 12px;
    }
    .auth-card .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }

    /* ─── Wizard steps override (register) ─── */
    .wizard > .steps > ul > li a {
        background: #f1f5f9 !important;
        color: #94a3b8 !important;
        border-radius: 10px !important;
        border: 1px solid #e2e8f0 !important;
    }
    .wizard > .steps > ul > li.current a {
        background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
        color: #fff !important;
        border-color: #818cf8 !important;
    }
    .wizard > .steps > ul > li.done a {
        background: #f0fdf4 !important;
        color: #16a34a !important;
        border-color: #bbf7d0 !important;
    }
    .wizard > .content {
        background-color: transparent !important;
        border-radius: 16px;
        overflow: visible;
    }
    .wizard > .actions a {
        background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 14px -3px rgba(99, 102, 241, 0.4) !important;
    }

    /* Body content offset for sticky topbar */
    .auth-content-offset { padding-top: 24px; padding-bottom: 40px; }

    /* ─── Responsive ─── */
    @media (max-width: 768px) {
        .auth-topbar-modern { padding: 12px 16px; }
        .auth-topbar-modern .topbar-logo { width: 36px; height: 36px; border-radius: 10px; }
        .auth-title { font-size: 20px; }
        .auth-card { margin: 0 4px; }
    }
</style>
