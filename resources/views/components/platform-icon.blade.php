@php
    $platform = str_contains($name, 'Cartões de recarga') ? 'gift-cards' : (str_contains($name, 'PlayStation') ? 'playstation' : (str_contains($name, 'Xbox') ? 'xbox' : (str_contains($name, 'Nintendo') ? 'nintendo' : 'pc')));
    $logo = match ($platform) {
        'playstation' => 'playstation.svg',
        'xbox' => 'xbox.svg',
        'nintendo' => 'nintendo-switch.svg',
        'gift-cards' => 'gift-cards.svg',
        default => 'windows-11.svg',
    };
@endphp
<span class="platform-icon platform-icon--{{ $platform }} {{ $class ?? '' }}" aria-hidden="true">
    <img src="{{ asset('images/platforms/'.$logo) }}" alt="" width="30" height="30">
</span>
