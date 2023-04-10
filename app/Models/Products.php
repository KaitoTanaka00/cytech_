<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    /*
     public static function leftJoin()
    {
    $product = DB::table('products')
                ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
                ->select('products.*', 'companies.company_name')
                ->distinct()
                ->get();
    }
    */


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
    
    /**
     * 一覧画面表示用にproductsテーブルから全てのデータを取得
     
    public function findAllProducts()
    {
        return products::all();
    }
    */

    public function findAllProductsWithCompanies()
    {
        $products = DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->get();
        return $products;
    }

    
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
    public function updateProduct($request, $product)
    {
        $result = $product->fill([
            'product_name'          => $request->product_name,
            'company_id'            => $request->company_id,
            'price'                 => $request->price,
            'stock'                 => $request->stock,
            'comment'               => $request->comment,
            'img_path'              => $request->img_path,
        ])->save();

        return $result;
    }

    /*　削除処理*/
    public function deleteProductById($id)
    {
        return $this->destroy($id);
    }
    
    

}
