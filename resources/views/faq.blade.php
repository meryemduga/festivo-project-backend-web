<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Veelgestelde Vragen (FAQ)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($categories as $category)
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-bold text-indigo-600 mb-4">{{ $category->name }}</h3>
                    <div class="space-y-4">
                        @foreach($category->items as $item)
                            <div class="border-b pb-2">
                                <h4 class="font-semibold text-gray-800">Q: {{ $item->question }}</h4>
                                <p class="text-gray-600 mt-1">A: {{ $item->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Geen FAQ items gevonden.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
