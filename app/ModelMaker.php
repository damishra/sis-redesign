<?php
        //A php script that gets table names and makes class names for ORM
	//Andrew Berson
namespace App;

define("MODEL_FORMAT", 
    "<?php\n
namespace App;\n
use Illuminate\Database\Eloquent\Model;\n
 
  class %sModel extends Model\n
  {\n
  protected \$table = '%s';\n
      //TODO: add Relationship mappings\n
        //TODO: add Private Keys\n
  }\n
");
define("TESTING",true);
class ModelMaker{
function createModel($tbl,$className){
  $newFile = fopen("/var/www/html/SISReDesign/app/".$className."Model.php", "w")
        or die("Could Not Create Model");
  fwrite($newFile,sprintf(MODEL_FORMAT, $className, $tbl));
  fclose($newFile);
  if(TESTING) echo $className." Model generated for table: ".$tbl."\n";
}
public function makeAll(){
  $nameMap = GetTableNames::getNames();
  foreach($nameMap as $tbl => $className){
      self::createModel($tbl,$className);
  }
}
static function showModels(){
  $command = "ls  /var/www/html/SISReDesign/app/*Model.php";
  $arrRaw = array();
  exec($command, $arrRaw);
  foreach ($arrRaw as $tbl => $name)  echo $name." exists\n";
}
}
if(TESTING){
    $mm =  new ModelMaker();
    $mm->makeAll();
}
if(TESTING)ModelMaker::showModels();
