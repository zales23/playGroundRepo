<?php 
	class ItemsController extends AppController {

			public $components = array('Session');


			public function delete($id = null)
			{
				$this->Item->id = $id; 

				if(!$id || !$this->Item->exists())
				{ 
					throw new NotFoundException('Nie znaleziono id');
				}

				if($this->request->is('post'))
				{
					if($this->Item->delete())
					{
						$this->Session->setFlash(_('Usunieto pozycje '));
					}
					else
					{
						$this->Session->setFlash(_('Nie usunieto pozycji'));
					}
				}

				$this->redirect('index');
			}

			public function edit($id = null)
			{
				if(!$id)
				{ 
					throw new NotFoundException('Nie znaleziono id');
				}

				 $data = $this -> Item -> findById($id);

				 if(!$data)
				{
					throw new NotFoundException('Nie znaleziono filmu');
				}

				if($this->request->is('post') || $this->request->is('put'))
				{
					if($this->Item->save($this->request->data))
					{
						$this->Session->setFlash(_('The item was updated'));
						$this->redirect('index');
					}
					else
					{
						$this->Session->setFlash(_('The item was NOT updated'));
					}
				}

				$this->request->data = $data;
			}


			public function add()
			{
				if($this->request->is('post'))
				{
					$this->Item->create();
					if($this->Item->save($this->request->data))
					{
						$this->redirect('index');
					}
					else
					{
						//if data fails do something
					}
				}
			}
	
			public function view($id = null)
			{
				if(!$id)
				{
					throw new NotFoundException('Nie znaleziono id');
				}
				 $data = $this -> Item -> findById($id);
				 if(!$data)
				{
					throw new NotFoundException('Nie znaleziono filmu');
				}
				 $this -> set('item', $data);
			}
	
			public function index()
			{
				$data = $this->Item->find('all', array('order'=>'id'));
				$count = $this->Item->find('count');
				$info = array(
					'items' => $data,
					'count' => $count
				);
				$this->set($info);
					
				///$this->set('items',$data);
				//$this->set('count',$count);
				//$this->set('color','blue');
			}
			
			public function search()
			{
					
		
			}
			
			public function _countItems()
			{
			
			}
	}

?>