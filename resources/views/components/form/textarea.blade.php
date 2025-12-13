@props([
    'name',
    'label',
    'rows' => 3,
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'xModel' => null
])

@php
    $inputClass = 'w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all';
@endphp

<div class="space-y-1">
    <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    
    <textarea 
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if($xModel) x-model="{{ $xModel }}" @endif
        class="{{ $inputClass }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    
    @error($name)
        <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
