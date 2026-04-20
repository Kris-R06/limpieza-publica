<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'sudo-Trash' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    {{-- Fuentes: Estandarizamos a Barlow para todo el proyecto --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet" />

    {{-- Tailwind y Phosphor CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0',
                            300: '#86efac', 400: '#4ade80', 500: '#22c55e',
                            600: '#16a34a', 700: '#15803d', 800: '#166534',
                            900: '#14532d', 950: '#052e16', 850: '#15532E',
                            1000: '#082112',
                        }
                    },
                    fontFamily: {
                        heading: ['"Barlow Condensed"', 'sans-serif'],
                        body:    ['"Barlow"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-body bg-white text-slate-800 antialiased flex flex-col min-h-screen">

    {{-- ══════════ HEADER ══════════ --}}
    <header class="bg-brand-850 border-b border-brand-1000 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <div class="shrink-0 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-brand-100 flex items-center justify-center">
                        <i class="ph ph-trash text-xl text-brand-850"></i>
                    </div>
                    <div>
                        <p class="font-heading text-xl font-bold text-white tracking-wide leading-tight uppercase">Sudo-Trash</p>
                    </div>
                </div>

                {{-- Navegación --}}
                <nav class="hidden md:flex items-center space-x-8">
                    @guest
                    <a href="{{ route('login') }}" class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition-all shadow-md shadow-brand-600/20 uppercase tracking-widest">
                        Ingresar
                    </a>
                    @endguest
                    @auth
                    <a href="{{ route('formulario.index') }}" class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition-all shadow-md shadow-brand-600/20 uppercase tracking-widest">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition-all shadow-md shadow-red-600/20 uppercase tracking-widest">
                            Cerrar Sesión
                        </button>
                    </form>
                    @endauth
                </nav>

                {{-- Botón Móvil --}}
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-white hover:text-brand-600">
                        <i class="ph ph-list text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Menu Móvil --}}
        <div id="mobile-menu" class="hidden md:hidden bg-brand-850 border-t border-brand-1000 p-4 space-y-4">
            <a href="{{ route('home') }}" class="block text-white font-bold uppercase tracking-wider">Inicio</a>
            <a href="{{ route('login') }}" class="block text-white font-bold uppercase tracking-wider">Login</a>
        </div>
    </header>

    <main class="grow">
        
        {{-- ══════════ HERO SECTION ══════════ --}}
        {{-- 3. BANNER PANORÁMICO (Stock Image) --}}
        <section class="w-full h-80 lg:h-100 relative overflow-hidden">
            <img 
                src="https://images.trvl-media.com/place/2204/cc8f99d2-e76e-40a2-8710-bee4dacd08cd.jpg" 
                alt="Ciudad Banner" 
                class="w-full h-full object-cover sepia-[0.3] brightness-[0.8]"
            >
            <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
        </section>

        {{-- DESCRIPCIÓN --}}
        <section class="py-16 lg:py-10 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-16">
                
                <div class="lg:w-1/2 flex flex-col justify-center space-y-8 text-center lg:text-left">
                    <h1 class="font-heading text-5xl sm:text-7xl font-extrabold text-slate-900 leading-[0.95] tracking-tight uppercase">
                        Ciudad limpia, <br>
                        <span class="text-brand-600">Gestión Inteligente</span>
                        <span class="text-brand-600">Con Sudo-Trash.</span>
                    </h1>
                    <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                        Registra formularios para monitorear las actividades diarias de las unidades de limpieza, asegurando un control eficiente y una ciudad más limpia para todos.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 px-10 rounded-xl shadow-xl shadow-brand-600/30 transition-all text-center uppercase tracking-widest">
                            Entrar al sistema
                        </a>
                    </div>
                </div>

                <div class="lg:w-1/2 w-full relative">
                    <div class="absolute -inset-4 bg-brand-100/50 rounded-3xl blur-2xl -z-10"></div>
                    <img 
                        src="https://matamoros.gob.mx/wp-content/uploads/2025/01/Entrega-Presidente-Municipal-Alberto-Granados-nuevos-camiones-compactadores-para-reforzar-limpieza-publica-en-Matamoros2-1-1024x683.jpg" 
                        alt="Gestión de limpieza" 
                        class="rounded-2xl shadow-2xl border border-white/50 object-cover w-full h-100 lg:h-96"
                    >
                </div>
            </div>
        </section>

        {{-- ══════════ FEATURES ══════════ --}}
        <section class="py-20 bg-gray-50 border-y border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="font-heading text-4xl font-bold text-slate-900 uppercase tracking-tight">Capacidades del Sistema</h2>
                    <div class="w-20 h-1.5 bg-brand-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    {{-- Card 1 --}}
                    <div class="bg-white p-10 rounded-2xl border border-gray-200 shadow-sm">
                        <div class="w-14 h-14 bg-brand-50 rounded-xl flex items-center justify-center mb-8 text-brand-600">
                            <i class="ph ph-clipboard-text text-3xl"></i>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-slate-900 mb-4 uppercase">Registros</h3>
                        <p class="text-slate-500 text-sm leading-relaxed tracking-wide">
                            Control detallado de actividades diarias, recolección y reportes de cumplimiento por ruta.
                        </p>
                    </div>

                    {{-- Card 2 --}}
                    <div class="bg-white p-10 rounded-2xl border border-gray-200 shadow-sm">
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-8 text-blue-600">
                            <i class="ph ph-map-trifold text-3xl"></i>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-slate-900 mb-4 uppercase">Monitoreo</h3>
                        <p class="text-slate-500 text-sm leading-relaxed tracking-wide">
                            Visualización de colonias atendidas y rutas activas.
                        </p>
                    </div>

                    {{-- Card 3 --}}
                    <div class="bg-white p-10 rounded-2xl border border-gray-200 shadow-sm">
                        <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center mb-8 text-purple-600">
                            <i class="ph ph-truck text-3xl"></i>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-slate-900 mb-4 uppercase">Unidades</h3>
                        <p class="text-slate-500 text-sm leading-relaxed tracking-wide">
                            Monitoreo de las unidades activas en el sistema.
                        </p>
                    </div>

                </div>
            </div>
        </section>

    </main>

    {{-- ══════════ FOOTER ══════════ --}}
    <footer class="bg-brand-850 py-12 border-t border-brand-1000 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-3">
                    <i class="ph ph-trash text-2xl text-brand-100"></i>
                    <span class="font-heading text-xl font-bold text-white uppercase tracking-widest">Sudo-Trash</span>
                </div>
                
                <p class="text-sm text-white font-medium">
                    &copy; {{ date('Y') }} Sistema de Limpieza Sudo-Trash. <span class="hidden sm:inline">|</span> Matamoros, Tamps.
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        });
    </script>
</body>
</html>