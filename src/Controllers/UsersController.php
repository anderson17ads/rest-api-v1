<?php
namespace App\Controllers;

use App\Config\Database;

class UsersController
{
	public function listar()
	{
		try {
			$db = new Database;
			$stmt = $db->conn->query('SELECT * FROM usuarios');

			echo json_encode($stmt->fetchAll(\PDO::FETCH_OBJ));
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}