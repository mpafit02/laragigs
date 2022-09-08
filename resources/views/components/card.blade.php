{{-- This is a card component, we can wrap anything with this design --}}
{{-- It will use those attributes by default, but if we pass any of these attributes e.g., <x-card class="p-20"></x-card> it will use the update attribute value --}}
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}
</div>