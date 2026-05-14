@php($name = $field->name)
<label class="block text-sm font-medium text-gray-700">
    {{ $field->label }}@if($field->is_required) <span class="text-red-500">*</span>@endif
</label>
<textarea
    wire:model.defer="data.{{ $name }}"
    rows="4"
    @if($field->placeholder) placeholder="{{ $field->placeholder }}" @endif
    class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('data.' . $name) border-red-500 @enderror"
></textarea>
@if ($field->help_text)
    <p class="mt-1 text-xs text-gray-500">{{ $field->help_text }}</p>
@endif
