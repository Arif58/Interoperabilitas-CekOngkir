<?php

$id_origin_city = $_GET['id_origin_city'];
$id_destination_city = $_GET['id_destination_city'];
$package_weight = $_GET['package_weight'];
$expedition = $_GET['expedition'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=".$id_origin_city."&destination=".$id_destination_city."&weight=".$package_weight."&courier=".$expedition,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: b44e2d39de34a200277fdcf08c8f7960"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$data = json_decode($response);
$no = 1;
?>
<table class="mx-auto mt-4 table table-sm table-hover">
  <thead>
    <tr class="table-primary">
      <th scope="col">No</th>
      <th scope="col">Tipe Layanan</th>
      <th scope="col">Estimasi Pengiriman (Hari)</th>
      <th scope="col">Harga</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data->rajaongkir->results[0]->costs as $dataOngkir){
      echo "<tr>
        <th>".$no++."</th>
        <td>".$dataOngkir->service."</td>
        <td>".$dataOngkir->cost[0]->etd."</td>
        <td>Rp.".number_format($dataOngkir->cost[0]->value, 2,",",".")."</td>
      </tr>";
    }
    ?>
  </tbody>
</table>
<!-- // if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     foreach ($data->rajaongkir->results[0]->costs as $dataOngkir) {
//       echo 'Tipe Layanan: '. $dataOngkir->service;
//       echo "<br/>";
//       echo 'Estimasi Pengiriman: '. $dataOngkir->cost[0]->etd;
//       echo "<br/>";
//       echo 'Harga: <b>Rp. '.number_format($dataOngkir->cost[0]->value, 2,",",".")."</b>";
//       echo '<hr>';
//     }
// } -->
