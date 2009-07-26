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
<title>Your new ARC2 application</title>
</head>

<body>

<h1>Welcome to your new ARC2 application</h1>

<ul>
    <li>This installer and application template for the
        <a href="http://arc.semsol.org/">ARC2</a> RDF store is 
        <a href="http://github.com/tuukka/arc2-starter-pack">
            <code>arc2-starter-pack</code>
        </a> developed at GitHub.</li>
    <li><a href="http://linkeddata.deri.ie/services/infrastructure/software">
        Home</a> at DERI Linked Data Research Centre
</ul>

<h2>Getting started</h2>

<ol>
<li>First, you need to 
    <strong><a href="admin">finish the installation</a></strong>.
</li>
<li>After that, you can start to use ARC2 with 
    <a href="http://www.xml.com/pub/a/2005/11/16/introducing-sparql-querying-semantic-web-tutorial.html?page=3">SPARQL</a> queries and 
    <a href="http://arc.semsol.org/docs/v2/sparql+">SPARQL+</a> commands:
    <ul>
    <li>Access on the Web via <strong>your <a href="endpoint.php">SPARQL endpoint</a></strong>.
    <li>Access on the command line via <strong><code>cli.php</code></strong>, 
        e.g.:
        <ul>
        <li><code>cd <?php print dirname(__FILE__) ?>/</code></li>
        <li><code>chmod +x cli.php</code></li>
        <li><code>./cli.php "LOAD &lt;http://chatlogs.planetrdf.com/swig/2009-07-26&gt;"</code></li>
        <li><code>./cli.php "LOAD &lt;file:///home/user/local_file.rdf&gt;"</code></li>
        <li><code>./cli.php "LOAD &lt;file://$PWD/file_in_current_dir.ttl&gt;"</code></li>
        <li><code>./cli.php "SELECT DISTINCT ?property WHERE { ?subject ?property ?object . }"</code></li>
        <li><code>./cli.php "DELETE FROM &lt;http://chatlogs.planetrdf.com/swig/2009-07-26&gt;"</code></li>
        </ul>
    </li>
    </ul>
</li>

</ol>

<h2>Developing this into your own PHP application</h2>

<p>You can <strong>edit this <code>index.php</code></strong> to become 
your own application. Here's a start:</p>

<blockquote>
<?php

print "<em>Running PHP code...</em>";

include_once(dirname(__FILE__).'/config.php');

/* store instantiation */

$store = ARC2::getStore($arc_config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}

$result = $store->query("SELECT DISTINCT ?property WHERE { ?subject ?property ?object . }");
$rows = $result["result"]["rows"];

if ($rows) {
    print "<table border='1'>\n";
    print "<tr><th>Properties currently in use in the triple store</th></tr>\n";

    foreach ($rows as $row) {
        $item = $row["property"];
        if (strpos($item, "http://www.w3.org/1999/02/22-rdf-syntax-ns#_") !== 0) {
            print "<tr><td>" . htmlspecialchars($item) . "</td></tr>\n";
        }
    }

    print "</table>\n";
} else {
    print "<strong>The ARC2 triple store is currently empty.\n";
    print "Please load some data first.</strong>";
}

?>

</blockquote>

</body>
</html>
