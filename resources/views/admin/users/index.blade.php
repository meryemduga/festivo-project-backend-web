<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gebruikersbeheer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-700 font-bold rounded shadow">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="p-4 bg-red-100 text-red-700 font-bold rounded shadow">{{ session('error') }}</div>
            @endif

            <!-- FORMULIER: Manueel nieuwe gebruiker aanmaken -->
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">Manueel nieuwe gebruiker aanmaken</h3>
                <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                        <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex items-center space-x-2 pb-2">
                        <input type="checkbox" name="is_admin" value="1" id="is_admin" class="rounded border-gray-300 text-indigo-600 shadow-sm">
                        <label for="is_admin" class="text-sm font-medium text-gray-700">Maak direct Admin</label>
                    </div>
                    <div class="md:col-span-4">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm font-bold shadow hover:bg-green-700">
                            + Voeg gebruiker toe
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABEL: Overzicht bestaande gebruikers -->
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">Bestaande gebruikers</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Naam</th>
                            <th class="p-2">E-mail</th>
                            <th class="p-2">Rol</th>
                            <th class="p-2 text-right">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b">
                                <td class="p-2">{{ $user->name }} @if($user->username)({{ '@' . $user->username }})@endif</td>
                                <td class="p-2">{{ $user->email }}</td>
                                <td class="p-2">
                                    <span class="px-2 py-1 text-xs rounded {{ $user->is_admin ? 'bg-purple-200 text-purple-800' : 'bg-gray-200 text-gray-800' }}">
                                        {{ $user->is_admin ? 'Admin' : 'Gebruiker' }}
                                    </span>
                                </td>
                                <td class="p-2 text-right space-x-2 flex justify-end items-center">
                                    <!-- Promote / Demote -->
                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs bg-indigo-600 text-white px-3 py-1 rounded shadow">
                                            {{ $user->is_admin ? 'Demote' : 'Promote' }}
                                        </button>
                                    </form>

                                    <!-- Delete -->
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-600 text-white px-3 py-1 rounded shadow">
                                                Verwijder
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>