@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Mijn bestellingen
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Besteldatum</th>
                            <th>Producten</th>
                            <th>Totaal bedrag</th>
                            <th>Opties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->created_at->formatLocalized('%A %d %B %Y') }}</td>
                            <td>{{ $item->product_amount }}</td>
                            <td>{{ $item->total_price }}</td>
                            <td><a href="{{ action('OrderController@show', $item->id) }}" class="btn btn-primary">Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
