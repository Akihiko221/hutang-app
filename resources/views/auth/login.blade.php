@extends('auth.layoutsAuth')

@section('authentication')
    <div class="flex items-center justify-center min-h-screen bg-blue-100">
        <div class="w-full max-w-md">
            <div
                class="bg-white shadow-lg rounded-lg px-8 py-6 transition-transform duration-500 ease-in-out transform hover:scale-105">
                <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Login</h2>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-500 p-4 rounded mb-4">
                        <strong>Error!</strong> {{ $errors->first('email') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mt-4">
                        <label for="email" class="block text-blue-600 font-semibold">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-2 mt-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"
                            value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-blue-600 font-semibold">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 mt-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"
                            required>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <!-- Tombol dengan animasi transisi dan bayangan -->
                        <button
                            class="px-6 py-3 text-white bg-blue-300 hover:bg-blue-400 hover:shadow-lg rounded-md focus:outline-none focus:bg-blue-400 transition duration-300 ease-in-out transform hover:scale-105">
                            Login
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-sm text-center text-black">
                    Don't have an account? <a href="{{ route('register') }}"
                        class="text-blue-500 hover:underline transition duration-300 ease-in-out">Register</a>
                </p>
            </div>
        </div>
    </div>
@endsection
