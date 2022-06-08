@extends('layouts.master')
{{-- @extends('admin.layouts.header') --}}


@section('content')
<div class="container">
    <div class="formdiv">
        <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1>Create Category</h1>
            <hr>

            <label for="username"><b>Category Name</b></label>
            <input type="text" placeholder="Enter Category Name" name="name" required>

            <br />
            <label><b>Category Image</b></label>
            <input type="file" class="form-control" id="customFile" name="image" />

            <a href="{{ route('admin.category.index')}}" class="btn btn-primary actionbtn">
                Back
            </a>
            <button type="submit" class="actionbtn btn btn-primary">Create</button>

        </form>
    </div>
</div>

@endsection