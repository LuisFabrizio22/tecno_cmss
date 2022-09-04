@extends('admin.master')
@section('title', 'Categorias')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="fas fa-folder-open"></i>Categorias</a>
    </li>
    @if ($category->parent != '0')
        <li class="breadcrumb-item">
            <a href="{{ url('/admin/categories/' . $category->parent . '/subs') }}"><i
                    class="far fa-folder-open"></i>{{ $category->getParent->cate_nombre }}</a>
        </li>
    @endif
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/' . $category->id_categoria . '/edit') }}"><i
                class="far fa-folder-open"></i>Editand:{{ $category->cate_nombre }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-edit"></i>Editar Categoría</h2>
                    </div>
                    <div class="inside">
                        @if (kvfj(Auth::user()->permissions, 'category_edit'))
                            {!! Form::open(['url' => '/admin/categories/' . $category->id_categoria . '/edit']) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', $category->cate_nombre, ['class' => 'form-control']) !!}
                            </div>
                            <div class="mb-3 mtop16">
                                <label for="formFile" class="form-label">Imagen Destacada:</label>
                                {!! Form::file('icon', ['class' => 'form-control', 'id' => 'formFile', 'accept' => 'image/*']) !!}
                            </div>
                            </a>
                            <label for="descripcion">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('descripcion', $category->cate_descripcion, ['class' => 'form-control']) !!}
                            </div>
                            <label for="order" class="mtop16">Orden:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('order', $category->order, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
