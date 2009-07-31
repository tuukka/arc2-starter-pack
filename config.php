<?php

include_once(dirname(__FILE__).'/arc/ARC2.php'); // path to the file ARC2.php

// SQL database configuration for storing the postings:
$arc_config = array(
  /* MySQL database settings */
  'db_host' => 'localhost',
  'db_user' => 'root',
  'db_pwd' => 'root',
  'db_name' => 'arc2test',

  /* ARC2 store settings */
  'store_name' => 'sandbox',

  /* SPARQL endpoint settings */
  'endpoint_features' => array(
    'select', 'construct', 'ask', 'describe', // allow read
    'load', 'insert', 'delete',               // allow update
    'dump'                                    // allow backup
  ),
  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  'endpoint_read_key' => '', /* optional */
  'endpoint_write_key' => '', /* optional */
  'endpoint_max_limit' => 250, /* optional */
);
