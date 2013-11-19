<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************
 *
 * UT Cinema Inc.
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: UT Cinema Web App
 * Movie_model.php
 *
 ************************************************************/
class Movie_model extends CI_Model {

	/**
     * Get the ticket info query
     *
     *
     * @return  $query (query)
     *
     */
	function showTickets(){
		$query = $this->db->query("select m.title, t.name, x.seat, x.first, x.last, x.creditcardnumber, x.creditcardexpiration
								from play m, theater t, showtime s, ticket x
								where m.id = s.play_id and t.id=s.theater_id and s.id=x.showtime_id");
		return $query;
	}
	/**
     * Insert the ticket info into ticket database
     * @param   $first - name (string)
     * @param   $last - name (string)
     * @param   $creditcard - number (string)
     * @param   $creditExpiration - date (string)
     * @param   $showID -  show id(int)
     * @param   $seatID -  seat id(int)
     *
     *
     */
	function buyTicket($first, $last, $creditcard, $creditExpiration, $showID, $seatID ){
		$this->db->query("insert into ticket (first,last,creditcardnumber,creditcardexpiration,showtime_id, seat)
									values ('$first', '$last', '$creditcard', '$creditExpiration', '$showID', '$seatID')");
	}
	/**
     * Get the list of theater's id
     * @param   $showtime_id - showID (string)
     *
     * @return  $query (query)
     *
     */
	function getTheater($showtime_id) {
		$query = $this->db->query("select theater_id
								from showtime where '$showtime_id' = id");
		return $query;
	}
	/**
     * Get the list of dates
     * @param   $showtime_id - showID (string)
     *
     * @return  $query (query)
     *
     */
	function getDate($showtime_id) {
		$query = $this->db->query("SELECT date
								FROM showtime WHERE '$showtime_id' = id");
		return $query;
								
    }
	/**
     * Get the list of time
     * @param   $showtime_id - showID (string)
     *
     * @return  $query (query)
     *
     */
	function getTime($showtime_id) {
		$query = $this->db->query("SELECT time
								FROM showtime WHERE '$showtime_id' = id");
		return $query;
		
	}
	/**
     * Get the the number of seats
     * @param   $showtime_id - showID (string)
     *
     * @return  $numSeats (int)
     *
     */
	function totalSeats($showtime_id) {
		$availSeats = $this->db->query("SELECT available
								FROM showtime WHERE '$showtime_id' = id");
								
		$takenSeats = $this->db->query("SELECT COUNT(*) as taken
									FROM ticket AS t JOIN showtime AS f ON t.showtime_id = f.id
									WHERE '$showtime_id' = f.id");
		$numSeats = 0;
		foreach ($availSeats->result_array() as $row) {	
		 	$numSeats = $row['available'];
	    }
		foreach ($takenSeats->result_array() as $row) {	
		 	$numSeats += $row['taken'];
	    }
		return $numSeats;
	}
	/**
     * get the seat id that's not taken
     * @param   $showtime_id - showID (string)
     *
     * @return  $query (query)
     *
     */
	function checkSeats($showId) {
		$query = $this->db->query("SELECT seat, f.id AS id
								FROM ticket AS t JOIN showtime AS f ON t.showtime_id = f.id
								WHERE '$showId' = f.id ; ");
		
		return $query;
	}
	/**
     * get all the movies in the database
     *
     * @return  $query (query)
     *
     */
	function get_movies()
	{
		$query = $this->db->query("select * from play");
		return $query;	
	} 
	/**
     * Delete the whole ticket database
     *
     */
	function deleteTicket(){
		$this->db->query("delete from ticket");
	}
	/**
     * Populate play database
     *
     */
	function populate(){
		$this->db->query("insert into play (title) values ('Men with Brooms')");
		$this->db->query("insert into play (title) values ('Juno')");
		$this->db->query("insert into play (title) values ('Barney\'s Version')");
		$this->db->query("insert into play (title) values ('Canadian Bacon')");
	}
	/**
     * delete play database
     *
     */
	function delete(){
		$this->db->query("delete from play");
	}
}

/* End of file admin.php */
/* Location: ../application/model/movie_model.php */