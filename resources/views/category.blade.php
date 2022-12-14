@extends('master')
@section('title', 'Tienda-'.$category->cate_nombre )
@section('custom_meta')
<meta name="category_id" content="{{$category->id_categoria }}">
@stop
@section('content')
    <div class="store">
        <div class="row mtop32">
            <div class="col-md-3">
                <div class="categories_list shadow-lg">
                    <h2 class="title"><i class="fas fa-stream"></i>{{$category->cate_nombre }}<i class="fas fa-chevron-down"></i></h2>
                    <ul>
                    @if($category->parent != "0")
                        <li><a href="{{url('/store/category/'.$category->getParent->id_categoria.'/'.$category->getParent->slug)}}">
                        <small><i class="fas fa-chevron-left"></i> Regresar a {{$category->getParent->cate_nombre}}</small>
                        </a>
                        </li>
                    @endif
                     @if($category->parent == "0")
                        <li>
                        <a href="{{url('/store/')}}">
                        <small><i class="fas fa-chevron-left"></i> Regresar a la tienda</small>
                        </a>
                        </li>
                         <li>
                        <a href="{{url('/store/category/'.$category->id_categoria.'/'.$category->slug)}}">
                        <small><i class="fas fa-chevron-down"></i> SubCategorías</small>
                        </a>
                        </li>
                    @endif

                        @foreach ($categories as $cat)
                            <li><a href="{{ url('/store/category/' . $cat->id_categoria . '/' . $cat->slug) }}"><img
                                        src="{{ url('/uploads/' . $cat->file_path . '/' . $cat->icono) }}"
                                        alt="">{{ $cat->cate_nombre }}
                                </a>
                            </li>

                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="store_white1">
                    <section>
                        <h2 class="home_title"><i class="fas fa-store-alt"></i> {{$category->cate_nombre}}</h2>
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
