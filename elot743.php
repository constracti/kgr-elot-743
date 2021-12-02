<?php

if ( !defined( 'ABSPATH' ) )
	exit;

function kgr_elot_743( string $in ): string {
	$diph_aei = ['α', 'ε', 'η'];
	$diph_yps = ['υ', 'ύ'];
	$diph_vita = [
		'α', 'ά', 'ε', 'έ', 'η', 'ή', 'ο', 'ό', 'ω', 'ώ',
		'ι', 'ί', 'ϊ', 'ΐ', 'υ', 'ύ', 'ϋ', 'ΰ',
		'β', 'γ', 'δ', 'ζ', 'λ', 'μ', 'ν', 'ρ',
	];
	$diphthongs = [
		'γγ' => 'ng',
		'γξ' => 'nx',
		'γχ' => 'nch',
		'ου' => 'ou',
		'ού' => 'ou',
	];
	$doubles = [
		'θ' => 'th',
		'χ' => 'ch',
		'ψ' => 'ps',
	];
	$singles = [
		'α' => 'a', 'ά' => 'a',
		'β' => 'v',
		'γ' => 'g',
		'δ' => 'd',
		'ε' => 'e', 'έ' => 'e',
		'ζ' => 'z',
		'η' => 'i', 'ή' => 'i',
		# θ in doubles
		'ι' => 'i', 'ί' => 'i', 'ϊ' => 'i', 'ΐ' => 'i',
		'κ' => 'k',
		'λ' => 'l',
		'μ' => 'm',
		'ν' => 'n',
		'ξ' => 'x',
		'ο' => 'o', 'ό' => 'o',
		'π' => 'p',
		'ρ' => 'r',
		'σ' => 's', 'ς' => 's',
		'τ' => 't',
		'υ' => 'y', 'ύ' => 'y', 'ϋ' => 'y', 'ΰ' => 'y',
		'φ' => 'f',
		# χ in doubles
		# ψ in doubles
		'ω' => 'o', 'ώ' => 'o',
	];
	$out = '';
	$l = mb_strlen( $in );
	$i = 0;
	while ( $i < $l ) {
		$cm = $i>0 ? mb_substr( $in, $i-1, 1 ) : '';
		$c0 = mb_substr( $in, $i, 1 );
		$c1 = mb_substr( $in, $i+1, 1 );
		$c2 = mb_substr( $in, $i+2, 1 );
		# μπ as b rule
		if ( mb_strtolower($c0.$c1) == 'μπ' && ( mb_ereg('^\W$|^_$|^$',$cm) || mb_ereg('^\W$|^_$|^$',$c2) ) ) {
			$out .= mb_strtoupper($c0) == $c0 ? mb_strtoupper('b') : 'b';
			$i+=2;
		}
		# diphthong υ rule
		elseif ( in_array( mb_strtolower($c0), $diph_aei ) && in_array( mb_strtolower($c1), $diph_yps ) ) {
			$t = $singles[mb_strtolower($c0)];
			$out .= mb_strtoupper($c0) == $c0 ? mb_strtoupper(mb_substr($t, 0, 1)) : mb_substr($t, 0, 1);
			if ( in_array( mb_strtolower($c2), $diph_vita ) )
				$out .= mb_strtoupper($c1) == $c1 ? mb_strtoupper('v') : 'v';
			else
				$out .= mb_strtoupper($c1) == $c1 ? mb_strtoupper('f') : 'f';
			$i+=2;
		}
		# diphthongs rule
		elseif ( array_key_exists( mb_strtolower($c0.$c1), $diphthongs ) ) {
			$t = $diphthongs[mb_strtolower($c0.$c1)];
			$out .= mb_strtoupper($c0) == $c0 ? mb_strtoupper(mb_substr($t, 0, 1)) : mb_substr($t, 0, 1);
			$t = mb_substr( $t, 1 );
			$out .= mb_strtoupper($c1) == $c1 ? mb_strtoupper($t) : $t;
			$i+=2;
		}
		# doubles rule
		elseif ( array_key_exists( mb_strtolower($c0), $doubles ) ) {
			$t = $doubles[mb_strtolower($c0)];
			$out .= mb_strtoupper($c0) == $c0 ? mb_strtoupper(mb_substr($t, 0, 1)) : mb_substr($t, 0, 1);
			$t = mb_substr( $t, 1 );
			$out .= mb_strtoupper($c0.$c1) == $c0.$c1 ? mb_strtoupper($t) : $t;
			$i+=1;
		}
		# single rule
		elseif ( array_key_exists( mb_strtolower($c0), $singles ) ) {
			$t = $singles[mb_strtolower($c0)];
			$out .= mb_strtoupper($c0) == $c0 ? mb_strtoupper($t) : $t;
			$i+=1;
		}
		# no rule
		else {
			$out .= $c0;
			$i+=1;
		}
	}
	return $out;
}
