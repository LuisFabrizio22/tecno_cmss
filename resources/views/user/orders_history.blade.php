@extends('master')
@section('title', 'Historial de compras')
@section('content')
    <div class="row mtop32">
        <div class="col-md-12">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-history"></i>Historial de compras</h2>

                </div>
                <div class="inside">
                    <div class="edit_avatar">
                        <table class="table table-striped align-middle table-hover">
                            <thead>
                                <tr>
                                <td width="20"><strong>N°</strong></td>
                                <td width="160"><strong>Estado</strong></td>
                                <td width="160"><strong>Tipo</strong></td>
                                <td width="160"><strong>Método de pago</strong></td>
                                <td width="124"><strong>Total</strong></td>
                                <td width="124"></td>
                              
                                </tr>
                            </thead>
                            @foreach (Auth::user()->getOrders as $order )
                            <tr>
                                <td>{{$order->o_number}}</td>
                                <td>{{ getOrderStatus($order->status) }}</td>
                                <td>{{ getOrderType($order->o_type) }}</td>
                                <td>{{ getPaymentsMethods($order->payment_method) }}</td>
                                <td>${{ $order->total }}</td>
                                <td><a href="{{url('/account/history/order/'.$order->id)}}" class="btn btn-primary btn-sm w-100"><i class="far fa-clipboard"></i> Ver Compra</a></td>
                            </tr>
                                
                            @endforeach


                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
