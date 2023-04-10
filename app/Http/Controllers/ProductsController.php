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

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $product = $this->products->findAllProductsWithCompanies();
        
        $companies = companies::all();
        
        return view('product', ['product'=>$product, 'companies'=>$companies]);
    }
    

    /* 登録画面*/
    public function create() {
        return view('products_register');
    }

    /* 登録処理*/
    public function store(Request $request)
    {
        $registerProduct = $this->products->InsertProduct($request);
        return redirect()->route('newproduct.store');
    }


    /*詳細画面の表示*/
    public function show($id)
    {
        $product = Products::find($id);

        return view('show', ['p'=>$product]);
    }

    /* 編集画面の表示 */
    public function edit($id)
    {
        $product = Products::find($id);

        $companies = companies::all();

        return view('edit', ['p'=>$product, 'companies'=>$companies]);
    }

    
    /* 商品検索*/
    public function search(Request $request)
    {
    //$keyword = $request->input('keyword');
    $request->keyword;
    
    $request->company_search;
    
    $query = Products::query();

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

    $companies = companies::all();
    
    return view('product',['product'=>$result, 'companies'=>$companies]);
    }

  /* 更新処理 */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);

        $updateProduct = $this->products->updateProduct($request, $product);

        $product = Products::find($id);

        $companies = companies::all();

        return view('edit',['p'=>$product, 'companies'=>$companies]);
    }

  /* 削除処理 */
    public function destroy($id)
    {
         // 指定されたIDのレコードを削除
        $deleteProduct = $this->products->deleteProductById($id);
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('products.index');
    }

}

