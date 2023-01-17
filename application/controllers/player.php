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
        if ($data['getPlayersAZQuery'] != FALSE) {
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
            RETURN;
        }
        else {
            $data['errorMessage'] = 'Something went wrong and player information was unable to be loaded at this time.';
            $data['link'] = 'home/loadHomeLoggedIn';
            $data['buttonText'] = 'Home';

            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }
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
                //'rules' => 'required|trim|min_length[1]|max_length[45]|valid_base64'
                'rules' => 'required|trim|min_length[1]|max_length[45]'
            ),
            array(
                'field' => 'lastName',
                'label' => 'Last Name',
                //'rules' => 'required|trim|min_length[1]|max_length[45]|valid_base64'
                'rules' => 'required|trim|min_length[1]|max_length[45]'
            ),
            array(
                'field' => 'phoneNumber',
                'label' => 'Phone Number',
                'rules' => 'required|exact_length[10]|numeric|callback_validateUniquePhone'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->add();
        }
        else {
            $tempFirst = $this->input->post('firstName');
            $tempLast = $this->input->post('lastName');
            $phone = $this->input->post('phoneNumber');
            $newPlayer = $tempLast . ', ' . $tempFirst;
            $queryResult = $this->player_model->insertPlayer($newPlayer, $phone);
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
        if ($data['getPlayerByIDQuery'] != FALSE) {
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
            RETURN;
        }
        else {
            $data['errorMessage'] = "Something went wrong. The Player's information was unable to be loaded at this time.";
            $data['link'] = 'player/index';
            $data['buttonText'] = 'Player - Home';

            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }
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
            ),
            array(
                'field' => 'newPhone',
                'label' => 'Phone Number',
                'rules' => 'trim|exact_length[10]|numeric|callback_validateUniquePhone'
            )
        );

        $this->form_validation->set_rules($config);
        $id = $this->input->post('playerID');

        if($this->form_validation->run() == FALSE ) {
            $this->edit($id);
        }
        else {
            $temp['oldName'] = $this->player_model->getPlayerNameByID($id);
            if ($temp['oldName'] == FALSE) {
                $temp['oldName'] = 'The player';
            }
            foreach($temp['oldName'] as $row) {
                if(isset($row->playerName)) {
                    $oldName = $row->playerName;
                }
            }
            //need to run a query to get current phone number for this player
            $phone['oldPhone'] = $this->player_model->getPlayerPhoneByID($id);
            foreach($phone['oldPhone'] as $row) {
                $oldPhone = $row->playerPhone;
            }
            $newFirst = $this->input->post('newFirstName');
            $newLast = $this->input->post('newLastName');
            $newPhone = $this->input->post('newPhone');
            $phoneUpdate = TRUE;
            $newName = $newLast . ', ' . $newFirst;
            $data['playerName'] = $newName;
            if ($newPhone == "" || is_null($newPhone)) {
                $data['playerPhone'] = $oldPhone;
                $phoneUpdate = FALSE;
            } 
            else {
                $data['playerPhone'] = $newPhone; 
            }
            $queryResult = $this->player_model->updatePlayer($id, $data);
            if ($queryResult == TRUE) {
                $data['title'] = 'Success!';
                $data['message'] = 'The information for player ' . $newName . ' was successfully updated.';
                $data['oldName'] = "Old Name:  " . $oldName;
                $data['newName'] = "New Name:  " . $newName;
                $data['oldPhone'] = "Old Phone:  " . $oldPhone;
                if ($phoneUpdate === TRUE) {
                    $data['newPhone'] = "New Phone:  " . $newPhone;
                } 
                else {
                    $data['newPhone'] = "";
                }
            }
            else {
                $data['title'] = 'Failure';
                $data['message'] = 'The player ' . $oldName . ' failed to update.';
                $data['oldname'] = '';
                $data['newName'] = '';
                $data['oldPhone'] = '';
                $data['newPhone'] = '';
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
        if ($data['getPlayerByIDQuery'] != FALSE) {
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
            RETURN;
        }
        else {
            $data['errorMessage'] = "The player's information was unable to be loaded at this time.  Please try again later.";
            $data['link'] = 'player/index';
            $data['buttonText'] = 'Player - Home';

            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }

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
    
    public function validateUniquePhone($phone) {
        //read in phone number
        //run query in db.  It should attempt to select the phone number value
        //return true if nothing found
        //return fals if found
        
        $this->load->model('player_model');
        if ($this->player_model->validateUniquePhone($phone)) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('validateUniquePhone', 'That phone number already belongs to another player.');
            return FALSE;
        }
    }

}