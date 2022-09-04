@extends('admin.master')

@section('title', 'Products')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i>Productos</a>
    </li>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-boxes"></i>Productos</h2>
                <ul>
                    @if (kvfj(Auth::user()->permissions, 'product_add'))
                        <li>

                            <a href="{{ url('/admin/product/add') }}">
                                <i class="fas fa-plus"></i>Agregar producto
                            </a>

                        </li>
                    @endif
                    <li>
                        <a href="#">Filtrar<i class="fas fa-chevron-down"></i></a>
                        <ul class="shadow">
                            <li><a href="{{ url('/admin/products/1') }}"><i class="fas fa-globe-americas"></i>Públicos</a>
                            </li>
                            <li><a href="{{ url('/admin/products/0') }}"><i class="fas fa-eraser"></i>Borrador</a></li>
                            <li><a href="{{ url('/admin/products/trash') }}"><i class="fas fa-trash"></i>Papelera</a>
                            </li>
                            <li><a href="{{ url('/admin/products/all') }}"><i class="fas fa-list-ul"></i>Todos</a></li>



                        </ul>
                    </li>
                    <li>
                        <a href="#" id="btn_search">
                            <i class="fas fa-search"></i>Buscar</a>

                    </li>

                </ul>
            </div>
            <div class="inside">
                <div class="form_search" id="form_search">

                    {!! Form::open(['url' => '/admin/products/search']) !!}

                    <div class="row">
                        
                        <div class="input-group">
                            <div class="col-md-4">
                                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('filter',null, ['0' => 'Nombre del producto', '1' => 'Código'], 0, ['class' => 'form-select']) !!}

                            </div>
                            <div class="col-md-4">
                                {!! Form::select('status',null, ['0' => 'Borrador', '1' => 'Públicos'], 0, ['class' => 'form-select']) !!}

                            </div>
                            <div class="col-md-4">
                                {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                       
                    </div>

                    {!! Form::close() !!}

                </div>
                @if (kvfj(Auth::user()->permissions, 'product_add'))
                    <div class="btns">
                        <a href="{{ url('/admin/product/add') }}" class="btn btn-primary"><i
                                class="fas fa-plus"></i>Agregar producto</a>
                    </div>
                @endif
                <table class="table table-striped mtop16">
                    <thead>
                        <tr>
                            <td>ID </td>
                            <td></td>
                            <td>Nombre</td>
                            <td>Categoria</td>
                            <td>Precio</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td width="50">{{ $p->id_articulo }}</td>
                                <td width="64">
                                    <a href="{{ url('/uploads/' . $p->file_path . '/' . $p->imagen) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ url('/uploads/' . $p->file_path . '/t_' . $p->imagen) }}" width="64">
                                    </a>
                                </td>
                                <td>{{ $p->nombre_articulo }} @if ($p->status == '0') <i
                                            class="fas fa-eraser" data-toggle="tooltip" data-placement="top"
                                            title="Estado: Borrador"></i> @endif
                                </td>
                                <td>{{ $p->cat->cate_nombre }}  @if($p->id_subcategoria !="0") <i class="fas fa-angle-double-right"></i> {{ $p->getSubCategory->cate_nombre }} @endif </td>
                               {{-- anizar como hacer la busqueda --}}
                                <td>{{ $p->precio }}</td>
                                <td>
                                <td>
                                    <div class="opts">
                                        @if (kvfj(Auth::user()->permissions, 'product_edit'))
                                            <a href="{{ url('/admin/product/' . $p->id_articulo . '/edit') }}"
                                                data-toggle="tooltip" data-toggle="tooltip" data-placement="top"
                                                title="editar">
                                                <i class="fas fa-edit"></i></a>
                                        @endif
                                        @if (kvfj(Auth::user()->permissions, 'product_delete'))
                                            <a href="{{ url('/admin/product/' . $p->id_articulo . '/delete') }}"
                                                data-toggle="tooltip" data-toggle="tooltip" data-placement="top"
                                                title="eliminar">
                                                <i class="fas fa-trash"></i></a>
                                        @endif
                                    </div>
                                </td>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
