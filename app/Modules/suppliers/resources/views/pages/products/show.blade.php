@extends('layouts.master')

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="container">
    <div class="formdiv">
        <h1>Product</h1>
        <hr>

        <label for="username"><b>Product Name</b></label>
        <input type="text" class="read-only-input" value="{{$product->name}}">

        <label for="username"><b>Category Name</b></label>
        <input type="text" placeholder="Enter Product Name" class="read-only-input"
            value="{{$product->category->name??'No category assigned'}}">
        <br />
        <label><b>Product Image</b></label>
        @if(count($product->images)!=0)
        @foreach($product->images as $image)
        <div class="image-input-wrapper" style="width: 430px;height: 258px;
            background-image: url({{ asset($image->file_path)}})">
        </div>
        <hr>
        <hr>
        @endforeach
        @else
        No images
        @endif
        {{--
        <?echo url()->previous();?> --}}
        <a href="{{url()->previous();}}" class="btn btn-primary actionbtn">
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