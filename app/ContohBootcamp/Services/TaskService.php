<?php

namespace App\ContohBootcamp\Services;

use App\ContohBootcamp\Repositories\TaskRepository;

class TaskService {
	private TaskRepository $taskRepository;

	public function __construct() {
		$this->taskRepository = new TaskRepository();
	}

	/**
	 * NOTE: untuk mengambil semua tasks di collection task
	 */
	public function getTasks()
	{
		$tasks = $this->taskRepository->getAll();
		return $tasks;
	}

	/**
	 * NOTE: menambahkan task
	 */
	public function addTask(array $data)
	{
		$taskId = $this->taskRepository->create($data);
		return $taskId;
	}

	/**
	 * NOTE: UNTUK mengambil data task
	 */
	public function getById(string $taskId)
	{
		$task = $this->taskRepository->getById($taskId);
		return $task;
	}

	/**
	 * NOTE: untuk update task
	 */
	public function updateTask(array $editTask, array $formData)
	{
		if(isset($formData['title']))
		{
			$editTask['title'] = $formData['title'];
		}

		if(isset($formData['description']))
		{
			$editTask['description'] = $formData['description'];
		}

		$id = $this->taskRepository->save( $editTask);
		return $id;
	}

	// ----------------------------------------
	// delete task
	public function deleteTask(string $taskId)
	{
		$this->taskRepository->destroy($taskId);
			
	}
	

	// assign task
	public function assignTask($existTask, $assigned)
	{
		$existTask['assigned'] = $assigned;

		$this->taskRepository->save($existTask);

	}


	// unassign task
	public function unassignTask($existTask)
	{
		$existTask['assigned'] = null;

		$this->taskRepository->save($existTask);

	}


	// create sub task
	public function createSubTask($existTask,$title,$description)
	{	
		$subtasks = isset($existTask['subtasks']) ? $existTask['subtasks'] : [];
	
		$this->taskRepository->createSub($existTask, $title, $description);
	}


	// delete sub task
	public function deleteSubTask($existTask,$subtaskId)
	{
		$subtasks = isset($existTask['subtasks']) ? $existTask['subtasks'] : [];
	
		$this->taskRepository->deleteSub($existTask, $subtaskId);
	}
}