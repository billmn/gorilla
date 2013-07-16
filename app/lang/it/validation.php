<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"        => "Il campo \":attribute\" deve essere accettato.",
	"active_url"      => "Il campo \":attribute\" non è una URL valida.",
	"after"           => "Il campo \":attribute\" deve essere una data successiva a :date.",
	"alpha"           => "Il campo \":attribute\" può contenere solo lettere.",
	"alpha_dash"      => "Il campo \":attribute\" può contenere solo lettere, numeri e trattini.",
	"alpha_num"       => "Il campo \":attribute\" può contenere solo lettere e numeri.",
	"before"          => "Il campo \":attribute\" deve essere una data precedente a :date.",
	"between"         => array(
		"numeric" => "Il campo \":attribute\" deve essere compreso tra :min - :max.",
		"file"    => "Il campo \":attribute\" deve essere compreso tra :min - :max kilobytes.",
		"string"  => "Il campo \":attribute\" deve essere compreso tra :min - :max caratteri.",
	),
	"confirmed"       => "Il campo conferma \":attribute\" non corrisponde.",
	"date"            => "Il campo \":attribute\" non è una data valida.",
	"date_format"     => "Il campo \":attribute\" non corrisponde al formato :format.",
	"different"       => "Il campo \":attribute\" ed il campo \":other\" devono essere differenti.",
	"digits"          => "Il campo \":attribute\" deve essere di :digits cifre.",
	"digits_between"  => "Il campo \":attribute\" deve essere compreso tra :min e :max cifre.",
	"email"           => "Il formato del campo \":attribute\" non è valido.",
	"exists"          => "The selected \":attribute\" is invalid.",
	"image"           => "Il campo \":attribute\" deve essere un'immagine.",
	"in"              => "The selected \":attribute\" is invalid.",
	"integer"         => "Il campo \":attribute\" deve essere un numero intero.",
	"ip"              => "Il campo \":attribute\" deve essere un indirizzo IP valido.",
	"max"             => array(
		"numeric" => "Il campo \":attribute\" non può essere superiore di :max.",
		"file"    => "Il campo \":attribute\" non può essere superiore di :max kilobytes.",
		"string"  => "Il campo \":attribute\" non può essere superiore di :max caratteri.",
	),
	"mimes"           => "Il campo \":attribute\" deve essere un file di tipo: :values.",
	"min"             => array(
		"numeric" => "Il campo \":attribute\" deve essere almeno di :min.",
		"file"    => "Il campo \":attribute\" deve essere almeno :min kilobytes.",
		"string"  => "Il campo \":attribute\" deve essere almeno :min caratteri.",
	),
	"not_in"          => "The selected \":attribute\" is invalid.",
	"numeric"         => "Il campo \":attribute\" deve essere un numero.",
	"regex"           => "Il formato del campo \":attribute\" non è valido.",
	"required"        => "Il campo \":attribute\" è richiesto.",
	"required_if"     => "Il campo \":attribute\" è richiesto quando \":other\" è \":value\".",
	"required_with"   => "Il campo \":attribute\" è richiesto quando \":values\" è presente.",
	"required_without" => "Il campo \":attribute\" è richiesto quando \":values\" non è presente.",
	"same"            => "Il campo \":attribute\" e \":other\" devono corrispondere.",
	"size"            => array(
		"numeric" => "Il campo \":attribute\" deve essere :size.",
		"file"    => "Il campo \":attribute\" deve essere :size kilobytes.",
		"string"  => "Il campo \":attribute\" deve essere :size caratteri.",
	),
	"unique"          => "Il campo \":attribute\" è già stato utilizzato.",
	"url"             => "Il formato del campo \":attribute\" non è valido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);