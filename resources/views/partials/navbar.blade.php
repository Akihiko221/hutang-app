<nav class="bg-transparent p-4 md:p-6">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <a href="/" class="text-2xl md:text-3xl font-bold text-blue-500 fade-in-up mb-4 md:mb-0">Hutang Manager</a>
        <div class="flex items-center fade-in-up">
            @if (Auth::check())
                <span class="text-blue-500 text-sm md:text-base mr-2 md:mr-4">Hello, <span
                        class="font-bold">{{ Auth::user()->name }}</span></span>
                <form class="inline" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="px-3 md:px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out transform hover:scale-105 text-sm md:text-base">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-3 md:px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out transform hover:scale-105 text-sm md:text-base">Login</a>
                <a href="{{ route('register') }}"
                    class="ml-2 md:ml-4 px-3 md:px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md transition duration-300 ease-in-out transform hover:scale-105 text-sm md:text-base">Register</a>
            @endif
        </div>
    </div>
</nav>
