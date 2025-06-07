<!DOCTYPE html>


<style type="text/css">
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
</style>
<?php
    $servername = "localhost";
    $username = "regfaskesdb";
    $password = "dbr3gfask3s#@!";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=dbfaskes", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch(PDOException $e) {
      //echo "Connection failed: " . $e->getMessage();
    }

    if(!empty($_GET['prop'])){
      $where_prop_k = 'AND data_klinik.id_prov = '.$_GET['prop'].'';
      $where_prop_l = 'AND data_labkes.id_prov = '.$_GET['prop'].'';
      $where_prop_rs = 'AND data_rs.id_prov = '.$_GET['prop'].'';
      $where_prop_u = 'AND data_utd.id_prov = '.$_GET['prop'].'';
      $where_prop_p = 'AND data_pm.id_prov_pm = '.$_GET['prop'].'';
      $andgroup_k = '';
      $andgroup_l = '';
      $andgroup_rs = '';
      $andgroup_u = '';
      $andgroup_p = '';
    }else{
      $where_prop_k = '';
      $where_prop_l = '';
      $where_prop_rs = '';
      $where_prop_u = '';
      $where_prop_p = '';
      $andgroup_k = '';//'GROUP BY data_klinik.id_prov LIMIT 0,200';
      $andgroup_l = '';//'GROUP BY data_labkes.id_prov LIMIT 0,200';
      $andgroup_rs = '';
      $andgroup_u = '';//'GROUP BY data_utd.id_prov LIMIT 0,200';
      $andgroup_p = '';//'GROUP BY data_pm.id_prov_pm LIMIT 0,200';
    }

    $stmt = $conn->prepare("(SELECT
  kategori.id,kategori.kategori_user,data_klinik.nama_klinik as nm_satker,data_klinik.alamat_faskes as al_satker ,data_klinik.latitude,data_klinik.longitude,data_klinik.id_prov
FROM
  trans_final 
  INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
  LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
  LEFT JOIN data_klinik ON trans_final.id_faskes = data_klinik.id_faskes  
   WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND latitude <> '' AND longitude <> '' ".$where_prop_k." ".$andgroup_k.")
UNION ALL
(SELECT
  kategori.id,kategori.kategori_user,data_labkes.nama_lab as nm_satker,data_labkes.alamat_faskes as al_satker, data_labkes.latitude,data_labkes.longitude,data_labkes.id_prov
FROM
  trans_final 
  INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
  LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
  LEFT JOIN data_labkes ON trans_final.id_faskes = data_labkes.id_faskes WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND latitude <> '' AND longitude <> '' ".$where_prop_l." ".$andgroup_l.")
  UNION ALL (SELECT
  kategori.id,kategori.kategori_user,data_rs.nama_rs as nm_satker ,data_rs.alamat_faskes as al_satker,data_rs.latitude,data_rs.longitude,data_rs.id_prov
FROM
  trans_final 
  INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
  LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
  LEFT JOIN data_rs ON trans_final.id_faskes = data_rs.id_faskes
  WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND latitude <> '' AND longitude <> '' ".$where_prop_rs." ".$andgroup_rs.")
  UNION ALL 
  (SELECT
  kategori.id,kategori.kategori_user, data_utd.nama_utd as nm_satker,data_utd.alamat_faskes as al_satker,data_utd.latitude,data_utd.longitude,data_utd.id_prov
FROM
  trans_final 
  INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
  LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
  LEFT JOIN data_utd ON trans_final.id_faskes = data_utd.id_faskes
  WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND latitude <> '' AND longitude <> '' ".$where_prop_u." ".$andgroup_u.")
  UNION ALL
  (SELECT
  kategori.id,kategori.kategori_user, data_pm.nama_pm as nm_satker,data_pm.alamat_faskes as al_satker,data_pm.latitude,data_pm.longitude,data_pm.id_prov_pm as id_prov
FROM
  trans_final 
  INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
  LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
  LEFT JOIN data_pm ON trans_final.id_faskes = data_pm.id_faskes
  WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND latitude <> '' AND longitude <> '' ".$where_prop_p." ".$andgroup_p."); ");
    $stmt->execute();

    // set the resulting array to associatives
     $result = $stmt->fetchAll(); 

     $kat[5] = array('0099FF','K');
     $kat[7] = array('00BF60','L');
     $kat[4] = array('FF0000','RS');
     $kat[6] = array('5454AB','U');
     $kat[9] = array('004831','P');

     
     foreach ($result as $result) {
      //echo $result['kategori_user'];;
      //if( ($result['latitude'] >= -90 AND $result['latitude'] <= 90) && ($result['longitude'] >= -180 AND $result['longitude'] <= 180) ){
      if(!empty($result['nm_satker'])){
        if(is_numeric($result['latitude']) && is_numeric($result['longitude'])){
          // $loc[] = array(''.strip_tags($result['nm_satker']).'', $result['latitude'],$result['longitude'], $result['id'],'<div><h5 id="firstHeading" class="firstHeading">'.$result['nm_satker'].'</h5><div id="bodyContent">'.$result['al_satker'].'</div></div>');
          if(empty($_GET['prop'])){
            $ket = '';
          }else{
            $ket = strip_tags($result['al_satker']);
          }
          $loc[] = array(''.strip_tags($result['nm_satker']).'', $result['latitude'],$result['longitude'], $result['id'],'<b>'.ucwords($result['nm_satker']).'</b><div style="width:250px;">'.$ket.'</div>');

        }
      }  

      // $loc[0] = array('RSUP Fatmawatix', -6.333430203816993,107.12204608310378, 1,'<div><h5 id="firstHeading" class="firstHeading">RSUP Fatmawati</h5><div id="bodyContent">Jl. RS. Fatmawati Raya No.4, RT.4/RW.9, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12430</div></div>');
      //echo $result['latitude'];
     }
     //echo 's';
     //echo json_encode($loc);
     //exit();

