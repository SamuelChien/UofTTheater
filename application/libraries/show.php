<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/************************************************************
 *
 * UT Cinema Inc.
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: UT Cinema Web App
 *
 ************************************************************/

class Show
{
    /**
     * Initialize the CI instance so we can access codeigniter model
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    /**
     * Get the string of html code for creating ticket table
     *
     *
     * @return  $tableString (string)
     *
     */
    function createTicketTable()
    {
        $tableString = '<table><tr><th>Movie Title</th><th>Theater Name</th><th>Seat Number</th><th>First Name</th><th>Last Name</th><th>Credit Card Number</th><th>Expiration</th></tr>';
        $this->CI->load->model('movie_model');
        $query = $this->CI->movie_model->showTickets();
        foreach ($query->result() as $row)
        {
            $tableString = $tableString . '<tr><td>'.$row->title.'</td><td>'.$row->name.'</td><td>'.$row->seat.'</td><td>'.$row->first.'</td><td>'.$row->last.'</td><td>'.$row->creditcardnumber.'</td><td>'.$row->creditcardexpiration.'</td></tr>';
        }
        $tableString = $tableString . "</table>";
        return $tableString;
    }
    /**
     * Get the string of html code for the theater selection
     *
     *
     * @return  $tableString (string)
     *
     */
    function createList()
    {
        $tableString = "<select id='provinces' name='theater'>";
        $this->CI->load->model('theater_model');
        $query = $this->CI->theater_model->get_theaters();
        foreach ($query->result() as $row)
        {
            $tableString = $tableString . "<option value='".$row->id."'>".$row->name.' - '.$row->address.'</option>';
        }
        $tableString = $tableString . "</select>";
        return $tableString;
    }
    /**
     * Get the string of html code for the date selection
     *
     *
     * @return  $tableString (string)
     *
     */
    function createTime($theater_id)
    {
        $tableString = "<select id='time'>";
        $this->CI->load->model('showtime_model');
        $query = $this->CI->showtime_model->get_date_by_theater($theater_id);
        foreach ($query->result() as $row)
        {
            $tableString = $tableString . "<option value='".$row->date."'>".$row->date.'</option>';
        }
        $tableString = $tableString . "</select>";
        return $tableString;
    }
    /**
     * Get the string of html code for the theater selection
     *
     *
     * @return  $tableString (string)
     *
     */
    function createMovieList($theater_id, $theaterDate)
    {   
        $this->CI->load->model('showtime_model');
        if($theaterDate == 'initial')
        {
            $theaterDate = $this->CI->showtime_model->get_first_date($theater_id);
        }
        $divString = "<ul id='showtimeContainter'>";
        $query = $this->CI->showtime_model->get_showtimes_list($theater_id, $theaterDate);
        $initialTitleID = "";
        foreach ($query->result() as $row)
        {
            if($row->play_id != $initialTitleID)
            {
                if($initialTitleID != "")
                {
                    $divString = $divString."</ul></div></li>";
                }
                $divString = $divString."<li class='movieEntry'><img src='/asset/images/1page-img".rand(2,4).".jpg' alt=''><div><h class='movietitle'>".$row->title."</h><ul><li><a href='/main/getSeats/".$row->id."'>".$row->time."</a></li>";
                $initialTitleID = $row->play_id;
            }
            else
            {
               $divString = $divString."<li><a href='/main/getSeats/".$row->id."'>".$row->time."</a></li>";
            }
            
        }
        $divString = $divString."</ul>";
        return $divString;
    }
    /**
     * Prepare the data array for ticket info
     *
     *
     * @return  $data (array)
     *
     */
    function getShowInfo($showID)
    {
        $this->CI->load->model('showtime_model');
        $query = $this->CI->showtime_model->getShowtimeInfoByID($showID);
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           $data['showTitle'] = $row->title;
           $data['name'] = $row->name;
           $data['address'] = $row->address;
           $data['date'] = $row->date;
           $data['time'] = $row->time;
           return $data;
        }
    }
}

/* End of file show.php */
/* Location: ../application/libraries/show.php */






