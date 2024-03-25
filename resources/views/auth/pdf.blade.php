<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devstagram - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ public_path('resources/css/app.css') }}" type="text/css">
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            padding: 20px 0;
            border-bottom: 1px solid #e5e7eb;
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            font-weight: 700;
        }

        .text-4xl {
            font-size: 24px;
            /* Ajustar según sea necesario */
        }

        .text-3xl {
            font-size: 18px;
            /* Ajustar según sea necesario */
        }

        .text-sm {
            font-size: 14px;
        }

        .font-bold {
            font-weight: bold;
        }

        .bg-white {
            background-color: #fff;
        }

        .border {
            border: 1px solid #e5e7eb;
        }

        .rounded-lg {
            border-radius: 8px;
        }

        .shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        }

        .p-5 {
            padding: 20px;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .mt-10 {
            margin-top: 40px;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .bg-red-500,
        .border-red-500 {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .text-white {
            color: #fff;
        }

        .bg-sky-600 {
            background-color: #0284c7;
        }

        /* Ajuste para el hover - como DomPDF no soporta :hover, definimos un color estático */
        .hover\:bg-sky-700:hover,
        .bg-sky-600 {
            background-color: #0369a1;
        }

        /* Si es posible, convertir las clases md: a reglas de media query si necesitas responsividad */
        @media screen and (min-width: 768px) {
            .md\\:w-4\\/12 {
                width: 33.333333%;
            }
        }

        /* Asegúrate de definir todas las clases utilizadas, incluso si no cambian el diseño predeterminado, para garantizar la consistencia */
    </style>
</head>

<body>
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold">
                DevStagram
            </h1>

            @auth
                <nav class="flex gap-2 items-center">
                    <a class=" font-bold text-gray-600 text-sm" href="#">Hola: <span
                            class="font-normal">{{ auth()->user()->username }}</span></a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="uppercase font-bold text-gray-600 text-sm">Cerrar Sesión</button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a class="uppercase font-bold text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="uppercase font-bold text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                </nav>
            @endguest

        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            Inicia Sesión en DevStagram
        </h2>
        <div class="md:flex md:justify-center md:gap-4 md:items-center">
            <div class="md:w-4/12">
                <img src="{{ public_path('img/login.jpg') }}" alt="Imagen login">
            </div>
            <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf
                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ session('mensaje') }}</p>
                    @endif
                    <div class="mb-5">
                        <div class="mb-5">
                            <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo
                                Electrónico</label>
                            <input type="email" id="email" name="email" placeholder="Tu correo electrónico"
                                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                                value={{ old('email') }}>
                            @error('email')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="password"
                                class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                            <input type="password" id="password" name="password" placeholder="Tu contraseña"
                                class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <input type="checkbox" name="remember" id="remember"> <label
                                class="text-sm  text-gray-500">Mantener mi sesión abierta</label>
                        </div>
                        <input type="submit" value="Iniciar Sesión"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                        <a href="{{ route('login.pdf') }}"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">PDF</a>

                </form>
            </div>
        </div>
    </main>
    <footer class="text-center p-5 text-gray-500 font-bold mt-10">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>
</body>

</html>
