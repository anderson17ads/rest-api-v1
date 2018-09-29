<?php
namespace App\Controllers;

use App\Config\Database;

class UsersController
{
	public function __construct($request, $response)
	{
		$this->request  = $request;
		$this->response = $response;
	}

	public function all()
	{
		try {
			$db = new Database;
			$stmt = $db->conn->query('SELECT * FROM usuarios');

			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function get()
	{
		$id = $this->request->getAttribute('id');

		try {
			$db = new Database;
			$stmt = $db->conn->query("SELECT * FROM usuarios WHERE id = {$id}");

			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}