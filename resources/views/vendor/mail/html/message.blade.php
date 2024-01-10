@php
    use Bee\Notify\Helpers\ThemeHelper;
@endphp
<x-mail::layout>
{{-- Header --}}
<x-slot:header>
@component(ThemeHelper::getComponent('header'), ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
