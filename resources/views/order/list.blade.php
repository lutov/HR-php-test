@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказы</div>

                    <div class="panel-body">

                        <table class="table">

                            <tr>
                                <th>ID</th>
                                <th>Партнер</th>
                                <th>Стоимость</th>
                                <th>Состав</th>
                                <th>Статус</th>
                            </tr>

                        @foreach($orders as $order)

                            <tr>

                                <td><a href="/order/{{$order->id}}">{{$order->id}}</a></td>
                                <td>{{$order->partner->name}}</td>
                                <td>{{$order->products()->sum(DB::raw('products.price * quantity'))}}</td>
                                <td>
                                    <ol>
                                    @foreach($order->products as $product)
                                        <li>{{$product->name}}, {{$product->price}} x {{$product->total->quantity}} = {{$product->price * $product->total->quantity}}</li>
                                    @endforeach
                                    </ol>
                                </td>
                                <td>{{$order->getStatus()}}</td>

                            </tr>

                        @endforeach
                        </table>

                        {{ $orders->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection