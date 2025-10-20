<!-- Shared Best Contact Times options -->
@php
// If the current Livewire property exists and contains a value not present in the
// standard list, render it as a selected option so the UI reflects saved state.
$current = null;
try {
if (isset($best_contact_times)) {
$current = $best_contact_times;
} elseif (isset($this) && property_exists($this, 'best_contact_times')) {
$current = $this->best_contact_times;
}
} catch (\Throwable $e) {
$current = null;
}
$options = [
'weekdays-am' => __('Weekdays AM'),
'weekdays-pm' => __('Weekdays PM'),
'weekends-am' => __('Weekends AM'),
'weekends-pm' => __('Weekends PM'),
'friday-only' => __('Friday Only'),
'saturday-only' => __('Saturday Only'),
'sunday-only' => __('Sunday Only'),
'anytime' => __('Anytime'),
];
@endphp

@if($current && ! array_key_exists($current, $options))
<option value="{{ $current }}">{{ __('Saved.') ?? 'Saved:' }} {{ $current }}</option>
@endif

@foreach($options as $value => $label)
<option value="{{ $value }}">{{ $label }}</option>
@endforeach