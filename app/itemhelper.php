<?php
//composer dumpautoload
function ShowList($items){
	$items_msg='';
	foreach ($items as $key ) {
		$items_msg .= $key->name.'%%'.$key->price.'%%'.'元'.'%%'.$key->quantity.'%%'.'dedwed'.'**';
	}
	return $items_msg;

}
?>