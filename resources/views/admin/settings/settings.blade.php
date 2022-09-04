@extends('admin.master')

@section('title', 'Products')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/settings') }}"><i class="fas fa-boxes"></i>Configuraciones</a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        {!! Form::open(['url' => '/admin/settings']) !!}
        {{-- Row #1 --}}
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> Generales</h2>
                    </div>
                    <div class="inside">
                        <label for="name">Nombre de la empresa:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::text('name', Config::get('localhost.name'), ['class' => 'form-control']) !!}
                        </div>
                        <label for="website" class="mtop16">Sitio Web:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::text('website', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="company_phone" class="mtop16">Teléfono:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('company_phone', Config::get('localhost.company_phone'), ['class' => 'form-control']) !!}
                        </div>
                        <label for="email_from" class="mtop16">Correo electrónico remitente:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('email_from', Config::get('localhost.email_from'), ['class' => 'form-control']) !!}
                        </div>
                        <label for="manteninance_cmde" class="mtop16">Modo mantenimiento:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::select('manteninance_mode', ['0' => 'Desactivado', '1' => 'Activo'], Config::get('localhost.manteninance_mode'), ['class' => 'form-control']) !!}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-coins"></i> Moneda y precios</h2>
                    </div>
                    <div class="inside">

                        <label for="name">Símbolo de Moneda:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::text('currency', Config::get('localhost.currency'), ['class' => 'form-control']) !!}
                        </div>

                        <label for="product_per_page" class="mtop16">Monto mínimo de compra:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('shipping_amount_min', Config::get('localhost.shipping_amount_min'), ['class' => 'form-control', 'min' => 0, 'required']) !!}
                        </div>
                        <label for="product_per_page" class="mtop16">Configuración de precio de envío:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::select('shipping_method', getShippingMethod(), Config::get('localhost.shipping_method'), ['class' => 'form-control']) !!}
                        </div>
                        <label for="product_per_page" class="mtop16">Valor del envío:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('shipping_default_value', Config::get('localhost.shipping_default_value'), ['class' => 'form-control', 'min' => 1, 'required']) !!}
                        </div>
                        <label for="shop_min_amount" class="mtop16">Monto mínimo de envió gratis:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('shop_min_amount', Config::get('localhost.shop_min_amount'), ['class' => 'form-control', 'min' => '1', 'required']) !!}
                        </div>
                        <label for="to_go" class="mtop16">Ordenes TOGO:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::select('to_go', getEnableorNot(),Config::get('localhost.to_go'), ['class' => 'form-select']) !!}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-wifi"></i> Redes Sociales</h2>
                    </div>
                    <div class="inside">
                        <label for="social_facebook" >Facebook: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fab fa-facebook"></i></span>
                            {!! Form::text('social_facebook', Config::get('localhost.social_facebook'), ['class' => 'form-control', 'min' => 1, 'required']) !!}
                        </div>
                        <label for="social_instagram" class="mtop16">Instagram: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fab fa-instagram"></i></span>
                            {!! Form::text('social_instagram', Config::get('localhost.social_instagram'), ['class' => 'form-control', 'min' => 1, 'required']) !!}
                        </div>
                        <label for="social_twitter"  class="mtop16" >Twitter:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fab fa-twitter"></i></span>
                            {!! Form::text('social_twitter', Config::get('localhost.social_twitter'), ['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="social_youtube"  class="mtop16" > Youtube:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fab fa-youtube"></i></span>
                            {!! Form::text('social_youtube', Config::get('localhost.social_youtube'), ['class' => 'form-control']) !!}
                        </div>

                        <label for="social_whatsapp"  class="mtop16" >Whatsapp:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fab fa-whatsapp"></i></span>
                            {!! Form::text('social_whatsapp', Config::get('localhost.social_whatsapp'), ['class' => 'form-control']) !!}
                        </div>
                </div>
               
            </div>
            

            
           
           
         

        </div>
        {{-- End row #1 --}}
        
         {{-- Row #2 --}}
        <div class="row mtop16">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-file "></i> Paginación</h2>
                    </div>
                    <div class="inside">
                        <label for="product_per_page_random" >Productos para mostrar por página(Random):</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('product_per_page_random', Config::get('localhost.product_per_page_random'), ['class' => 'form-control', 'min' => 1, 'required']) !!}
                        </div>
                        <label for="product_per_page" class="mtop16">Productos para mostrar por página :</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('product_per_page', Config::get('localhost.product_per_page'), ['class' => 'form-control', 'min' => 1, 'required']) !!}
                        </div>
                        <label for="map"  class="mtop16" >Ubicaciones:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i></span>
                            {!! Form::number('map', Config::get('localhost.map'), ['class' => 'form-control']) !!}


                        </div>
                        
                </div>
               
            </div>
            
        </div>
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-wallet"></i> Pagos e Integraciones</h2>
                </div>
                <div class="inside">

                    <label for="payment_method_cash">Pagos en efectivo:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-cash-register"></i></span>
                        {!! Form::select('payment_method_cash',getEnableorNot(), Config::get('localhost.payment_method_cash'), ['class' => 'form-select']) !!}
                    </div>

                    <label for="payment_method_transfer" class="mtop16">Transferencia / Depósito bancario:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-comment-dollar"></i></span>
                            {!! Form::select('payment_method_transfer',getEnableorNot(), Config::get('localhost.payment_method_transfer'), ['class' => 'form-select']) !!}
                    </div>

                    
                    <label for="payment_method_paypal" class="mtop16">Paypal:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-paypal"></i></span>
                            {!! Form::select('payment_method_paypal',getEnableorNot(), Config::get('localhost.payment_method_paypal'), ['class' => 'form-select']) !!}
                    </div>

                       
                    <label for="payment_method_credit_cart" class="mtop16">Tarjeta de crédito:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-credit-card"></i></span>
                            {!! Form::select('payment_method_credit_cart',getEnableorNot(), Config::get('localhost.payment_method_credit_cart'), ['class' => 'form-select']) !!}
                    </div>

                    
                    
                    

                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fab fa-linux"></i> Servidor</h2>
                </div>
                <div class="inside">

                    <label for="server_uploads_paths">Uploads Server Path:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i></span>
                        {!! Form::text('server_uploads_paths', Config::get('localhost.server_uploads_paths'), ['class' => 'form-control']) !!}
                    </div>

                    <label for="server_uploads_user_paths" class="mtop16">Uploads Server Path:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i></span>
                        {!! Form::text('server_uploads_user_paths', Config::get('localhost.server_uploads_user_paths'), ['class' => 'form-control']) !!}
                    </div>
                

                </div>
            </div>
        </div>
          {{-- End row #2 --}}


        <div class="row mtop16">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="inside">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
        
        {!! Form::close() !!}
        
    </div>
@endsection
