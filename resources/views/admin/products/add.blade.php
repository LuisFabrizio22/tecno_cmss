@extends('admin.master')
@section('title', 'Agregar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i>Productos</a> </li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/products/add') }}"><i class="fas fa-plus"></i>Agregar Productos</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-plus"></i>Agregar Productos</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/product/add', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nombre producto:</label>
                        <div class="input-group">
                              <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="price">Precio:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            {!! Form::number('price', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                        </div>
                    </div>
                </div>
                <div class="row mtop16">
                    <div class="col-md-3">
                        <label for="category">Categoria:</label>
                        <div class="input-group">
                           
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                   
                            {!! Form::select('category', $cats, 0, ['class' => 'form-select', 'id'=>'category']) !!}
                            {!! Form::hidden('subcategory_actual', 0, ['id'=>'subcategory_actual']) !!}

                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="subcategory">Subcategoría:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::select('subcategory', [], null, ['class' => 'form-select', 'id'=>'subcategory', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="name">Imagen destacada:</label>
                        <div class="formFile">
                            {!! Form::file('img', ['class' => 'form-control', 'id' => 'formFile', 'accept' => 'image/*']) !!}
                            <label class="form-label" for="formFile"></label>
                        </div>
                    </div>
                </div>

                <div class="row ">
                   
                  

                  

               
                    <div class="col-md-12">
                        <label for="content">Descipción:</label>
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) !!}

                    </div>

                    <div class="col-md-6" class="mtop16">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                    </div>


                    {!! Form::close() !!}


                </div>

            </div>
        </div>

    @endsection
