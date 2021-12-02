@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.clients') <small>{{$clients->total()}}</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li class="active"><b>@lang('site.clients')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.clients')</h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 20px">
                            <form action="{{route('dashboard.clients.index')}}" method="GET" >
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" name="search" class="form-control" value="{{ request()->search}}">
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('dashboard.clients.create')}}" method="GET" >
                                <button type="submit"  class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                            </form>
                        </div>
                        @if ($clients->count()>0)
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.address')</th>
                                    <th>@lang('site.phone')</th>
                                    <th>@lang('site.orders')</th>
                                    <th>@lang('site.active')</th>
                                </tr>
                                @foreach ($clients as $index=>$client)
                                    <tr>
                                        <td>{{$index + 1 }}</td>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td><a href="{{route('dashboard.client.orders.create',$client->id)}}" class="btn btn-info btn-sm">@lang('site.add_order')</a></td>
                                        <td>
                                            @if (auth()->user()->hasPermission('update_clients'))
                                                <form action="{{route('dashboard.clients.edit',$client->id)}}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                                </form>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-warning disabled"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                            @endif
                                            @if (auth()->user()->hasPermission('delete_clients'))
                                                <form action="{{ route('dashboard.clients.destroy',$client->id)}}" class="inline" method="POST">
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
                            {{ $clients->appends(request()->query())->links() }}
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
