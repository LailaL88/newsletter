<?php

class ResultController
    {
        protected $model;

        public function __construct($model)
        {
            $this->model = $model;
        }

        private function getSearchInput()
        {
            if (isset($_POST["search"])) {
                $input = htmlspecialchars($_POST["search-input"]);
                $this->model->sql = "SELECT * FROM emails  WHERE email LIKE '%$input%'";
                $_SESSION['provider'] = "";
            }
        }

        private function sortFilter($provider, $input)
        {
            $this->model->sql = 'SELECT * FROM emails';    

            if ($this->model->provider != "" || isset($_POST["by-date"])) {
                $this->model->sql="SELECT * FROM emails WHERE email REGEXP '$provider$' AND email LIKE '%$input%'";    
            }
            
            if (isset($_POST["by-name"])) {
                $this->model->sql="SELECT * FROM emails  WHERE email REGEXP '$provider$' AND email LIKE '%$input%' ORDER BY email";
            }
            
            if (isset($_POST["all"])) {
                $this->model->sql = 'SELECT * FROM emails';
                $_SESSION['provider'] = "";
                $_SESSION['input'] = "";
            } 
        
            $this->getSearchInput();    
        }
        
        private function getButtonTexts($q)
        {
            $this->model->getEmailProviderArray($q);
            foreach ($this->model->uniqueEmailEndings as $value) {
                $dotPos = strpos($value, ".");
                $afterDot = substr($value, $dotPos);
                $buttonText = str_replace($afterDot, "", $value);
                array_push($this->model->capitalisedBtnTexts, ucwords($buttonText));
            }
        }

        public function callFunctions()
        {
            session_start();
            $this->model->getAllEmails();
            require_once("sessionVariablesController.php");
            $variablesController = new VariablesController($this->model);
            $variablesController->setSessionInput();
            $this->getButtonTexts($this->model->qAll);
            $variablesController->getProviderVariable();
            $this->model->deleteEmail($this->model->rowIds);
            $this->sortFilter($_SESSION['provider'], $variablesController->input);
            $this->model->getEmails();
        }
    }
