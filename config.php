<?php

include_once(dirname(__FILE__).'/arc/ARC2.php');

// SQL database configuration for storing the postings:
$arc_config = array(
  /* MySQL db settings */
  'db_host' => 'localhost', /* optional, default is localhost */
  'db_user' => 'arc2sparql',
  'db_pwd' => 'arc2sparql-secret',
  'db_name' => 'arc2sparql',

  /* ARC2 store settings */
  'store_name' => 'arc2sparql',

  /* SPARQL endpoint settings */
  'endpoint_features' => array(
    'select', 'construct', 'ask', 'describe', 
    'load', 'insert', 'delete', 
    'dump' /* dump is a special command for streaming SPOG export */
  ),
  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  'endpoint_read_key' => '', /* optional */
  'endpoint_write_key' => '', /* optional */
  'endpoint_max_limit' => 250, /* optional */
);

?>
