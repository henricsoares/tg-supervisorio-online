<?php
	
	
	system("kill $(pgrep raspistill");
	system("kill $(pgrep mjpg");
	system("rm -r /tmp/stream");
	
?>
