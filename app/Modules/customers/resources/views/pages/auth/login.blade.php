@extends('layouts.master')

@section('title')
{{ $title ??'Login-Customer' }}
@endsection

@section('content')

<div class="formdiv">
          <form action="{{route('customer.login')}}" method="POST">
                    @csrf
                    <h1>Customer Login</h1>
                    <hr>

                    <label for="username"><b>Customer Name</b></label>
                    <input type="text" placeholder="Enter Customer Name" name="name" id="username" required>


                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

                    <button type="submit" class="actionbtn primary">Sign in</button>
          </form>
</div>

@endsection