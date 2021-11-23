@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.edit_product')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.products.index')}}">@lang('site.products')</a></li>
                <li><b>@lang('site.edit_product')</b></li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="box box-warning" style="padding-top: 20px">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('dashboard.products.update',$product)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <!-- text input -->
                           <div class="form-group">
                                <label>@lang('site.category')</label>
                                <select name="category_id" class="form-control">
                                    <option>...</option>
                                    @foreach ($categories as $category)
                                      <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @include('partials._errors',['name'=>'category_id'])
                            </div>

                            @foreach (config('translatable.locales') as $locale)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('site.'.$locale.'.name')</label>
                                    <input type="text" class="form-control" name="{{$locale}}[name]" value="{{$product->translate($locale)->name}}">
                                    @include('partials._errors',['name'=>$locale.'.name'])
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('site.'.$locale.'.description')</label>
                                    <textarea   class="form-control ckeditor"
                                                rows="3"
                                                placeholder="Enter ..."
                                                name="{{$locale}}[description]">
                                        {{{ $product->translate($locale)->description }}}
                                    </textarea>
                                    @include('partials._errors',['name'=>$locale.'.description'])
                                </div>

                            @endforeach

                            {{-- price --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.purchase_price')</label>
                                <input type="number" class="form-control" name="purchase_price" value="{{$product->purchase_price}}">
                                @include('partials._errors',['name'=>'purchase_price'])
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.sale_price')</label>
                                <input type="number" class="form-control" name="sale_price" value="{{$product->sale_price}}">
                                @include('partials._errors',['name'=>'sale_price'])
                            </div>
                            {{--end price--}}

                            {{--start stock --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('site.stock')</label>
                                <input type="number" class="form-control" name="stock" value="{{$product->stock}}">
                                @include('partials._errors',['name'=>'stock'])
                            </div>
                            {{--end stock--}}

                            {{--start image--}}
                            <div class="form-group">
                                <label for="exampleInputPassword1">@lang('site.image')</label>
                                <input type="file" class="form-control" name="image" id="imgInp">
                                @include('partials._errors',['name'=>'image'])
                            </div>

                            <div class="form-group">
                                <img src="{{ $product->image_path}}" class="img-thumbnail" style="width: 100px" id="blah">
                            </div>
                            {{--end image--}}

                            {{--  end permition  --}}
                            <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection


