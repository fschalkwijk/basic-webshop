@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Bestelling #{{ $item->id }} - {{ $item->created_at->formatLocalized('%A %d %B %Y') }}
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
                            <th class="total-product-amount">{{ $item->product_amount }}</th>
                            <th class="total-price">&euro; {{ number_format($item->total_price, 2, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>BTW:</th>
                            <th class="total-vat">&euro; {{ number_format($item->total_vat, 2, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>Totaal:</th>
                            <th class="total-price">&euro; {{ number_format($item->total_price, 2, ',', '.') }}</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($item->products->sortBy(function($item, $key){ return $key; }) as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>&euro; {{ number_format($product->pivot->price_each, 2, ',', '.') }}</td>
                            <td>{{ $product->pivot->amount }}</td>
                            <td>&euro; {{ number_format($product->pivot->amount * $product->pivot->price_each, 2, ',', '.') }}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Verzendgegevens
                </div>

                <table class="table table-striped">
                    <tr>
                        <th>Naam</th>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <th>Emailadres</th>
                        <td>{{ $item->email }}</td>
                    </tr>
                    <tr>
                        <th>Adres</th>
                        <td>{{ $item->address }}</td>
                    </tr>
                    <tr>
                        <th>Postcode plaats</th>
                        <td>{{ $item->zipcode }} {{ $item->city }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
