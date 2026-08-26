<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gebruikersbeheer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            @if(session('success'))
                <div class="mb-4 text-green-600 font-bold">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 text-red-600 font-bold">{{ session('error') }}</div>
            @endif

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="p-2">Naam</th>
                        <th class="p-2">E-mail</th>
                        <th class="p-2">Rol</th>
                        <th class="p-2">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b">
                            <td class="p-2">{{ $user->name }} ({{ '@' . $user->username }})</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2">
                                <span class="px-2 py-1 text-xs rounded {{ $user->is_admin ? 'bg-purple-200 text-purple-800' : 'bg-gray-200 text-gray-800' }}">
                                    {{ $user->is_admin ? 'Admin' : 'Gebruiker' }}
                                </span>
                            </td>
                            <td class="p-2">
                                <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-xs bg-indigo-600 text-white px-3 py-1 rounded">
                                        {{ $user->is_admin ? 'Demote naar Gebruiker' : 'Maak Admin' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ontvangen Contactberichten</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow space-y-4">
            @forelse($messages as $msg)
                <div class="border-b pb-4">
                    <div class="flex justify-between font-bold">
                        <span>{{ $msg->name }} ({{ $msg->email }})</span>
                        <span class="text-xs text-gray-500">{{ $msg->created_at->format('d-m-Y H:i') }}</span>
                    </div>
                    <p class="text-gray-700 mt-2">{{ $msg->message }}</p>
                </div>
            @empty
                <p class="text-gray-500">Nog geen berichten ontvangen.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>