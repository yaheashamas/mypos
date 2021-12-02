@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.update_client')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a></li>
                <li><b>@lang('site.update_client')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box box-warning" >
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.update_client')</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('dashboard.clients.update',$client->id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('put')
                            <!-- text input -->
                            <div class="form-group">
                                <label>@lang('site.name')</label>
                                <input type="text" class="form-control" name="name" value="{{ $client->name}}">
                                @include('partials._errors',['name'=>'name'])
                            </div>

                            <div class="form-group">
                                <label>@lang('site.address')</label>
                                <input type="text" class="form-control" name="address" value="{{ $client->address}}">
                                @include('partials._errors',['name'=>'address'])
                            </div>

                            <div class="form-group">
                                <label>@lang('site.phone')</label>
                                <input type="text" class="form-control" name="phone" value="{{ $client->phone}}">
                                @include('partials._errors',['name'=>'phone'])
                            </div>

                            <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection


