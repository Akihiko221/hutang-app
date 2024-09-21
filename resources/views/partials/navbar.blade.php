    <nav class="bg-transparent p-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-3xl font-bold text-blue-500 fade-in-up">Hutang Manager</a>
            <div class="fade-in-up">
                @if (Auth::check())
                    <span class="text-blue-500 mr-4">Hello, <span class="font-bold">{{ Auth::user()->name }}</span></span>
                    <form class="inline" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Login</a>
                    <a href="{{ route('register') }}"
                        class="ml-4 px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Register</a>
                @endif
            </div>
        </div>
    </nav>
