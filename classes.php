<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('test.db');
      }
   }
   
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
	   $db = new MyDB();
      echo "Opened database successfully\n";
   }
	function generateForm(){
		echo '<div><form method="POST">
		Name<input type="text" name="name"><br>
		<input type="submit" name="test">
		</form></div>';
	}
	function insert($n){
		$sql = <<<EOF
		INSERT name INTO details values($n)
EOF;
	$res = $db->exec($sql)
	if($res){
		echo 'success';
	}else { echo 'fail';}
	
	}
	if(isset($_POST["test"])){
		insert(trim($_POST["name"]));
	}
	generateForm();
?>