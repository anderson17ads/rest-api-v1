<?php
namespace App\Controllers;

use App\Config\Database;

class UsersController
{
	public function __construct($request)
	{
		$this->request = $request;
	}

	/**
	 * Recupera todos os usuários
	 *
	 * @return string JSON
	 */
	public function all()
	{
		try {
			$db = new Database;
			$stmt = $db->conn->query('SELECT * FROM usuarios');

			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\PDOException $e) {
			echo '{"error: {"message" : '. $e->getMessage() .'}}';
		}
	}

	/**
	 * Recupera um usuário
	 *
	 * @return string JSON
	 */
	public function get()
	{
		$id = $this->request->getAttribute('id');

		try {
			$db = new Database;
			$stmt = $db->conn->query("SELECT * FROM usuarios WHERE id = {$id}");

			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\PDOException $e) {
			echo '{"error: {"message" : '. $e->getMessage() .'}}';
		}
	}

	/**
	 * Adiciona um novo usuário
	 *
	 * @return string JSON
	 */
	public function add()
	{
		$nome 	  = $this->request->getParam('nome');
		$telefone = $this->request->getParam('telefone');
		$email 	  = $this->request->getParam('email');

		try {
			$db = new Database;
			$stmt = $db->conn->prepare("INSERT INTO usuarios (nome, telefone, email) VALUES (:nome, :telefone, :email)");

			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':telefone', $telefone);
			$stmt->bindParam(':email', $email);

			$stmt->execute();

			echo '{"notice": {"message" : "Usuário adicionado com sucesso!"}}';
		} catch (\PDOException $e) {
			echo '{"error: {"message" : '. $e->getMessage() .'}}';
		}
	}

	/**
	 * Edita o usuário
	 *
	 * @return string JSON
	 */
	public function edit()
	{
		$id 	  = $this->request->getAttribute('id');
		$nome 	  = $this->request->getParam('nome');
		$telefone = $this->request->getParam('telefone');
		$email 	  = $this->request->getParam('email');

		$sql = "UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email WHERE id = {$id}";

		try {
			$db = new Database;
			$stmt = $db->conn->prepare($sql);

			$stmt->bindParam('nome', $nome);
			$stmt->bindParam('telefone', $telefone);
			$stmt->bindParam('email', $email);

			$stmt->execute();

			echo '{"notice" : {"message" : "Usuário alterado com sucesso!"}}';
		} catch (\PDOException $e) {
			echo '{"error" : {"message" : '. $e->getMessage() .'}}';
		}
	}

	/**
	 * Deleta o usuário
	 *
	 * @return string JSON
	 */
	public function delete()
	{
		$id = $this->request->getAttribute('id');

		try {
			$db = new Database;
			$stmt = $db->conn->prepare("DELETE FROM usuarios WHERE id = {$id}");
			
			$stmt->execute();

			echo '{"notice" : {"message" : "Usuário deletado com sucesso!"}}';
		} catch (\PDOException $e) {
			echo '{"error" : {"message" : '. $e->getMessage() .'}}';
		}
	}
}