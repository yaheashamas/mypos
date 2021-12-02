@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.create_user')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
                <li><b>@lang('site.create_user')</b></li>
            </ol>
        </section>

        @include('partials._session')
        <section class="content">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.create_user')</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('dashboard.users.store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.first_name')</label>
                                <input type="text" class="form-control" name="first_name">
                                @include('partials._errors',['name'=>'first_name'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.last_name')</label>
                                <input type="text" class="form-control" name="last_name">
                                @include('partials._errors',['name'=>'last_name'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.email')</label>
                                <input type="email" class="form-control" name="email">
                                @include('partials._errors',['name'=>'email'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.image')</label>
                                <input type="file" class="form-control" name="image" id="imgInp">
                                @include('partials._errors',['name'=>'image'])
                            </div>

                            <div class="form-group">
                                <img src="{{ asset('uploads/imageUsers/default.png')}}" class="img-thumbnail" style="width: 100px" id="blah">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.password')</label>
                                <input type="password" class="form-control" name="password">
                                @include('partials._errors',['name'=>'password'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.password_confirmation')</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                @include('partials._errors',['name'=>'password_confirmation'])
                            </div>

                            {{--  start permition  --}}
                            <label for="exampleInputPassword1">@lang('site.permition')</label>

                            <?php
                                $models = ['users','categories','products','clients','orders'];
                                $CRUDs = ['create','read','update','delete'];
                            ?>

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                        <li class="{{$index == 0 ? 'active' : ''}}"><a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                @foreach ($models as $index=>$model)
                                    <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">
                                        @foreach ($CRUDs as $CRUD)
                                            <label><input type="checkbox" name="permissions[]" value="{{$CRUD.'_'.$model}}"> @lang('site.'.$CRUD)</label>
                                        @endforeach
                                    </div>
                                @endforeach
                                </div>
                                @include('partials._errors',['name'=>'permissions'])
                            </div>
                            {{--  end permition  --}}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>{{-- end form create--}}
            <div class="col-md-6">
                <!-- Custom Tabs -->
            </div>
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
