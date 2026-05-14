@php($name = $field->name)
<input type="hidden" wire:model.defer="data.{{ $name }}">
