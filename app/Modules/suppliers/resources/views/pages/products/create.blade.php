@extends('layouts.master')


@section('content')
<div class="container">
    <div class="formdiv">
        <form action="{{route('supplier.product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1>Create Product</h1>
            <hr>

            <label for="username"><b>Product Name</b></label>
            <input type="text" placeholder="Enter Product Name" name="name" required>

            <label><b>Category</b></label>
            <select name="category_id">
                <option selected value="">Categories</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <br />
            <label><b>Product Images</b></label>
            <input type="file" multiple class="form-control" id="customFile" name="images[]" />

            <a href="{{ route('supplier.product.index')}}" class="btn btn-primary actionbtn">
                Back
            </a>
            <button type="submit" class="actionbtn btn btn-primary">Create</button>

        </form>
    </div>
</div>

@endsection