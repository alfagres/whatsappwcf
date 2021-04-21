<?php

/*

Plugin Name: Whatsapp para WCFM

Plugin URI: https://novatec.com.co

Description: Aumenta el incremento de interación con el cliente utilizando este sistema.

Version: 1.0

Author: Luis Rios

Author URI: https://novatec.com.co

License: Comercial

*/



if ($number!=""){


		echo"
		<form style='float: right;
    				list-style: none !important;
    				position: fixed;
    				z-index: 99;
   					bottom: 32px;
    				left: 32px;' >
		​			<textarea id='zipfieldw' name='zip' rows='5' cols='70' style='display:none'>$product_width</textarea>
		​			<textarea id='zipfieldh' name='zip' rows='5' cols='70' style='display:none'>$product_height</textarea>
		​			<textarea id='zipfieldl' name='ziplink' rows='5' cols='70' style='display:none' >$urlp</textarea>
    				<ul class='tshirts'>
						<a rel='nofollow' target='_blank' href='  https://api.whatsapp.com/send?phone=57$number&text=$text%20$product_title:%20$urlp'>
    						<li style='float: left; list-style:none !important;'>
   	    						<img id='scrapy' type='image' src='$urlimg' border='0' style='margin-left:7%;' value='$product_title' ></img>
   							</li>
   						</a>
   					</ul>
	 			</form>";
	 }




//  WhatsApp en la tienda del vendedor
function custom_woocommerce_tienda_vendedor() {
  global $WCFM, $WCFMmp, $product;
  $product = wc_get_product();
  $id = $product->get_id();
  $store_id = $WCFM->wcfm_vendor_support->wcfm_get_vendor_id_from_product( $id );
	//  echo   $store_id;
	$store_user  = wcfmmp_get_store( absint( $store_id ) );
  		$phone       = $store_user->get_phone();
		$text = get_option('orderonwhatsapp_Beginning_message');
		$number = $phone;		
   		$host= $_SERVER["HTTP_HOST"];
      $url= $_SERVER["REQUEST_URI"];
   		$urlimg=  plugins_url('img/buttontryeiton.png',__FILE__) ;
  		$urldelimg=  plugins_url('img/buttovntryeiton.png',__FILE__) ;
  		$product_url=get_post_meta( get_the_ID(),'_my_meta_value_keyy',true );
      	$product = wc_get_product();
     	 $id = $product->get_id();
	if ($number!=""){
				echo"
				<form style='float: right;
    				list-style: none !important;
    				position: fixed;
    				z-index: 99;
   					bottom: 32px;
    				left: 32px;' >
		​			<textarea id='zipfieldw' name='zip' rows='5' cols='70' style='display:none'>$product_width</textarea>
		​			<textarea id='zipfieldh' name='zip' rows='5' cols='70' style='display:none'>$product_height</textarea>
		​			<textarea id='zipfieldl' name='ziplink' rows='5' cols='70' style='display:none' >$urlp</textarea>
    				<ul class='tshirts'>
						<a rel='nofollow' target='_blank' href='  https://api.whatsapp.com/send?phone=57$number&text=$text%20$product_title:%20$host$url'>
    						<li style='float: left; list-style:none !important;'>
   	    						<img id='scrapy' type='image' src='$urlimg' border='0' style='margin-left:7%;' value='$product_title' ></img>
   							</li>
   						</a>
   					</ul>
	 			</form>";
	 }
   }

add_action( 'woocommerce_after_shop_loop' , 'custom_woocommerce_tienda_vendedor', 10, 2 );

