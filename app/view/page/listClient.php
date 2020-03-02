<?php
	$i = 1;
	foreach($users as $u){
		echo $i .": ";
?>
	<a href=index.php?p=consultationClient&id=<?php echo $u->getID();?>><?php echo $u->getPrenom() . " " . $u->getNom()?> </a></br>
<?php
		$i++;
	}
?>