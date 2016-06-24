@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Jouw winkelmandje
                </div>

                <table class="table table-striped cart-table">
                    <thead>
                        <tr>
                            <th>Artikelnummer</th>
                            <th>Naam</th>
                            <th>Prijs p/s</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th colspan="2"></th>
                            <th>Subtotaal:</th>
                            <th class="total-product-amount">{{ Cart::getTotalProductAmount() }}</th>
                            <th class="total-price">&euro; {{ number_format(Cart::getTotalPrice(), 2, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>BTW:</th>
                            <th class="total-vat">&euro; {{ number_format(Cart::getTotalVat(), 2, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>Totaal:</th>
                            <th class="total-price">&euro; {{ number_format(Cart::getTotalPrice(), 2, ',', '.') }}</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach(Cart::getItems()->sortBy(function($item, $key){ return $key; }) as $product_id => $cart_item)
                        <tr>
                            <td>{{ $product_id }}</td>
                            <td>{{ $cart_item->product->title }}</td>
                            <td>&euro; {{ number_format($cart_item->product->price, 2, ',', '.') }}</td>
                            <td>
                                <div class="input-group" style="max-width: 150px">
                                    <span class="input-group-btn">
                                        <a
                                            class="btn btn-default remove-product"
                                            href="{{ action('CartController@removeProduct', ['product' => $product_id, 'amount' => 1]) }}" data-product-id="{{ $product_id }}">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </a>
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        step="1"
                                        value="{{ $cart_item->amount }}"
                                        name="amount"
                                        class="form-control product-amount"
                                        id="product-amount-{{ $product_id }}"
                                        data-product-id="{{ $product_id }}">

                                    <span class="input-group-btn">
                                        <a
                                            class="btn btn-default add-product"
                                            href="{{ action('CartController@addProduct', ['product' => $product_id]) }}"
                                            data-product-id="{{ $product_id }}">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td>&euro; {{ number_format($cart_item->amount * $cart_item->product->price, 2, ',', '.') }}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(Cart::getTotalProductAmount() > 0)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Verzenden en betalen
                </div>

                <div class="panel-body">
                    <form action="{{ action('CartController@checkout') }}" method="POST" role="form">
                        {{ csrf_field() }}

                        <div class="col-sm-6">
                            @include('layouts.input', [
                                'name' => 'name',
                                'title' => 'Naam',
                                'item' => $user])

                            @if(!Auth::check())
                            @include('layouts.input', [
                                'name' => 'email',
                                'title' => 'Emailadres',
                                'item' => $user,
                                'type' => 'email'])
                            @endif

                            @include('layouts.input', [
                                'name' => 'address',
                                'title' => 'Adres',
                                'item' => $user])

                            <div class="row">
                                <div class="col-sm-4">
                                    @include('layouts.input', [
                                        'name' => 'zipcode',
                                        'title' => 'Postcode',
                                        'item' => $user,
                                        'attrs'     => [
                                            'title'     => trans('validation.custom.zipcode.regex'),
                                            'maxlength' => 6,
                                            'pattern'   => config('regex.raw.zipcode.regex')
                                        ]])
                                </div>

                                <div class="col-sm-8">
                                    @include('layouts.input', [
                                        'name' => 'city',
                                        'title' => 'Plaats',
                                        'item' => $user])
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            @if(!Auth::check())
                            @include('layouts.input', [
                                'name' => 'password',
                                'title' => 'Password',
                                'type' => 'password',
                                'required' => false])


                            @include('layouts.input', [
                                'name' => 'password_confirmation',
                                'title' => 'Password confirmation',
                                'type' => 'password',
                                'required' => false])
                            @endif

                            @include('layouts.select', [
                                'name' => 'bank',
                                'title' => 'Bank',
                                'key' => 'id',
                                'value' => 'name',
                                'options' => [
                                    ['id' => 1001, 'name' => 'ABN Amro'],
                                    ['id' => 1005, 'name' => 'ING Bank'],
                                    ['id' => 1009, 'name' => 'Rabobank'],
                                ]])
                        </div>

                        <div class="col-sm-12 clearfix">
                            <button type="submit" class="btn btn-primary pull-right">Bestel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
