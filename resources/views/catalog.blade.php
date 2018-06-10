@extends('index')
@section('content')
<div class="container">

  <div class="row main-title">
    <div class="col-6 text-left "> <h2>Тестовый каталог</h2></div>
    <div class="col-6 text-right">
      <form method="POST" action="/" id="search">
        {!! csrf_field() !!}
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="search">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Поиск</button>
          </div>
        </div>
      </form>
    </div>
    <div id="result" class="col-12 hidden"></div>
  </div>
  
  @foreach($products->chunk(4) as $product_c)
  <div class="row row-card">
    @foreach($product_c as $product)
    <div class="col-3 card card-flex">
      <img class="card-img-top image-card" src="{{$product->image}}" alt="{{$product->title}}">
      <div class="card-body">
        <h5 class="card-title">{{$product->title}}</h5>
        <p class="card-text text-desc">{{ str_limit($product->description, 100)}}</p>
        <a target="_blanck" href="{{$product->url}}" class="btn btn-primary">Подробнее</a>
      </div>
    </div>
    @endforeach
  </div>
  @endforeach
  
</div>
@endsection