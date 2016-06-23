<?php
$raw_items = [
    'zipcode'       => ['regex' => '^([1-9]\d{3})\s?([a-zA-Z]{2})$'],
    'password'      => ['regex' => '^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?i)(?!.*(?<c>.)(\k<c>){2,})(?!password|wachtwoord).{5,}$']
];

$items = ['raw' => $raw_items];
foreach($raw_items as $key => $raw_item){
    $items[$key] = '/'.$raw_item['regex'].'/'.(isset($raw_item['modifiers']) ? $raw_item['modifiers'] : '');
}

return $items;
?>
