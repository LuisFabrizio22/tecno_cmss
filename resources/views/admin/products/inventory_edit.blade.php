@extends('admin.master')
@section('title', 'Inventario de Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i>Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/' . $inventory->getProduct->id_articulo . '/edit') }}"><i
                class="fas fa-boxes"></i>{{ $inventory->getProduct->nombre_articulo }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/' . $inventory->id_articulo. '/inventory') }}"><i
                class="fas fa-boxes"></i>Inventario
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/inventory/' . $inventory->id . '/edit') }}"><i
                class="fas fa-boxes"></i>{{ $inventory->name }}
        </a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- columna #1 --}}
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-edit"></i>Editar Inventario</h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/product/inventory/' . $inventory->id . '/edit']) !!}
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('name', $inventory->name, ['class' => 'form-control']) !!}
                        </div>
                        <label for="name" class="mtop16">Cantidad de Inventario:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::number('inventory',  $inventory->quantity, ['class' => 'form-control', 'min' => '1']) !!}
                        </div>

                        <label for="name" class="mtop16">Precio:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                {{ config('localhost.currency') }}.
                            </span>
                            {!! Form::number('price',  $inventory->price, ['class' => 'form-control', 'min' => '1', 'step' => 'any']) !!}
                        </div>

                        <label for="limited" class="mtop16">Límite de inventario:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'],  $inventory->limited, ['class' => 'form-select']) !!}
                        </div>

                        <label for="minimun" class="mtop16">Inventario mínimo:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::number('minimun', $inventory->minimun, ['class' => 'form-control', 'min' => '1']) !!}
                        </div>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            {{-- columna #2 --}}
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-box"></i>Variantes</h2>
                    </div>
                    <div class="inside">
                        <div class="row">
                           
                            <div class="col-md-6">
                                {!! Form::open(['url'=>'/admin/product/inventory/'.$inventory->id.'/variant']) !!}
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'nombre variante']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            </div>
                            
                        </div>
                        {!! Form::close() !!}
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td></td>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventory->getVariants as $variant )
                                <tr>
                                    <td>{{ $variant->id }}
                                    <td>{{ $variant->name }}
                                    </td>
                                    <td>
                                        <div class="opts">
                                        <a href="#" data-path="admin/product/variant" data-action="delete" data-placement="top"
                                        data-object="{{ $variant->id }}"data-toggle="tooltip"
                                            title="Eliminar" class="btn-deleted deleted">
                                            <i class="fas fa-trash-alt"></i></a>
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
