
@extends('templates/main')

@section('header')
    
@endsection
@section('container')
    {{-- @dd($posts) --}}
    
<div class="container mt-5">
    @foreach ($posts as $post)
    <h1>{!! $post->identity_name !!}</h1>
    <div class="row mt-5">
        {!! $post->identity_about !!}
    </div>
@endforeach 
</div>    
      
@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection