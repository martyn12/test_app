<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * метод отображения главной страницы админки
     */

    public function index()
    {
        return view('admin.index');
    }
}
