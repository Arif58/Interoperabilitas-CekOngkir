<?php
include "getProvince.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ongkir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

  <div class="jumbotron text-center">
    <h1>Hitung Ongkir!</h1>
    <p>Yuk Hitung Ongkir Kalian Yuk!</p> 
  </div>
    
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <h3>Kota Asal</h3>
        <h6>Provinsi</h6>
        <select name="provinsi_asal" onchange="findOriginCity(this.value)">
          <option>-- Pilih Provinsi --</option>
          <?php 
            foreach ($data->rajaongkir->results as $provinsi){
              echo '<option value="'.$provinsi->province_id.'">'.$provinsi->province.'</option>';
            }
          ?>
        </select>
        <h6 class="mt-3">Kota</h6>
        <select name="kota_asal" id="kota_asal">
          <option>-- Pilih Kota --</option>
        </select>
      </div>

      <div class="col-sm-4">
        <h3>Kota Tujuan</h3>
        <h6>Provinsi</h6>
        <select name="provinsi_tujuan" onchange="findDestinationCity(this.value)">
          <option>-- Pilih Provinsi --</option>
          <?php 
            foreach ($data->rajaongkir->results as $provinsi){
              echo '<option value="'.$provinsi->province_id.'">'.$provinsi->province.'</option>';
            }
          ?>
        </select>
        <h6 class="mt-3">Kota</h6>
        <select name="kota_tujuan" id="kota_tujuan">
          <option>-- Pilih Kota --</option>
        </select>
      </div>

      <div class="col-sm-4">
        <h3>Kurir & Barang</h3>        
        <h6>Kurir</h6>
        <select id="kurir" name="kurir">
          <!-- <option>-- Pilih Kurir --</option> -->
          <option value="jne">JNE</option>
          <option value="pos">POS</option>
          <option value="tiki">TIKI</option>         
        </select>
        <h6 class="mt-3">Berat Kiriman (gram)</h6>
        <input type="text" id="berat_kiriman" name="berat_kiriman">
        <input type="submit" class="btn btn-dark" value="Cek Ongkir" name="cek_ongkir" onclick="cekOngkir();">
      </div>

    </div>
  </div>
  
  <div class="container">
    <div class="text-center" id="biayaOngkir">
    </div>
  </div>
  <script>

    function findOriginCity(province_id){
      var xmlhttp = new XMLHttpRequest();
  
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("kota_asal").innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "http://localhost/api/getCity.php?province_id="+province_id, true);
      xmlhttp.send();
    }

    function findDestinationCity(province_id){
      var xmlhttp = new XMLHttpRequest();
  
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("kota_tujuan").innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "http://localhost/api/getCity.php?province_id="+province_id, true);
      xmlhttp.send();
    }

    function cekOngkir(){
      var id_origin_city = document.getElementById("kota_asal").value;
      var id_destination_city = document.getElementById("kota_tujuan").value;
      var package_weight = document.getElementById("berat_kiriman").value;
      var expedition = document.getElementById("kurir").value;

      var xmlhttp = new XMLHttpRequest();
  
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("biayaOngkir").innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "http://localhost/api/ongkir.php?id_origin_city="+id_origin_city+"&id_destination_city="+id_destination_city+"&package_weight="+package_weight+"&expedition="+expedition, true);
      xmlhttp.send();
    }
  </script>
</body>

  
</html>
