<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************
 *
 * UT Cinema Inc.
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: UT Cinema Web App
 * main.php
 *
 ************************************************************/
class Main extends CI_Controller {

    
    function __construct() {
    	// Call the Controller constructor
    	parent::__construct();
    }

    /**
     * Load initial main page.
     */
    function index() 
    {
        $this->load->library('show');
        $data['list'] = $this->show->createList();
        $this->load->view('begin', $data);
    }

	/**
     * Load the home page for a specific theater, with the movie list for a specific time.
     */
    function home()
    {
        $data['theater_id'] = $this->input->post('theater');
        $this->load->library('show');
        $data['time'] = $this->show->createTime($data['theater_id']);
        $data['movieList'] = $this->show->createMovieList($data['theater_id'], 'initial');
        $this->load->view('home', $data);
    }

	/**
     * Show the movies and their showtimes for a specific theater and date.
     */
    function getShowTimeMovieList($theaterID, $date)
    {
        $this->load->library('show');
        $data['movieTime'] = $this->show->createMovieList($theaterID, $date);
        echo $data['movieTime'];
    }

	/**
     * Load the page for purchasing a ticket.
     */
    function creditCardPayment($showID, $seatID)
    {
        $this->load->library('show');
        $data = $this->show->getShowInfo($showID);
        $data['showID'] = $showID;
        $data['seatID'] = $seatID;
        $data['title'] = 'UofT Cinema - Purchase';
        $data['renderPage'] = 'select';
        $this->load->view('customer', $data);
    }

	/**
     * purchase a ticket after filling up all the information needed.
     */
    function purchaseTicket(){
        $this->load->library('show');
        $data = $this->show->getShowInfo($this->input->post('showID'));
        $data['showID'] = $this->input->post('showID');
        $data['seatID'] = $this->input->post('seatID');
        $data['firstname'] = $this->input->post('firstname');
        $data['lastname'] = $this->input->post('lastname');
        $data['creditcard'] = $this->input->post('creditcard');
        $data['month'] = $this->input->post('month');
        $data['year'] = $this->input->post('year');

        //get the current date
        $year = intval(date('y'));
        $month = intval(date('m'));

        //server side validation for empty field, credit card length, and expired credit card
        if(empty($data['showID']) || empty($data['seatID']) || empty($data['firstname']) || empty($data['lastname']) || empty($data['creditcard']) || empty($data['month']) || empty($data['year']))
        {
            $error['msg'] = "Make sure you filled in all fields";
            $this->load->view('invalid', $error);
        }
        else if(strlen($data['creditcard'])!=16||$data['creditcard'] != strval(intval($data['creditcard']))){
            $error['msg'] = "Make sure credit card is 16 digits";
            $this->load->view('invalid', $error);
        }
        else if(intval($data['year'])<$year || (intval($data['year']) == $year && intval($data['month'])<$month)){
            $error['msg'] = "Credit Card Expired!";
            $this->load->view('invalid', $error);
        }
        else
        {
            $this->load->model('showtime_model');
            $this->showtime_model->ticket_bought($data['showID']);
            $this->load->model('movie_model');
            $this->movie_model->buyTicket($data['firstname'], $data['lastname'], $data['creditcard'], $data['month'].$data['year'], $data['showID'], $data['seatID']);
            $this->load->view('ticket', $data);
        }
    }

	/**
     * Load available seats for a specific showtime.
     */
    function getSeats($showId) {

        $this->load->model('movie_model');
        
        foreach ($this->movie_model->getTheater($showId)->result_array() as $row) {
            $theater = $row['theater_id'];
        }

        foreach ($this->movie_model->getDate($showId)->result_array() as $row) {
            $date = $row['date'];
        }
        foreach ($this->movie_model->getTime($showId)->result_array() as $row) {
            $time = $row['time'];
        }
        
        $totalSeats = $this->movie_model->totalSeats($showId);
        
        $takenSeats = $this->movie_model->checkSeats($showId);
        
        $table = array();
        foreach ($takenSeats->result_array() as $row) { 
            $table[$row['seat']] = $row['seat'];
        }

        $data['f_id'] = $showId;

        for ($i=1; $i <= $totalSeats; $i++) {
            if (in_array($i, $table)) {
                $data['f_seat' . strval($i)] = 'true';
            } else {
                $data['f_seat' . strval($i)] = 'false';
            }
        }

        $tableString = "";
        foreach ($table as $entry){
            $tableString = $tableString.$entry.", ";
        }
        $data['tableString'] = $tableString;
        $data['totalSeats'] = $totalSeats;
        $data['f_theater'] = $theater;
        $data['f_date'] = $date;
        $data['f_time'] = $time;
        $data['showID'] = $showId;
        
        $data['title'] = 'UofT Cinema - Booking system - Pick a seat';
        $data['renderPage'] = 'seats';

        $this->load->view('customer', $data);
    }
    
}

