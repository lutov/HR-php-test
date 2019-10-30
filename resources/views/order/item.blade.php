@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказ №{{$order->id}}</div>

                    <div class="panel-body">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="">

                            {{ csrf_field() }}

                            <div class="form-group">

                                <label for="client_email">Email клиента</label>
                                <input type="text" name="client_email" id="client_email" value="{{$order->client_email}}" class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="partner_id">Партнер</label>
                                <select name="partner_id" id="partner_id" class="form-control">
                                @foreach($partners as $partner)
                                    <option value="{{$partner->id}}" @if($partner->id == $order->partner_id) selected @endif>{{$partner->name}}</option>
                                @endforeach
                                </select>

                            </div>

                            <label for="products">Продукты</label>
                            <fieldset class="form-group">

                                @foreach($order->products as $product)
                                    <div class="form-group row" id="products">
                                        <div class="col-md-9">
                                            <label for="quantity_{{$product->id}}">{{$product->name}}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="quantity[]" id="quantity_{{$product->id}}" value="{{$product->params->quantity}}" class="form-control form-inline">
                                        </div>
                                    </div>
                                @endforeach

                            </fieldset>

                            <div class="form-group">

                                <label for="status">Статус заказа</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach($order->getStatusList() as $key => $status)
                                        <option value="{{$key}}" @if($key == $order->status) selected @endif>{{$status}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                Стоимость заказа: {{$order->products()->sum(DB::raw('order_products.price * quantity'))}}
                            </div>

                            <input class="btn btn-primary" type="submit" value="Сохранить">

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection