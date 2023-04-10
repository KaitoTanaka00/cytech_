<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TestUser;

class TestUserController extends Controller
{
    public function getTestData (Request $request)
    {
        $items = TestUser::all();
        return view ('test_views.index', ['items' => $items]);
    }
}
