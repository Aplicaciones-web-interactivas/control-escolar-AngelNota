<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Control Escolar' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    <div class="min-h-full" x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
        
        <!-- Navbar -->
        <nav class="bg-white shadow-sm border-b border-slate-100 sticky top-0 z-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    
                    <!-- Left: Logo & Desktop Links -->
                    <div class="flex">
                        <div class="flex shrink-0 items-center gap-3">
                            <!-- SVG Logo placeholder -->
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-md">
                                CE
                            </div>
                            <span class="font-bold text-xl tracking-tight text-slate-900 hidden sm:block">ControlEscolar</span>
                        </div>
                        
                        <div class="hidden sm:-my-px sm:ml-8 sm:flex sm:space-x-8">
                            <!-- Aquí la lógica será revisar el rol del usuario, de momento mostramos los 3 accesos como demo -->
                            <a href="#" class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-slate-900 transition-colors">
                                Dashboard
                            </a>
                            <a href="#" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-500 hover:border-slate-300 hover:text-slate-700 transition-colors">
                                Portal Profesor
                            </a>
                            <a href="#" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-500 hover:border-slate-300 hover:text-slate-700 transition-colors">
                                Portal Alumno
                            </a>
                            <a href="/admin" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-500 hover:border-slate-300 hover:text-slate-700 transition-colors">
                                Admin (Filament)
                            </a>
                        </div>
                    </div>

                    <!-- Right: User Menu (Desktop) -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <button type="button" class="relative rounded-full bg-white p-1 text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                            <span class="sr-only">Ver notificaciones</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                        </button>

                        <div class="relative ml-3">
                            <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" type="button" class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-transform hover:scale-105" id="user-menu-button">
                                <span class="sr-only">Abrir menú de usuario</span>
                                <img class="h-9 w-9 rounded-full object-cover border-2 border-slate-100" src="https://ui-avatars.com/api/?name=Usuario+Test&background=e2e8f0&color=475569" alt="">
                            </button>
                            
                            <!-- Dropdown -->
                            <div x-show="userMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" x-cloak>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors" role="menuitem">Mi Perfil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors" role="menuitem">Configuración</a>
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium border-t border-slate-100 mt-1" role="menuitem">Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Abrir menú principal</span>
                            <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <svg x-show="mobileMenuOpen" class="hidden h-6 w-6" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" class="sm:hidden border-b border-slate-200" id="mobile-menu" x-cloak>
                <div class="space-y-1 pb-3 pt-2">
                    <a href="#" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700">Dashboard</a>
                    <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-slate-500 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700">Portal Profesor</a>
                    <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-slate-500 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700">Portal Alumno</a>
                    <a href="/admin" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-slate-500 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700">Admin (Filament)</a>
                </div>
                <!-- Mobile User Info -->
                <div class="border-t border-slate-200 pb-3 pt-4">
                    <div class="flex items-center px-4">
                        <div class="shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Usuario+Test" alt="">
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-slate-800">Usuario de Prueba</div>
                            <div class="text-sm font-medium text-slate-500">usuario@control-escolar.com</div>
                        </div>
                        <button type="button" class="relative ml-auto shrink-0 rounded-full bg-white p-1 text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Ver notificaciones</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-slate-100 p-6 lg:p-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="mt-auto border-t border-slate-200 bg-white py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Sistema de Control Escolar. Todos los derechos reservados.
            </div>
        </footer>

    </div>

    @livewireScripts
</body>
</html>
