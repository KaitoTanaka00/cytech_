<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;
    
    // モデルに関連付けるテーブル
    protected $table = 'products';

    //Companiesモデルとリレーション
    public function company()
    {
        return $this->belongsTo('App\Models\Companies');
    }

    //productsのDB取得
    public function getProduct()
    {
        $product = DB::table($this->table)->get();

        return $product;
    }

    //productsのidを取得
    public function find($id)
    {
        $findProduct = DB::table($this->table)
        ->select('products.*', 'companies.company_name')
        ->where('products.id',$id)
        ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
        ->first();
        
        // dd($findProduct);

        return $findProduct;
    }

    //検索処理
    public function seachProduct(Request $request)
    {
        $query = DB::table($this->table);
        
        if(!empty($request->keyword))
        {
            $query->where('product_name','like','%'.$request->keyword.'%');
        }

        if($request->company_search && $request->company_search != 0){
        //dd($request);
            $query->where('company_id',"=",$request->company_search);
        }

        $result = $query->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')->get();

        return $result;
    }

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'product_name',
        'company_id',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at'
    ];

    //productsとcompaniesの結合
    public function findAllProductsWithCompanies()
    {
        $products = DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->get();
        return $products;
    }

    //登録処理
    public function InsertProduct($request)
    {
        // リクエストデータを基に登録する
        return $this->create([
            'product_name'          => $request->product_name,
            'company_id'            => $request->company_id,
            'price'                 => $request->price,
            'stock'                 => $request->stock,
            'comment'               => $request->comment,
            'img_path'              => $request->img_path,
        ]);
    }

    //編集
    public function updateProduct($request, $id)
    {
        \DB::table($this->table)
        ->where('products.id', $id)
        ->update([
            'product_name'          => $request->product_name,
            'company_id'            => $request->company_id,
            'price'                 => $request->price,
            'stock'                 => $request->stock,
            'comment'               => $request->comment,
            'img_path'              => $request->img_path,
        ]);

        $result = $this->find($id);        
        //dd($result);

        return $result;
    }

    /*　削除処理*/
    public function deleteProductById($id)
    {
        return $this->destroy($id);
    }
    
    

}