?> 
<html>
  <head>
    <title>Info Windows</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/metro/4.4.3/css/metro-all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
   
   
    <!-- jsFiddle will insert css and js -->
  </head>
  <body>
    <aside class="sidebar pos-absolute z-2"
       data-role="sidebar"
       data-toggle="#sidebar-toggle-3"
       id="sb3"
       data-shift=".shifted-content">
    <!-- <div style="margin-top: 10px;"></div>
    <div style="margin-bottom: 20px;">
        <div>
          <center><img src="" width="60%"></center>
        </div>
    </div> -->
    <div style="overflow-x: scroll; height: 100%;" >
    <ul class="sidebar-menu">
        <li><a><span class="mif-my-location fg-blue icon"></span>Pilih Provinsi</a></li>
        <li class="divider"></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=11"><span class="mif-location fg-red icon"></span> Aceh  </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=31"><span class="mif-location fg-red icon"></span> DKI Jakarta </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=12"><span class="mif-location fg-red icon"></span> Sumatera Utara</a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=13"><span class="mif-location fg-red icon"></span> Sumatera Barat  </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=14"><span class="mif-location fg-red icon"></span> Riau </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=15"><span class="mif-location fg-red icon"></span> Jambi </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=16"><span class="mif-location fg-red icon"></span> Sumatera Selatan </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=17"><span class="mif-location fg-red icon"></span> Bengkulu </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=18"><span class="mif-location fg-red icon"></span> Lampung </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=19"><span class="mif-location fg-red icon"></span> Bangka Belitung </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=21"><span class="mif-location fg-red icon"></span> Kepulauan Riau  </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=32"><span class="mif-location fg-red icon"></span> Jawa Barat</a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=33"><span class="mif-location fg-red icon"></span> Jawa Tengah </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=34"><span class="mif-location fg-red icon"></span> Di Yogyakarta </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=35"><span class="mif-location fg-red icon"></span> Jawa Timur </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=36"><span class="mif-location fg-red icon"></span> Banten </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=51"><span class="mif-location fg-red icon"></span> Bali </a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=52"><span class="mif-location fg-red icon"></span> Nusa Tenggara Barat</a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=53"><span class="mif-location fg-red icon"></span> Nusa Tenggara Timur </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=61"><span class="mif-location fg-red icon"></span> Kalimantan Barat </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=62"><span class="mif-location fg-red icon"></span> Kalimantan Tengah </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=63"><span class="mif-location fg-red icon"></span> Kalimantan Selatan</a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=64"><span class="mif-location fg-red icon"></span> Kalimantan Timur </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=65"><span class="mif-location fg-red icon"></span> Kalimantan Utara</a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=71"><span class="mif-location fg-red icon"></span> Sulawesi Utara </a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=72"><span class="mif-location fg-red icon"></span> Sulawesi Tengah </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=73"><span class="mif-location fg-red icon"></span> Sulawesi Selatan </a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=74"><span class="mif-location fg-red icon"></span> Sulawesi Tenggara  </a></li>
        <li><a href="http://103.74.143.45/map_dev/?prop=75"><span class="mif-location fg-red icon"></span> Gorontalo </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=76"><span class="mif-location fg-red icon"></span> Sulawesi Barat </a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=81"><span class="mif-location fg-red icon"></span> Maluku </a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=82"><span class="mif-location fg-red icon"></span> Maluku Utara </a></li>  
        <li><a href="http://103.74.143.45/map_dev/?prop=94"><span class="mif-location fg-red icon"></span> Papua </a></li> 
        <li><a href="http://103.74.143.45/map_dev/?prop=91"><span class="mif-location fg-red icon"></span> Papua Barat </a></li>
    </ul>
    </div>
