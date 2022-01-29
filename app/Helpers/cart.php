<?php
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

function addToCart($product){

    $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
    //  return $already_cart;

    if($already_cart) 
    {
        // dd($already_cart);
        $already_cart->quantity = $already_cart->quantity + 1;
        $already_cart->amount = $product->price + $already_cart->amount;
        // return $already_cart->quantity;
        // if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
        $already_cart->save();
        Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$already_cart->id]);

    }
    else
    {
        $cart = new Cart;
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        // $cart->price = ($product->price-($product->price*$product->discount)/100);
        $cart->price = $product->price;

        $cart->quantity = 1;
        $cart->amount=$cart->price*$cart->quantity;
        // if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
        $cart->save();

        Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$cart->id]);
    }

 }

 function addGiftToCart($product,$toName,$toEmail,$message,$fromName){

    $already_cart = Cart::where('user_id', auth()->user()->id)->where('email',$toEmail)->where('order_id',null)->where('product_id', $product->id)->first();
    //  return $already_cart;

    if($already_cart) 
    {
        // dd($already_cart);
        $already_cart->quantity = $already_cart->quantity + 1;
        $already_cart->amount = $product->price + $already_cart->amount;
        // return $already_cart->quantity;
        // if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
        $already_cart->save();
        Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$already_cart->id]);

    }
    else
    {
        $cart = new Cart;
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        // $cart->price = ($product->price-($product->price*$product->discount)/100);
        $cart->price = $product->price;
        $cart->email = $toEmail;
        $cart->name = $toName;
        $cart->message = $message;
        $cart->from_name = $fromName;
        $cart->quantity = 1;
        $cart->amount=$cart->price*$cart->quantity;
        // if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
        $cart->save();

        Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$cart->id]);
    }
 }


 function addToCartForGuestInSession($product){

    $carts = Session::get('carts');
    /*
     * If product already exist into the cart then update QTY of product
     * Othewise add new product into the cart
     */

    if(isset($carts[ $product->id])):
        $carts[$product->id]['quantity'] += 1;
        $carts[$product->id]['amount'] = $product->price * $carts[$product->id]['quantity'];

    else:
        $carts[$product->id]['quantity'] =1; // Dynamically add initial qty
        $carts[$product->id]['amount'] = $product->price*1;
        $carts[$product->id]['price'] = $product->price;
        $carts[$product->id]['product'] = $product->toArray(); 

    endif;

    Session::put('carts', $carts);
}


function addGiftToCartForGuestInSession($product,$toName,$toEmail,$message,$fromName){

    $carts = Session::get('carts');
    /*
     * If product already exist into the cart then update QTY of product
     * Othewise add new product into the cart
     */

    if(isset($carts[ $product->id]) && isset($carts[$product->id]['email']) && $carts[$product->id]['email'] == $toEmail):
        $carts[$product->id]['quantity'] += 1;
        $carts[$product->id]['amount'] = $product->price * $carts[$product->id]['quantity'];
    else:
        $carts[$product->id]['quantity'] =1; // Dynamically add initial qty
        $carts[$product->id]['amount'] = $product->price*1;
        $carts[$product->id]['price'] = $product->price;
        $carts[$product->id]['email'] = $toEmail;
        $carts[$product->id]['name'] = $toName;
        $carts[$product->id]['message'] = $message;
        $carts[$product->id]['from_name'] = $fromName;
        $carts[$product->id]['product'] = $product->toArray(); 
    endif;

    Session::put('carts', $carts);
}


