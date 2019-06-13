<?php
set_time_limit(0);

$url = '';

$file = fopen('arquivo.csv', 'r');

while (($line = fgetcsv($file)) !== false) {
  if (!empty($line[0])) {
    $csv[] = $url . $line[0];
    $only_file[] = $line[0];
  }
}
fclose($file);

$urls = $csv;

foreach($only_file as $u) {
  getFile($url . $u, 'path/' . $u);
}

function getFile($file, $newFileName) 
{ 
    $err_msg = ''; 
    echo "<br>Attempting message download for $file<br>"; 
    $out = fopen($newFileName, 'wb'); 
    if ($out == FALSE){ 
      print "File not opened<br>"; 
      exit; 
    } 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_FILE, $out); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_URL, $file); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch); 
    echo "<br>Error is : ".curl_error ( $ch); 
    curl_close($ch); 
    fclose($out); 
}