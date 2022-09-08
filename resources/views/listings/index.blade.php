{{-- Do this if you have the layout.blade.php in the resources/views/ folder --}}
{{-- We want our views to extent the layout.blade.php, anything in the head (e.g., stylesheet) --}}
{{-- @extends('layout') --}}

{{-- Whatever is in the @section(...) should match the content of the @yield(...) in the layout.blade.php, in our case it is the text 'content'  --}}
{{-- @section('content')  --}}
<x-layout>
{{-- Show the hero only in the listings page --}}
@include('partials._hero')

{{-- Show the search component --}}
@include('partials._search')

{{-- <h1>{{$heading}}</h1> --}}
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
{{-- You can do this --}}
{{-- @if(count($listings) == 0)
<p> No listings founds </p>
@endif

@foreach ($listings as $listing)

@php
    $new_id = $listing['id'] + 100;
    // Do some processing
@endphp
Listing with new id: {{$new_id}}

<h2>{{$listing['title']}}</h2>
<p>{{$listing['description']}}</p>
@endforeach --}}

{{-- Or you can do this --}}
@unless (count($listings) == 0)
    
@foreach ($listings as $listing)

{{-- @php
    $new_id = $listing['id'] + 100;
    // Do some processing
@endphp
Listing with new id: {{$new_id}} --}}

{{-- <h2><a href="/listings/{{$listing['id']}}"> {{$listing['title']}} </a></h2>
<p>{{$listing['description']}}</p> --}}

{{-- Use the component listing-card --}}
<x-listing-card :listing="$listing"/>

@endforeach

@else
<p> No listings founds </p>

@endunless

</div>
<div class="mt-6 p-4">{{$listings->links()}}</div>
</x-layout>
{{-- Do this if you have the layout.blade.php in the resources/views/ folder --}}
{{-- @endsection --}}