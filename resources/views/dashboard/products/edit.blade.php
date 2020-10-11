@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}">@lang('site.products')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title">@lang('site.add')</h3>

                    </div><!-- end of box header -->

                    <div class="box-body ">

                        @include('partials._errors')

                        {{-- category --}}
                        <div class="form-group">
                            <label>@lang('site.category')</label>
                            <select name="category_id" class="form-control select2">
                                <option value="">----</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{$product->category_id == $category->id? 'selected':''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                            <div class="form-group">
                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                            </div>

                            <div class="form-group">
                                <label>@lang('site.description')</label>
                                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                            </div>


                        {{--image--}}
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>


                        {{--purchase price--}}
                        <div class="form-group">
                            <label>@lang('site.purchase_price')</label>
                            <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ $product->purchase_price }}" min="1" required>
                        </div>

                        {{--sale price--}}
                        <div class="form-group">
                            <label>@lang('site.sale_price')</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}" min="1" required>
                        </div>

                        {{--stock--}}
                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock}}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                        </div>

                    </div><!-- end of box body -->

                </div><!-- end of box -->

            </form><!-- end of form -->

        </section>

    </div><!-- end of content wrapper -->

@endsection
