<?php

date_default_timezone_set("America/Los_Angeles");
$CurrentTime = time();
$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
echo $DateTime;
?>
