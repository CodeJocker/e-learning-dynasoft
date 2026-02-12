<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Login | E-Learn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-gray-100 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tighter text-indigo-500">E-LEARN</h1>
        </div>

        <div class="w-full max-w-md bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-2xl">
            <h2 class="text-2xl font-bold text-center mb-2">Instructor Login</h2>
            <p class="text-gray-400 text-sm text-center mb-6">Access your instructor dashboard</p>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-900/20 border border-red-500 text-red-400 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('instructor.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm mb-1 text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm mb-1 text-gray-300">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 py-3 rounded-lg font-bold transition shadow-lg shadow-indigo-500/20">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center border-t border-gray-800 pt-4">
                <p class="text-sm text-gray-400">
                    Not an instructor? 
                    <a href="{{ route('student.auth.register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                        Register as Student
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
