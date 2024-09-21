<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hutang Web</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom keyframes for animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in-up {
            animation: fadeInUp 1s ease-out;
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>

<body class="bg-white text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('partials.navbar')

    {{-- Masuknya Content Utama --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

</body>

</html>
