@if($user->profile_picture)
    <div class="mb-4">
        <p class="text-sm text-gray-600 mb-2">Huidige Profielfoto:</p>
        <img src="{{ Storage::url($user->profile_picture) }}" alt="Profielfoto" class="w-24 h-24 rounded-full object-cover border">
    </div>
@endif