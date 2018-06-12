@foreach($products->chunk(4) as $product_c)
  <div class="row row-card">
    @foreach($product_c as $product)
    <div class="card card-flex">
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
