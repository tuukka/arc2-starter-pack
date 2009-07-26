

ARC2 Starter Pack - a "seed" for SPARQL/Linked Data apps employing ARC2
=======================================================================


Public example at http://tuukka.sioc-project.org/arc2-starter-pack
Developed at http://github.com/tuukka/arc2-starter-pack
Home at http://linkeddata.deri.ie/services/infrastructure/software


Requirements
------------

1. You need to have
  - a WWW server with PHP5 or PHP4.3 or higher.
  - MySQL 4.0.4 or higher.


Quick installation
------------------

1. Move this 'arc2-starter-pack' directory to a web server directory.

2. Download ARC2 (http://arc.semsol.org) and unzip it inside the 
   'arc2-starter-pack' directory.
  - E.g. http://arc.semsol.org/download/2009/03/05/arc.zip

3. Continue with a Web browser to the 'arc2-starter-pack' directory.
  a) E.g. http://localhost/arc2-starter-pack/index.php
  b) *Or*, you can continue on the command line (see below).


Installation on the command line
--------------------------------

1. Continue from the previous steps by editing the parameters in config.php.

2. Create the database with the name you used for db_name in the config.
  - Either use a graphical MySQL administration interface such as phpmyadmin,
  - Or run the following command in the shell:
    mysql -h localhost -u config_db_user -p -e "create database config_db_name;"

3. You can restrict access to the SPARQL server using the following methods:

  a) You can set read and write API keys that clients need to match.
    - Edit config.php and set endpoint_*_keys to something hard to guess.

  b) Add access control rules (password, IP address) to a .htaccess file.

4. That's all! Now you can use ARC2 with SPARQL and SPARQL+:

  a) Access index.php and endpoint.php with a Web browser.

  b) Run cli.php on the command line:
    - chmod +x cli.php
    - ./cli.php "LOAD <http://chatlogs.planetrdf.com/swig/2009-07-26>"
    - ./cli.php "LOAD <file:///home/user/local_file.rdf>"
    - ./cli.php "LOAD <file://$PWD/file_in_current_dir.ttl>"
    - ./cli.php "SELECT DISTINCT ?property WHERE { ?subject ?property ?object . }"
    - ./cli.php "DELETE FROM <http://chatlogs.planetrdf.com/swig/2009-07-26>"

  c) Edit index.php to become your own application.


Example .htaccess file for controlling access
---------------------------------------------

To restrict who can access the SPARQL endpoint by IP address, you can put 
the following lines (please adjust accordinly) into .htaccess:

Order deny,allow
Deny from all

# List IP addresses of the clients that should be allowed 
Allow from 127.0.0.1 # localhost, ie. access from the same machine
Allow from 194.187.213.68 # tuukka.iki.fi
