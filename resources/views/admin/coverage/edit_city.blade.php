@extends('admin.master')
@section('title', 'Cobertura de envios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/') }}"><i class="fas fa-shipping-fast"></i> Cobertura de envios</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/'.$coverage->province_id.'/cities') }}"><i class="fas fa-shipping-fast"></i> {{ $coverage->getState->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/city'.$coverage->id.'/cities') }}"><i class="fas fa-shipping-fast"></i> {{ $coverage->name }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>Editar ciudad de envío</h2>
                    </div>
                    <div class="inside">
                            {!! Form::open(['url' => '/admin/coverage/city/'.$coverage->id.'/edit']) !!}
                     
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', $coverage->name, ['class' => 'form-control']) !!}
                            </div>
                            
                            <label for="module" class="mtop16">Estatus:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('status',getCoverageStatus(),$coverage->status, ['class' => 'form-select']) !!}
                            </div>

                            <label for="price" class="mtop16">Valor del envío:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('price', $coverage->price, ['class' => 'form-control', 'min'=>'0', 'step' =>'any']) !!}
                            </div>

                            <label for="days" class="mtop16">Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('days', $coverage->days, ['class' => 'form-control', 'min'=>'0', 'step' =>'any']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                  
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-shipping-fast"></i>Información general.</h2>
                    </div>
                    <div class="inside">
                        @if($coverage->ctype =="1")
                        <p><strong>Tipo: </strong> Ciudad</p>
                        <p><strong>Provincia / Ciudad: </strong>{{ $coverage->getState->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
    
    
        </div>
    </div>
@endsection
