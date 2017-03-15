@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/graph">ORDERS</a>
                </div>

                <div class="panel-body">
                    <div class="container">
                        <div class="row">
                            <div class="search-row">
                                <div class="input-group">
                                    <input type="hidden" name="search_param" value="all" id="search_param">
                                    <input type="text" class="form-control search-query" name="x"
                                           placeholder="Search term...">
                                    <div class="input-group-btn search-panel">
                                        <select class="form-control search-by" id="category">
                                            <option value='all' selected>All</option>
                                            <option value='name'>Client</option>
                                            <option value='products_name'>Product</option>
                                            <option value='products_total'>Total</option>
                                            <option value='products_date'>Date</option>
                                        </select>
                                    </div>
                                    <span class="input-group-btn">
                                            <button class="btn btn-default searcher" token="{{ csrf_token() }}"
                                                    type="button">
                                                <span class="glyphicon glyphicon-search">
                                                </span>
                                            </button>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div id="canvas" style="height: 250px;"></div>

                        <span id="mail">{!!  Html::mailto(Config::get('constants.ADMIN_MAIL'), 'Email this report') !!}</span>
                        <table class="rwd-table">
                            <tr>
                                <th>Client <a class="sortable" direction="up" column="name" href=""
                                              token="{{ csrf_token() }}"><img width="18" src="/img/12.png"></a> <a
                                            class="sortable" direction="down" column="name" href=""
                                            token="{{ csrf_token() }}"><img width="18" src="/img/15.png"></a></th>
                                <th>Product<a class="sortable" direction="up" column="product" href=""
                                              token="{{ csrf_token() }}"><img width="18" src="/img/12.png"></a> <a
                                            class="sortable" direction="down" column="product" href=""
                                            token="{{ csrf_token() }}"><img width="18" src="/img/15.png"></a></th>
                                <th>Total</th>
                                <th>Date<a class="sortable" direction="up" column="date" href=""
                                           token="{{ csrf_token() }}"><img width="18" src="/img/12.png"></a> <a
                                            class="sortable" direction="down" column="date" href=""
                                            token="{{ csrf_token() }}"><img width="18" src="/img/15.png"></a></th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach ($orders as $key)
                                <tr>
                                    <td data-th="client">{{$key->name}}</td>
                                    <td data-th="product">{{$key->products_name}}</td>
                                    <td data-th="total">{{$key->products_total}}</td>
                                    <td data-th="date">{{$key->products_date}}</td>
                                    <td data-th="Edit">
                                        <button class="btn btn-warning edit-order" order="{{$key->products_id}}"
                                                token="{{ csrf_token() }}">
                                            EDIT
                                        </button>
                                    </td>
                                    <td data-th="delete">
                                        <button class="btn btn-danger delete-order" order="{{$key->products_id}}"
                                                token="{{ csrf_token() }}">
                                            DELETE
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div id="render"><?= $orders->render(); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection