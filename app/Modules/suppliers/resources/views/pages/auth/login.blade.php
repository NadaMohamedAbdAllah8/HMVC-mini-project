@extends('layouts.master')

@section('title')
{{ $title ??'Login-Supplier' }}
@endsection

@section('content')

<div class="formdiv">
          <form action="{{route('supplier.post.login')}}" method="POST">
                    @csrf
                    <h1>Supplier Login</h1>
                    <hr>

                    <label for="username"><b>Supplier Name</b></label>
                    <input type="text" placeholder="Enter Supplier Name" name="name" id="username" required>


                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

                    <button type="submit" class="actionbtn primary">Sign in</button>
          </form>
</div>

@endsection