@props(['trigger'])

<div class="dropdown">
    {{-- Trigger --}}

        {{ $trigger }}

    {{-- Links --}}
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        {{ $slot }}
    </div>
</div>
