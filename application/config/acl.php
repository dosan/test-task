<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config[ 'permission' ] = array(
    'users' => array(
        'add' => array( 'admin' ),
        'edit own' => array( 'blogger', 'editor', 'admin' ),
        'edit all' => array( 'editor', 'admin' ),
        'delete own' => array( 'blogger', 'editor', 'admin' ),
        'delete all' => array( 'editor', 'admin' ),
    ),
    'umpires' => array(
        'add' => array( 'admin' ),
        'edit own' => array( 'umpire', 'admin' ),
        'edit all' => array( 'admin' ),
        'delete own' => array( 'umpire', 'admin' ),
        'delete all' => array( 'admin' ),
    ),
    'cricket' => array(
        'add' => array( 'umpire', 'admin' ),
        'edit own' => array(), // not applicable
        'edit all' => array( 'umpire', 'admin' ),
        'delete own' => array( ), // not applicable
        'delete all' => array( 'umpire', 'admin' ),
    ),
); ?>