<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************
 *
 * UT Cinema Inc.
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: UT Cinema Web App
 * theater_model.php
 *
 ************************************************************/
class Theater_model extends CI_Model {

    /**
     * get all the theaters in the database.
     */
	function get_theaters()
	{
		$query = $this->db->query("select * from theater");
		return $query;	
	}  

    /**
     * populate the database.
     */
	function populate() {
		$this->db->query("insert into theater (name,address) values ('Gallery 1265','1265 Military Trail
Scarborough')"); 
		$this->db->query("insert into theater (name,address) values ('Hart House Theatre','7 Hart House Circle
Toronto')");
		$this->db->query("insert into theater (name,address) values ('University of Toronto Art Centre','15 King\'s College Circle
Toronto')");
		
	}

    /**
     * delete the database.
     */
	function delete() {
		$this->db->query("delete from theater");
	}
	
	/**
     * Retrieve all booked tickets.
     */
	function getTicketInfo() {
		
		$query = $this->db->query("SELECT date, first, last, creditcardnumber, 
						creditcardexpiration, seat FROM ticket JOIN showtime 
						ON ticket.showtime_id = showtime.id");
		
		return $query;
	}
}