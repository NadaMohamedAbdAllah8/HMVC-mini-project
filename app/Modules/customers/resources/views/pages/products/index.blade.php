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
                            <a href="{{ route('customer.product.show',$product->id)}}" title="Show" class="">
                                Show</a>
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