//  WhatsApp en el producto del vendedor
function custom_woocommerce_productos() {
  global $WCFM, $WCFMmp, $product;
  	$product = wc_get_product();
  	$id = $product->get_id();
  	$store_id = $WCFM->wcfm_vendor_support->wcfm_get_vendor_id_from_product( $id );
//  echo   $store_id;
	$store_user  = wcfmmp_get_store( absint( $store_id ) );
 	$phone       = $store_user->get_phone();
	$text = get_option('orderonwhatsapp_Beginning_message');
	$number = $phone;
	$urlimgthumb= wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	$product_title= get_the_title();
    $productx = get_page_by_title( $product_title, OBJECT,'product' );
    $product_height = get_post_meta( $productx->ID,'_my_meta_value_keyyQ',true );
    $product_width = get_post_meta( $productx->ID,'_my_meta_value_key',true );
    $urlp = get_permalink(get_the_ID());
   	$urlimg=  plugins_url('img/buttontryeiton.png',__FILE__) ;
  	$urldelimg=  plugins_url('img/buttovntryeiton.png',__FILE__) ;
  	$product_url=get_post_meta( get_the_ID(),'_my_meta_value_keyy',true );
    $product = wc_get_product();
    $id = $product->get_id();
	if ($number!=""){
	    		echo"
					<form style='float: right;
    					list-style: none !important;
    					position: fixed;
    					z-index: 99;
   			 			bottom: 28px;
   			 			left: 32px;' >
	 					<textarea id='zipfieldw' name='zip' rows='5' cols='70' style='display:none'>$product_width</textarea>
	 					<textarea id='zipfieldh' name='zip' rows='5' cols='70' style='display:none'>$product_height</textarea>
						<textarea id='zipfieldl' name='ziplink' rows='5' cols='70' style='display:none' >$urlp</textarea>
     						<ul class='tshirts'>
								<a rel='nofollow' target='_blank' href='  https://api.whatsapp.com/send?phone=57$number&text=$text%20$product_title:%20$urlp'>
    								<li style='float: left; list-style:none !important;'>
   	    							<img id='scrapy' type='image' src='$urlimg' border='0' style='margin-left:7%;' value='$product_title' ></img>
   									</li>
   								</a>
  		 					</ul>
	 				</form>";
	 }
   }

add_action( 'woocommerce_single_product_summary' , 'custom_woocommerce_productos', 10, 2 );

//  WhatsApp en checkout vendedor
function custom_woocommerce_checkout() {
	if( wcfm_is_marketplace() ) {
		$vendor_id = 0;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$cart_product_id = $cart_item['product_id'];
			$cart_product = get_post( $cart_product_id );
			$cart_product_author = $cart_product->post_author;
			//Halber 20210407 - Ajuste para obtener los datos de whatsapp del store
			//$store_user  = wcfmmp_get_store( absint( $store_id ) );
			$store_user  = wcfmmp_get_store( absint( $cart_product_author ) );
			$phone = $store_user->get_phone();
			$number = $phone;
			$urlp = get_permalink(get_the_ID());
   			$urlimg=  plugins_url('img/buttontryeiton.png',__FILE__) ;
  			$urldelimg=  plugins_url('img/buttovntryeiton.png',__FILE__) ;
			if( function_exists( 'wcfm_is_vendor' ) && wcfm_is_vendor( $cart_product_author ) ) $vendor_id = $cart_product_author;
			break;
		}	
		echo"
				<form style='float: right;
    				list-style: none !important;
    				position: fixed;
    				z-index: 99;
   					bottom: 32px;
    				left: 32px;' >
		​			<textarea id='zipfieldw' name='zip' rows='5' cols='70' style='display:none'>$product_width</textarea>
		​			<textarea id='zipfieldh' name='zip' rows='5' cols='70' style='display:none'>$product_height</textarea>
		​			<textarea id='zipfieldl' name='ziplink' rows='5' cols='70' style='display:none' >$urlp</textarea>
    				<ul class='tshirts'>
						<a rel='nofollow' target='_blank' href='  https://api.whatsapp.com/send?phone=57$number&text=$text%20$product_title:%20$urlp'>
    						<li style='float: left; list-style:none !important;'>
   	    						<img id='scrapy' type='image' src='$urlimg' border='0' style='margin-left:7%;' value='$product_title' ></img>
   							</li>
   						</a>
   					</ul>
	 			</form>";
	 }
   }


//Acción para cart
add_action( 'woocommerce_after_cart', 'custom_woocommerce_checkout' );  

//Acción para checkout
add_action( 'woocommerce_after_checkout_form', 'custom_woocommerce_checkout' );  
