

<body>
    <div class="container mx-auto p-4">
        <div class="max-w-md mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-6">Forgot Password</h1>

            <p class="text-gray-600 mb-4">Enter your email address and we'll send you a link to reset your password.</p>

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

            <form method="POST" action="{{ route('forgot_password_submit') }}" class="bg-white p-6 rounded border border-gray-300">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded" placeholder="admin@example.com" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Send Reset Link
                </button>

                <div class="mt-4">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 text-sm">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

