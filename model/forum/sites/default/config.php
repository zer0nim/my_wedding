<?php

/* 
 * @CODOLICENSE
 */

defined('IN_CODOF') or die();

$installed=false;

function get_codo_db_conf() {


    $config = array (
  'driver' => 'mysql',
  'host' => 'localhost',
  'database' => 'codoforum',
  'username' => 'root',
  'password' => '',
  'prefix' => '',
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
);

    return $config;
}

$DB = get_codo_db_conf();

$CONF = array (
    
  'driver' => 'Custom',
  'UID'    => '5856443760395',
  'SECRET' => '58564437603d2',
  'PREFIX' => ''
);
