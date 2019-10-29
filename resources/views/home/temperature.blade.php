@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Температура в Брянске</div>

                    <div class="panel-body">

                        <div class="temperature">@if(0 < $temperature)+@endif{{$temperature}}°</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection