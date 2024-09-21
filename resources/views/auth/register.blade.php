@extends('auth.layoutsAuth')

@section('authentication')
    <div class="flex items-center justify-center min-h-screen bg-blue-100">
        <div class="w-full max-w-md">
            <div
                class="bg-white shadow-lg rounded-lg px-8 py-6 transition-transform duration-500 ease-in-out transform hover:scale-105">
                <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Register</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mt-4">
                        <label for="name" class="block text-blue-600 font-semibold">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-2 mt-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"
                            value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block text-blue-600 font-semibold">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-2 mt-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-blue-600 font-semibold">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 mt-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"
                            required>
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-blue-600 font-semibold">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2 mt-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"
                            required>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <!-- Tombol dengan animasi transisi dan bayangan -->
                        <button
                            class="px-6 py-3 text-white bg-blue-300 hover:bg-blue-400 hover:shadow-lg rounded-md focus:outline-none focus:bg-blue-400 transition duration-300 ease-in-out transform hover:scale-105">
                            Register
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-sm text-center text-blue-600">
                    Already have an account? <a href="{{ route('login') }}"
                        class="text-blue-500 hover:underline transition duration-300 ease-in-out">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection
