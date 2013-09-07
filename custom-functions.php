<?php

// ==  CUSTOM FUNCTIONS  ======================================================
//
//	   Use this file to add your own custom functions to this theme. This will
//	   make it much easier to upgrade to a newer version of this theme without
//	   losing any of your customizations.
//
// ============================================================================

// ADD YOUR CUSTOM CSS BELOW THIS LINE


function test_new_contact(){
  $user_contactmethods = array(
      'aim' => __('Discipline + Year'),
      'yim' => __('Position'),
  );
  return $user_contactmethods;
}
add_filter( 'user_contactmethods', 'test_new_contact' );




?>