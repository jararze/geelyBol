@php($name = $field->name)
@php($options = is_array($field->options) ? $field->options : [])
@php($isLive = in_array($field->name, $liveFieldNames ?? [], true))
<label class="block text-sm font-medium text-gray-700">
    {{ $field->label }}@if($field->is_required) <span class="text-red-500">*</span>@endif
</label>
<select
    wire:model{{ $isLive ? '.live' : '.defer' }}="data.{{ $name }}"
    class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('data.' . $name) border-red-500 @enderror"
>
    <option value="">{{ $field->placeholder ?: 'Selecciona...' }}</option>
    @foreach ($options as $opt)
        @php($val = is_array($opt) ? ($opt['value'] ?? null) : $opt)
        @php($lbl = is_array($opt) ? ($opt['label'] ?? $val) : $opt)
        <option value="{{ $val }}">{{ $lbl }}</option>
    @endforeach
</select>
@if ($field->help_text)
    <p class="mt-1 text-xs text-gray-500">{{ $field->help_text }}</p>
@endif
