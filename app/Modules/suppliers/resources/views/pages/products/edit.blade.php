@extends('layouts.master')

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="container">
    <div class="formdiv">
        <form action="{{route('supplier.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf {{ method_field('PUT') }}
            <h1>Edit Product</h1>
            <hr>

            <label for="username"><b>Product Name</b></label>

            <input type="text" placeholder="Enter Product Name" name="name" value="{{old('name',$product->name)}}"
                required>

            <label><b>Category</b></label>
            <select name="category_id">
                <option selected value="">Categories</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" @if($product->category_id==$category->id) selected
                    @endif>{{$category->name}}</option>
                @endforeach
            </select>

            <input type="file" class="form-control" id="customFile" multiple name="images[]" />

            <span class="form-text text-muted">
                The images will be replaced
            </span>

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

            <a href="{{ route('supplier.product.index')}}" class="btn btn-primary actionbtn">
                Back
            </a>
            <button type="submit" class="actionbtn btn btn-primary">Edit</button>

        </form>
    </div>
</div>

@endsection