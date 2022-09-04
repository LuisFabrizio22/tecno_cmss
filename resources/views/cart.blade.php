@extends('master')
@section('title', 'Carrito de compra')
@section('content')
    <div class="cart mtop32">

        <div class="container">
            @if (count(collect($items)) == '0')
                <div class="no_items shadow">
                    <div class="inside">
                        <p><img src="{{ url('/static/images/empty-cart.png') }}" ></p>
                        <p><strong>Hola {{ Auth::user()->name }}</strong>, Aun no tienes nada en tu carrito de compra,
                            animate a agregar
                            uno de
                            nuestros increíbles productos</p>
                        <p>
                            <a href="{{ url('/store') }}">Ir a la tienda</a>
                        </p>

                    </div>

                </div>

            @else
                <div class="items mtop32">

                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel">
                                <div class="header">
                                    <h2 class="title"><i class="fas fa-shopping-cart"></i> Carrito de compras</h2>
                                </div>
                                <div class="inside">
                                    <table class="table table-striped align-middle table-hover">
                                        <thead>
                                            <tr>
                                                <td> </td>
                                                <td width="60"> </td>
                                                <td><strong>Producto</strong></td>
                                                <td width="160"><strong>Cantidad</strong></td>
                                                <td><strong>Subtotal</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <td>
                                                        <a href="{{ url('/cart/item/' . $item->id . '/delete') }}"
                                                            data-action="delete" data-toggle="tooltip" data-toggle="tooltip"
                                                            data-placement="top " title="eliminar" class="btn-delete">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>

                                                    </td>
                                                    <td> <img
                                                            src="{{ url('/uploads/' . $item->getProduct->file_path . '/t_' . $item->getProduct->imagen) }}"
                                                            class="img-fluid rounded">
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ url('/product/' . $item->getProduct->id_articulo . '/t_' . $item->getProduct->slug) }}">
                                                            {{ $item->label_item }}

                                                            <div class="price_discount">
                                                                Precio:
                                                                @if ($item->discount_status == '1')
                                                                    <span
                                                                        class="price_initial">{{ config('localhost.currency') . ' ' . number_format($item->price_initial, 2, '.', ',') }}
                                                                    </span>-
                                                                @endif
                                                                <span
                                                                    class="price_unit">{{ config('localhost.currency') . ' ' . number_format($item->price_unit, 2, '.', ',') }}
                                                                    @if ($item->discount_status == '1')
                                                                        ({{ $item->discount }})% de descuento)
                                                                    @endif
                                                                </span>
                                                            </div>

                                                        </a>
                                                    </td>
                                                    <td width="100">
                                                        <div class="form_quantity">

                                                            {!! Form::open(['url' => '/cart/item/' . $item->id . '/update']) !!}
                                                            {!! Form::number('quantity', $item->quantity, ['min' => '1', 'class' => 'form-control']) !!}
                                                            <button type="submit"><i class="far fa-save"></i></button>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                    <td>{{ config('localhost.currency') . ' ' . $item->total }} </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3"> </td>
                                                <td><strong>Subtotal: </strong></td>
                                                <td>{{ config('localhost.currency') . ' ' . number_format($order->getSubtotal(), 2, '.', ',') }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="3"> </td>
                                                <td><strong>Precio de envio: </strong></td>
                                                <td>{{ config('localhost.currency') . ' ' . number_format($order->delivery, 2, '.', ',') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"> </td>
                                                <td><strong>Total: </strong></td>
                                                <td>{{ config('localhost.currency') . ' ' . number_format($order->total, 2, '.', ',') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            {!! Form::open(['url' => '/cart']) !!}
                            {!! Form::hidden('payment_method', null,['id'=>'field_payment_method_id']) !!}
                            <div class="panel">
                                <div class="header">
                                    <h2 class="title"><i class="fas fa-map-marker"></i> Dirección de envio</h2>
                                </div>
                                <div class="inside">
                                    @if($order->o_type == "0")
                                        @if (!is_null(Auth::user()->getAddressDefault))
                                            <p style="margin-bottom: 2px;"><strong>Provincia: </strong>
                                                {{ Auth::user()->getAddressDefault->getState->name }}</p>
                                            <p style="margin-bottom: 2px;"><strong>Ciudad: </strong>
                                                {{ Auth::user()->getAddressDefault->getCity->name }}</p>
                                            <p style="margin-bottom: 2px;"><strong>Dirección: </strong>
                                                {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'add1') }}
                                                {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'add2') }}
                                                {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'add3') }}
                                            </p>
                                            <p style="margin-bottom: 2px;"><strong>Referencia: </strong> {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'add4') }}  </p>
                            
                                                <a href="{{ url('account/address') }}" class="btn btn-dark mtop16">Cambiar
                                                    Dirección</a>
                                        
                                        @else
                                            <p>Su usuario no tiene direcciones registradas</p>
                                            <p><a href="{{ url('/account/address') }}" class="btn btn-dark mtop16">Agregar
                                                    Dirección</a></p>
                                        @endif
                                    @endif

                                    @if(config('localhost.to_go') == "1")

                                    <div class="mcswitch">
                                        <a href="{{ url('/cart/'.$order->id.'/type/0') }}"  class="sl @if($order->o_type == "0") active @endif"><i class="fas fa-motorcycle"></i>Domicilio</a>
                                        <a href="{{ url('/cart/'.$order->id.'/type/1') }}"  class="sl @if($order->o_type == "1") active @endif"><i class="fas fa-car-side"></i>TO GO</a>
                                       
                                    </div>
                                   
                                   @endif
                                </div>
                            </div>
                            <div class="panel mtop8">
                                <div class="header">
                                    <h2 class="title"><i class="fas fa-credit-card"></i> Método de pago</h2>
                                </div>
                                <div class="inside">
                                    <div class="payments_methods">
                                        @if (config('localhost.payment_method_cash') == '1')
                                            <a href="#" class="btn_payment_method w-100" id="payment_method_cash" data-payment-method-id="0">
                                                <i class="fas fa-cash-register"></i> Pagar en efectivo
                                            </a>
                                        @endif
                                        @if (config('localhost.payment_method_transfer') == '1')
                                            <a href="#" class="btn_payment_method w-100" id="payment_method_transfer"  data-payment-method-id="1">
                                                <i class="fas fa-comment-dollar"></i> Transferencia o depósito
                                            </a>
                                        @endif
                                        @if (config('localhost.payment_method_paypal') == '1')
                                            <a href="#" class="btn_payment_method w-100" id="payment_method_paypal"  data-payment-method-id="2">
                                                <i class="fab fa-paypal"></i> Paypal
                                            </a>
                                        @endif
                                        @if (config('localhost.payment_method_credit_cart') == '1')
                                            <a href="#" class="btn_payment_method w-100" id="payment_method_credit_cart"  data-payment-method-id="3">
                                                <i class="fas fa-credit-card"></i> Tarjeta de crédito
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                                <div class="panel mtop8">
                                    <div class="header">
                                        <h2 class="title"><i class="fas fa-credit-card"></i> Enviar comentario</h2>
                                    </div>
                                    <div class="inside">
                                        {!! Form::textarea('order_msg', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                    </div>
                                </div>

                                @if (!is_null(Auth::user()->getAddressDefault))
                                    <div class="panel mtop16">
                                        <div class="inside">
                                            {!! Form::submit('Completar orden', ['class' => 'btn btn-success disabled', 'id'=>'pay_btn_complete']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </div>

                        </div>
                    </div>
            @endif

        </div>


    </div>
@stop
