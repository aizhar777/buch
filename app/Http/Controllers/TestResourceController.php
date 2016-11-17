<?php

namespace App\Http\Controllers;

use App\Product;
use App\Trade;
use Illuminate\Http\Request;
use App\Http\Requests;

class TestResourceController extends Controller
{
    public function test()
    {
        $products = Product::all()->toArray();
        //dd($products);
        print '$products = [<br>';
        foreach ($products as $product){
            print '[<br>';

            foreach ($product as $key => $val){
                if($key == 'id' or $key == 'created_at' or $key == 'updated_at') continue;
                print '"' . $key . '" => "' . $val . '",<br>';
            }

            print '],<br>';
        }
        print '];<br>';
        //var_dump($this->checkPerm('delete.client'));
        //dd(\NumberToWords::getStr(125));
        //return view('tests');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
