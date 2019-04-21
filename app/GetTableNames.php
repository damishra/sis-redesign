<?php
        //A php script that gets table names and makes class names for ORM
	//Andrew Berson
namespace App;
class GetTableNames{
public static $nameMap = array();
static function classFriendlyNames($arr){
 $new = array();   
$repl = ["_" => ""];
  foreach ($arr as $idx => $name) 
        $new[$name]=rtrim(strtr(ucwords($name,"_"),$repl),"s");
  return $new;
}
static function getNames(){
$command = "mysql sis < /var/www/html/SISReDesign/resources/sql/gettables.sql";
$arrRaw = array();
exec($command, $arrRaw);
$arr = array();
foreach (array_slice($arrRaw,1) as $idx => $name) $arr[]=rtrim($name);
/*$arr=[
     "course",
     "course_list",
     "course_section",
     "course_section_enroll_type",
     "course_section_user",
     "department",
     "grades",
     "login",
     "major",
     "major_course",
     "migrations",
     "role",
     "semester",
     "user",
     "user_advisor",
   ];*/
$nameMap = self::classFriendlyNames($arr);
foreach ($nameMap as $tbl => $name) echo $name." represents ".
  $tbl."\n";
return $nameMap;
}
}
GetTableNames::getNames();
