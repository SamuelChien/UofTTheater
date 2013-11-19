<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Showtime_model extends CI_Model {
	/************************************************************
	 *
	 * UT Cinema Inc.
	 *
	 * Copyright 2013. All Rights Reserved.
	 * This file may not be redistributed in whole or part.
	 *
	 * Application: UT Cinema Web App
	 * showtime_model.php
	 *
	 ************************************************************/

    /**
     * decrement the number of available tickets for a showtime by 1.
     */
	function ticket_bought($showID)
	{
		$this->db->query("update showtime set available = CASE WHEN available > 0 THEN available - 1 ELSE 0 END where id = '$showID'");
	}
	
	/**
     * get info about all the showtimes.
     */
	function get_showtimes()
	{
		$query = $this->db->query("select m.title, t.name, t.address, s.date, s.time, s.available
								from play m, theater t, showtime s
								where m.id = s.play_id and t.id=s.theater_id order by s.theater_id, s.date, s.time, s.play_id");
		return $query;	
	}

    /**
     * Get info for a specific showtime.
     */
	function getShowtimeInfoByID($showID)
	{
		$query = $this->db->query("select m.title, t.name, t.address, s.date, s.time
								from play m, theater t, showtime s
								where m.id = s.play_id and t.id=s.theater_id and s.id='$showID'");
		return $query;	
	}

    /**
     * Get all the dates where there are movies with available seats at a specific theater.
     */
	function get_date_by_theater($theater_id)
	{
		$query = $this->db->query("select DISTINCT(s.date)
								from theater t, showtime s
								where t.id = '$theater_id' and t.id = s.theater_id and s.available > 0");

		return $query;	
	} 

    /**
     * Get the first date of all the dates where there are movies with available seats at a specific theater.
     */
	function get_first_date($theater_id)
	{
		$query = $this->db->query("select DISTINCT(s.date)
								from theater t, showtime s
								where t.id = '$theater_id' and t.id = s.theater_id and s.available > 0");
		if ($query->num_rows() > 0)
		{
			$row = $query->row(0);
			return $row->date;
		}
		return "none";
	}

    /**
     * Get a list of all the showtimes at a specific theater on a specific date.
     */
	function get_showtimes_list($theater_id, $theaterDate)
	{
		$query = $this->db->query("select m.title, s.id, s.play_id, s.time
								from play m, showtime s
								where m.id = s.play_id and '$theater_id'=s.theater_id and s.available > 0 and s.date='$theaterDate'");
		return $query;	
	}

    /**
     * populate.
     */
	function populate() {
		
		$movies = $this->movie_model->get_movies();
		$theaters = $this->theater_model->get_theaters();
		
		//If it returns some results we continue
		if ($movies->num_rows() > 0 && $theaters->num_rows > 0){
			foreach ($movies->result() as $movie){
				foreach ($theaters->result() as $theater){
					for ($i=1; $i < 15; $i++) {
						for ($j=20; $j <= 22; $j+=2) {
							$this->db->query("insert into showtime (play_id,theater_id,date,time,available)
									values ($movie->id,$theater->id,adddate(current_date(), interval $i day),'$j:00',3)");
								
						}
					}		
				}				
			}
		}		
	}

	function delete() {
		$this->db->query("delete from showtime");
	}
}