@extends('master')
@section('title', 'Búsqueda')
@section('content')
<div class="store">
    <div class="row mtop32">
        <div class="col-md-3">
            <div class="categories_list shadow-lg">
                <h2 class="title"><i class="fas fa-stream"></i>Categorias</h2>

            </div>
        </div>
        <div class="col-md-9">
            <div class="home_action_bar nomargin shadow">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['url' => '/search']) !!}
                        <div class="input-group">
                            <i class="fas fa-search"></i>
                            {!! Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => '¿Buscas algo?', 'required']) !!}
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="store_white1 mtop32">
                <section>
                    <h2 class="home_title"><i class="fas fa-store-alt"></i> Buscando: {{ $query }}</h2>
                    <div class="products_list" id="products_list">
                        @foreach($products as $product)
                        <div class="product">
                            <div class="image">
                                <div class="overlay">
                                    <div class="btns">
                                        <a href="{{ url('/product/'.$product->id_articulo.'/'.$product->slug) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                       
                                    </div>
                                </div>
                                <img src="{{ url('/uploads/'.$product->file_path.'/t_'.$product->imagen) }}" alt="">
                            </div>
                            <a href="{{ url('/uploads/'.$product->id_articulo.'/'.$product->slug) }}">
                            <div class="title">{{ $product->nombre_articulo }}</div>
                            <div class="price">{{ Config::get('localhost.currency') }} {{ $product->precio }}</div>
                            </a>
                        </div>

                        @endforeach
                    </div>

                </section>
            </div>
        </div>
    </div>
</div>
@endsection
