<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function foodShow(Request $request){

        $categories = $request->user()->categories;
        return view('pages.food', compact('categories'));
    }



    public function index()
    {
          
        $tables = request()->user()->table()->orderBy('name', 'asc')->get();
        
        return view('pages.table', compact('tables'));
    }

    public function order(Request $request){
        return $request->qty;
    }



}
