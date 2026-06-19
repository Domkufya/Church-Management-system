<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use app\assets\AppAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);

if (!empty($this->params['meta_description'])) {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
}
if (!empty($this->params['meta_keywords'])) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
}

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// Google Fonts
$this->registerLinkTag(['rel' => 'preconnect', 'href' => 'https://fonts.googleapis.com']);
$this->registerLinkTag(['rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com', 'crossorigin' => true]);
$this->registerLinkTag(['rel' => 'stylesheet', 'href' => 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap']);

$this->registerCss(<<<'CSS'

/* ══════════════════════════════════════════════════════════
   CHURCH MANAGEMENT SYSTEM — Design System
   Tokens · Layout · Components
   ══════════════════════════════════════════════════════════ */

:root {
    /* Brand */
    --c-primary:      #1E3A8A;
    --c-primary-dk:   #162d6e;
    --c-primary-md:   #2563EB;
    --c-primary-lt:   #3B82F6;
    --c-gold:         #F59E0B;
    --c-gold-dk:      #D97706;
    --c-gold-lt:      #FEF3C7;

    /* UI */
    --c-bg:           #F1F5F9;
    --c-surface:      #FFFFFF;
    --c-border:       #E2E8F0;
    --c-text:         #0F172A;
    --c-text-muted:   #64748B;
    --c-success:      #10B981;
    --c-danger:       #EF4444;
    --c-warning:      #F59E0B;

    /* Sidebar */
    --sidebar-w:      260px;
    --sidebar-w-sm:   72px;
    --topbar-h:       60px;

    /* Stat card accents */
    --s-members:    #3B82F6;
    --s-attendance: #10B981;
    --s-events:     #F59E0B;
    --s-offerings:  #8B5CF6;
    --s-prayer:     #EC4899;
    --s-depts:      #06B6D4;
    --s-children:   #F97316;
    --s-expenses:   #EF4444;

    /* Radius / shadow */
    --r-sm:  6px;
    --r-md:  12px;
    --r-lg:  18px;
    --shadow-sm: 0 1px 4px rgba(15,23,42,.07);
    --shadow-md: 0 4px 16px rgba(15,23,42,.10);
    --shadow-lg: 0 8px 32px rgba(15,23,42,.13);
}

/* ── Reset / Base ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }

html, body { height: 100%; margin: 0; }

body {
    font-family: 'Inter', sans-serif;
    background: var(--c-bg);
    color: var(--c-text);
    font-size: 0.9rem;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
}

h1, h2, h3, h4, .display-font {
    font-family: 'Playfair Display', serif;
    line-height: 1.25;
}

a { text-decoration: none; }

/* ══════════════════════════════════════════════════════════
   GUEST LANDING PAGE — full-screen two-panel layout
   ══════════════════════════════════════════════════════════ */

.landing-wrap {
    display: flex;
    min-height: 100vh;
    overflow: hidden;
}

/* Left panel — deep brand blue */
.landing-panel-left {
    flex: 0 0 48%;
    background: linear-gradient(160deg, #162d6e 0%, #1E3A8A 45%, #2563EB 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 4rem 4rem 3rem;
    position: relative;
    overflow: hidden;
}

/* Signature: large faint cross behind text */
.landing-panel-left::before {
    content: '✝';
    position: absolute;
    bottom: -4rem;
    left: -3rem;
    font-size: 32rem;
    color: rgba(255,255,255,0.04);
    font-family: 'Playfair Display', serif;
    line-height: 1;
    pointer-events: none;
    user-select: none;
}

.landing-panel-left::after {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 320px;
    height: 320px;
    background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%);
    pointer-events: none;
}

.landing-logo-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(245,158,11,0.15);
    border: 1px solid rgba(245,158,11,0.4);
    color: var(--c-gold);
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 0.35rem 1rem;
    border-radius: 99px;
    margin-bottom: 2rem;
}

.landing-title {
    font-size: clamp(2.4rem, 4vw, 3.6rem);
    font-weight: 800;
    color: #fff;
    margin: 0 0 0.5rem;
    line-height: 1.15;
}

.landing-title span {
    color: var(--c-gold);
}

.landing-sub {
    font-size: 1rem;
    color: rgba(255,255,255,0.65);
    font-weight: 400;
    margin-bottom: 1.8rem;
    max-width: 340px;
    line-height: 1.65;
}

.landing-verse {
    border-left: 3px solid var(--c-gold);
    padding-left: 1rem;
    margin-bottom: 2.5rem;
    max-width: 360px;
}

.landing-verse p {
    font-style: italic;
    color: rgba(255,255,255,0.7);
    font-size: 0.9rem;
    margin: 0 0 0.3rem;
    line-height: 1.6;
}

.landing-verse cite {
    font-style: normal;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--c-gold);
    letter-spacing: 0.06em;
}

.landing-stats {
    display: flex;
    gap: 2rem;
    margin-top: 0.5rem;
}

.landing-stat-item {
    text-align: left;
}

.landing-stat-item .num {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}

.landing-stat-item .lbl {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.5);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* Right panel — light, login form */
.landing-panel-right {
    flex: 1;
    background: var(--c-surface);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 3rem 3rem;
    position: relative;
}

.landing-panel-right .welcome-text {
    text-align: center;
    margin-bottom: 2.5rem;
}

.landing-panel-right .welcome-text h2 {
    font-size: 1.8rem;
    color: var(--c-primary);
    margin-bottom: 0.35rem;
}

.landing-panel-right .welcome-text p {
    color: var(--c-text-muted);
    font-size: 0.88rem;
}

.landing-action-card {
    width: 100%;
    max-width: 380px;
    background: var(--c-bg);
    border: 1px solid var(--c-border);
    border-radius: var(--r-lg);
    padding: 2rem;
    margin-bottom: 1.5rem;
}

.landing-action-card .btn-primary-church {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.85rem 1.5rem;
    background: var(--c-primary);
    color: #fff;
    border: none;
    border-radius: var(--r-md);
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
    margin-bottom: 0.75rem;
    letter-spacing: 0.01em;
}

.landing-action-card .btn-primary-church:hover {
    background: var(--c-primary-dk);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(30,58,138,0.3);
    color: #fff;
}

.landing-action-card .btn-gold-church {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.85rem 1.5rem;
    background: var(--c-gold);
    color: #fff;
    border: none;
    border-radius: var(--r-md);
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.18s, transform 0.15s;
    letter-spacing: 0.01em;
}

.landing-action-card .btn-gold-church:hover {
    background: var(--c-gold-dk);
    transform: translateY(-1px);
    color: #fff;
}

.landing-action-card .divider {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--c-text-muted);
    font-size: 0.75rem;
    margin: 0.75rem 0;
}

