<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/21/2015
 * Time: 10:41 AM
 */

class Player extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index () {
        $this->load->model('player_model');
        $data['getPlayersQuery'] = $this->player_model->getPlayers();
        foreach($data['getPlayersQuery'] as $row) {
            if ($row->playerHandicap == "" || 0 || null) {
                $row->playerHandicap = "N/A";
            }
            if ($row->playerHandicapIndex == "" || 0 || null) {
                $row->playerHandicapIndex = "N/A";
            }
        }

        $this->load->view('header_view');
        $this->load->view('player_view', $data);
        $this->load->view('footer_view');
    }
}