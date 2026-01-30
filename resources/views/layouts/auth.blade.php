<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Authentication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-gray-100 antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tighter text-indigo-500">E-LEARN</h1>
        </div>

        @yield('content')

    </div>

</body>
</html>