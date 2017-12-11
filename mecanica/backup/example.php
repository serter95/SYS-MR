<?php 
   /* 
    * pgBackupRestore PHP Class Benchmark Example 
    * for php-cli 
    * 
    * usage: 
    * php -q example.php - Perform both backup and restore 
    * php -q example.php backup - Perform backup 
    * php -q example.php restore - Perform restore 
    * 
    */ 
   require("../seguridad.php");
   require("pgBackupRestore.class2.php"); 
   
   $dbopts = parse_url(getenv('DATABASE_URL')); // HEROKU
   
   // POSTGRESQL AUTH INFO 
   $db_host = $dbopts["host"]; //"localhost"; 
   $db_user = $dbopts["user"]; //"postgres"; 
   $db_pass = $dbopts["pass"]; //"1234"; 
   // SOURCE DATABASE (Backup) 
   $source_db= ltrim($dbopts["path"],'/'); //"SYS-M&R"; 
   // SQL FILE TO BE CREATED 
   //$sql_file="maquinas.sql"; 
   $sql_file=$_FILES["path"]["tmp_name"]; 
   // DESTINATION DATABASE (Restore)
   $dest_db=ltrim($dbopts["path"],'/'); //"SYS-M&R"; 

   $action = $_REQUEST["actionButton"]; 

   function timer() 
   { 
      $time = microtime(); 
      $time = explode(" ", $time); 
      $time = $time[1] + $time[0]; 
      return($time);
   }

   switch($action) 
   { 
      case 'backup': 
         $Backup = true; 
         $Restore = false; 
      break; 
    
      case 'restore': 
         $Backup = false; 
         $Restore = true; 
      break; 

    default: 
         header('Location:../BD.php'); 
      break;
   } 
   //printf ("--[ Current Memory Limit: %s\n\n", ini_get('memory_limit')); 
date_default_timezone_set('America/Caracas');

   if ($Backup) 
   { 
      $d=date('d');
      $m=date('m');
      $y=date('Y');
      $h=date('H');
      $min=date('i');
      $seg=date('s');
//      $timestamp=strptime($d."-".$m."-".$y);
      $sql_file="SYS-M&R_".$d."-".$m."-".$y."_".$h."_".$min."_".$seg.".sql"; 
    //  printf ("[+] Backup of database '$source_db' in progress\n"); 
      $s = timer(); 
      $pgBackup = new pgBackupRestore($db_host, $db_user, $db_pass, $source_db); 
      $pgBackup->UseDropTable = false; 
      $pgBackup->Backup($sql_file); 
      $e = timer(); 
      //  printf("[+] Backup took %d seconds to terminate\n\n", ($e - $s)); 
   } 

   if ($Restore) 
   { 

 
    //  printf ("[+] Restore to database '$dest_db' in progress\n"); 
      $s = timer(); 
      $pgRestore = new pgBackupRestore($db_host, $db_user, $db_pass, $dest_db); 
      $pgRestore->Restore($sql_file);
      $e = timer(); 
     
    //  printf("[+] Restore took %d seconds to terminate\n\n", ($e - $s)); 
      
   } 
 

?> 