</aside>
<div class="shifted-content h-100 p-ab">
    <div class="app-bar pos-absolute  z-1" style="background-color: #5577AE;" data-role="appbar">
        <button class="app-bar-item c-pointer" id="sidebar-toggle-3">
            <span class="mif-menu fg-white"></span>
        </button>
        <div style="float: left; width: 40%;"><span style="color: #fff; font-size: 18px; font-weight: bold;">Peta Sebaran Fasilitas Kesehatan</span></div>
        <div style="width: 92%;float: left;" >
          <?php /*d
          <select data-role="select" id="sampleSelect">
             <option value="-"> Peta Sebaran Fasilitas Kesehatan </option>
               <?php foreach ($loc as $key => $value) { ?>        
                <option value=""><?php echo $value[0]; ?></option> 
              <?php } ?>
          </select>
          */?>
          <!-- <select class="js-example-data-array">
            
          </select> -->

        </div><div style="clear: both;"></div>
    </div>

    <div class="h-100">
        <div id="map"></div>
    </div>
</div>
<?php 
/*
 $lat_long[31]['lat'] = '-6.208760';
 $lat_long[31]['long'] = '106.845599';

 $lat_long[32]['lat'] = '-6.943097';
 $lat_long[32]['long'] = '107.633545';
*/
$lat_long[11]=array('4.695135','96.7493993');
$lat_long[12]=array('2.1153547','99.5450974');
$lat_long[13]=array('-0.7399397','100.8000051');
$lat_long[14]=array('0.2933469','101.7068294');
$lat_long[15]=array('-1.4851831','102.4380581');
$lat_long[16]=array('-3.3194374','103.914399');
$lat_long[17]=array('-3.5778471','102.3463875');
$lat_long[18]=array('-4.5585849','105.4068079');
$lat_long[19]=array('-2.7410513','106.4405872');
$lat_long[21]=array('3.9456514','108.1428669');
$lat_long[31]=array('-6.211544','106.845172');
$lat_long[32]=array('-7.090911','107.668887');
$lat_long[33]=array('-7.150975','110.1402594');
$lat_long[34]=array('-7.8753849','110.4262088');
$lat_long[35]=array('-7.5360639','112.2384017');
$lat_long[36]=array('-6.4058172','106.0640179');
$lat_long[51]=array('-8.4095178','115.188916');
$lat_long[52]=array('-8.6529334','117.3616476');
$lat_long[53]=array('-8.6.573819','121.0793705');
$lat_long[61]=array('-0.2787808','111.4752851');
$lat_long[62]=array('-1.6814878','113.3823545');
$lat_long[63]=array('-3.0926415','115.2837585');
$lat_long[64]=array('1.6406296','116.419389');
$lat_long[71]=array('0.6246932','123.9750018');
$lat_long[72]=array('-1.4300254','121.4456179');
$lat_long[73]=array('-3.6687994','119.9740534');
$lat_long[74]=array('-4.14491','122.174605');
$lat_long[75]=array('0.6999372','122.4467238');
$lat_long[76]=array('-2.8441371','119.2320784');
$lat_long[81]=array('-3.2384616','130.1452734');
$lat_long[82]=array('1.5709993','127.8087693');
$lat_long[91]=array('-1.3361154','133.1747162');
$lat_long[94]=array('-4.269928','138.0803529');

//echo $lat_long[$_GET['prop']][0];

