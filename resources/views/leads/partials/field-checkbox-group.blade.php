@php($name = $field->name)
@php($options = is_array($field->options) ? $field->options : [])
<fieldset>
    <legend class="block text-sm font-medium text-gray-700">
        {{ $field->label }}@if($field->is_required) <span class="text-red-500">*</span>@endif
    </legend>
    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2">
        @foreach ($options as $opt)
            @php($val = is_array($opt) ? ($opt['value'] ?? null) : $opt)
            @php($lbl = is_array($opt) ? ($opt['label'] ?? $val) : $opt)
            <label class="flex items-start text-sm text-gray-700">
                <input
                    type="checkbox"
                    wire:model.defer="data.{{ $name }}"
                    value="{{ $val }}"
                    class="mt-0.5 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                >
                <span class="ml-2">{{ $lbl }}</span>
            </label>
        @endforeach
    </div>
    @if ($field->help_text)
        <p class="mt-1 text-xs text-gray-500">{{ $field->help_text }}</p>
    @endif
</fieldset>
