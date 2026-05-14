@php($name = $field->name)
@php($options = is_array($field->options) ? $field->options : [])
<label class="block text-sm font-medium text-gray-700">
    {{ $field->label }}@if($field->is_required) <span class="text-red-500">*</span>@endif
</label>
<select
    wire:model.defer="data.{{ $name }}"
    multiple
    size="{{ min(6, max(3, count($options))) }}"
    class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('data.' . $name) border-red-500 @enderror"
>
    @foreach ($options as $opt)
        @php($val = is_array($opt) ? ($opt['value'] ?? null) : $opt)
        @php($lbl = is_array($opt) ? ($opt['label'] ?? $val) : $opt)
        <option value="{{ $val }}">{{ $lbl }}</option>
    @endforeach
</select>
<p class="mt-1 text-xs text-gray-500">Mantén presionado Ctrl/Cmd para seleccionar varias opciones.</p>
@if ($field->help_text)
    <p class="mt-1 text-xs text-gray-500">{{ $field->help_text }}</p>
@endif
