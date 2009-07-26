<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp
/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:xsd ="http://www.w3.org/2001/XMLSchema#"
  xmlns:dcterms="http://purl.org/dc/terms/"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"  
  xmlns:vcard="http://www.w3.org/2006/vcard/ns#"
  xmlns:owl="http://www.w3.org/2002/07/owl#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">

<head>
<title>Your ARC2 application</title>
</head>

<body>

<h1>Welcome to your ARC2 application</h1>

<h2>Getting started</h2>

<ol>
<li>First, you need to <a href="admin">finish the installation</a>.</li>

<li>After that, you can start to use ARC2:
<ul>
<li>Access the <a href="endpoint.php">SPARQL endpoint</a>
<li>Run SPARQL queries and SPARQL+ commands on the command line 
(e.g. <code>./cli.php "SELECT DISTINCT ?class WHERE { ?subject rdf:type ?class . }"</code>)
</ul>
</li>

</ol>

<h2>Developing this into your own application</h2>

<p>You can edit this index.php to become your ARC2 application. Here's a 
start:</p>

<blockquote>
<?php

print "Running PHP code...";

include_once(dirname(__FILE__).'/config.php');

/* store instantiation */

$store = ARC2::getStore($arc_config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}

$result = $store->query("SELECT DISTINCT ?class WHERE { ?subject rdf:type ?class . }");
$rows = $result["result"]["rows"];

if ($rows) {
    print "<table>\n";
    print "<tr><th>Classes currently in use in the triple store</th></tr>\n";

    foreach ($rows as $row) {
        print "<tr><td>" . htmlspecialchars($row["class"]) . "</td></tr>\n";
    }

    print "</table>\n";
} else {
    print "<em>The ARC2 triple store contains nothing with a class.\n";
    print "Load some data first.</em>";
}

?>

</blockquote>

</body>
</html>
