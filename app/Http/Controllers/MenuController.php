<?php

namespace Bimenu\Http\Controllers;

use Bimenu\Product;
use Bimenu\Items;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function menu(Request $request)
    {

        //$product_id=$request->product_id;
        $product_id=1;

//        Product::select('id')
//            ->join('votesbi dk ', 'votes.user_id', '=', 'friends.friend_id')//kanka geliyorum hemen patron çağırdı 5 dk max kanka benim işim var acil sonra hallederiz
//            ->get();
     //  $items=  Product::find($product_id)->items;
// önce products kısmında hangi itemler var yani bu şirkete eklenmiş hangi itemler varsa çekiyorum ve kategorilerini çekip ekrana kategorilerine göre basmak istiyorum kanka tamam önce bi raw yazalım
//        $productCategory = Items::where('id', "1")
//        ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
//        ->select('items.name','categories.name')->first();


        $result = Items
             ::where('items.product_id',$product_id)
             ->where('items.enabled',1)
            // ->join('categories', 'items.category_id', '=', 'categories.id')
            ->join('products', 'products.id', '=', 'items.product_id')
            ->join('categories', 'categories.id', '=','items.category_id')
            ->orderBy('items.category_id', 'ASC')
            ->select('products.name as product_name','categories.id as category_id','categories.name as category_name','categories.description as category_description','items.id as item_id','items.name as item_name','items.description as item_description','items.price as item_price','items.photos as item_photos')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->get();




//       foreach ($result as $item)
//       {
//           $item->category= Items::find($item->category_id)->category;
//       }



   //   $items= Items::where('product_id',$product_id)->get();






      return view('mobile.menu',['result'=>$result]);
    }
}
