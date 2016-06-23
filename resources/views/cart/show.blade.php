@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Your shoppingcart
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Articlenumber</th>
                            <th>Name</th>
                            <th>Price e/a</th>
                            <th>Amount</th>
                            <th>Price</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th colspan="2"></th>
                            <th>Subtotal:</th>
                            <th>{{ Cart::getTotalProductCount() }}</th>
                            <th>&euro; {{ number_format(Cart::getTotalPrice(), 2, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>Vat:</th>
                            <th>&euro; {{ number_format(Cart::getTotalVat(), 2, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>Total:</th>
                            <th>&euro; {{ number_format(Cart::getTotalPrice(), 2, ',', '.') }}</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach(Cart::getItems() as $product_id => $cart_item)
                        <tr>
                            <td>{{ $product_id }}</td>
                            <td>{{ $cart_item->product->title }}</td>
                            <td>&euro; {{ number_format($cart_item->product->price, 2, ',', '.') }}</td>
                            <td>
                                <div class="input-group" style="max-width: 150px">
                                    <span class="input-group-btn">
                                        <a class="btn btn-default" href="{{ action('CartController@removeProduct', ['product' => $product_id, 'amount' => 1]) }}">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </a>
                                    </span>

                                    <input type="number" min="0" step="1" value="{{ $cart_item->amount }}" name="amount" class="form-control">

                                    <span class="input-group-btn">
                                        <a class="btn btn-default" href="{{ action('CartController@addProduct', ['product' => $product_id]) }}">
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

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Checkout
                </div>

                <div class="panel-body">
                    <form action="{{ action('CartController@checkout') }}" method="POST" role="form">
                        <div class="col-sm-6">
                            @include('layouts.input', [
                                'name' => 'name',
                                'title' => 'Name',
                                'item' => $user])

                            @include('layouts.input', [
                                'name' => 'email',
                                'title' => 'Emailaddress',
                                'item' => $user,
                                'type' => 'email'])

                            @include('layouts.input', [
                                'name' => 'address',
                                'title' => 'Address',
                                'item' => $user])

                            <div class="row">
                                <div class="col-sm-4">
                                    @include('layouts.input', [
                                        'name' => 'zipcode',
                                        'title' => 'Zipcode',
                                        'item' => $user])
                                </div>

                                <div class="col-sm-8">
                                    @include('layouts.input', [
                                        'name' => 'city',
                                        'title' => 'City',
                                        'item' => $user])
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            @if(!Auth::check())
                                @include('layouts.input', [
                                    'name' => 'password',
                                    'title' => 'Password',
                                    'type' => 'password'])


                                @include('layouts.input', [
                                    'name' => 'password_confirmation',
                                    'title' => 'Password confirmation',
                                    'type' => 'password'])
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
