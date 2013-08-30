<?php

// ==  CUSTOM FUNCTIONS  ======================================================
//
//	   Use this file to add your own custom functions to this theme. This will
//	   make it much easier to upgrade to a newer version of this theme without
//	   losing any of your customizations.
//
// ============================================================================

// ADD YOUR CUSTOM CSS BELOW THIS LINE

function custom_search_form($searchText) {


	$form = get_search_form(false);
	$form = str_replace('To search type and hit enter', $searchText, $form);

	$form = $form . '100';

	return $form;
}


?>