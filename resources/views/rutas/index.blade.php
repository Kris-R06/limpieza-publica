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
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Rutas de Limpieza Pública</h1>
            <a href="{{ route('rutas.create') }}" class="inline-block mb-4 bg-eco hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors shadow-sm">Agregar Nueva Ruta</a>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Listado de Rutas</h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Aquí puedes ver todas las rutas de limpieza pública registradas en el sistema.</p>
                </div>
                <div class="border-t border-gray-200 ">
                    <table class="min-w-full divide-y divide-gray-200 ">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número de Ruta</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($rutas as $ruta)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ruta->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ruta->numero }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                    <div class="inline-flex items-center gap-4">
                                        <a href="{{ route('rutas.edit', $ruta->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                        <form action="{{ route('rutas.destroy', $ruta->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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