@extends('layouts.bpp')

@section('title', '商品編集')

@section('content')
<div class="container small">
  <h1>商品編集</h1>
  <form action="{{ route('product.update', ['id'=>$p->id]) }}" method="POST">
  @csrf
      <div class="form-group">
      商品名<input type="text" name="product_name" value="{{ $p->product_name }}" required><br>
      メーカー名
      <select name="company_id">
        @foreach($companies as $value)
          @if($value->id = $p->company_id)
            <option value="{{ $value->id }}" selected>{{ $value->company_name }}</option>
          @else
            <option value="{{ $value->id }}">{{ $value->company_name }}</option>
          @endif
        @endforeach
      </select><br>
      価格<input type="text" name="price" value="{{ $p->price }}" required><br>
      在庫数<input type="text" name="stock" value="{{ $p->stock }}" required><br>
      コメント<textarea name="comment">{{ $p->comment }}</textarea><br>
      画像<input type="file" name="img_path">
      </div>
      <input type="submit" value="更新">
  </form>
  <a href="{{ route('product.show',  ['id'=>$p->id]) }}"><input type="button" name="" id="" value="戻る"></a>

</div>

@endsection