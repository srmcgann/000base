#!/bin/bash

echo "enter the new domain..."
read -r newdomain

echo "enter the new database USER name"
read -r newdbuser

echo "enter the new database name"
read -r newdb

php sd.php "$newdomain" "$newdbuser" "$newdb";
