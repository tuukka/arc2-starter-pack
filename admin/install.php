<?php
            
include_once('../arc/ARC2.php');
  
$DEBUG = false;

if(isset($_GET['cmd'])){ 
	$cmd = $_GET['cmd'];

	if($cmd =="create-db") {
		echo createDB();         
	}   
	else {
		if($cmd =="create-store") {
			createStore();         
		}
		else echo "<p>Sorry, I didn't understand the command ...</p>";
	}            
}

function createDB(){
	global $DEBUG;
	$host =  urldecode($_GET['host']);
	$name =  $_GET['name'];
	$user = $_GET['user'];
	$pwd = $_GET['pwd'];

	$ret = "<p>";
	$dbExists = false;
	
	$con = mysql_connect($host, $user, $pwd); // try to connect
	if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
	
	$dblist = mysql_list_dbs($con); // check if the database already exists
	while ($row = mysql_fetch_object($dblist)) {
	     $db = $row->Database;
		 if ($db == $name) $dbExists = true;
	}
	
	if(!$dbExists) {
		if (mysql_query("CREATE DATABASE " . $name, $con)) {
		  $ret .= "Created database '$name' at '$host' for user '$user' with password '$pwd'</p>";
		}
		else {
		  $ret .= "Error creating database: " . mysql_error() . "</p>";
		}
	}
	else $ret .= "The database '$name' already exists. We are ready to create an RDF store.</p>";
	
	mysql_close($con);
	
	return $ret;

}

function createStore(){
	global $DEBUG;
	$host =  urldecode($_GET['host']);
	$name =  $_GET['name'];
	$user = $_GET['user'];
	$pwd = $_GET['pwd'];
	$store_name =  $_GET['store'];

	print "<p>";
	
	$config = array(
	  'db_host' => $host,
	  'db_name' => $name,
	  'db_user' => $user,
	  'db_pwd' => $pwd,
	  'store_name' => $store_name
	);
	
	$store = ARC2::getStore($config);

	if (!$store->isSetUp()) {
		print "Setting up the store...";
		$store->setUp();
		print "Done.";
	} else {
		print "The store was already set up.";
	}
	print "
<p>Now just paste the following snippet into the file <code>config.php</code>,
making sure that <code>&lt;?php</code> is the first line:
</p>
<pre>
&lt;?php

include_once(dirname(__FILE__).'/arc/ARC2.php'); // path to the file ARC2.php

// SQL database configuration for storing the postings:
\$arc_config = array(
  /* MySQL database settings */
  'db_host' => '$host',
  'db_user' => '$user',
  'db_pwd' => '$pwd',
  'db_name' => '$name',

  /* ARC2 store settings */
  'store_name' => '$store_name',

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
</pre>";

}

?>
