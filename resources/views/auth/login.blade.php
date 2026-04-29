<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'sudo-Trash' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">


    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        eco: {
                            light: '#f0fdf4',
                            DEFAULT: '#16a34a',
                            dark: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-eco-light text-gray-800 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <main class="bg-white rounded-2xl shadow-xl flex w-full max-w-5xl overflow-hidden min-h-100vh">
        
        <section class="hidden md:block md:w-1/2 relative">
            <div class="absolute inset-0 bg-eco-dark/30 z-10 mix-blend-multiply"></div>
            <div class="absolute inset-0 z-20 flex flex-col justify-center px-10 text-white">
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <h2 class="text-3xl font-bold">Sudo-Trash</h2>
                </div>
                <h3 class="text-4xl font-extrabold mb-4 leading-tight">Únete al cambio verde.</h3>
                <p class="text-lg text-green-50">Gestiona, monitorea y optimiza la limpieza pública.</p>
            </div>
            <img 
                src="https://lirp.cdn-website.com/777d988b/dms3rep/multi/opt/recoleccion-de-basura-programada-seredecom-1920w.jpg" 
                alt="Ciudad limpia y ecológica" 
                class="absolute inset-0 w-full h-full object-cover z-0"
            >
            </section>

        <section class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center relative bg-white">
            
            <div id="login-view" class="w-full max-w-md mx-auto transition-opacity duration-300">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Bienvenido de nuevo</h2>
                    <p class="text-gray-500 mt-2">Ingresa tus credenciales para acceder al sistema</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required 
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors" 
                            placeholder="operador@gmail.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <a href="#" class="text-sm font-medium text-eco hover:text-green-700">¿Olvidaste tu contraseña?</a>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors" 
                            placeholder="••••••••">
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-eco hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-eco transition-colors">
                        Iniciar Sesión
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    ¿No tienes una cuenta? 
                    <button type="button" id="show-register" class="font-medium text-eco hover:text-green-700 focus:outline-none">Regístrate aquí</button>
                </p>
            </div>

            <div id="register-view" class="w-full max-w-md mx-auto hidden transition-opacity duration-300">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Crear Cuenta</h2>
                    <p class="text-gray-500 mt-2">Registra tus datos para operar en el sistema</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre(s)</label>
                        <input type="text" id="name" name="name" required 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors">
                    </div>

                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Apellidos</label>
                        <input type="text" id="lastname" name="lastname" required 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors">
                    </div>
                    <!---<div>
                        <label for="reg-materno" class="block text-sm font-medium text-gray-700">Apellido Materno</label>
                        <input type="text" id="reg-materno" name="apellidoMaterno" required 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors">
                    </div>--->

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" id="password" name="password" required 
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required 
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-eco focus:border-eco outline-none transition-colors">
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 mt-2 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-eco hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-eco transition-colors">
                        Registrarse
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    ¿Ya tienes una cuenta? 
                    <button type="button" id="show-login" class="font-medium text-eco hover:text-green-700 focus:outline-none">Inicia sesión</button>
                </p>
            </div>

        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginView = document.getElementById('login-view');
            const registerView = document.getElementById('register-view');
            
            const btnShowRegister = document.getElementById('show-register');
            const btnShowLogin = document.getElementById('show-login');

            // Mostrar Registro, Ocultar Login
            btnShowRegister.addEventListener('click', () => {
                loginView.classList.add('hidden');
                registerView.classList.remove('hidden');
                // Opcional: Pequeña animación (Fade in)
                registerView.classList.add('opacity-0');
                setTimeout(() => registerView.classList.remove('opacity-0'), 50);
            });

            // Mostrar Login, Ocultar Registro
            btnShowLogin.addEventListener('click', () => {
                registerView.classList.add('hidden');
                loginView.classList.remove('hidden');
                // Opcional: Pequeña animación (Fade in)
                loginView.classList.add('opacity-0');
                setTimeout(() => loginView.classList.remove('opacity-0'), 50);
            });
        });
    </script>
</body>
</html>