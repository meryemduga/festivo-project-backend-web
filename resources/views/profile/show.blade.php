<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profiel van {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profielfoto" class="w-32 h-32 rounded-full mb-4 object-cover">
                @else
                    <div class="w-32 h-32 bg-gray-200 rounded-full mb-4 flex items-center justify-center">Geen foto</div>
                @endif

                <h3 class="text-lg font-bold">{{ $user->name }} ({{ '@' . $user->username }})</h3>
                <p class="text-gray-600"><strong>Geboortedatum:</strong> {{ $user->birthday ?? 'Niet opgegeven' }}</p>
                <p class="mt-4"><strong>Over mij:</strong></p>
                <p class="text-gray-700">{{ $user->bio ?? 'Nog geen bio toegevoegd.' }}</p>

                @if(auth()->check() && auth()->id() === $user->id)
                    <a href="{{ route('profile.custom-edit') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded">Profiel Bewerken</a>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>