<?php

class indexController extends baseController {

    public function index() {
        $this->registry->template->show('index');
    }

    public function teams() {
        $teamnames = $this->registry->model->getTeamnames();
        $this->registry->template->teamnames = $teamnames;
        $this->registry->template->show('header');
        $this->registry->template->show('teams');
    }

    public function goals() {
        $topscorers = $this->registry->model->getTopScorers();
        $this->registry->template->topscorers = $topscorers;
        $this->registry->template->show('header');
        $this->registry->template->show('goals');
    }

    public function assists() {
        $topassists = $this->registry->model->getTopAssists();
        $this->registry->template->topassists = $topassists;
        $this->registry->template->show('header');
        $this->registry->template->show('assists');
    }

    public function schedule() {
        $this->registry->template->show('header');
        $this->registry->template->show('schedule');
    }

    public function signup() {
        $teamnames = $this->registry->model->getTeamnames();
        $this->registry->template->teamnames = $teamnames;
        $this->registry->template->show('header');
        $this->registry->template->show('signup');
    }

}

?>
