@extends('admin.master')

@section('title', 'Módulo Sliders')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/sliders') }}"><i class="fa fa-images"></i>Slider</a>
    </li>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">


                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-images"></i>Agregar Slider</h2>

                    </div>

                    <div class="inside">

                        @if (kvfj(Auth::user()->permissions, 'slider_add'))
                            {!! Form::open(['url' => '/admin/slider/add', 'files'=>true]) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>


                            <label for="visible" class="mtop16">Visible:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('visible', ['0' => 'No Visible', '1' => 'Visible'], 1, ['class' => 'form-select']) !!}
                            </div>

                            <div class="mb-3 mtop16">

                                <label for="formFile" class="form-label">Imagen Destacada:</label>
                                {!! Form::file('img', ['class' => 'form-control', 'id' => 'formFile', 'accept' => 'image/*']) !!}

                            </div>

                            <label for="name">Contenido:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5']) !!}
                            </div>

                            <label for="name" class="mtop16">Orden de aparición:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('sorder', 0, ['class' => 'form-control', 'min' => '0']) !!}
                            </div>
                            </labe>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}

                    </div>


                </div>
                @endif

            </div>

            <div class="col-md-8">
                <div class="panel show">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-plus"></i>Agrgar Slider</h2>
                    </div>
                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Slider
                                    </td>
                                    <td>Nombre
                                    </td>
                                    <td>Contenido
                                    </td>
                                    <td>
                                    </td>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td width="100px"><img
                                                src="{{ url('/uploads/' . $slider->file_path) . '/' . $slider->file_name }}"
                                                class="img-fluid">
                                        </td>
                                        <td>{{ $slider->name }}</td>
                                        <td>
                                            <div class="slider_content">{!! html_entity_decode($slider->content) !!}</div>
                                        </td>
                                        <td>
                                            <div class="opts">
                                                @if (kvfj(Auth::user()->permissions, 'slider_edit'))
                                                    <a href="{{ url('/admin/slider/' . $slider->id . '/edit') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (kvfj(Auth::user()->permissions, 'slider_delete'))
                                                    <a href="#" data-path="admin/slider" data-action="delete" 
                                                    data-object="{{ $slider->id}}" data-toggle="tooltip" data-popper-placement="top"
                                                    title="Eliminar" class="btn-deleted"}}>
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
    </div>

@endsection
