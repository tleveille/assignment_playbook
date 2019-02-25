<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
   <?php
   
   # count of records to fetch
   $count = 20;
   
   # get datetime
   $now = date ( 'Y-m-d H:i:s' ) ;
   
   # get src ip address
   # as per our firewall rules requests should only come through our loadbalancer
   if ( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
       $srcaddress=$_SERVER["HTTP_X_FORWARDED_FOR"];
   } else if ( array_key_exists('REMOTE_ADDR', $_SERVER)) {
       $srcaddress=$_SERVER["REMOTE_ADDR"];
   } else if ( array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
       $srcaddress=$_SERVER["HTTP_CLIENT_IP"];
   }
   
   
   # get server hostname
   $srvname = gethostname();
   
   $client = new GearmanClient();
   $client->addServer("backend1","4730");
   
   # insert the record
   $insertresult = $client->doNormal("insert_record", json_encode(array(
       'srvname'=>$srvname,
       'date'=>$now,
       'srcaddress'=>$srcaddress
   )));
   echo "<p>" . $insertresult . "</p>";
   
   # fetch the last $count number of records
   $listresult = $client->doNormal("list_records", $count) ;
   
   # convert the result from json to array
   $records = [];
   $records = json_decode($listresult);
   
   echo "Last hits (latest first): \n";
   foreach ($records as $record) {
       echo "<p>" . $record->date . " " . $record->srcaddress . " " . $record->srvname . "</p>";
   }
   
   ?>
 </body>
</html>