?>  
   
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        
        <?php 
          /*
          $loc[0] = array('RSUP Fatmawati', -6.296244,106.795013, 1,'<div><h5 id="firstHeading" class="firstHeading">RSUP Fatmawati</h5><div id="bodyContent">Jl. RS. Fatmawati Raya No.4, RT.4/RW.9, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12430</div></div>');
          $loc[1] = array('RSUP Persahabatan', -6.20369,106.883157, 1,'<div><h5 id="firstHeading" class="firstHeading">RSUP Persahabatan</h5><div id="bodyContent">Jl. Rumah Sakit Persahabatan, Pisangan Tim., Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13230, Indonesia</div></div>');
          $loc[2] = array('RS Kariadi',-6.99272979167,110.406412708, 2,'<div><h5 id="firstHeading" class="firstHeading">RSUP Kariadi</h5><div id="bodyContent">Jl. DR. Sutomo No.16, Randusari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50244</div></div>');
          $loc[3] = array('RS Sanglah', -8.66266816415,115.187625288, 3,'<div><h5 id="firstHeading" class="firstHeading">RSUP Sanglah</h5><div id="bodyContent">Jl. Diponegoro, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80113</div></div>');
          $loc[4] = array('RSUP Dr. M. Djamil', -0.459045,100.558145, 3,'<div><h5 id="firstHeading" class="firstHeading">RSUP Dr. M. Djamil</h5><div id="bodyContent">Jl. Perintis Kemerdekaan, Sawahan Tim., Kec. Padang Tim., Kota Padang, Sumatera Barat 25171</div></div>');
          $loc[5] = array('RSUPN Dr. Cipto Mangunkusumo', -6.197399, 106.847672, 1,'<div><h5 id="firstHeading" class="firstHeading">RSUPN Dr. Cipto Mangunkusumo</h5><div id="bodyContent">Jl. Pangeran Diponegoro No.71, RW.5 · (021) 1500135</div></div>');
          $loc[6] = array('RSUP Kanker Dharmais', -6.20772167, 106.63659333, 1,'<div><h5 id="firstHeading" class="firstHeading">RSUP Kanker Dharmais</h5><div id="bodyContent">Jl. Letjen S. Parman No.84, RW.9, Kota Bambu Sel., Kec. Palmerah, Daerah Khusus Ibukota Jakarta 11420</div></div>');
          $loc[7] = array('RSHS Hasan Sadikin',-6.796027, 107.649497, 1,'<div><h5 id="firstHeading" class="firstHeading">RSHS Hasan Sadikin</h5><div id="bodyContent">Jl. Pasteur No.38, Pasteur, Kec. Sukajadi, Kota Bandung, Jawa Barat 40161</div></div>');
        */

          if(!isset($satker)){
             if(empty($_GET['prop'])){
              $lat = '-1.430025';
              $long = '121.445618';
              $zoom = 5;
             }else{
              $lat = ''.$lat_long[$_GET['prop']][0].'';
              $long = ''.$lat_long[$_GET['prop']][1].'';
              $zoom = 9;
             }
          }else{
            $lat = ''.$loc[$satker][1].'';
            $long = ''.$loc[$satker][2].'';
            $zoom = 15;
          }
         // echo 'sssss'.$loc[1][0];
        ?>

        
  </body>
</html>
<script type="text/javascript">
  var locations = <?php echo json_encode($loc); ?>;
  var katz = <?php echo json_encode($kat); ?>;

  console.log(katz[5][0]);

    console.log(locations);
  // This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.
function initMap() {
  

    //var locations = <?php echo json_encode($loc); ?>;

    console.log(locations);

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: <?php echo $zoom; ?>,
      center: new google.maps.LatLng(<?php echo $lat ?>,<?php echo $long; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    const svgMarker = {
    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
    fillColor: "green",
    fillOpacity: 1,
    strokeWeight: 1,
    strokeColor:'white',
    rotation: 0,
    scale: 2,
    anchor: new google.maps.Point(15, 30),
  };


    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,
          icon: 'http://www.googlemapsmarkers.com/v1/'+katz[locations[i][3]][1]+'/'+katz[locations[i][3]][0]+'/FFFFFF/FFFFFF/',
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][4]);
            infowindow.open(map, marker);
          }
        })(marker, i));
    }
}

$("#sampleSelect").change(function() {
  var open = $(this).data("isopen");
  if(open) {
    window.location.href = $(this).val()
  }
  //set isopen to opposite so next time when use clicked select box
  //it wont trigger this event
  $(this).data("isopen", !open);
});

// var data = [
//     {
//         id: 0,
//         text: 'enhancement'
//     },
//     {
//         id: 1,
//         text: 'bug'
//     },
//     {
//         id: 2,
//         text: 'duplicate'
//     },
//     {
//         id: 3,
//         text: 'invalid'
//     },
//     {
//         id: 4,
//         text: 'wontfix'
//     }
// ];

// $(".js-example-data-array").select2({
//   data: data
// })

</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metro/4.4.3/js/metro.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi8Jv1juu3th7JZmyHDyuRnDbNzkV2Eno&callback=initMap"></script>