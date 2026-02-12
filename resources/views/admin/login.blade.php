<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Learn Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-primary text-primary">

    <div class="w-full max-w-md surface-card border border-subtle rounded-2xl shadow-xl p-8">
        
        {{-- Title --}}
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-accent">E-Learn</h1>
            <p class="text-sm text-secondary mt-1">
                Welcome to the Admin Dashboard
            </p>
        </div>

        {{-- Login Form --}}
        <form method="POST" action="{{ url('/admin/login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm mb-1 text-secondary">Email</label>
                <input
                    type="email"
                    name="email"
                    required
                    class="w-full px-4 py-2 rounded-lg surface-muted border border-subtle
                           focus:outline-none focus:ring-2 focus:ring-[color:var(--accent-primary)]"
                    placeholder="admin@example.com"
                >
                @error('email')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm mb-1 text-secondary">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 rounded-lg surface-muted border border-subtle
                           focus:outline-none focus:ring-2 focus:ring-[color:var(--accent-primary)]"
                    placeholder="••••••••"
                >
            </div>

            {{-- Button --}}
            <button
                type="submit"
                class="w-full py-2 rounded-lg bg-accent text-white font-medium
                       hover:opacity-90 transition"
            >
                Login
            </button>
        </form>

        {{-- Footer --}}
        <p class="text-center text-xs text-secondary mt-6">
            © {{ date('Y') }} E-Learn System
        </p>

    </div>

</body>
</html>
