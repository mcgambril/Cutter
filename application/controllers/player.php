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
        $data['getPlayersAZQuery'] = $this->player_model->getPlayersAZ();
        foreach($data['getPlayersAZQuery'] as $row) {
            if ($row->playerHandicap == "" || 0 || null) {
                $row->playerHandicap = "TBD";
            }
            if ($row->playerHandicapIndex == "" || 0 || null) {
                $row->playerHandicapIndex = "TBD";
            }
        }

        $this->load->view('header_view');
        $this->load->view('player_view', $data);
        $this->load->view('footer_view');
    }

    public function add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('header_view');
        $this->load->view('player_add_view');
        $this->load->view('footer_view');
    }

    public function submitNewPlayer() {
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'firstName',
                'label' => 'First Name',
                'rules' => 'required|trim|min_length[1]|max_length[45]|valid_base64'
            ),
            array(
                'field' => 'lastName',
                'label' => 'Last Name',
                'rules' => 'required|trim|min_length[1]|max_length[45]|valid_base64'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->add();
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

    public function edit($paramID = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('player_model');

        if (is_null($paramID)) {
            $id = $this->uri->segment(3);
        }
        else {
            $id = $paramID;
        }

        $data['getPlayerByIDQuery'] = $this->player_model->getPlayerByID($id);
        foreach($data['getPlayerByIDQuery'] as $row) {
            if(is_null($row->playerHandicap)) {
                $row->playerHandicap = 'TBD';
            }
            if(is_null($row->playerHandicapIndex)) {
                $row->playerHandicapIndex = 'TBD';
            }
        }

        $this->load->view('header_view');
        $this->load->view('player_edit_view', $data);
        $this->load->view('footer_view');
    }

    public function submitEditPlayer() {
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'newFirstName',
                'label' => 'First Name',
                'rules' => 'required|trim|min_length[1]|max_length[45]'
            ),
            array(
                'field' => 'newLastName',
                'label' => 'Last Name',
                'rules' => 'required|trim|min_length[1]|max_length[45]'
            )
        );

        $this->form_validation->set_rules($config);
        $id = $this->input->post('playerID');

        if($this->form_validation->run() == FALSE ) {
            //redirect('/player/edit/' . $id);
            $this->edit($id);
            //need to go back to the Edit screen for the current player
        }
        else {
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
            $this->playerEditResult($data);
        }
    }

    public function playerEditResult($data) {
        $this->load->view('header_view');
        $this->load->view('player_edit_result_view', $data);
        $this->load->view('footer_view');
    }

    public function delete() {
        $this->load->helper('form');
        $this->load->model('player_model');

        $id = $this->uri->segment(3);
        $data['getPlayerByIDQuery'] = $this->player_model->getPlayerByID($id);
        foreach($data['getPlayerByIDQuery'] as $row) {
            if (is_null($row->playerHandicap)) {
                $row->playerHandicap = 'TBD';
            }
            if (is_null($row->playerHandicapIndex)) {
                $row->playerHandicapIndex = 'TBD';
            }
        }

        $this->load->view('header_view');
        $this->load->view('player_delete_view', $data);
        $this->load->view('footer_view');
    }

    public function submitDelete() {
        $this->load->model('player_model');
        $this->load->helper('form');

        $id = $this->input->post('playerID');
        $data['name'] = $this->player_model->getPlayerNameByID($id);

        $queryResult = $this->player_model->deletePlayer((int)$id);

        $this->playerDeleteResult($queryResult, $data);
    }

    public function playerDeleteResult($queryResult, $data) {
        foreach($data['name'] as $row) {
            $deletedPlayer = $row->playerName;
        }

        if ($queryResult == TRUE) {
            $data['title'] = 'Success!';
            $data['message'] = $deletedPlayer . ' was successfully deleted from the database.';
        }
        else {
            $data['title'] = 'Failed';
            $data['message'] = 'Error: ' . $deletedPlayer . ' failed to be deleted from the database.  Please try again later.';
        }

        $this->load->view('header_view');
        $this->load->view('player_delete_result_view', $data);
        $this->load->view('footer_view');
    }

}