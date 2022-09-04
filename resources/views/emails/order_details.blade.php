@extends('emails.master')
@section('content')
<p>Hola: <strong> {{ $order->getUser->name }} {{ $order->getUser->lastname }}</strong></p>
    <p> Hemos recibido su orden N°{{ $order->o_number }} y este es el detalle de su compra </p>

<table class="table table-striped align-middle table-hover">
    <thead>
        <tr>
            
            <td width="50"> </td>
            <td><strong>Producto</strong></td>
            <td width="60"><strong>Cantidad</strong></td>
            <td width="200"><strong>Subtotal</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->getItems as $item)
            <tr>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"> <img
                        src="{{ url('/uploads/' . $item->getProduct->file_path . '/t_' . $item->getProduct->imagen) }}"
                        style="width: 50px; border-radius: 4px">
                </td>
                <td  style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px">
                    <a
                        href="{{ url('/product/' . $item->getProduct->id_articulo . '/t_' . $item->getProduct->slug) }}" style="color: #333; text-decoration:none">
                        {{ $item->label_item }}

                        <div class="price_discount" style="font-weight: 700;">
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
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px">{{$item->quantity}}
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px">{{$item->total}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"> </td>
            <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"><strong>Subtotal: </strong></td>
            <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px">{{ config('localhost.currency') . ' ' . number_format($order->getSubtotal(), 2, '.', ',') }}
            </td>

        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"> </td>
            <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"><strong>Precio de envio: </strong></td>
            <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px">{{ config('localhost.currency') . ' ' . number_format($order->delivery, 2, '.', ',') }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"> </td>
            <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px"><strong>Total: </strong></td>
            <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px">{{ config('localhost.currency') . ' ' . number_format($order->total, 2, '.', ',') }}
            </td>
        </tr>
    </tbody>
</table>
@if (!is_null($order->user_address_id))
<p><strong>La orden será enviada a la dirección</strong></p>  
<p style="margin-bottom: 2px; margin-top: 0px;"><strong>Provincia: </strong>
    {{ $order->getUserAddress->getState->name }}</p>
<p style="margin-bottom: 2px; margin-top: 0px;"><strong>Ciudad: </strong>
    {{ $order->getUserAddress->getCity->name }}</p>
<p style="margin-bottom: 2px; margin-top: 0px;"><strong>Dirección: </strong>
    {{ kvfj($order->getUserAddress->addr_info, 'add1') }}
    {{ kvfj($order->getUserAddress->addr_info, 'add2') }}
    {{ kvfj($order->getUserAddress->addr_info, 'add3') }}
</p>
<p style="margin-bottom: 2px; margin-top: 0px;"><strong>Referencia: </strong>
    {{ kvfj($order->getUserAddress->addr_info, 'add4') }} </p>

@endif
<hr>
<p>Se reserva el derecho de aceptar o rechazar una orden, sin previo aviso, si su orden se marca como rechazada 
y ha seleccionado un método de pago como transferencia o tarjeta de crédito, su dinero será reembolsando de forma 
automática.
</p>
@if($order->payment_method == "0")
<p>Ha seleccionado pagar en efectivo en su domicilio.</p>
    
@endif

@stop