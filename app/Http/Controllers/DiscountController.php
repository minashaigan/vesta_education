<?php

namespace App\Http\Controllers;

use App\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function Make_discount($price,$code)
    {
        $response=array();
        $discount=Discount::where('code',$code)->first();
        if(is_null($discount)){
            $response['error']=1; // not such a code in valid
            $response['price']=$price;
            return $response;
        }
        else {
            if($discount->count <= 0){
                $response['error']=2; // not available as it is expired
                $response['price']=$price;
                return $response;
            }
            else {
                $response['error']=0; // there is no error
                if($discount->type==0){
                    $newprice=$price*$discount->value/100;
                }
                else{
                    $newprice=$price-$discount->value;
                }
                $response['price']=$newprice;
                return $response;
            }
        }
    }

    public function Reduce_count($code)
    {
        $response=array();
        $discount=Discount::where('code',$code)->first();
        if(is_null($discount)){
            $response['error']=1; // not such a code in valid
            return $response;
        }
        else {
            if($discount->count <= 0){
                $response['error']=2; // not available as it is expired
                return $response;
            }
            else {
                try{
                    $select=Discount::find($discount->id);
                    $select->count=$select->count-1;
                    $select->save();
                }
                catch ( \Illuminate\Database\QueryException $e){
                    $response['error']=3; //Not Possible to remove
                    return $response;
                }
                $response['error']=0; //No such Problem
                return $response;
            }
        }
    }
}

