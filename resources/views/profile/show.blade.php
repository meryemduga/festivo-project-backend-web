<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Profil Card / Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center space-x-6">
                    <!-- Avatar -->
                    <div class="w-24 h-24 bg-indigo-600 rounded-full flex items-center justify-center text-white text-3xl font-bold uppercase shadow-md">
                        {{ substr($user->username ?? $user->name ?? 'A', 0, 1) }}
                    </div>

                    <!-- User Info -->
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $user->username ?? $user->name }}</h1>
                            @if(isset($user->is_admin) && $user->is_admin)
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase">
                                    Administrator
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-500">{{ $user->email }}</p>
                        @if(isset($user->created_at))
                            <p class="text-xs text-gray-400">Lid sinds: {{ $user->created_at->format('d-m-Y') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Extra Info / Biografie & Opties -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Over de Beheerder</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $user->bio ?? 'Welkom op het profiel van de beheerder van Festivo. Vanaf hier beheer je alle evenementen, reacties en instellingen.' }}
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Snelle Acties</h2>
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700 transition">
                            Nieuw Event Aanmaken
                        </a>
                        <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition">
                            Alle Evenementen Bekijken
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
