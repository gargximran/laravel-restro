<?php

namespace App\Http\Controllers;

use App\Bill;
use App\table;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        if(request()->user()->isAdmin){
            $tables = request()->user()->table()->orderBy('name', 'asc')->get();
        }else{
            $tables = request()->user()->admin->table()->orderBy('name', 'asc')->get();
        }
        return view('pages.dashboard', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ex = $request->user()->table()->where('name', $request->name)->get()->count();
        if($ex){
            return redirect()->route('tableShow');
        }
        $table = new table();
        $table->name = $request->name;
        $table->table_id = uniqid().Str::random(12).time();
        $table->user()->associate($request->user());
        $table->status = 0;
        if($table->save()){
            return redirect()->route('tableShow');
        }
        return redirect()->route('tableShow');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        if(request()->user()->isAdmin){
            $categories = request()->user()->categories()->orderBy('name', 'asc')->get();
            $users = request()->user()->user;
        }else{
            $categories = request()->user()->admin->categories()->orderBy('name', 'asc')->get();
            $users = request()->user()->admin->user;
        }


        
        return view('pages.inTable', compact('categories','table', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
    }




    public function start($table, $boyid)
    {
        $table = table::where('table_id', $table)->first();
        $user = User::find($boyid);
    

    
        $bill = new Bill();       
        $bill->bill_id = time();
        $bill->table_id = $table->table_id;
        $bill->table_name = $table->name;
        $bill->total = 0;
        $bill->discount = 0;
        $bill->payable = 0;
        $bill->by = $user->name;
        $bill->vat = 0;
        $bill->service_charge = 0;
        $bill->status = 1;
        $bill->user_id = $table->user_id;
        if($bill->save()){
            $table->status = 1;
            $table->save();
            return back();
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Table $table)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ex = $request->user()->table()->where('name', $request->name)->where('id', '!=', $table->id)->get()->count();

        if($ex){
            return redirect()->route('tableShow');
        }

        $table->name = $request->name;
        if($table->save()){
            return redirect()->route('tableShow');
        }
        return redirect()->route('tableShow');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Table $table)
    {
        if($table->delete()){
            return redirect()->route('tableShow');
        }
        return redirect()->route('tableShow');
    }
}
