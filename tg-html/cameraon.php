<?php
	
	system("rm -r /tmp/stream");
	system("mkdir /tmp/stream");
	system("chmod a+rw /tmp/stream");
	system("raspistill -w 340 -h 280 -q 5 -o /tmp/stream/pic.jpg -tl 100 -t 9999999 -th 0:0:0 -n & ");
	system("LD_LIBRARY_PATH=/opt/mjpg-streamer/ /opt/mjpg-streamer/mjpg_streamer -i ''input_file.so -f /tmp/stream -n pic.jpg'' -o ''output_http.so -p 9000 -w /opt/mjpg-streamer/www'' &");
?>
