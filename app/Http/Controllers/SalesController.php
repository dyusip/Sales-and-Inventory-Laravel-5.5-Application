<?php

namespace App\Http\Controllers;

use App\Branch_Inventory;
use App\Inventory;
use App\SalesHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    //
    private function generate()
    {
        $order_no = SalesHeader::max('sh_no');//Generate Order No
        return (SalesHeader::count()<1)?"OR-NO-00100":++$order_no;
    }
    public function index()
    {
        $inventories = Inventory::all();
        $order_no = $this->generate();//call generate function
        return view('User.sales',compact('inventories','order_no'));
    }
    public function show_item($id)
    {
        return Inventory::where('code',$id)->first();
    }
    public function store(Request $request)
    {
        //return $request->all();
        $order_no = $this->generate();//call generate function to check current order #
        $request->merge(['sh_no' => $order_no]);
        $create = SalesHeader::create([
            'sh_no' => $request->sh_no,
            'date' => $request->date,
            'total' => $request->totalAmount,
        ]);
        foreach ($request->product as $item => $value){
            $create->detail()->create([
                'sd_no' => $request->sh_no,
                'prod_code' => $request->product[$item],
                'prod_name' => $request->prod_name[$item],
                'prod_os' => $request->prod_os[$item],
                'prod_price' => $request->prod_price[$item],
                'prod_qty' => $request->prod_qty[$item],
                'prod_total' => $request->amount[$item],
            ]);
            $inventory = Inventory::where(['code'=> $request->product[$item]]);
            $inventory->update(['quantity'=> DB::raw('quantity - '.$request->prod_qty[$item])]);
        }
        return redirect('sales')->with('status',"Order#: {$request->sh_no} successfully saved.");

    }
}