.landing-action-card .divider::before,
.landing-action-card .divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--c-border);
}

.landing-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    width: 100%;
    max-width: 380px;
}

.landing-feature-pill {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--c-bg);
    border: 1px solid var(--c-border);
    border-radius: var(--r-sm);
    padding: 0.6rem 0.85rem;
    font-size: 0.78rem;
    color: var(--c-text-muted);
    font-weight: 500;
}

.landing-feature-pill .pill-icon {
    font-size: 1rem;
    flex-shrink: 0;
}

.landing-footer-note {
    position: absolute;
    bottom: 1.5rem;
    font-size: 0.72rem;
    color: var(--c-text-muted);
}

/* Mobile: stack panels */
@media (max-width: 768px) {
    .landing-wrap { flex-direction: column; }
    .landing-panel-left {
        flex: none;
        padding: 2.5rem 1.5rem 2rem;
        align-items: center;
        text-align: center;
    }
    .landing-panel-left::before { font-size: 16rem; }
    .landing-verse { border-left: none; border-top: 3px solid var(--c-gold); padding: 0.75rem 0 0; }
    .landing-stats { justify-content: center; }
    .landing-panel-right { padding: 2rem 1.5rem; }
    .landing-features { grid-template-columns: 1fr 1fr; }
}


/* ══════════════════════════════════════════════════════════
   AUTHENTICATED LAYOUT — Sidebar + Topbar + Content
   ══════════════════════════════════════════════════════════ */

.app-shell {
    display: flex;
    min-height: 100vh;
}

/* ── Sidebar ──────────────────────────────────────────────── */
.app-sidebar {
    width: var(--sidebar-w);
    background: var(--c-primary);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 1040;
    transition: width 0.25s cubic-bezier(.4,0,.2,1);
    overflow: hidden;
    box-shadow: 4px 0 20px rgba(15,23,42,0.18);
}

.app-sidebar.collapsed {
    width: var(--sidebar-w-sm);
}

/* Brand area */
.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.1rem 1.25rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    min-height: var(--topbar-h);
    overflow: hidden;
    text-decoration: none;
}

.sidebar-brand-icon {
    width: 36px;
    height: 36px;
    background: var(--c-gold);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
    color: #fff;
}

