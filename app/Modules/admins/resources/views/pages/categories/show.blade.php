@extends('layouts.master')
{{-- @extends('admin.layouts.header') --}}

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="container">
    <div class="formdiv">
        <h1>Category</h1>
        <hr>

        <label for="username"><b>Category Name</b></label>
        <input type="text" class="read-only-input" value="{{old('name',$category->name)}}">
        <br />
        <label><b>Category Image</b></label>
        @if(isset($category->image->file_path)&&!is_null($category->image->file_path))
        <div class="image-input-wrapper" style="width: 430px;height: 258px;
            background-image: url({{ asset($category->image->file_path)}})">
        </div>
        @else
        No image
        @endif
        <a href="{{ route('admin.category.index')}}" class="btn btn-primary actionbtn">
            Back
        </a>

    </div>
</div>

@endsection
@section('scripts')
<script>
    $( "#pagination_options" ).on( 'change', function () {
        var selectedPagination = $( this ).find( ":selected" ).val();

        var current_url = window.location.href.split( '?' );

        if ( current_url[ 0 ] ) {
            var url = current_url[ 0 ] + "?page=1&pagination=" + selectedPagination;
        } else {
            var url = window.location.href + "?page=1&pagination=" + selectedPagination;
        }
     
       window.location.href = url;
    } );
</script>
@endsection