<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Control Escolar') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS (Vite) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback if Vite is not running, though we expect it to be -->
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a; /* Slate 900 */
        }
        /* Subtly animate the glowing orbs for that premium feel */
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.05); }
        }
        .animate-blob {
            animation: pulse-slow 8s infinite alternate;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>
<body class="antialiased min-h-screen relative overflow-hidden text-white selection:bg-indigo-500/30">

    <!-- Glowing Background Orbs -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-600/30 blur-[120px] mix-blend-screen animate-blob"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] rounded-full bg-indigo-600/30 blur-[120px] mix-blend-screen animate-blob animation-delay-2000"></div>
        <div class="absolute top-[20%] left-[30%] w-[40%] h-[40%] rounded-full bg-purple-600/20 blur-[100px] mix-blend-screen animate-blob animation-delay-4000"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center p-6 md:p-12">
        
        <!-- Header Section -->
        <div class="text-center mb-16 space-y-6 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-4 shadow-lg">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Sistema Activo</span>
            </div>
            
            <h1 class="text-6xl md:text-7xl lg:text-8xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-br from-white via-indigo-200 to-blue-400 drop-shadow-sm pb-2">
                Control Escolar
            </h1>
            
            <p class="text-lg md:text-xl text-slate-300 font-medium leading-relaxed drop-shadow">
                Bienvenido al portal institucional. Seleccione la plataforma correspondiente a su rol para acceder a sus herramientas y paneles de gestión.
            </p>
        </div>

        <!-- Role Portals (Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-6xl">
            
            <!-- Card: Administrador -->
            <a href="/admin" class="group relative flex flex-col items-center p-10 rounded-3xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:bg-slate-800/60 hover:border-blue-500/50 hover:shadow-[0_0_40px_rgba(59,130,246,0.25)]">
                <!-- Glowing Icon Container -->
                <div class="w-24 h-24 mb-8 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 group-hover:shadow-blue-500/50 transition-all duration-500 ring-4 ring-white/10">
                    <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 tracking-wide">Administrador</h2>
                
                <p class="text-slate-400 text-center text-sm md:text-base leading-relaxed group-hover:text-slate-300 transition-colors">
                    Panel de control central. Gestión de catálogos, cuentas de usuario, asignaciones globales y configuración del sistema.
                </p>
                
                <!-- Interaction Hint -->
                <div class="mt-8 flex items-center gap-2 text-blue-400 text-sm font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                    <span>Ingresar al Portal</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

            <!-- Card: Profesor -->
            <a href="/profesor" class="group relative flex flex-col items-center p-10 rounded-3xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:bg-slate-800/60 hover:border-emerald-500/50 hover:shadow-[0_0_40px_rgba(16,185,129,0.25)]">
                <!-- Glowing Icon Container -->
                <div class="w-24 h-24 mb-8 rounded-full bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 group-hover:shadow-emerald-500/50 transition-all duration-500 ring-4 ring-white/10">
                    <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 tracking-wide">Profesor</h2>
                
                <p class="text-slate-400 text-center text-sm md:text-base leading-relaxed group-hover:text-slate-300 transition-colors">
                    Portal docente. Consulta de grupos académicos, visores de horarios, listas de alumnos y captura ágil de calificaciones.
                </p>
                
                <!-- Interaction Hint -->
                <div class="mt-8 flex items-center gap-2 text-emerald-400 text-sm font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                    <span>Ingresar al Portal</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

            <!-- Card: Alumno -->
            <a href="/alumno" class="group relative flex flex-col items-center p-10 rounded-3xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:bg-slate-800/60 hover:border-violet-500/50 hover:shadow-[0_0_40px_rgba(139,92,246,0.25)]">
                <!-- Glowing Icon Container -->
                <div class="w-24 h-24 mb-8 rounded-full bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center shadow-lg shadow-violet-500/30 group-hover:scale-110 group-hover:shadow-violet-500/50 transition-all duration-500 ring-4 ring-white/10">
                    <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                    </svg>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 tracking-wide">Alumno</h2>
                
                <p class="text-slate-400 text-center text-sm md:text-base leading-relaxed group-hover:text-slate-300 transition-colors">
                    Portal estudiantil. Visualización del historial de entregas, consulta de calificaciones por materia, y subida rápida de tareas asignadas.
                </p>
                
                <!-- Interaction Hint -->
                <div class="mt-8 flex items-center gap-2 text-violet-400 text-sm font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                    <span>Ingresar al Portal</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

        </div>
        
        <!-- Footer -->
        <footer class="mt-16 text-center text-slate-500 text-sm absolute bottom-6 w-full">
            <p>&copy; {{ date('Y') }} Control Escolar. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>
