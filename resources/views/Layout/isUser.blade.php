<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Deacourse Laravel</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen">
    <div>
        {{-- <header>
            <nav class="bg-gray-800">
                <div class="max-w-full mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <div class="flex-1 px-10 flex items-center justify-center sm:items-stretch sm:justify-start">
                            <div class="flex-shrink-0 flex items-center">
                                <h1 class="text-2xl text-white">DeaCourse Laravel</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile menu -->
                <div class="sm:hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="/"
                            class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                            aria-current="page">Dashboard</a>
                    </div>
                </div>
            </nav>
        </header> --}}
        <div>
            @yield('content')
        </div>
    </div>
    <footer class="py-5 mt-auto w-full text-center bg-gray-800 text-white bottom-0">&copy; Made with ❤️ | whisnuys
    </footer>
</body>

</html>
