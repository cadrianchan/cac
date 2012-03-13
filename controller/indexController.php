<?php

class indexController extends baseController {

    public function index() {
        $teamnames = $this->registry->model->getTeamnames();
        $this->registry->template->teamnames = $teamnames;
        $this->registry->template->show('header');
        $this->registry->template->show('sidebar');
        $this->registry->template->show('index');
        $this->registry->template->show('footer');
    }

    public function teams() {
        $teamnames = $this->registry->model->getTeamnames();
        $this->registry->template->teamnames = $teamnames;
        $this->registry->template->show('header');
        $this->registry->template->show('sidebar');
        $this->registry->template->show('teams');
        $this->registry->template->show('footer');
    }

    public function goals() {
        $topscorers = $this->registry->model->getTopScorers();
        $this->registry->template->topscorers = $topscorers;
        $this->registry->template->show('header');
        $this->registry->template->show('sidebar');
        $this->registry->template->show('goals');
        $this->registry->template->show('footer');
    }

    public function assists() {
        $topassists = $this->registry->model->getTopAssists();
        $this->registry->template->topassists = $topassists;
        $this->registry->template->show('header');
        $this->registry->template->show('sidebar');
        $this->registry->template->show('assists');
        $this->registry->template->show('footer');
    }

    public function schedule() {
        $this->registry->template->show('header');
        $this->registry->template->show('sidebar');
        $this->registry->template->show('schedule');
        $this->registry->template->show('footer');
    }

    public function signup() {
        $teamnames = $this->registry->model->getTeamnames();
        $this->registry->template->teamnames = $teamnames;
        $this->registry->template->show('header');
        $this->registry->template->show('sidebar');
        $this->registry->template->show('signup');
        $this->registry->template->show('footer');
    }

}

?>
