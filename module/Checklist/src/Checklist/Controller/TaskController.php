<?php
namespace Checklist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Checklist\Model\TaskEntity;
use Checklist\Form\TaskForm;

class TaskController extends AbstractActionController
{

    public function getTaskMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TaskMapper');
    }

    public function indexAction()
    {
        $mapper = $this->getTaskMapper();
        return new ViewModel(array(
            'tasks' => $mapper->fetchAll()
        ));
    }
    public function addAction()
    {
    	$form = new TaskForm();
    	$task = new TaskEntity();
    	$form->bind($task);
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setData($request->getPost());
    		if ($form->isValid()) {
    			$this->getTaskMapper()->saveTask($task);
    
    			// Redirect to list of tasks
    			return $this->redirect()->toRoute('task');
    		}
    	}
    
    	return array('form' => $form);
    }
    public function editAction()
    {
    	$id = (int)$this->params('id');  //The params() method is a plugin that provides a  way to retrieve parameters from the matched route
    	if (!$id) {
    		return $this->redirect()->toRoute('task', array('action'=>'add'));
    	}
    	$task = $this->getTaskMapper()->getTask($id);
    
    	$form = new TaskForm();
    	$form->bind($task);
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setData($request->getPost());
    		if ($form->isValid()) {
    			$this->getTaskMapper()->saveTask($task);
    
    			return $this->redirect()->toRoute('task');
    		}
    	}
    
    	return array(
    			'id' => $id,
    			'form' => $form,
    	);
    }
    public function deleteAction()
    {
    	$id = $this->params('id');
    	$task = $this->getTaskMapper()->getTask($id);
    	if (!$task) {
    		return $this->redirect()->toRoute('task');
    	}
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		if ($request->getPost()->get('del') == 'Yes') {
    			$this->getTaskMapper()->deleteTask($id);
    		}
    
    		return $this->redirect()->toRoute('task');
    	}
    
    	return array(
    			'id' => $id,
    			'task' => $task
    	);
    }
}
