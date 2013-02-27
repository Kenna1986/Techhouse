<?php
switch ($actionRequest) {
    default :
        _e("<h3>Action '$actionRequest' invalid!</h3>");
        break;
    case 'default' :
        //print_r(Request::getParams());
        break;
    case 'add' :
        $params = Request::getParams();
        $cart = new Cart();
        echo $cart->getSessionId();
        //Request::redirect('checkout/cart', array('id' => 2));
        break;
}

//print_r($_SERVER);