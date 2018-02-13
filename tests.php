<?php

if ( !defined( 'ABSPATH' ) )
	exit;

$tests = [
	'Some TEXT in... English!',
	'ΜΠΟΡΑ, Μπόρα, μπόρα, ΤΑΜΠ-Τάμπ-ταμπ, ΕΜΠΡΟΣ, Εμπρός, εμπρός!',
	'ΕΥΧΑΡΙΣΤΟΣ, ευ, Αυγή, αυτοκίνητο.',
	'ελέγχους, ΕΓΓΡΑΦΟΥ',
	'Χτύπημα, θρανίο, ΨΑΡΙ, Χ-ψ!',
];
foreach ( $tests as $test )
	echo kgr_elot743( $test ) . "\n";
