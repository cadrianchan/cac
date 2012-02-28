<?php
session_start();

class profileController extends baseController {

    public function index() {
        $this->registry->template->show('profileheader');
        $this->registry->template->show('profileindex');
    }
    
    public function logout() {
        userLogout();
        $this->registry->template->show('profileheader');
        $this->registry->template->show('logout');
    }
    
    public function profile() {
        $this->registry->template->show('profileheader');
        $this->registry->template->show('profile');
    }
    
    public function members() {
        $this->registry->template->show('profileheader');
        $this->registry->template->show('members');
    }
    
    public function friends() {
        $this->registry->template->show('profileheader');
        $this->registry->template->show('friends');
    }
    
    public function messages() {
        $this->registry->template->show('profileheader');
        $this->registry->template->show('messages');
    }

}

?>
