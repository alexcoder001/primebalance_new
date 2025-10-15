@props(['active' => false])

<a class="{{ $active ? 'nav-link active rounded-3' : 'nav-link rounded-3'}}" aria-current="{{ $active ? 'page' : 'false'}}" {{ $attributes }}>
    {{ $slot }}
</a>
