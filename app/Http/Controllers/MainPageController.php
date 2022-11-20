<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
        return view('main', [
            'title' => 'Trang Chủ Shop Nước Hoa',
        ]);
    }
}
