<a href="{{ route('home') }}">Home</a> || <a href="{{ route('about') }}">About</a> || <a
    href="{{ route('login') }}">login</a> || <a href="{{ route('registration') }}">Register</a>
<h1>home page</h1>


<div class="container mx-auto p-4">
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Registration</h1>

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

        <form method="POST" action="{{ route('registration_submit') }}"
            class="bg-white p-6 rounded border border-gray-300">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
              <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

             <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password"
                    class="w-full px-3 py-2 border border-gray-300 rounded" required>
                @error('confirm_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
               Register
            </button>

        </form>
    </div>
</div>
