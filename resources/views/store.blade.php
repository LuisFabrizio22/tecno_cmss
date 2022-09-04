@extends('master')
@section('title', 'Tienda')
@section('content')
    <div class="store">
        <div class="row mtop32">
            <div class="col-md-3">
                <div class="categories_list shadow-lg">
                    <h2 class="title"><i class="fas fa-stream"></i>Categorias</h2>
                    <ul>
                        @foreach ($categories as $category)
                            <li><a href="{{ url('/store/category/' . $category->id_categoria . '/' . $category->slug) }}"><img
                                        src="{{ url('/uploads/' . $category->file_path . '/' . $category->icono) }}"
                                        alt="">{{ $category->cate_nombre }}
                                </a>
                            </li>

                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="store_white1">
                    <section>
                        <h2 class="home_title"><i class="fas fa-store-alt"></i> Ultimos productos agregados</h2>
                        <div class="products_list" id="products_list"></div>
                        <div class="load_more_products">
                            <a href="#" id="load_more_products"><i class="far fa-paper-plane"></i> Cargar más productos</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
