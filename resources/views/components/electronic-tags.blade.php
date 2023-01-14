@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv);
@endphp

<div class=" gap-2 d-flex justify-content-center my-4">
  @foreach($tags as $tag)
    <a class="btn btn-outline-primary m-1 rounded-pill" href="/?tag={{$tag}}">{{$tag}}</a>
  @endforeach
</div>
