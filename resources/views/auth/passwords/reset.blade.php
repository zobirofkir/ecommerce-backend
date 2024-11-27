<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('app.name') }} - Reset Password</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-8 bg-white rounded shadow-lg">
        <h1 class="mb-6 text-2xl font-bold text-center">Reset Password</h1>

        {{-- Display Success Message --}}
        @if(session('status'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('status') }}
            </div>
        @endif

        {{-- Display Error Messages --}}
        @if($errors->any())
            <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ request()->token }}">

            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email', request()->get('email')) }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-300 focus:outline-none">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">New Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-300 focus:outline-none">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-gray-300 focus:outline-none">
                @error('password_confirmation')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:outline-none">
                    Reset Password
                </button>
            </div>
        </form>
    </div>

</body>
</html>
