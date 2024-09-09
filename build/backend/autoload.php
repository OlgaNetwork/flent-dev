<?php
spl_autoload_register( function( $class ) {
    //print_r( __DIR__ );
    require( __DIR__ . "/model/" . $class . ".php" );
} );
