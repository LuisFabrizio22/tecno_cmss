@extends('master')
@section('title', 'Mis direcciones de entrega')
@section('content')
    <div class="row mtop16">
        <div class="col-md-3">
            <div class="panel">
                <div class="header">
                    <h2 class="title"><i class="fas fa-map-marker-alt"></i> Agregar dirección</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/address/add']) !!}
                            <label  for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                            <label class="mtop16" for="module">Provincia: </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('province_id', $states, null, ['class' => 'form-select', 'id'=>'state']) !!}
                            </div>
                            <label class="mtop16" for="city">Ciudad: </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('city', [], null, ['class' => 'form-select','id'=>'address_city', 'required']) !!}
                            </div>
                            <label class="mtop16" for="add1">Barrio:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('add1', null, ['class' => 'form-control']) !!}
                            </div>
                            <label class="mtop16" for="add2">Calle / Avenida / Pasaje:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('add2', null, ['class' => 'form-control']) !!}
                            </div>
                            <label class="mtop16" for="add3">Casa / Apartamento N°:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('add3', null, ['class' => 'form-control']) !!}
                            </div>
                            <label class="mtop16" for="add4">Referencia: </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('add4', null, ['class' => 'form-control']) !!}
                            </div>       
                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-map-marker-alt"></i>Mis direcciones de entrega</h2>                
                </div>
                <div class="inside">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td> <strong>Nombre:</strong> </td>
                                <td> <strong>Provincia / Ciudad:</strong> </td>
                                <td> <strong>Dirección:</strong> </td>
                                <td> </td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->getAddress as $address )
                            <tr>

                                <td> <p>{{ $address->name }}</p>
                                    
                                </td>
                                <td>
                                    <p>{{  $address->getState->name }}-{{ $address->getCity->name }}</p>
                                    @if($address->defaul == "0")
                                    <p><a href="{{ url('/account/address/'.$address->id.'/setdefault') }}">Convertir en principal</a></p>
                                    @else
                                    <p> <small>Dirección de entrega principal</small></p>
                                    @endif
                                </td>
                                <td> <p>
                                    <strong>Barrio, conjunto o residencia: </strong>{{ kvfj($address->addr_info, 'add1') }}
                                    </p>
                                    <p>
                                        <strong>Calle / Avenida / Pasaje: </strong>{{ kvfj($address->addr_info, 'add2') }}
                                    </p>
                                    <p>
                                        <strong>Casa o Apartamento N°: </strong>{{ kvfj($address->addr_info, 'add3') }}
                                    </p>
                                    <p>
                                        <strong>Referencia: </strong>{{ kvfj($address->addr_info, 'add4') }}
                                    </p>


                                </td>
                                <td>
                                    @if($address->defaul == "0")
                                        <a href="#" class="btn-delete btn-deleted" data-object="{{ $address->id }}" 
                                            data-action="delete" data-path="account/address" >
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    @endif
                                
                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
