<?php
return [
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/
	"accepted"             => ":Attribute dient te worden geaccepteerd.",
	"active_url"           => ":Attribute is geen geldige URL.",
	"after"                => ":Attribute dient een datum te zijn na :date.",
	"alpha"                => ":Attribute mag alleen letters bevatten.",
	"alpha_dash"           => ":Attribute mag alleen letters, nummers, and strepen bevatten.",
	"alpha_num"            => ":Attribute mag alleen letters en nummers bevatten.",
	"array"                => ":Attribute moet een array zijn.",
	"before"               => ":Attribute moet een datum zijn eerder dan :date.",
	"between"              => [
		"numeric" => ":Attribute moet tussen :min en :max liggen.",
		"file"    => ":Attribute moet tussen :min en :max kilobytes zijn.",
		"string"  => ":Attribute moet tussen :min en :max karakters lang zijn.",
		"array"   => ":Attribute moet tussen :min en :max items bevatten.",
	],
	"boolean"              => ":Attribute kan enkel true of false zijn.",
	"confirmed"            => ":Attribute bevestiging komt niet overeen.",
	"date"                 => ":Attribute is geen geldige datum.",
	"date_format"          => ":Attribute komt niet overeen met het formaat :format.",
	"different"            => ":Attribute en :other dienen verschillend te zijn.",
	"digits"               => ":Attribute moet :digits cijfers zijn.",
	"digits_between"       => ":Attribute moet tussen :min en :max cijfers zijn.",
	"email"                => ":Attribute dient een geldig emailadres te zijn.",
	"filled"               => ":Attribute veld is verplicht.",
	"exists"               => "Het geselecteerde :attribute is ongeldig.",
	"image"                => ":Attribute dient een afbeelding te zijn.",
	"in"                   => "Het geselecteerde :attribute is ongeldig.",
	"integer"              => ":Attribute dient een geheel getal te zijn.",
	"ip"                   => ":Attribute dient een geldig IP adres te zijn.",
	"max"                  => [
		"numeric" => ":Attribute mag niet groter zijn dan :max.",
		"file"    => ":Attribute mag niet groter zijn dan :max kilobytes.",
		"string"  => ":Attribute mag niet groter zijn dan :max karakters.",
		"array"   => ":Attribute mag niet meer dan :max items bevatten.",
	],
	"mimes"                => ":Attribute dient een bestand te zijn van het type: :values.",
	"min"                  => [
		"numeric" => ":Attribute dient minimaal :min te zijn.",
		"file"    => ":Attribute dient minimaal :min kilobytes te zijn.",
		"string"  => ":Attribute dient minimaal :min karakters te bevatten.",
		"array"   => ":Attribute dient minimaal :min items te bevatten.",
	],
	"not_in"               => "Het geselecteerde :attribute is ongeldig.",
	"numeric"              => "Het :attribute dient een nummer te zijn.",
	"regex"                => "Het :attribute formaat is ongeldig.",
	"required"             => "Het :attribute veld is verplicht.",
	"required_if"          => "Het :attribute veld is verplicht wanneer :other is :value.",
	"required_with"        => "Het :attribute veld is verplicht wanneer :values aanwezig is.",
	"required_with_all"    => "Het :attribute veld is verplicht wanneer :values aanwezig is.",
	"required_without"     => "Het :attribute veld is verplicht wanneer :values niet aanwezig is.",
	"required_without_all" => "Het :attribute veld is verplicht wanneer geen van :values aanwezig is.",
	"same"                 => "Het :attribute en :other moeten hetzelfde zijn.",
	"size"                 => [
		"numeric" => ":Attribute moet :size zijn.",
		"file"    => ":Attribute moet :size kilobytes groot zijn.",
		"string"  => ":Attribute moet :size karakters lang zijn.",
		"array"   => ":Attribute moet :size items bevatten.",
	],
    "slug_unique"          => ":Attribute moet een unieke slug hebben",
	"unique"               => ":Attribute is al bezet.",
	"url"                  => ":Attribute formaat is ongeldig.",
    "url_response_ok"      => ":Attribute verwijst naar een ongeldige locatie",
	"timezone"             => ":Attribute moet een geldige tijdszone zijn.",
    "numeric_array"        => ":Attribute moet een komma gescheiden lijst met getallen zijn.",

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
	'custom' => [
	],

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
	'attributes' => array_merge([
        'address'       => 'adres',
        'amount'        => 'aantal',
        'city'          => 'plaats',
        'created_at'    => 'aangemaakt op',
        'deleted_at'    => 'verwijdert op',
        'description'   => 'omschrijving',
        'email'         => 'emailadres',
        'image'         => 'afbeelding',
        'name'          => 'naam',
        'order_id'      => 'bestelnummer',
        'password'      => 'wachtwoord',
        'price'         => 'prijs',
        'price_each'    => 'prijs per stuk',
        'product_id'    => 'artikelnummer',
        'remember_token'=> 'onthoud code',
        'title'         => 'titel',
        'token'         => 'code',
        'transaction_id'=> 'transactienummer',
        'updated_at'    => 'aangepast op',
        'user_id'       => 'gebruikersnummer',
        'vat_percentage'=> 'btw percentage',
        'verified_at'   => 'geverifieerd op',
        'zipcode'       => 'postcode',
	]),
];
