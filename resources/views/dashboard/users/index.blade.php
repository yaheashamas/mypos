@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.users') <small>{{$users->total()}}</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li class="active"><b>@lang('site.users')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box" style="padding-top: 20px">
                    <div class="box-body">
                        <div style="padding-bottom: 20px">
                            <form action="{{route('dashboard.users.index')}}" method="GET" >
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" name="search" class="form-control" value="{{ request()->search}}">
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('dashboard.users.create')}}" method="GET" >
                                <button type="submit"  class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                            </form>
                        </div>
                        @if ($users->count()>0)
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('site.first_name')</th>
                                    <th>@lang('site.last_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.active')</th>
                                </tr>
                                @foreach ($users as $index=>$user)
                                    <tr>
                                        <td>{{$index + 1 }}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td><img src="{{$user->image_path}}" alt="" style="width: 100px" class="img-thumbnail"></td>
                                        <td>
                                            @if (auth()->user()->hasPermission('update_users'))
                                                <form action="{{route('dashboard.users.edit',$user->id)}}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                                </form>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-warning disabled"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                            @endif
                                            @if (auth()->user()->hasPermission('delete_users'))
                                                <form action="{{ route('dashboard.users.destroy',$user->id)}}" class="inline" method="POST">
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
                            {{ $users->appends(request()->query())->links() }}
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
