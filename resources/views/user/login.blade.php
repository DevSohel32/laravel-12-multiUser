<div class="container mx-auto p-4">
        <div class="max-w-md mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-6">User Login</h1>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login_submit') }}" class="bg-white p-6 rounded border border-gray-300">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-gray-700">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </button>

                <div class="mt-4">
                    <a href="{{ route('forgot_password') }}" class="text-blue-500 hover:text-blue-700 text-sm">Forgot Password?</a>
                    <a href="{{ route('registration') }}" class="text-blue-500 hover:text-blue-700 text-sm ml-4">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </div>
