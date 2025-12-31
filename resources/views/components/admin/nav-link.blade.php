@props(['route', 'label', 'icon'])

@php
    $isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
          {{ $isActive
                ? 'bg-slate-800 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
          }}">
    <span class="text-lg leading-none">{{ $icon }}</span>
    <span>{{ $label }}</span>
</a>