.sidebar-brand-text {
    overflow: hidden;
    transition: opacity 0.2s, width 0.25s;
}

.sidebar-brand-text strong {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: 0.95rem;
    color: #fff;
    white-space: nowrap;
    line-height: 1.2;
}

.sidebar-brand-text span {
    font-size: 0.68rem;
    color: rgba(255,255,255,0.5);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    white-space: nowrap;
}

.app-sidebar.collapsed .sidebar-brand-text {
    opacity: 0;
    width: 0;
}

/* Scroll area */
.sidebar-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 1rem 0;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.1) transparent;
}

/* Section labels */
.sidebar-section-label {
    font-size: 0.62rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.35);
    padding: 0.9rem 1.35rem 0.35rem;
    white-space: nowrap;
    overflow: hidden;
    transition: opacity 0.2s;
}

.app-sidebar.collapsed .sidebar-section-label {
    opacity: 0;
}

/* Nav items */
.sidebar-nav-item {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    padding: 0.65rem 1.25rem;
    color: rgba(255,255,255,0.72);
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.15s, color 0.15s;
    white-space: nowrap;
    position: relative;
    text-decoration: none;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
}

.sidebar-nav-item:hover {
    background: rgba(255,255,255,0.08);
    color: #fff;
}

.sidebar-nav-item.active {
    background: rgba(245,158,11,0.15);
    color: var(--c-gold);
    border-right: 3px solid var(--c-gold);
}

.sidebar-nav-item .nav-icon {
    font-size: 1.05rem;
    flex-shrink: 0;
    width: 22px;
    text-align: center;
}

.sidebar-nav-item .nav-label {
    overflow: hidden;
    transition: opacity 0.2s, width 0.25s;
}

.app-sidebar.collapsed .nav-label {
    opacity: 0;
    width: 0;
}

/* Tooltip on collapsed */
.app-sidebar.collapsed .sidebar-nav-item:hover::after {
    content: attr(data-label);
    position: absolute;
    left: calc(var(--sidebar-w-sm) + 8px);
    background: #1e293b;
    color: #fff;
    font-size: 0.78rem;
    padding: 0.3rem 0.75rem;
    border-radius: 6px;
    white-space: nowrap;
    pointer-events: none;
    z-index: 2000;
    box-shadow: var(--shadow-md);
}

/* Dropdown sub-items */
.sidebar-dropdown-body {
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.3s ease;
}

.sidebar-dropdown-body.open {
    max-height: 300px;
}

.sidebar-sub-item {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    padding: 0.5rem 1.25rem 0.5rem 3.4rem;
    color: rgba(255,255,255,0.55);
    font-size: 0.82rem;
    cursor: pointer;
    transition: color 0.15s, background 0.15s;
    text-decoration: none;
    white-space: nowrap;
}

.sidebar-sub-item:hover {
    color: rgba(255,255,255,0.9);
    background: rgba(255,255,255,0.05);
}

.sidebar-sub-item.active {
    color: var(--c-gold);
}

.app-sidebar.collapsed .sidebar-dropdown-body { display: none; }

/* Chevron */
.nav-chevron {
    margin-left: auto;
    font-size: 0.65rem;
    color: rgba(255,255,255,0.4);
    transition: transform 0.25s;
}

.sidebar-nav-item.open .nav-chevron {
    transform: rotate(90deg);
}

/* Sidebar footer */
.sidebar-footer {
    padding: 0.85rem 1.25rem;
    border-top: 1px solid rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    overflow: hidden;
}

.sidebar-user-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--c-gold);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    font-weight: 700;
    flex-shrink: 0;
    text-transform: uppercase;
}

.sidebar-user-info {
    overflow: hidden;
    transition: opacity 0.2s;
    flex: 1;
    min-width: 0;
}

.app-sidebar.collapsed .sidebar-user-info {
    opacity: 0;
    width: 0;
}

.sidebar-user-info .uname {
    font-size: 0.82rem;
    font-weight: 600;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.sidebar-user-info .urole {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.45);
    text-transform: capitalize;
}

.sidebar-logout-btn {
    background: none;
    border: none;
    color: rgba(255,255,255,0.4);
    font-size: 1rem;
    cursor: pointer;
    padding: 0;
    flex-shrink: 0;
    transition: color 0.15s;
}

.sidebar-logout-btn:hover { color: var(--c-danger); }

.app-sidebar.collapsed .sidebar-logout-btn { display: none; }

