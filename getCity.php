<?php

$province_id = $_GET['province_id'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$province_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: b44e2d39de34a200277fdcf08c8f7960"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $dataKota = json_decode($response);
    // echo "<pre>"; print_r($dataKota); echo"</pre>";
}

foreach ($dataKota->rajaongkir->results as $city){
  echo '<option value="'.$city->city_id.'">'.$city->type." ".$city->city_name.'</option>';
}


?>