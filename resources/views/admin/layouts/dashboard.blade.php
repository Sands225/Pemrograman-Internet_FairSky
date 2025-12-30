<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('css')

    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Poppins', 'sans-serif'],
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        {{-- Main Content --}}
        <main class="flex-1 ml-64 p-8">
            @yield('content')
        </main>

    </div>
</body>
</html>
