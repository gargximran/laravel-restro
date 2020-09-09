<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Food;

class FoodController extends Controller
{
    public function storeCategory(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $cat = Category::where('user_id', $request->user()->user_id)->where('name', $request->name)->get()->count();

        if($cat){
            return redirect()->route('foodShow');
        }

        $category = new Category();
        $category->name = $request->name;
        $category->cat_id = uniqid().Str::random(12).time();
        $category->user()->associate($request->user());
        if($category->save()){
            return redirect()->route('foodShow');
        }else{
            return redirect()->route('foodShow');
        }        
    }




    public function updateCategory(Request $request,User $user, Category $category){
        $request->validate([
            "name" => 'required'
        ]);
        $cat = Category::where('user_id', $request->user()->user_id)->where('name', $request->name)->where('id', "!=", $category->id)->get()->count();

        if($cat){
            return redirect()->route('foodShow');
        }

        $category->name = $request->name;
        if($category->save()){
            return redirect()->route('foodShow');
        }else{
            return redirect()->route('foodShow');
        } 
    }






    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);

        $fo = Food::where('name', $request->name)->where('user_id', $request->user()->user_id)->get()->count();

        if($fo){
            return redirect()->route('foodShow');
        }

        $category = Category::where('cat_id', $request->category)->where('user_id', $request->user()->user_id)->first();

        $food = new Food();
        $food->food_id = uniqid().Str::random(12).time();
        $food->name = $request->name;
        $food->user()->associate($request->user());
        $food->price = $request->price;
        $food->type = $request->type;
        $food->category()->associate($category);
        if($food->save()){
            return redirect()->route('foodShow');
        }else{
            return redirect()->route('foodShow');
        } 
    }


    public function update(Request $request, User $user, Food $food){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);
        $fo = Food::where('name', $request->name)->where('user_id', $request->user()->user_id)->where('id', '!=', $food->id)->get()->count();

        if($fo){
            return redirect()->route('foodShow');
        }

        $category = Category::where('cat_id', $request->category)->where('user_id', $request->user()->user_id)->first();

        $food->name = $request->name;
        $food->user()->associate($request->user());
        $food->price = $request->price;
        $food->type = $request->type;
        $food->category()->associate($category);
        if($food->save()){
            return redirect()->route('foodShow');
        }else{
            return redirect()->route('foodShow');
        } 



    }




    public function deleteCategory(Request $request,User $user, Category $category)
    {
        if($category->foods() && $category->foods()->delete()){
            if($category->delete()){
                return redirect()->route('foodShow');
            }
            return redirect()->route('foodShow');
        }

        if($category->delete()){
            return redirect()->route('foodShow');
        }
        return redirect()->route('foodShow');
    }
}
