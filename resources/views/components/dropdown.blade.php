@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white', 'dropdownClasses' => ''])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    'none', 'false' => '',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    '60' => 'w-60',
    default => 'w-48',
};

$dropdownId = 'dropdown-' . uniqid();
@endphp

<div class="relative">
    <div onclick="toggleDropdownMenu('{{ $dropdownId }}')">
        {{ $trigger }}
    </div>

    <div id="{{ $dropdownId }}" class="hidden absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }} {{ $dropdownClasses }}">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

<script>
function toggleDropdownMenu(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
    dropdowns.forEach(dropdown => {
        if (!dropdown.closest('.relative').contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
});
</script>
