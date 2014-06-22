<?php

class PostController extends AppController {
	public $name = 'post';
	
	public function index()
	{
		/*if($this->request->is('post'))
		{
			$this->Post->create();
			if($this->Post->save($this->request->data))
			{
				$this->Session->setFlash('Your File has been uploaded!');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Your File has been uploaded!');
				$this->redirect(array('action' => 'index'));
				
				if(!empty($this->Post->data['Post']['filepath']) && is_string($this->Post->data['Post']['filepath']))
				{
					$this->request->data['Post']['filepath'] = $this->Post->data['Post']['filepath'];
				}
				
			}	
		}*/
		
		
			$message = $this->Post->import($filename);
			debug($message);
		
		
	}
	function csvimport($imgname) {
		var_dump($imgname);
		
		//echo $imgname;
		/*$messages = $this->Post->import($imgname);
                $this->set('messages', $messages);
				print_r($messages);*/
				$filename = WWW_ROOT  . 'files' . DS . $imgname;
				// open the file
 				$handle = fopen($filename, "r");

				// read the 1st row as headings
				$header = fgetcsv($handle);
				
				// read each data row in the file
                $i = 0;
 			while (($row = fgetcsv($handle)) !== FALSE) {
 			$i++;
 			$data = array();

 			// for each header field
 			foreach ($header as $k=>$head) {
 				// get the data field from Model.field
 				if (strpos($head,'.')!==false) {
	 				$h = explode('.',$head);
	 				$data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
					
					//$add = $this->Post->query("INSERT INTO tbl_mail_users ('staff_name', 'age', 'gender', 'prefecture', 'status', 'pc_email', 'mobile_email', 'device_type') values(".$data.")");
					
					/*$fields = array('fieldname1'=>':value1', 'fieldname2'=>':value2');
$values = array(
  'value1'=>'actual value to be set for 1st field',
  'value2'=>'actual value to be set for 2nd field'
  );
 
$queryData = array(
  'table' => 'tbl_mail_users';
  'fields' => implode(', ', array_keys($fields)),
  'values' => implode(', ', array_values($fields))
); 
 
$result = $db->execute($db->renderStatement('create', $queryData),array(), $values);*/
					
				}
 				// get the data field from field
				else {
	 				$data['post'][$head]=(isset($row[$k])) ? $row[$k] : '';
				}
 			}
			print_r($data, false);
		}
				//print_r($data, false);
				//if (($handle = fopen($filename, "r")) !== FALSE) {
    /*while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $db->conn->query("INSERT INTO tbl_mail_user values('" . implode('\',\'', $data) . "');");
    }*/
    fclose($handle);
//}
	}
	
}

?>