@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#020C1B] px-6 py-12">
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Create Instructor
                </h1>
                <p class="text-[#9FB3C8] text-sm mt-2">
                    Register a new educator to the platform.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 text-sm font-medium text-[#9FB3C8] hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>

        <!-- Card -->
        <div class="bg-[#0A192F] border border-[#1C2A3A] rounded-2xl shadow-xl p-10">

            <form method="POST" action="{{ route('admin.instructors.store') }}">
                @csrf

                <div class="grid md:grid-cols-2 gap-10">

                    <!-- LEFT -->
                    <div class="space-y-7">

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-[#9FB3C8] mb-2">
                                Full Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="John Doe"
                                required
                                class="w-full px-4 py-3 rounded-xl
                                       bg-[#020C1B] border border-[#1C2A3A]
                                       text-white placeholder-[#9FB3C8]
                                       focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]
                                       outline-none transition"
                            >
                            @error('name')
                                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-[#9FB3C8] mb-2">
                                Email Address
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="instructor@example.com"
                                required
                                class="w-full px-4 py-3 rounded-xl
                                       bg-[#020C1B] border border-[#1C2A3A]
                                       text-white placeholder-[#9FB3C8]
                                       focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]
                                       outline-none transition"
                            >
                            @error('email')
                                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="space-y-7">

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-[#9FB3C8] mb-2">
                                Password
                                <span class="text-xs text-[#9FB3C8]/60 italic">
                                    (auto-generated if left blank)
                                </span>
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                class="w-full px-4 py-3 rounded-xl
                                       bg-[#020C1B] border border-[#1C2A3A]
                                       text-white placeholder-[#9FB3C8]
                                       focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]
                                       outline-none transition"
                            >
                            @error('password')
                                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="mt-12 pt-8 border-t border-[#1C2A3A] flex flex-col sm:flex-row justify-between items-center gap-6">

                    <p class="text-xs text-[#9FB3C8]">
                        New instructors will receive an email invitation.
                    </p>

                    <button type="submit"
                        class="px-8 py-3 bg-[#22C55E]
                               text-[#020C1B] font-semibold text-sm
                               rounded-xl shadow-lg
                               hover:bg-emerald-400
                               transition-all duration-200">
                        Create Instructor
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection
