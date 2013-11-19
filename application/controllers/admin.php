<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/************************************************************
 *
 * UT Cinema Inc.
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: UT Cinema Web App
 * admin.php
 *
 ************************************************************/
class Admin extends CI_Controller {

    
    function __construct() {
        // Call the Controller constructor
        parent::__construct();
    }
    /**
     * Load initial admin page with 3 options
     */
    function index() 
    {
        $data['title'] = 'UofT Cinema - Admin';
        $data['renderPage'] = 'adminOption';
        $this->load->view('customer', $data);
    }
    /**
     * Populate the database
     */
	function populate()
	{
		$this->load->model('movie_model');
		$this->load->model('theater_model');
		$this->load->model('showtime_model');
		$this->movie_model->deleteTicket();
		$this->movie_model->delete();
		$this->theater_model->delete();
		$this->showtime_model->delete();
		$this->movie_model->populate();
		$this->theater_model->populate();
		$this->showtime_model->populate();
		redirect('/admin');
	}
    /**
     * Delete the ticket table
     */
	function delete()
	{
		$this->load->model('movie_model');
		$this->load->model('theater_model');
		$this->load->model('showtime_model');
		$this->movie_model->deleteTicket();
		$this->movie_model->delete();
		$this->theater_model->delete();
		$this->showtime_model->delete();
		$this->movie_model->populate();
		$this->theater_model->populate();
		$this->showtime_model->populate();
		redirect('/admin');
	}
	/**
     * show all the tickets in the database
     */
	function showTickets()
	{
		$this->load->library('show');
        $data['tickets'] = $this->show->createTicketTable();
        $data['title'] = 'UofT Cinema - TicketTable';
        $data['renderPage'] = 'ticketTable';
        $this->load->view('customer', $data);
    }
}
/* End of file admin.php */
/* Location: ../application/controller/admin.php */