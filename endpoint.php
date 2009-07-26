<?php

include_once(dirname(__FILE__).'/config.php');

/* instantiation */
$ep = ARC2::getStoreEndpoint($arc_config);

if (!$ep->isSetUp()) {
  $ep->setUp(); /* create MySQL tables */
}

/* request handling */
$ep->go();

?>