function add_to_cart_session_cart_item(){

    if(Session::get('carts') && count(Session::get('carts'))){

        $carts = Session::get('carts');
        foreach(Session::get('carts') as $product_id =>$attribute){
            $product = Product::find( $product_id);

            $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
            //  return $already_cart;

            if($already_cart) {
                // dd($already_cart);
                $already_cart->quantity += $attribute['quantity'];
                $already_cart->amount +=  $product->price*$attribute['quantity'];
                // return $already_cart->quantity;
                // if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
                $already_cart->save();

            }else{

                $cart = new Cart;
                $cart->user_id = auth()->user()->id;
                $cart->product_id = $product->id;
                // $cart->price = ($product->price-($product->price*$product->discount)/100);
                $cart->price = $product->price;

                $cart->quantity =$attribute['quantity'];
                $cart->amount=$cart->price*$cart->quantity;
                // if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
                $cart->save();

                Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$cart->id]);
            }

            unset($carts[$product_id ]);

            Session::put('carts', count($carts) ? $carts :null);

        }
    }


 }

 function get_cart(){

    if(is_user_logged_in()){
     
        return Cart::with('product')->where('user_id',auth()->user()->id)->where('order_id',null)->get()->toArray();
    }
    else{
        return Session::get('carts') ? Session::get('carts') :[];
    }
 }


  function get_cart_count()
  {
    if(is_user_logged_in())
    {
        $carts = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get();
        return  $carts->count();
    }
    else
    {
        $carts = Session::get('carts');
        return $carts ? count($carts ) :0;
        //return Session::get('carts') ? Session::get('carts') :[];
    }
  }

  function get_cart_taxable_amount(){
    if(is_user_logged_in())
    {
        $amount = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->sum('amount');
        return  $amount;
    }
    else
    {
        $carts = Session::get('carts');
        return $carts ? array_sum(array_column($carts,'amount')) :0;
        //return Session::get('carts') ? Session::get('carts') :[];
    }
  }

  function get_offer_discount_amount(){
        if(is_user_logged_in())
        {
            $amount = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->sum('amount');
            return  $amount;
        }
        else
        {
            $carts = Session::get('carts');
            $totalAmt = array_sum(array_column($carts,'amount'));

            $countOffer1 = 0;
            $productIdsOffer1 = [];
            $finalAmtOffer1 = 0;  
            $remainingAmtOffer1 = 0;   
            $offer1Qty = 3;  
            $countOffer2 = 0;
            $productIdsOffer2 = [];
            $finalAmtOffer2= 0;
            $discountAmtOffer2 = 0;
            $remainingAmtOffer2 = 0;
            $offer2Qty = 2;

            foreach($carts as $v)
            {
               if($v['product']['is_offer'] == 1 && $v['product']['offer'] == 1)
               {
                  $countOffer1 = $countOffer1 + $v['quantity'];
               }
               else if($v['product']['is_offer'] == 1 && $v['product']['offer'] == 2)
               {
                  $countOffer2 = $countOffer2 + $v['quantity'];
               }
            }

              //dd($countOffer1,$countOffer2,$carts,$productIdsOffer1,$productIdsOffer2);
            if($countOffer1 >= 3)
            {   
                if( $totalAmt > 6500)
                {
                    $cartOrderByAmt = collect($carts)->sortBy('price')->toArray();

                    foreach($cartOrderByAmt as $v)
                    {  
                        if($v['product']['is_offer'] == 1 && $v['product']['offer'] == 1)
                        {
                            if($offer1Qty > 0 && $offer1Qty >= $v['quantity'])
                            { 
                                $offer1Qty = $offer1Qty -  $v['quantity'];
                            }
                            else if($offer1Qty > 0 && $offer1Qty < $v['quantity'])
                            {
                                $difference = $v['quantity'] - $offer1Qty;
                                $remainingAmtOffer1 = $remainingAmtOffer1 + $difference * $v['price'];
                            }
                        }    
                        else
                        {
                            $remainingAmtOffer1 = $remainingAmtOffer1 + $v['amount'];
                        }
                    }

                    $finalAmtOffer1 = 6500 + $remainingAmtOffer1;
                    return $totalAmt - $finalAmtOffer1;
                }    
            }

            if($countOffer2 >= 2)
            {    
                $cartOrderByAmt = collect($carts)->sortBy('price')->toArray();

                foreach($cartOrderByAmt as $v)
                {
                    if($v['product']['is_offer'] == 1 && $v['product']['offer'] == 2)
                    {
                        if($offer2Qty > 0 && $offer2Qty >= $v['quantity'])
                        { 
                           $discountAmtOffer2 = $discountAmtOffer2 + (20 * ( $v['quantity'] * $v['price'] ))/100; 
                           $offer2Qty = $offer2Qty - $v['quantity'];
                        }
                        else if($offer2Qty > 0 && $offer2Qty < $v['quantity'])
                        {
                            $difference = $v['quantity'] - $offer2Qty;
                            $discountAmt = 0;
                            if($offer2Qty != 0)
                            {
                                $discountAmtOffer2 =  $discountAmtOffer2 + 20 * ($offer2Qty * $v['price'])/100;
                            }
                           
                            $remainingAmtOffer2 = $remainingAmtOffer2 + $difference * $v['price'];
                        }
                    }    
                    else
                    {
                        $remainingAmtOffer2 = $remainingAmtOffer2 + $v['amount'];
                    }
                }    

            // dd($totalAmt,$remainingAmtOffer2,$discountAmtOffer2);   $finalAmtOffer2 = $totalAmt - $remainingAmtOffer2;
                return $discountAmtOffer2;
            }

            // $finalAmt = $totalAmt - $finalAmtOffer1;
            // dd($finalAmt);

            return 0;
            //return Session::get('carts') ? Session::get('carts') :[];
        }
  }

  function get_tax_total($taxable_amount){

    $gst = env('GST_PERCENTAGE') ? env('GST_PERCENTAGE') :18;
 
    return ($gst * $taxable_amount) / 100;
 }

  function get_cart_product_qty(){
    $cart_product_qty = array_sum(array_column(get_cart(), 'quantity'));
    return  $cart_product_qty;
  }


  function addToCart_live($product){


    if (is_user_logged_in()){
    
    $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();

    if($already_cart) {
        $already_cart->quantity = $already_cart->quantity + 1;
        $already_cart->amount = $product->price+ $already_cart->amount;
        $already_cart->save();
        Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$already_cart->id]);
    }else{
        $cart = new Cart;
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        $cart->price = $product->price;
        $cart->quantity = 1;
        $cart->amount=$cart->price*$cart->quantity;
        $cart->save();
        Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$cart->id]);
    }

    }else{
        
        $carts = Session::get('carts');
        /*
         * If product already exist into the cart then update QTY of product
         * Othewise add new product into the cart
         */
    
        if(isset($carts[ $product->id])):
            $carts[$product->id]['quantity'] += 1;
            $carts[$product->id]['amount'] = $product->price * $carts[$product->id]['quantity'];
    
        else:
            $carts[$product->id]['quantity'] =1; // Dynamically add initial qty
            $carts[$product->id]['amount'] = $product->price*1;
            $carts[$product->id]['price'] = $product->price;
            $carts[$product->id]['product'] = $product->toArray(); 
    
        endif;
    
        Session::put('carts', $carts);
    }


 }



 function removeToCart_live($product){


    if (is_user_logged_in()){
    
    $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();

    if($already_cart) {
        if($already_cart->quantity==1){
            $already_cart->delete();
        }else{
            $already_cart->quantity = $already_cart->quantity - 1;
            $already_cart->amount = $product->price+ $already_cart->amount;
            $already_cart->save();
            Wishlist::where(['user_id'=>Auth::id(),'cart_id'=>null,'product_id'=>$product->id])->update(['cart_id'=>$already_cart->id]);
        }
    
    }

    }else{
        
        $carts = Session::get('carts');
        /*
         * If product already exist into the cart then update QTY of product
         * Othewise add new product into the cart
         */
    
        if(isset($carts[ $product->id])):
            if($carts[$product->id]['quantity']==1){

                unset($carts[$product->id]);
            }else{
                $carts[$product->id]['quantity'] -= 1;
                $carts[$product->id]['amount'] = $product->price * $carts[$product->id]['quantity'];    
            
            }
         
        endif;
    
        Session::put('carts', $carts);
    }


 }


 function is_product_in_cart($product_id){
    if (is_user_logged_in()){
        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product_id)->first();
    
        return isset($already_cart) ? true :false;

    }else{
        $carts = Session::get('carts');
        return isset($carts[ $product_id]) ? true :false;
    }

    
 }
?>
