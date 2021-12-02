@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.edit_user')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
                <li><b>@lang('site.edit_user')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box box-warning" >
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.edit_user')</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('dashboard.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('put')
                            <!-- text input -->
                            <div class="form-group">
                                <label>@lang('site.first_name')</label>
                                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name}}">
                                @include('partials._errors',['name'=>'first_name'])
                            </div>

                            <div class="form-group">
                                <label>@lang('site.last_name')</label>
                                <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                                @include('partials._errors',['name'=>'last_name'])
                            </div>

                            <div class="form-group">
                                <label>@lang('site.email')</label>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}">
                                @include('partials._errors',['name'=>'email'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.image')</label>
                                <input type="file" class="form-control" name="image" id="imgInp">
                                @include('partials._errors',['name'=>'image'])
                            </div>

                            <div class="form-group">
                                <img src="{{$user->image_path}}" class="img-thumbnail" style="width: 100px" id="blah">
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
                                            <label><input type="checkbox" {{$user->hasPermission($CRUD.'_'.$model)?'checked':''}} name="permissions[]" value="{{$CRUD.'_'.$model}}"> @lang('site.'.$CRUD)</label>
                                        @endforeach
                                    </div>
                                @endforeach
                                </div>
                                @include('partials._errors',['name'=>'permissions'])
                            </div>
                            {{--  end permition  --}}
                            <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection


