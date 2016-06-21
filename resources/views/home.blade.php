@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {!! $products->render() !!}
        </div>

        @foreach($products as $product)
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $product->title }}</div>

                <div class="panel-body">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="img-responsive">
                </div>

                <div class="panel-footer clearfix">
                    <span class="price">&euro; {{ number_format($product->price, 2, ',', '.') }}</span>

                    <a href="{{ action('ProductController@show', $product->id) }}" class="btn btn-primary pull-right">
                        Bekijk
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-sm-12">
            {!! $products->render() !!}
        </div>
    </div>
</div>
@endsection
