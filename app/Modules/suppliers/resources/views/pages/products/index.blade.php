@extends('layouts.master')


@section('title')
{{ $title }}
@endsection

@section('styles')
<style>
    <link href="{{ asset('assets/css/pages_style.css') }}"rel="stylesheet"type="text/css"/>
</style>
@endsection

@section('content')

<div id="alert-comp" {{-- style="height:50px;background-color: rgb(37, 222, 222)" --}}>
    <x-alert :message="$message" />
</div>

<br />

<a href="{{ route('supplier.product.create')}}" class="btn btn-primary actionbtn" style="width:20%">
    Create Product
</a>


<div class="container">
    <div class="card">
        <div class="card-body">

            @if (count($products) != 0)
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $product['name'] }}</td>
                        <td>

                            <a href="{{ route('supplier.product.show',$product->id)}}" title="Show" class="">
                                Show</a>

                            <a href="{{ route('supplier.product.edit',
                             $product->id)}}" title="Edit" class="">
                                Edit</a>

                            <form action="{{ route('supplier.product.destroy',$product->id)}}" method="POST"
                                style="display: inline;">
                                @csrf {{ method_field('Delete') }}

                                <button type="sumbit" class="btn-looklike-link" title=Delete
                                    onclick="return confirm('Are you sure?')"> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            No records
            @endif

        </div>
    </div>
</div>

@endsection