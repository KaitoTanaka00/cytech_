<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{
    // モデルに関連付けるテーブル
    protected $table = 'companies';

    protected $fillable = ['company_name', 'street_address', 'representive_name'];

    //companiesのDB取得
    public function getData()
    {
        $companies = DB::table($this->table)->get();

        return $companies;
    }

    //Productsモデルとリレーション
    public function products()
    {
        return $this->hasMany('App\Models\Products');
    }
    
}
