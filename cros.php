<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://alintacodingtest.azurewebsites.net/api/Movies",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
error_reporting(E_ERROR | E_PARSE);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $result = json_decode($response,true);
  foreach ($result as $key => $row) {
      $sorted[$key]  = $row['name'];
  }

  array_multisort($sorted, SORT_ASC , $result);  
  foreach ($result as $key => $value) 
  {
    foreach ($value['roles'] as $subkey => $subvalue) 
    {
      $response_array[$subvalue['actor']][] = $subvalue['name'];
    };
  }
  echo json_encode($response_array);
}