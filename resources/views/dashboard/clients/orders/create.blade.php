@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.create_client')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a></li>
                <li><b>@lang('site.create_client')</b></li>
            </ol>
        </section>

        @include('partials._session')
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('site.categories')</h3>
                        </div>
                        <div class="box-body">
                            @foreach ($categories as $category)
                                <div class="panel-group">
                                    <div class="panel panel-info">
                                        {{-- head panel --}}
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="#{{str_replace(' ','_',$category->name)}}" data-toggle="collapse">{{$category->name}}</a>
                                            </h4>
                                        </div>
                                        {{-- body panel --}}
                                        <div id="{{str_replace(' ','_',$category->name)}}" class="panel-collapse collapse">
                                            @if ($category->products->count() > 0)
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>
                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{$product->name}}</td>
                                                                <td>{{$product->stock}}</td>
                                                                <td>{{$product->sale_price}}</td>
                                                                <td><a href=""
                                                                        id="product-{{$product->id}}"
                                                                        data-name="{{$product->name}}"
                                                                        data-id="{{$product->id}}"
                                                                        data-price="{{$product->sale_price}}"
                                                                    class="btn btn-success btn-sm add-product-btn"><i class="fa fa-plus"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('site.orders')</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('dashboard.client.orders.store',$client->id) }}" method="POST">
                                @csrf

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.products')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="order-list">
                                    </tbody>
                                </table>
                                <h4>
                                    @lang('site.total') : <span class="total-price">0</span>
                                </h4>
                                <button type="submit" class="btn btn-primary btn-sm w-100 btn-block" id="add-oder-form-btn">
                                    <i class="fa fa-plus"></i> @lang('site.add_order')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
