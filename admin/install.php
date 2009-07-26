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
	$store =  $_GET['store'];
	
	$config = array(
	  'db_host' => $host,
	  'db_name' => $name,
	  'db_user' => $user,
	  'db_pwd' => $pwd,
	  'store_name' => $store
	);
	
	$store = ARC2::getStore($config);

	if (!$store->isSetUp()) {
		$store->setUp();
	}
}

?>