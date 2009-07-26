#!/usr/bin/env php
<?php

include_once(dirname(__FILE__).'/config.php');

/* store instantiation */

$store = ARC2::getStore($arc_config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}

/* query handling */

$query = $argv[1];

$result = $store->query($query);

/* error handling */

if ($errors = $store->getErrors()) {
    error_log("arc2sparql error:\n" . join("\n", $errors));
    exit(10);
}

/* result handling */

if ($result["query_type"] == "construct" ||
    $result["query_type"] == "describe"
) {
    $ser = ARC2::getTurtleSerializer();
    print $ser->getSerializedIndex($result["result"]);  
    print "\n";
} else if ($result["query_type"] == "select") {
    $vars = $result['result']['variables'];
    $rows = $result['result']['rows'];
    foreach ($vars as $var) {
        print $var . " ";
    }
    print "\n";
    foreach ($rows as $row) {
        foreach ($vars as $var) {
            print $row[$var] . " ";
        }
        print "\n";
    }
} else if ($result["query_type"] == "load") {
    print "Loaded " . $result["result"]["t_count"] . " triples.\n";
} else if ($result["query_type"] == "insert") {
    print "Inserted " . $result["result"]["t_count"] . " triples.\n";
} else if ($result["query_type"] == "delete") {
    print "Deleted " . $result["result"]["t_count"] . " triples.\n";
} else if ($result["query_type"] == "ask") {
    if ($result["result"]) {
        print "yes\n";
        exit(0);
    } else {
        print "no\n";
        exit(1);
    }
} else if ($result["query_type"] == "dump") {
    // The query already printed the dump, nothing to do here
} else {
    // Something unexpected
    var_dump($result);
}

exit(0);

?>
