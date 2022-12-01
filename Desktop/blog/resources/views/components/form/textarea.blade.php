@props(['name'])

<x-form.margindiv>
    <x-form.label name="{{ $name }}"/>

    <textarea class="border border-gray-200 p-2 w-full w-full rounded"
              name="{{ $name }}"
              id="{{ $name }}"
              required
              {{ $attributes }}
    >{{ $slot ?? old($name) }}</textarea>

    <x-form.error name="{{ $name }}"/>
</x-form.margindiv>
