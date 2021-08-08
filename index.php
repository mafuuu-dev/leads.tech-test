<?php

require __DIR__ . '/vendor/autoload.php';

use App\LogLine;
use App\FileWriter;
use App\ExecutionTime;

use LeadGenerator\Lead;
use LeadGenerator\Generator;

$executionTime = new ExecutionTime();
$executionTime->start();

$fileWriter = new FileWriter( "log.txt" );

$generator = new Generator();
$generator->generateLeads( 10, function ( Lead $lead ) use ( $fileWriter ) {
	$fileWriter->write( new LogLine( $lead ) );

	sleep( 5 );
} );

$executionTime->end();
echo "\n$executionTime\n";
