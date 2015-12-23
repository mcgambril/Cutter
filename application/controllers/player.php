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

    public function Add() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('header_view');
        $this->load->view('player_add_view');
        $this->load->view('footer_view');
    }

    public function Edit() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('player_model');

        $id = $this->uri->segment(3);
        $data['getPlayerByIDQuery'] = $this->player_model->getPlayerByID($id);

        $this->load->view('header_view');
        $this->load->view('player_edit_view', $data);
        $this->load->view('footer_view');
    }

    public function submitEditPlayer() {
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('newFirstName', 'First Name', 'required');
        $this->form_validation->set_rules('newLastName', 'Last Name', 'required');

        if($this->form_validation->run() ==FALSE ) {
            //need to go back to the Edit screen for the current player
        }
        else {
            $id = $this->input->post('playerID');
            $temp['oldName'] = $this->player_model->getPlayerNameByID($id);
            foreach($temp['oldName'] as $row) {
                if(isset($row->playerName)) {
                    $oldName = $row->playerName;
                }
            }
            $newFirst = $this->input->post('newFirstName');
            $newLast = $this->input->post('newLastName');
            $newName = $newLast . ', ' . $newFirst;
            $data['playerName'] = $newName;
            $queryResult = $this->player_model->updatePlayer($id, $data);
            if ($queryResult == TRUE) {
                $data['title'] = 'Success!';
                $data['message'] = "'" . $oldName . "'s' name was changed to '" . $newName . ".'";
            }
            else {
                $data['title'] = 'Failure';
                $data['message'] = "'" . $oldName . "'s' name failed to updated to '" . $newName . ".'  Please try again later";
            }
            $this->playerUpdateResult($data);
        }
    }

    public function submitNewPlayer() {
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');

        if($this->form_validation->run()== FALSE) {
            $this->Add();
        }
        else {
            $tempFirst = $this->input->post('firstName');
            $tempLast = $this->input->post('lastName');
            $newPlayer = $tempLast . ', ' . $tempFirst;
            $queryResult = $this->player_model->insertPlayer($newPlayer);
            $this->playerAddResult($newPlayer, $queryResult);
        }
    }

    public function playerAddResult($player, $queryResult) {
        if ($queryResult == TRUE) {
            $data['player'] = $player;
            $data['title'] = 'Success!';
            $data['message1'] = $player . ' was successfully added to the database.';
            $data['message2'] = 'You can now enter scores for this player.';
        }

        else {
            $data['player'] = $player;
            $data['title'] = 'Failure';
            $data['message1'] = 'Something went wrong and ' . $player . ' failed to be added to the database.';
            $data['message2'] = 'Please go back and try again.';
        }

        $this->load->view('header_view');
        $this->load->view('player_add_result_view', $data);
        $this->load->view('footer_view');
    }

    public function playerUpdateResult($data) {
        $this->load->view('header_view');
        $this->load->view('player_update_result_view', $data);
        $this->load->view('footer_view');
    }
}