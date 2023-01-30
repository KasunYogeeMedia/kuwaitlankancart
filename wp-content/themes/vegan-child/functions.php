<?php

function apustheme_child_enqueue_styles() {
	if ( is_multisite() ) {
		wp_enqueue_style( 'apustheme-child-style', get_stylesheet_uri() );
	} else {
		wp_enqueue_style( 'apustheme-parent-style', get_template_directory_uri() . '/style.css' );
	}
}

add_action( 'wp_enqueue_scripts', 'apustheme_child_enqueue_styles', 100 );

add_action('woocommerce_process_registration_errors', 'validatePasswordReg', 10, 2 );
add_action('woocommerce_process_registration_errors', 'validatePasswordReg', 10, 2 );

function validatePasswordReg( $errors, $user ) {
// change value here to set minimum required password chars
if(strlen($_POST['password']) < 6  ) {
$errors->add( 'woocommerce_password_error', __( 'Password must be at least 6 characters long.' ) );
}
// adding ability to set maximum allowed password chars — uncomment the following two (2) lines to enable that
//elseif (strlen($_POST['password']) > 16 )
//$errors->add( 'woocommerce_password_error', __( 'Password must be shorter than 16 characters.' ) );
return $errors;
}

add_action('woocommerce_save_account_details_errors', 'validateProfileUpdate', 10, 2 );

function validateProfileUpdate( $errors, $user ) {
// change value here to set minimum required password chars
if(strlen($_POST['password_2']) < 6  ) {
$errors->add( 'woocommerce_password_error', __( 'Password must be at least 6 characters long.' ) );
}
// adding ability to set maximum allowed password chars — uncomment the following two (2) lines to enable that
//elseif (strlen($_POST['password_2']) > 16 )
//$errors->add( 'woocommerce_password_error', __( 'Password must be shorter than 16 characters.' ) );
return $errors;
}

add_action('woocommerce_password_reset', 'validatePasswordReset', 10, 2 );

function validatePasswordReset( $errors, $user ) {
// change value here to set minimum required password chars — uncomment the following two (2) lines to enable that
if(strlen($_POST['password_3']) < 6  ) {
$errors->add( 'woocommerce_password_error', __( 'Password must be at least 6 characters long.' ) );
}
// adding ability to set maximum allowed password chars — uncomment the following two (2) lines to enable that
//elseif (strlen($_POST['password_3']) > 16 )
//$errors->add( 'woocommerce_password_error', __( 'Password must be shorter than 16 characters.' ) );
return $errors;
}


add_action( 'woocommerce_after_checkout_validation', 'minPassCharsCheckout', 10, 2 );
function minPassCharsCheckout( $user ) {
// change value here to set minimum required password chars on checkout page account registration
if ( strlen( $_POST['account_password'] ) < 6  ) {
wc_add_notice( __( 'Password must be at least 6 characters long.', 'woocommerce' ), 'error' );
}
}