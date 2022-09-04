@extends('admin.master')
@section('title', 'Categorias')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="far fa-folder-open"></i>Categorias</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#"><i class="far fa-folder-open"></i>Categoría:{{ $category->cate_nombre }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#"><i class="far fa-folder-open"></i>Subcategorías</a>
    </li>


@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas folder-open"></i>Subcategorías de: <strong>{{ $category->cate_nombre }}</strong></h2>

                    </div>
                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="64px"></td>
                                    <td>Nombre</td>
                                    <td width="140">Descripción</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->getSubcategories as  $cat)
                                <tr>
                                    <td>
                                        @if(!is_null($cat->icono)) 
                                        <img src="{{ url('/uploads/'. $cat->file_path . '/' .$cat->icono) }}" class="img-fluid">
                                        @endif
                                    </td>
                                    <td>{{ $cat->cate_nombre }}</td>
                                    <td> {{ $cat->cate_descripcion }}</td>
                                    <td> 
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'category_edit'))
                                            <a href="{{ url('/admin/categories/'.$cat->id_categoria.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endif
                                            
                                            <a href="{{ url('/admin/categories/'.$cat->id_categoria.'/subs') }}" data-toggle="tooltip" data-placement="top" title="Subcategorías">
                                                <i class="fas fa-list-ul"></i>
                                            </a>
                                            
                                            @if(kvfj(Auth::user()->permissions, 'category_delete'))
                                            <a href="{{ url('/admin/categories/'.$cat->id_categoria.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
