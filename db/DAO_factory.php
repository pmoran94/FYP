<?php
/**
 * @author Paul
 * definition of the DAO factory
 */
include_once 'simple_db_manager.php';

class DAO_Factory {
	private $dbManager;
	
	// method to  attain the instance of the dbManager
	function getDbManager() {
		if($this->dbManager == null)
			throw new Exception("No persistence storage link");
		return $this->dbManager;
	}

	/**
	 * init resources: connect to the database
	 */
	function initDBResources() {
	
		/*
			Initialise the database connection and assign the dbManager
		*/
		$this->dbManager = new dbmanager(DB_NAME);
		$this->dbManager->openConnection();
	}

	/**
	 * release resources: close the database link
	 */
	function clearDBResources() {
		if($this->dbManager != null)
		//--- close the database connection
			$this->dbManager->closeConnection();
	}

	/**
	 * return the reference of the Users DAO
	 *//*
	function getUsersDAO() {
	
		// -- import the usersDAO script for use once
		require_once("dao/usersDAO.php");
		return new usersDAO($this->getDbManager());
	}*/
	
	function getNotificationsDAO(){
		require_once("dao/notificationsDAO.php");
		return new notificationsDAO($this->getDbManager());
	
	}

	function getCustomersDAO(){
		require_once("dao/customersDAO.php");
		return new customersDAO($this->getDbManager());
	}

	function getEmployeesDAO(){
		require_once("dao/employeesDAO.php");
		return new employeesDAO($this->getDbManager());
	}

	function getQRTicketsDAO(){
		require_once("dao/qrticketsDAO.php");
		return new qrticketsDAO($this->getDbManager());
	}

}


