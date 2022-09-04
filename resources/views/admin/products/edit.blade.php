@extends('admin.master')
@section('title', 'Editar producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i>Productos</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-edit"></i>Edit Productos</h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/product/' . $p->id_articulo . '/edit', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Nombre producto:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::text('name', $p->nombre_articulo, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-6">
                                    <label for="category">Categoría padre:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::select('category', $cats, $p->id_categoria, ['class' => 'form-select', 'id'=>'category']) !!}
                                    {!! Form::hidden('subcategory_actual', $p->id_subcategoria, ['id'=>'subcategory_actual']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="subcategory">Subcategoría:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::select('subcategory', [], null, ['class' => 'form-select', 'id'=>'subcategory', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 mtop16">
                                    <label for="name">Imagen destacada:</label>
                                    <div class="formFile">
                                        {!! Form::file('img', ['class' => 'form-control', 'id' => 'formFile', 'accept' => 'image/*']) !!}
                                        <label for="formFile" class="form-label">
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3 mtop16">
                                    <label for="in_discount">Descuento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::select('in_discount',['0'=>'No', '1'=>'Si'], $p->in_discount, ['class' => 'form-select']) !!}
                                        
                                    </div>
                                </div>

                                <div class="col-md-3 mtop16">
                                    <label for="discount">Descuento porcentaje:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::number('discount',$p->discount, ['class' => 'form-control', 'min'=>'0.00', 'step'=>'any']) !!}
                                        
                                    </div>
                                </div>
                            </div>

                           

                        </div>

                        <div class="row ">

                            <div class="col-md-3">
                                <label for="price">Precio:</label>
                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>

                                    </span>


                                    {!! Form::number('price', $p->precio, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>



                           

                            <div class="col-md-4">
                                <label for="date">Fecha Creación:</label>
                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>

                                    </span>

                                    {!! Form::date('date', $p->fecha_creacion, ['class' => 'form-control','disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-3 mtop16">
                                <label for="status">Estado: </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $p->status, ['class' => 'form-select']) !!}
                                </div>
                            </div>
                           
                            <div class="col-md-4  mtop16">
                                <label for="discount_until_date">Fecha limite de descuento: </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::date('discount_until_date', $p->discount_until_date, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-12 mtop16">
                                <label for="content">Descipción:</label>
                                {!! Form::textarea('content', $p->observacion, ['class' => 'form-control', 'id' => 'editor']) !!}

                            </div>
                            <div class="col-md-6" class="mtop16">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>


                    </div>

                </div>


            </div>
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-image"></i>Imagen destacada</h2>
                        <div class="inside">
                            <img src="{{ url('/uploads/' . $p->file_path . '/t_' . $p->imagen) }}" width="64"
                                class="img-fluid">

                        </div>


                    </div>

                </div>
                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="far fa-images"></i>Galeria
                        </h2>
                        <div class="inside product_gallery">
                            @if (kvfj(Auth::user()->permissions, 'product_gallery_add'))

                                {!! Form::open(['url' => '/admin/product/' . $p->id_articulo . '/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}

                                {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'required']) !!}

                                {!! Form::close() !!}

                                <div class="btn-submit">

                                    <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                                </div>
                            @endif


                            <div class="tumbs">
                                @foreach ($p->getGallery as $img)
                                    <div class="tumb">
                                        @if (kvfj(Auth::user()->permissions, 'product_gallery_delete'))

                                            <a href="{{ url('/admin/product/' . $p->id_articulo . '/gallery/' . $img->id . '/delete') }}"
                                                data-toggle="tooltip" data-toggle="tooltip" data-placement="top"
                                                title="eliminar">
                                                <i class="fas fa-trash-alt"></i></a>
                                        @endif

                                        <img src="{{ url('/uploads/' . $img->file_path . '/t_' . $img->file_name) }}">
                                    </div>

                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endsection
