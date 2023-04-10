<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{
    protected $table = 'companies';

    protected $fillable = ['company_name', 'street_address', 'representive_name'];

     /**
     * 一覧画面表示用にcompaniesテーブルから全てのデータを取得
     */
    public function Companies()
    {
        return companies::all();
    }

    //Productsモデルとリレーション
    public function products()
    {
        return $this->hasMany('App\Models\Products');
    }
    
}
