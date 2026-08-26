<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profiel Bewerken</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('profile.custom-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Gebruikersnaam</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Geboortedatum</label>
                    <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Bio</label>
                    <textarea name="bio" class="w-full border rounded p-2">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Profielfoto</label>
                    <input type="file" name="profile_picture" class="w-full border rounded p-2">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
            </form>
        </div>
    </div>
</x-app-layout>