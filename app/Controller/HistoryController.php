<?php

class HistoryController extends AppController {
	public $name = 'History';
	
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
		
		
			$this->set('History');
		
		
	}
	
}

?>