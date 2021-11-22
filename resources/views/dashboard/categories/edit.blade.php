@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.edit_user')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.categories.index')}}">@lang('site.categories')</a></li>
                <li><b>@lang('site.edit_user')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box box-warning" style="padding-top: 20px">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('dashboard.categories.update',$category->id)}}" method="POST">
                            {{ csrf_field() }}
                            @method('put')
                            <!-- text input -->

                            @foreach (config('translatable.locales') as $locale)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('site.'.$locale.'.name')</label>
                                    <input type="text" class="form-control" name="{{$locale}}[name]" value="{{$category->translate($locale)->name}}">
                                    @include('partials._errors',['name'=>$locale.'.name'])
                                </div>
                            @endforeach

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


