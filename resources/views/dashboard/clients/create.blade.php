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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.create_client')</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('dashboard.clients.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.name')</label>
                                <input type="text" class="form-control" name="name">
                                @include('partials._errors',['name'=> 'name'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.address')</label>
                                <input type="text" class="form-control" name="address">
                                @include('partials._errors',['name'=> 'address'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.phone')</label>
                                <input type="number" class="form-control" name="phone">
                                @include('partials._errors',['name'=> 'phone'])
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>{{-- end form create--}}
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
