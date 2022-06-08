@extends('layouts.master')
{{-- @extends('admin.layouts.header') --}}

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="container">
    <div class="formdiv">
        <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf {{ method_field('PUT') }}
            <h1>Edit Category</h1>
            <hr>

            <label for="username"><b>Category Name</b></label>

            <input type="text" placeholder="Enter Category Name" name="name" value="{{old('name',$category->name)}}"
                required>
            <input type="file" class="form-control" id="customFile" name="image" />

            <span class="form-text text-muted">
                The image will be replaced
            </span>

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
            <button type="submit" class="actionbtn btn btn-primary">Edit</button>

        </form>
    </div>
</div>

@endsection