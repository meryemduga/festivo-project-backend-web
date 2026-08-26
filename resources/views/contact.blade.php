<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contact Opnemen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
            @if(session('success'))
                <div class="mb-4 text-green-600 font-bold bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-medium">Naam</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">E-mailadres</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Bericht</label>
                    <textarea name="message" rows="5" class="w-full border rounded p-2" required></textarea>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Verzenden</button>
            </form>
        </div>
    </div>
</x-app-layout>