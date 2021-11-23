@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.products') <small>{{$products->total()}}</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li class="active"><b>@lang('site.products')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.products')</h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 20px">
                            <form action="{{route('dashboard.products.index')}}" method="GET" >
                                <div class="col-md-4">
                                    <div class="input-group">
                                        {{--  start button search  --}}
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        {{--  end button search  --}}
                                        <input type="text" name="search" class="form-control" value="{{ request()->search}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select name="category_id" class="form-control">
                                        <option>@lang('site.allCategory')</option>
                                        @foreach ($categories as $category)
                                          <option value="{{$category->id}}" {{ request()->category_id == $category->id ? 'selected': ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            <form action="{{route('dashboard.products.create')}}" method="GET" >
                                <button type="submit"  class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                            </form>

                        </div>
                        @if ($products->count()>0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.discription')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.iamge')</th>
                                <th>@lang('site.active')</th>
                            </tr>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{$index + 1 }}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>
                                        <img src="{{$product->imagePath}}" style="object-fit:contain;width: 150px;height: 150px">
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_categories'))
                                            <form action="{{route('dashboard.products.edit',$product)}}" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-warning disabled"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_categories'))
                                            <form action="{{ route('dashboard.products.destroy',$product)}}" class="inline" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm delete btn-danger"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-danger disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{--  start paginate  --}}
                        {{ $products->appends(request()->query())->links() }}
                        {{--  end paginate  --}}
                        @else
                           <h1>@lang('site.no_data_found')</h1>
                        @endif
                    </div>
                </div>
            </div>
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
