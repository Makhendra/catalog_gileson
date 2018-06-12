@extends('index')

@section('header')
<div class="row main-title">
    <div class="col-6 text-left "> <h2>Тестовый каталог</h2></div>
    <div class="col-6 text-right">
      <form method="POST" action="/" id="search">
        {!! csrf_field() !!}
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="search" minlength="3" id="input-search">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Поиск</button>
          </div>
        </div>
      </form>
    </div>
    <div id="result" class="col-12"></div>
    <div class="close-search hidden"></div>
  </div>
@endsection


@section('content')
  @include('fragments.categories')
  @include('fragments.products')
@endsection