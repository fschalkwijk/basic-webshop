@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Product #{{ $item->id }} - {{ $item->title }}
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="img-responsive">
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>Prijs</th>
                                    <td>&euro; {{ $item->price }}</td>
                                </tr>
                                <tr>
                                    <th>BTW percentage</th>
                                    <td>{{ $item->vat_percentage * 100 }}%</td>
                                </tr>
                                <tr>
                                    <th>BTW bedrag</th>
                                    <td>&euro; {{ number_format($item->price * $item->vat_percentage, 2, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-sm-12">
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-9 col-sm-4 col-sm-offset-8 col-xs-6 col-xs-offset-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a
                                        class="btn btn-default remove-product"
                                        href="{{ action('CartController@removeProduct', ['product' => $item->id, 'amount' => 1]) }}" data-product-id="{{ $item->id }}">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                </span>

                                <input
                                    type="number"
                                    min="0"
                                    step="1"
                                    value="{{ Cart::getProductAmount($item) }}"
                                    name="amount"
                                    class="form-control product-amount"
                                    id="product-amount-{{ $item->id }}"
                                    data-product-id="{{ $item->id }}">

                                <span class="input-group-btn">
                                    <a
                                        class="btn btn-default add-product"
                                        href="{{ action('CartController@addProduct', ['product' => $item->id]) }}"
                                        data-product-id="{{ $item->id }}">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
