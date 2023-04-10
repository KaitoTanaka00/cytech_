@extends('layouts.bpp')

@section('title', '商品詳細')

@section('content')
<h1>詳細確認</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>商品情報ID</th>
      <th>商品画像</th>
      <th>商品名</th>
      <th>メーカー名</th>
      <th>価格</th>
      <th>在庫数</th>
      <th>コメント</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $p->id }}</td>
      <td><img src="{{asset('image/'.$p->img_path)}}" height="10" width="30"></td>
      <td>{{ $p->product_name }}</td>
      <td>{{ $p->company_name }}</td>
      <td>{{ $p->price }}</td>
      <td>{{ $p->stock }}</td>
      <td>{{ $p->comment }}</td>
    </tr>
  </tbody>
</table>
<a href="{{ route('product.edit', ['id'=>$p->id]) }}" class="btn btn-primary" ><input class="edit" type="button" value="編集"></a>
</br>
<a href="{{ route('products.index') }}"><input type="button" name="" id="" value="戻る"></a>

@endsection
