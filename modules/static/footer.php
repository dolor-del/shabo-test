<?php
if (Core::$CREATED == date('Y')) {
	$created = Core::$CREATED;
} else $created = Core::$CREATED.' - '.date('Y');
?>