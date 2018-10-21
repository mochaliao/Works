<?php
class Fivesec_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	function getMovieList()
	{
		// $movies = file_get_contents("http://check.iamiweb.com/index.php/api/getMovieList");
        //$movies = file_get_contents("http://check.iami-web.com/index.php/api/getMovieList");
        $movies = file_get_contents("http://check.iami-web.me/index.php/api/getMovieList");
        return json_decode($movies);
	}
}