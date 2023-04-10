@extends('layouts.bpp')

@section('title', '商品一覧')


@section('content')
    商品一覧</br>
    <form class="form-inline" action="{{ url('search') }}">
        <div class="form-group">
            <input type="text" name="keyword" value="{{request('$keyword')}}" class="form-control" placeholder="キーワード入力">
        </div>
        
        <select name="company_search">
            <option value="0">-</option>
            @foreach($companies as $value)
            <option value="{{ $value->id }}">{{ $value->company_name }}</option>
            @endforeach
        </select>

        <input type="submit" value="検索" class="btn btn-info">
        <input type="button" onclick="location.href='./test_views'" value="クリア">
    </form>
    
    <table>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
        @foreach($product as $p)
        <tr class="dbconect" id="{{$p->id}}">
            <td>{{ $p->id }}</td>
            <td><img src="{{asset('image/'.$p->img_path)}}" height="10" width="30"></td>
            <td>{{ $p->product_name }}</td>
            <td>{{ $p->price }}</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->company_name }}</td>
            <td><a href="{{ route('product.show', ['id'=>$p->id]) }}" class="btn btn-primary" ><input class="show" type="button" value="詳細"></a></td>
            <td>
                <form action="{{ route('product.destroy', ['id'=>$p->id]) }}" method="POST"> 
                @csrf
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
     
    
    <input type="button" onclick="location.href='./products_register'" value="商品登録">
@endsection
