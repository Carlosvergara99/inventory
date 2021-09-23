<?php

namespace App\Http\Controllers;

use App\inventory;
use App\inventory_product;
use App\product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
   public function GetInventory(Request $request)
   {

       $inventory = inventory::with('products');

      if (isset( $request->delivery_date) && isset( $request->order_number) ) {
         $inventory->where('delivery_date', $request->delivery_date)->where('order_number', 'LIKE', "%{$request->order_number}%");
      }
      if (isset( $request->delivery_date) && !isset( $request->order_number)) {
         $inventory->where('delivery_date', $request->delivery_date);
      }
      if ( isset( $request->order_number)  && !isset( $request->delivery_date)) {
         $inventory->where('order_number', 'LIKE', "%{$request->order_number}%");
      }
       $result = $inventory->OrderBy('id', 'DESC')->get();
      return response()->json($result);

   }
   public function Createinventory( Request $request)
   {
      $inventory =new inventory($request->only('delivery_date','order_number'));
      $inventory->save();
      foreach ($request->products as $key => $value) {
          $this->syncStock($value['id'],$value['stock']);
           inventory_product::create([
            'product_id' => $value['id'],
            'inventory_id'=> $inventory->id,
            'quantity' => $value['quantity'],
            'total' => $value['total'],
        ]);
      }
   }
      public function syncStock($id,$stok)
      {
        $product = product::whereId($id)->first();
        $product->stock = $stok;
        $product->save();
      }
    public function GetProducts()
    {
        $products = product::get(['id','quantity','name','stock','price']);
        return response()->json($products);

    }
   public function StockProduct(Request $request)
   {
       $product = product::whereId($request->id)->Where('quantity' ,'>=', $request->quantity)->first(['id','quantity','name','stock','price']);
         if (isset($product)) {
            $product->stock = $product->stock - $request->quantity;
            $product->total =$product->price* $request->quantity;
            $product->quantity = $request->quantity;

         }else{
            $product ='';
         }
         return response()->json($product);


   }
}
