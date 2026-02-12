<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | E-LEARN</title>
    
</head>
<body class="bg-black min-h-screen flex items-center justify-center p-6 text-white">

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <span class="bg-blue-600 text-white px-3 py-1 font-bold tracking-widest uppercase rounded-lg">E-Learn</span>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-green-900/50 border border-green-700 text-green-300 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 rounded-xl bg-red-900/50 border border-red-700 text-red-300 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="mb-4 p-4 rounded-xl bg-blue-900/50 border border-blue-700 text-blue-300 text-sm text-center">
                {{ session('info') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 rounded-xl bg-red-900/50 border border-red-700 text-red-300 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-zinc-950 border border-zinc-800 p-8 rounded-3xl shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">@yield('title')</h2>

            <!-- Form -->
            @yield('form') 

            <!-- Footer -->
            <div class="mt-6 text-center text-gray-400">
                @yield('footer')
            </div>
        </div>
    </div>

</body>
</html>
