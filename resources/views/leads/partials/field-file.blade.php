@php($name = $field->name)
<label class="block text-sm font-medium text-gray-700">
    {{ $field->label }}@if($field->is_required) <span class="text-red-500">*</span>@endif
</label>
<input
    type="file"
    wire:model="data.{{ $name }}"
    class="mt-1 block w-full text-sm text-gray-700 file:mr-3 file:rounded-md file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 @error('data.' . $name) border-red-500 @enderror"
>
<div wire:loading wire:target="data.{{ $name }}" class="mt-1 text-xs text-blue-600">
    Subiendo...
</div>
@if ($field->help_text)
    <p class="mt-1 text-xs text-gray-500">{{ $field->help_text }}</p>
@endif
