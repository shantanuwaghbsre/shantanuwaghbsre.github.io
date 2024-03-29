<?php
    include 'config.php';


// COOKIE  CODE

    // add products to cart
if(isset($_POST['addCart'])){
    $p_id = $_POST['addCart'];
    // Check if user_cart cookie is set
    if(isset($_COOKIE['user_cart'])){
        $user_cart = json_decode($_COOKIE['user_cart']);
    }else{
        $user_cart = [];
    }
      // Check if the product is not already in the cart, then add it
    if(!in_array($p_id,$user_cart)){
        array_push($user_cart,$p_id);
    }
     // Get the count of products in the cart
    $cart_count = count($user_cart);
    $u_cart = json_encode($user_cart);
// Set cookies for user_cart and cart_count
    if(setcookie('user_cart',$u_cart,time() + (1000),'/','','',TRUE)){
        setcookie('cart_count',$cart_count,time() + (1000),'/','','',TRUE);
        echo 'cookie set successfully';
    }else{
        echo 'false';
    }
}

// remove products from cart
if(isset($_POST['removeCartItem'])){
    $p_id = $_POST['removeCartItem'];
    
    if($_COOKIE['cart_count'] == '1'){
          // Check if cart_count cookie is 1, if so, remove all cart cookies
        setcookie('cart_count','',time() - (180),'/','','',TRUE);
        setcookie('user_cart','',time() - (180),'/','','',TRUE);
    }else{
          // If cart_count is greater than 1, remove the specified product from the cart
        if(isset($_COOKIE['user_cart'])){
            $user_cart = json_decode($_COOKIE['user_cart']);
             // Convert object to array if necessary
            if(is_object($user_cart)){
                $user_cart = get_object_vars($user_cart);
            }
             // Find and remove the specified product from the cart
            if (($key = array_search($p_id, $user_cart)) !== false) {
                unset($user_cart[$key]);
            }
        }
            // Update cart_count and user_cart cookies
        $cart_count = count($user_cart);
        $u_cart = json_encode($user_cart);

        if(setcookie('user_cart',$u_cart,time() + (180),'/','','',TRUE)){
            setcookie('cart_count',$cart_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }
}


// add products in wishlist
if(isset($_POST['addWishlist'])){
    $p_id = $_POST['addWishlist'];
     // Check if user_wishlist cookie is set
    if(isset($_COOKIE['user_wishlist'])){
        $user_wishlist = json_decode($_COOKIE['user_wishlist']);
    }else{
        $user_wishlist = [];
    }
     // Check if the product is not already in the wishlist, then add it
    if(!in_array($p_id,$user_wishlist)){
        array_push($user_wishlist,$p_id);
    }
  // Get the count of products in the wishlist
    $wishlist_count = count($user_wishlist);
    $u_wishlist = json_encode($user_wishlist);
 // Set cookies for user_wishlist and wishlist_count
    if(setcookie('user_wishlist',$u_wishlist,time() + (180),'/','','',TRUE)){
        setcookie('wishlist_count',$wishlist_count,time() + (180),'/','','',TRUE);
        echo 'cookie set successfully';
    }else{
        echo 'false';
    }
}

// remove products from wishlist
if(isset($_POST['removeWishlistItem'])){
    $p_id = $_POST['removeWishlistItem'];
     // Check if wishlist_count cookie is 1, if so, remove all wishlist cookies
    if($_COOKIE['wishlist_count'] == '1'){
        setcookie('wishlist_count','',time() - (180),'/','','',TRUE);
        setcookie('user_wishlist','',time() - (180),'/','','',TRUE);
    }else{
         // If wishlist_count is greater than 1, remove the specified product from the wishlist
        if(isset($_COOKIE['user_wishlist'])){
            $user_wishlist = json_decode($_COOKIE['user_wishlist']);
            // Convert object to array if necessary

            if(is_object($user_wishlist)){
                $user_wishlist = get_object_vars($user_wishlist);
            } // Find and remove the specified product from the wishlist
            if (($key = array_search($p_id, $user_wishlist)) !== false) {
                unset($user_wishlist[$key]);
            }
        } // Update wishlist_count and user_wishlist cookies
        $wishlist_count = count($user_wishlist);
        $u_wishlist = json_encode($user_wishlist);

        if(setcookie('user_wishlist',$u_wishlist,time() + (180),'/','','',TRUE)){
            setcookie('wishlist_count',$wishlist_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }
}

// add products from wishlist to cart

if(isset($_POST['proceedCart'])){
    $p_id = $_POST['proceedCart'];
     // Check if user_wishlist cookie is set
    if(isset($_COOKIE['user_wishlist'])){
        $user_wishlist = json_decode($_COOKIE['user_wishlist']);
        // Convert object to array if necessary
        if(is_object($user_wishlist)){
            $user_wishlist = get_object_vars($user_wishlist);
        }
         // Check if user_cart cookie is set
        if(isset($_COOKIE['user_cart'])){
            $user_cart = json_decode($_COOKIE['user_cart']);
             // Convert object to array if necessary
            if(is_object($user_cart)){
                $user_cart = get_object_vars($user_cart);
            }  // Merge wishlist items into cart and remove duplicates
            array_merge($user_cart,$user_wishlist);
            $user_cart = array_unique($user_cart);

        }else{ // If user_cart cookie is not set, set it to the wishlist items
            $user_cart= $user_wishlist;
        }
 // Encode user_cart array and update cart_count
        $u_cart = json_encode($user_cart);
        $cart_count = count($user_cart);
// Set cookies for user_cart and cart_count
        if(setcookie('user_cart',$u_cart,time() + (180),'/','','',TRUE)){
            setcookie('cart_count',$cart_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }

}