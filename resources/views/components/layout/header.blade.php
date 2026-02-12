<header 
class="flex items-center justify-between px-6 py-4 
       bg-[#0A192F] border-b border-[#1C2A3A] 
       sticky top-0 z-30 backdrop-blur-sm"
x-data="{ 
    searchMobileOpen: false, 
    profileModal: {{ $errors->any() ? 'true' : 'false' }},
    password: '',
    password_confirmation: '',
    get passwordsMatch() { 
        if(this.password === '' && this.password_confirmation === '') return true;
        return this.password === this.password_confirmation;
    }
}">

    <!-- LEFT -->
    <div class="flex items-center gap-4 flex-1">

        <button @click="toggleSidebar()" 
            class="p-2 text-[#9FB3C8] rounded-lg hover:bg-[#020C1B] hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="hidden sm:flex items-center text-sm text-[#9FB3C8]">
            <span class="opacity-60">Pages</span>
            <span class="mx-2 opacity-40">/</span>
            <span class="font-semibold text-white">Dashboard</span>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.instructors.create') }}"
                   class="hidden md:flex items-center gap-2 px-4 py-2 
                          text-sm font-semibold rounded-lg
                          bg-[#22C55E] text-[#020C1B]
                          hover:bg-emerald-400 transition shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Instructor
                </a>
            @endif

            <!-- PROFILE BUTTON -->
            <button @click="profileModal = true"
                class="flex items-center gap-3 group">

                <div class="hidden md:flex flex-col text-right leading-tight">
                    <p class="text-sm font-semibold text-white">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-[#9FB3C8] capitalize">
                        {{ auth()->user()->role }}
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full 
                            bg-gradient-to-tr from-[#22C55E] to-emerald-400
                            p-[2px] group-hover:scale-105 transition">
                    <div class="w-full h-full rounded-full 
                                bg-[#0A192F] overflow-hidden">
                        <img
                            src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0A192F&color=22C55E' }}"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </button>
        @endauth

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                class="group relative flex items-center justify-center
                       w-10 h-10 rounded-xl
                       bg-[#020C1B] border border-[#1C2A3A]
                       text-[#9FB3C8]
                       hover:text-red-400 hover:border-red-400
                       transition-all duration-300"
                title="Logout">

                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </form>

    </div>

    <!-- PROFILE MODAL -->
    <template x-teleport="body">
        <div x-show="profileModal"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4"
             x-cloak>

            <!-- Overlay -->
            <div @click="profileModal = false"
                 class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

            <!-- Modal Card -->
            <div x-show="profileModal"
                 x-transition.scale.95
                 class="relative w-full max-w-lg
                        bg-[#0A192F]
                        border border-[#1C2A3A]
                        rounded-2xl shadow-2xl">

                <!-- Header -->
                <div class="p-6 border-b border-[#1C2A3A] flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white">
                        Admin Profile
                    </h2>
                    <button @click="profileModal = false"
                        class="text-[#9FB3C8] hover:text-white transition">
                        ✕
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center gap-3">
                        <img id="modalPreview"
                             src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0A192F&color=22C55E' }}"
                             class="w-20 h-20 rounded-full border-2 border-[#22C55E] object-cover">

                        <input type="file"
                               name="profile_image"
                               onchange="previewImage(this)"
                               class="text-xs text-[#9FB3C8] cursor-pointer">
                    </div>

                    <div>
                        <label class="text-xs uppercase text-[#9FB3C8]">Full Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full mt-1 px-4 py-2
                                      bg-[#020C1B]
                                      border border-[#1C2A3A]
                                      rounded-lg text-white
                                      focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E] outline-none">
                    </div>

                    <div>
                        <label class="text-xs uppercase text-[#9FB3C8]">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full mt-1 px-4 py-2
                                      bg-[#020C1B]
                                      border border-[#1C2A3A]
                                      rounded-lg text-white
                                      focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E] outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs uppercase text-[#9FB3C8]">New Password</label>
                            <input type="password"
                                   name="password"
                                   x-model="password"
                                   class="w-full mt-1 px-4 py-2 bg-[#020C1B] border border-[#1C2A3A] rounded-lg text-white">
                        </div>

                        <div>
                            <label class="text-xs uppercase text-[#9FB3C8]">Confirm</label>
                            <input type="password"
                                   name="password_confirmation"
                                   x-model="password_confirmation"
                                   class="w-full mt-1 px-4 py-2 bg-[#020C1B] border border-[#1C2A3A] rounded-lg text-white">
                        </div>
                    </div>

                    <p x-show="!passwordsMatch"
                       class="text-red-400 text-xs font-semibold">
                        Passwords do not match.
                    </p>

                    <div class="pt-4 border-t border-[#1C2A3A] flex justify-end gap-3">
                        <button type="button"
                                @click="profileModal = false"
                                class="text-[#9FB3C8] hover:text-white text-sm">
                            Cancel
                        </button>

                        <button type="submit"
                                :disabled="!passwordsMatch"
                                class="px-6 py-2 bg-[#22C55E]
                                       text-[#020C1B] font-semibold rounded-lg
                                       hover:bg-emerald-400
                                       disabled:opacity-50 transition">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </template>

</header>
