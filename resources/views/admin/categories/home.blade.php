@extends('admin.master')
@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/') }}"><i class="fas fa-folder-open"></i>Categorias</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>Agregar Categoría</h2>
                    </div>
                    <div class="inside">
                        @if (kvfj(Auth::user()->permissions, 'category_add'))
                            {!! Form::open(['url' => '/admin/categories/add', 'files' => true]) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <label for="category" class="mtop16">Categoría padre:</label>
                            <div class="input-group ">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                <select name="parent" class="form-select">
                                    <option value="0">Sin Categoría padre</option>
                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->id_categoria }}">{{ $cat->cate_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 mtop16">
                                <label for="formFile" class="form-label">Imagen Destacada:</label>
                                {!! Form::file('icon', ['class' => 'form-control', 'id' => 'formFile', 'accept' => 'image/*']) !!}
                            </div>
                            <label for="descripcion">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                            </div>
                            <label for="order" class="mtop16">Orden:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('order', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-folder-open"></i>Categorías</h2>
                    </div>
                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td width="64px"></td>
                                    <td>Nombre</td>
                                    <td>Descripción</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $cat)
                                    <tr>
                                        <td> <img src="{{ url('/uploads/' . $cat->file_path . '/' . $cat->icono) }}"
                                                class="img-fluid"></td>
                                        <td>{{ $cat->cate_nombre }}</td>
                                        <td> {{ $cat->cate_descripcion }}</td>
                                        <td>
                                            <div class="opts">
                                                @if (kvfj(Auth::user()->permissions, 'category_edit'))
                                                    <a href="{{ url('/admin/categories/' . $cat->id_categoria . '/edit') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ url('/admin/categories/' . $cat->id_categoria . '/subs') }}"
                                                    data-toggle="tooltip" data-placement="top" title="Subcategorías">
                                                    <i class="fas fa-list-ul"></i>
                                                </a>
                                                @if (kvfj(Auth::user()->permissions, 'category_delete'))
                                                    <a href="{{ url('/admin/categories/' . $cat->id_categoria . '/delete') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
