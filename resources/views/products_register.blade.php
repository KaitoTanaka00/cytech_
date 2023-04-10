@extends('layouts.bpp')

@section('title', '商品登録')

@section('content')
    <title>商品登録</title>

    <form action="{{route("newproduct.store")}}" method=POST>
      {{ csrf_field() }}
      商品名<input type="text" name="product_name" required><br>
      メーカー名
      <select name="company_id">
        <option value="1">company A</option>
        <option value="2">company B</option>
        <option value="3">company C</option>
      </select><br>
      価格<input type="text" name="price" pattern="^[0-9A-Za-z]+$" required><br>
      在庫数<input type="text" name="stock" pattern="^[0-9A-Za-z]+$" required><br>
      コメント<textarea name="comment"></textarea><br>
      画像<input type="file" name="img_path">
      <br><br>
      <input type="submit" value="登録">
    </form>    
    <a href="{{ route('products.index') }}"><input type="button" name="" id="" value="戻る"></a>
@endsection