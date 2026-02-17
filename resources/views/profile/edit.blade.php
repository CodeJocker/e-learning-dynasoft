@extends('layouts.student')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold mb-6">Edit Your Profile</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
                    </div>
                    <input type="file" name="avatar" accept="image/*" class="block">
                </div>
                @error('avatar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Bio -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                <textarea name="bio" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                @error('bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Skills -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Skills (comma-separated)</label>
                <input type="text" name="skills" value="{{ old('skills', implode(', ', $user->profile->skills ?? [])) }}" placeholder="e.g. Python, JavaScript, Design" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                @error('skills') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Privacy Setting -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Privacy</label>
                <select name="privacy_setting" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                    <option value="public" {{ old('privacy_setting', $user->profile->privacy_setting ?? 'public') == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="friends" {{ old('privacy_setting', $user->profile->privacy_setting ?? 'public') == 'friends' ? 'selected' : '' }}>Friends Only</option>
                    <option value="private" {{ old('privacy_setting', $user->profile->privacy_setting ?? 'public') == 'private' ? 'selected' : '' }}>Private</option>
                </select>
                @error('privacy_setting') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4 pt-4 border-t">
                <button type="submit" class="flex-1 bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">Save Changes</button>
                <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
