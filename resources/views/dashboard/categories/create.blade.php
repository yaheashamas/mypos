@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.create_category')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.categories.index')}}">@lang('site.categories')</a></li>
                <li><b>@lang('site.create_category')</b></li>
            </ol>
        </section>

        @include('partials._session')
        <section class="content">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.create_category')</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('dashboard.categories.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">

                            @foreach (config('translatable.locales') as $locale)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('site.'.$locale.'.name')</label>
                                    <input type="text" class="form-control" name="{{$locale}}[name]">
                                    @include('partials._errors',['name'=>$locale.'.name'])
                                </div>
                            @endforeach

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
