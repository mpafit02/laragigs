@props(['tagsCsv'])

@php
    // Turn the comma separated string in to a list of tags 
    $tags = explode(',', $tagsCsv);
@endphp
<ul class="flex">
    @foreach ($tags as $tag)
    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <!-- The href will be the axisting url (that'r why we use the "?") plus the tag value -->
        <a href="/?tag={{$tag}}">{{$tag}}</a>
    </li>
    @endforeach
</ul>