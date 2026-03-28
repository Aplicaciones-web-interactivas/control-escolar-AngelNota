@props(['theme' => 'admin'])

@php
$color1 = match($theme) {
    'admin' => 'bg-blue-600',
    'profesor' => 'bg-emerald-600',
    'alumno' => 'bg-violet-600',
    default => 'bg-blue-600'
};
$color2 = match($theme) {
    'admin' => 'bg-indigo-600',
    'profesor' => 'bg-teal-600',
    'alumno' => 'bg-purple-600',
    default => 'bg-indigo-600'
};
$color3 = match($theme) {
    'admin' => 'bg-cyan-600',
    'profesor' => 'bg-green-600',
    'alumno' => 'bg-fuchsia-600',
    default => 'bg-cyan-600'
};
@endphp

<style>
/* Shared */
.fi-topbar, .fi-simple-main section { backdrop-filter: blur(16px) !important; }
.fi-simple-main section { border-radius: 1.5rem !important; }
@keyframes pulse-slow { 0%, 100% { opacity: 0.3; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.05); } }

/* === DARK MODE === */
html.dark body { background-color: #0f172a !important; color: white !important; }
html.dark .fi-topbar { background-color: rgba(15,23,42,0.6) !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
html.dark .fi-main, html.dark .fi-sidebar, html.dark .fi-layout { background-color: transparent !important; }
html.dark .fi-auth-page, html.dark main.fi-simple-main { background-color: transparent !important; }
html.dark .fi-simple-main section { background-color: rgba(30,41,59,0.7) !important; border: 1px solid rgba(255,255,255,0.1) !important; box-shadow: 0 0 40px rgba(0,0,0,0.3) !important; }
html.dark .fi-logo, html.dark .fi-simple-header-heading, html.dark .fi-simple-header-subheading, html.dark .fi-simple-main label span, html.dark .fi-simple-main a { color: white !important; }
html.dark .light-orbs { display: none; }

/* === LIGHT MODE === */
html:not(.dark) body { background-color: #f8fafc !important; }
html:not(.dark) .fi-topbar { background-color: rgba(255,255,255,0.6) !important; border-bottom: 1px solid rgba(0,0,0,0.05) !important; }
html:not(.dark) .fi-main, html:not(.dark) .fi-sidebar, html:not(.dark) .fi-layout { background-color: transparent !important; }
html:not(.dark) .fi-auth-page, html:not(.dark) main.fi-simple-main { background-color: transparent !important; }
html:not(.dark) .fi-simple-main section { background-color: rgba(255,255,255,0.7) !important; border: 1px solid rgba(0,0,0,0.1) !important; box-shadow: 0 0 40px rgba(0,0,0,0.05) !important;}
html:not(.dark) .dark-orbs { display: none; }
</style>

<!-- Dark Mode Orbs (mix-blend-screen for glowing effect) -->
<div class="dark-orbs fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
    <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] rounded-full {{ $color1 }}/30 blur-[120px] mix-blend-screen" style="animation: pulse-slow 8s infinite alternate;"></div>
    <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] rounded-full {{ $color2 }}/30 blur-[120px] mix-blend-screen" style="animation: pulse-slow 8s infinite alternate; animation-delay: 2s;"></div>
    <div class="absolute top-[20%] left-[30%] w-[40%] h-[40%] rounded-full {{ $color3 }}/20 blur-[100px] mix-blend-screen" style="animation: pulse-slow 8s infinite alternate; animation-delay: 4s;"></div>
</div>

<!-- Light Mode Orbs (mix-blend-multiply for subtle colors on white) -->
<div class="light-orbs fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
    <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] rounded-full {{ $color1 }}/20 blur-[120px] mix-blend-multiply" style="animation: pulse-slow 8s infinite alternate;"></div>
    <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] rounded-full {{ $color2 }}/20 blur-[120px] mix-blend-multiply" style="animation: pulse-slow 8s infinite alternate; animation-delay: 2s;"></div>
    <div class="absolute top-[20%] left-[30%] w-[40%] h-[40%] rounded-full {{ $color3 }}/10 blur-[100px] mix-blend-multiply" style="animation: pulse-slow 8s infinite alternate; animation-delay: 4s;"></div>
</div>
