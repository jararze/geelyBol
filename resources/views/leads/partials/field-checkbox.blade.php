@php($name = $field->name)
<label class="flex items-start text-sm text-gray-700">
    <input
        type="checkbox"
        wire:model.defer="data.{{ $name }}"
        class="mt-0.5 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 @error('data.' . $name) border-red-500 @enderror"
    >
    <span class="ml-2">
        {{ $field->label }}@if($field->is_required) <span class="text-red-500">*</span>@endif
    </span>
</label>
@if ($field->help_text)
    <p class="mt-1 text-xs text-gray-500 pl-6">{{ $field->help_text }}</p>
@endif