/* ── Topbar ───────────────────────────────────────────────── */
.app-topbar {
    position: fixed;
    top: 0;
    left: var(--sidebar-w);
    right: 0;
    height: var(--topbar-h);
    background: var(--c-surface);
    border-bottom: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    padding: 0 1.5rem;
    gap: 1rem;
    z-index: 1030;
    transition: left 0.25s cubic-bezier(.4,0,.2,1);
    box-shadow: var(--shadow-sm);
}

.app-shell.sidebar-collapsed .app-topbar {
    left: var(--sidebar-w-sm);
}

.topbar-toggle {
    background: none;
    border: none;
    color: var(--c-text-muted);
    font-size: 1.1rem;
    cursor: pointer;
    padding: 0.4rem;
    border-radius: var(--r-sm);
    transition: background 0.15s, color 0.15s;
    flex-shrink: 0;
}

.topbar-toggle:hover {
    background: var(--c-bg);
    color: var(--c-primary);
}

.topbar-page-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--c-text);
    flex: 1;
}

.topbar-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.topbar-icon-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: none;
    border: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    cursor: pointer;
    color: var(--c-text-muted);
    transition: background 0.15s, color 0.15s, border-color 0.15s;
}

.topbar-icon-btn:hover {
    background: var(--c-bg);
    color: var(--c-primary);
    border-color: var(--c-primary);
}

/* ── Main content ─────────────────────────────────────────── */
.app-content-wrap {
    margin-left: var(--sidebar-w);
    margin-top: var(--topbar-h);
    flex: 1;
    min-width: 0;
    transition: margin-left 0.25s cubic-bezier(.4,0,.2,1);
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - var(--topbar-h));
}

.app-shell.sidebar-collapsed .app-content-wrap {
    margin-left: var(--sidebar-w-sm);
}

.app-content {
    flex: 1;
    padding: 2rem 2rem 1rem;
}

/* ── App Footer ───────────────────────────────────────────── */
.app-footer {
    background: var(--c-primary);
    border-top: 3px solid var(--c-gold);
    padding: 0.85rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.app-footer-left {
    font-size: 0.78rem;
    color: rgba(255,255,255,0.55);
}

.app-footer-left strong {
    color: rgba(255,255,255,0.8);
}

.app-footer-verse {
    font-size: 0.75rem;
    font-style: italic;
    color: rgba(255,255,255,0.4);
    text-align: center;
    flex: 1;
}

.app-footer-right {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.app-footer-right a {
    color: rgba(255,255,255,0.4);
}

.app-footer-right a:hover { color: var(--c-gold); }

.footer-logo-light { filter: brightness(0) invert(1) opacity(0.35); }
.footer-logo-dark  { display: none; }

/* ══════════════════════════════════════════════════════════
   SHARED COMPONENTS
   ══════════════════════════════════════════════════════════ */

/* Stat cards */
.stat-card {
    background: var(--c-surface);
    border-radius: var(--r-md);
    padding: 1.35rem 1.25rem;
    border: 1px solid var(--c-border);
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.stat-card .stat-bar {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: var(--r-md) var(--r-md) 0 0;
}

.stat-card .stat-icon-box {
    width: 44px; height: 44px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    margin-bottom: 0.85rem;
}

.stat-card .stat-val {
    font-family: 'Playfair Display', serif;
    font-size: 1.85rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.2rem;
}

.stat-card .stat-lbl {
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: var(--c-text-muted);
}

.sc-members    .stat-bar { background: var(--s-members); }
.sc-members    .stat-icon-box { background: rgba(59,130,246,.1); color: var(--s-members); }
.sc-members    .stat-val { color: var(--s-members); }

.sc-attendance .stat-bar { background: var(--s-attendance); }
.sc-attendance .stat-icon-box { background: rgba(16,185,129,.1); color: var(--s-attendance); }
.sc-attendance .stat-val { color: var(--s-attendance); }

.sc-events     .stat-bar { background: var(--s-events); }
.sc-events     .stat-icon-box { background: rgba(245,158,11,.1); color: var(--s-events); }
.sc-events     .stat-val { color: var(--s-events); }

.sc-offerings  .stat-bar { background: var(--s-offerings); }
.sc-offerings  .stat-icon-box { background: rgba(139,92,246,.1); color: var(--s-offerings); }
.sc-offerings  .stat-val { color: var(--s-offerings); }

.sc-prayer     .stat-bar { background: var(--s-prayer); }
.sc-prayer     .stat-icon-box { background: rgba(236,72,153,.1); color: var(--s-prayer); }
.sc-prayer     .stat-val { color: var(--s-prayer); }

.sc-depts      .stat-bar { background: var(--s-depts); }
.sc-depts      .stat-icon-box { background: rgba(6,182,212,.1); color: var(--s-depts); }
.sc-depts      .stat-val { color: var(--s-depts); }

.sc-children   .stat-bar { background: var(--s-children); }
.sc-children   .stat-icon-box { background: rgba(249,115,22,.1); color: var(--s-children); }
.sc-children   .stat-val { color: var(--s-children); }

.sc-expenses   .stat-bar { background: var(--s-expenses); }
.sc-expenses   .stat-icon-box { background: rgba(239,68,68,.1); color: var(--s-expenses); }
.sc-expenses   .stat-val { color: var(--s-expenses); }

/* Church card */
.church-card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--r-md);
    box-shadow: var(--shadow-sm);
}

.church-card .church-card-header {
    padding: 1rem 1.35rem;
    border-bottom: 1px solid var(--c-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.church-card .church-card-header h5 {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--c-primary);
    margin: 0;
}

.church-card .church-card-body {
    padding: 1.25rem 1.35rem;
}

/* Section title */
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--c-primary);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-title::after {
    content: '';
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, var(--c-gold) 0%, transparent 100%);
    border-radius: 2px;
    margin-left: 0.5rem;
}

