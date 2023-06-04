@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Обновить товар</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Админ панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Продукты</a></li>
                            <li class="breadcrumb-item active">Редактирование товара</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('products.update', $product->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Наименование товара"
                        value="{{ $product->title }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Обложка товара</label>
                        <div>
                            <img src="{{ asset('storage/' . $product->preview_image) }}" alt="preview_image" class="w-50 mb-2">
                        </div>
                        <input type="file" class="form-control" name="preview_image" placeholder="Обложка товара">
                        @error('preview_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Фотографии товара</label>
                        <div class="d-flex">
                            @foreach($images as $image)
                            <img src="{{ asset('storage/' . $image->path) }}" class="w-50 m-2">
                                @endforeach
                        </div>
                        <input type="file" class="form-control" name="images[]" multiple>
                        @error('images[]')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="description" placeholder="Описание товара"
                               value="{{ $product->description }}">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="price" placeholder="Цена товара"
                               value="{{ $product->price }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-25">
                        <label>Размер</label>
                        <select class="form-control" name="size">
                            @foreach($sizes as $id => $size)
                                <option value="{{ $id }}"
                                    {{ $id == $product->size ? ' selected' : '' }}
                                >{{ $size }}</option>
                            @endforeach
                        </select>
                        @error('size')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-25">
                        <label>Категория товара</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? ' selected' : '' }}
                                >{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-default" value="Обновить">
                </form>
            </div>
        </div>
    </div>

@endsection


