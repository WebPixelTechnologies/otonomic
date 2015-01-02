<?php
/*
This runs if an update requires a long progress and could break the page. Since 1.6.2
*/

define('MYMAIL_DO_UPDATE', true);

global $wpdb;

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
@ini_set('display_errors', true); //Ensure that Fatal errors are displayed.
$time_start = microtime(true);

ob_start();

/* ====================================================================== */
/* [1.6.2] converting all subscribers timestamp value to sent to reduce space
/* ====================================================================== */

$entries = $wpdb->get_results("SELECT meta_id, meta_value, post_id FROM {$wpdb->postmeta} WHERE meta_key = 'mymail-campaigns' AND meta_value LIKE '%{%s:9:\"timestamp\";%}%' LIMIT 0,1000");

$total = (count($entries)) ? $wpdb->get_var("SELECT COUNT(DISTINCT {$wpdb->postmeta}.meta_id) as cnt FROM {$wpdb->postmeta} WHERE meta_key = 'mymail-campaigns' and meta_value LIKE '%\"timestamp\"%'") : 0;


$sqls = array();
foreach($entries as $d){
	$data = maybe_unserialize($d->meta_value);
	$change = false;
	if(!$data){
		$data = array();
		$change = true;
	}
	foreach($data as $id => $camp){
		if(isset($data[$id]['timestamp'])){
			$timestamp = intval($data[$id]['timestamp']); 
			unset($data[$id]['sent']);
			unset($data[$id]['timestamp']);
			$data[$id] = isset($data[$id])
				? array('sent' => $timestamp) + $data[$id]
				: array('sent' => $timestamp);
			$change = true;
		}
	}
	if($change) $sqls[] = "UPDATE {$wpdb->postmeta} SET meta_value = '".(serialize($data))."' WHERE {$wpdb->postmeta}.meta_id = {$d->meta_id}";
}

if(!empty($sqls)){

	$count = 0;
	foreach($sqls as $sql){
		if($wpdb->query($sql)) $count++;
	}
	echo $count.' subscribers meta data updated, '.($total-$count).' left';
	
	update_option('mymail_batch_update', true);
}else{
	delete_option('mymail_batch_update');
}


/* ====================================================================== */
/* 
/* ====================================================================== */




/* ====================================================================== */
/* End
/* ====================================================================== */



if($value = get_option('mymail_batch_update')){
	
	$output = ob_get_contents();
	
	$msg = '<strong>['.date('m/d/Y H:i:s', current_time('timestamp')).'] A batch update for MyMail is still in progress but should be finished soon! Please ignore error messages until this message disappears'.(is_numeric($value) ? ' ('.$value.'% finished)' : '').'</strong>';
	
	if($output){
		$msg .= '<pre><code>'.$output.'</code></pre><small>'.(microtime(true) - $time_start).' sec</small>';
	}
	
	
	ob_end_clean();
	mymail_notice($msg, 'error', true, 'batchupdate');
	
}else{

	mymail_remove_notice('batchupdate');
	
}

?>