/* Buttons */
.btn-church {
    background: var(--c-primary);
    color: #fff;
    border: none;
    border-radius: var(--r-sm);
    padding: 0.5rem 1.15rem;
    font-size: 0.84rem;
    font-weight: 600;
    transition: background 0.18s, transform 0.15s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.btn-church:hover { background: var(--c-primary-dk); transform: translateY(-1px); color: #fff; }

.btn-church-gold {
    background: var(--c-gold);
    color: #fff;
    border: none;
    border-radius: var(--r-sm);
    padding: 0.5rem 1.15rem;
    font-size: 0.84rem;
    font-weight: 600;
    transition: background 0.18s, transform 0.15s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.btn-church-gold:hover { background: var(--c-gold-dk); color: #fff; transform: translateY(-1px); }

/* Tables */
.table thead th {
    background: var(--c-primary);
    color: #fff;
    font-size: 0.72rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    border: none;
    padding: 0.75rem 1rem;
}

.table td { padding: 0.7rem 1rem; vertical-align: middle; }
.table-hover tbody tr:hover { background: rgba(37,99,235,0.04); }

/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0 0 1rem;
    margin: 0;
    font-size: 0.78rem;
}
.breadcrumb-item a { color: var(--c-primary-md); }
.breadcrumb-item.active { color: var(--c-text-muted); }

/* Alerts */
.alert { border-radius: var(--r-sm); border: none; font-size: 0.86rem; }
.alert-success { background: #ecfdf5; color: #065f46; border-left: 4px solid var(--c-success); }
.alert-danger   { background: #fef2f2; color: #991b1b; border-left: 4px solid var(--c-danger); }
.alert-warning  { background: #fffbeb; color: #92400e; border-left: 4px solid var(--c-gold); }
.alert-info     { background: #eff6ff; color: #1e40af; border-left: 4px solid var(--c-primary-lt); }

/* Mobile sidebar overlay */
@media (max-width: 992px) {
    .app-sidebar {
        transform: translateX(-100%);
        width: var(--sidebar-w) !important;
    }
    .app-sidebar.mobile-open { transform: translateX(0); }

    .sidebar-overlay {
        position: fixed; inset: 0;
        background: rgba(15,23,42,0.5);
        z-index: 1039;
        display: none;
    }
    .sidebar-overlay.visible { display: block; }

    .app-topbar { left: 0 !important; }
    .app-content-wrap { margin-left: 0 !important; }
}

/* Dark mode */
[data-bs-theme="dark"] {
    --c-bg:      #0f172a;
    --c-surface: #1e293b;
    --c-border:  #334155;
    --c-text:    #e2e8f0;
    --c-text-muted: #94a3b8;
}

[data-bs-theme="dark"] .app-topbar { background: #1e293b; }
[data-bs-theme="dark"] .church-card,
[data-bs-theme="dark"] .stat-card { background: #1e293b; border-color: #334155; }
[data-bs-theme="dark"] .landing-panel-right { background: #1e293b; }
[data-bs-theme="dark"] .landing-action-card { background: #0f172a; border-color: #334155; }
[data-bs-theme="dark"] .landing-feature-pill { background: #0f172a; border-color: #334155; }

CSS
);
?>