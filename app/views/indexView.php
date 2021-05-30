<?php

class IndexView
{
    private $model;
        
    public function __construct($model) {
        $this->model = $model;
    }

    private function showCheckboxErrorMessage()
    {
        if ($this->model->checkboxErr != "") {
        echo "<noscript><div class='php-message'>" . $this->model->checkboxErr . "</div></noscript>";
        }
    }

    private function showEmptyEmailErrorMsg()
    {
        if ($this->model->emptyEmailErr != "") {
        echo "<noscript><div class='php-message'>" . $this->model->emptyEmailErr . "</div></noscript>";
        }
    }

    private function showUnvalidEmailErrorMsg()
    {
        if ($this->model->unvalidEmailErr != "") {
            echo "<noscript><div class='php-message'>" . $this->model->unvalidEmailErr . "</div></noscript>";
        }
        if ($this->model->colombiaEmailErr != "") {
            echo "<noscript><div class='php-message'>" . $this->model->colombiaEmailErr . "</div></noscript>";
        }
    }

    private function showPhpValidationMessages()
    {
        $this->showEmptyEmailErrorMsg();    
        $this->showUnvalidEmailErrorMsg();
        $this->showCheckboxErrorMessage();
    }

    public function output()
    {
        require_once("indexPageTop.phtml");
        $this->showPhpValidationMessages();
        require_once("indexPageBottom.html");
    }
}
