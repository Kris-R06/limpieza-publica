<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRegistro | Sistema de Limpieza Pública</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        eco: {
                            light: '#f0fdf4', // green-50
                            DEFAULT: '#16a34a', // green-600
                            dark: '#14532d', // green-900
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold text-eco flex items-center gap-2">
                        <svg class="w-8 h-8 text-eco" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        EcoRegistro
                    </a>
                </div>

                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-eco px-3 py-2 rounded-md text-sm font-medium transition-colors">Inicio</a>
                    <a href="{{ route('login') }}" class="bg-eco hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors shadow-sm">Login</a>
                </nav>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-600 hover:text-eco focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-eco hover:bg-eco-light">Inicio</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-eco hover:bg-eco-light">Login</a>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        
        <section class="bg-eco-light py-12 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-12">
                
                <div class="lg:w-1/2 flex flex-col justify-center space-y-6 text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                        Gestión inteligente para una <span class="text-eco">ciudad más limpia</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600">
                        El sistema centralizado de registro de recolección, mantenimiento y monitoreo de limpieza pública. Optimiza rutas, reporta incidencias y ayuda a mantener el entorno verde.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <button class="bg-eco hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition-all">
                            Comenzar ahora
                        </button>
                        <button class="bg-white hover:bg-gray-50 text-eco border border-eco font-semibold py-3 px-8 rounded-lg shadow-sm transition-all">
                            Saber más
                        </button>
                    </div>
                </div>

                <div class="lg:w-1/2 w-full">
                    <img 
                        src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                        alt="Camión de limpieza pública ecológico" 
                        class="rounded-xl shadow-2xl object-cover w-full h-[400px]"
                    >
                    </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">¿Por qué usar EcoRegistro?</h2>
                    <p class="mt-4 text-lg text-gray-600">Herramientas diseñadas para facilitar el trabajo de los operarios y supervisores.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-14 h-14 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4 text-eco">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Registro Preciso</h3>
                        <p class="text-gray-600">Lleva el control exacto del tonelaje, zonas atendidas y horarios de los camiones recolectores.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-14 h-14 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4 text-eco">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Mapeo de Rutas</h3>
                        <p class="text-gray-600">Visualiza en tiempo real las áreas de cobertura y optimiza los trayectos para ahorrar combustible.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-14 h-14 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4 text-eco">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Gestión de Personal</h3>
                        <p class="text-gray-600">Administra turnos, reportes de cuadrillas y asignación de vehículos de forma rápida y sencilla.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-eco-dark text-white py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <span class="text-2xl font-bold flex items-center gap-2 mb-4">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    EcoRegistro
                </span>
                <p class="text-green-200 text-sm">
                    Mejorando la logística de limpieza pública para garantizar espacios urbanos limpios, saludables y sostenibles para todos.
                </p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4 text-white">Enlaces Rápidos</h4>
                <ul class="space-y-2 text-sm text-green-200">
                    <li><a href="#" class="hover:text-white transition-colors">Inicio</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Acerca del Sistema</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Soporte Técnico</a></li>
                    <li><a href="#login" class="hover:text-white transition-colors">Acceso Operadores</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4 text-white">Contacto</h4>
                <ul class="space-y-2 text-sm text-green-200">
                    <li>Teléfono: (555) 123-4567</li>
                    <li>Email: soporte@ecoregistro.gob</li>
                    <li>Atención: Lunes a Viernes, 8am - 6pm</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-8 border-t border-green-800 text-center text-sm text-green-300">
            &copy; 2026 Sistema de Registro de Limpieza Pública. Todos los derechos reservados.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                // Alterna la clase 'hidden' para mostrar/ocultar el menú
                menu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>