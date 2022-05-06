<?php
function convertCurrency($amount,$from_currency,$to_currency){
  $apikey = 'aede2f4b064b9ae51f5d';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free URL if you're using the free version
  $json = file_get_contents("https://api.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

  var_dump("https://api.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

  
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 2, '.', '');
}

//uncomment to test
echo convertCurrency(10, 'USD', 'MXN');
?>