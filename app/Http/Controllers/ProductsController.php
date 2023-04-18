<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Companies;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
  /* 一覧画面
  public function __construct()
    {
        $this->products = new Products();
    }

   public function index()
    {
        $product = $this->products->findAllProducts();

        return view('product', compact('product'));
    }
    */

    public $companies;
    public $product;

    //インスタンス生成
    public function __construct()
    {
        $this->products = new Products();
        $this->companies = new Companies();
    }

    //productsとcompaniesの結合・companiesの取得
    public function index()
    {
        $product = $this->products->findAllProductsWithCompanies();
        
        $company = $this->companies->getData();
        
        return view('product', ['product'=>$product, 'companies'=>$company]);
    }
    

    /* 登録画面*/
    public function create() {
        return view('products_register');
    }

    /* 登録処理*/
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $registerProduct = $this->products->InsertProduct($request);

            DB::commit();
        } catch (Exception $e) {

            DB::rollback();
        }
        return redirect()->route('newproduct.store');
    }


    /*詳細画面の表示*/
    public function show($id)
    {
        $product = $this->products->find($id);
        //$product = Products::find($id);

        return view('show', ['p'=>$product]);
    }

    /* 編集画面の表示 */
    public function edit($id)
    {
        $product = $this->products->find($id);

        $company = $this->companies->getData();

        return view('edit', ['p'=>$product, 'companies'=>$company]);
    }

    
    /* 商品検索*/
    public function search(Request $request)
    {
    //$keyword = $request->input('keyword');
        $result = $this->products->seachProduct($request);

        $company = $this->companies->getData();
    
        return view('product',['product'=>$result, 'companies'=>$company]);
    }

    /* 更新処理 */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //$product = $this->products->find($id);

            $updateProduct = $this->products->updateProduct($request, $id);
// 
            //$product = $this->products->find($id);

        } catch (Exception $e) {
            DB::rollback();
        }        
        //dd($updateProduct);

        $company = $this->companies->getData();


        return view('edit',['p'=>$updateProduct, 'companies'=>$company]);
    }

    /* 削除処理 */
    public function destroy($id)
    {
         // 指定されたIDのレコードを削除
        DB::beginTransaction();
        try {
            $deleteProduct = $this->products->deleteProductById($id);
        } catch (Exception $e) {
            DB::rollback();
        }
        
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('products.index');
    }

}

