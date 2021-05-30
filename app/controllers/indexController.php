<?php

class IndexController
{
	private $model;

	public function __construct($model){
		$this->model = $model;
	}

    public function testInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	private function getCheckboxErrorMessage()
    {
        if (empty($_POST["php-checkbox"])) {
            $this->model->checkboxErr = "You must accept the terms and conditions";
        }
    }

    private function getEmptyEmailErrorMsg()
    {
        if (empty($_POST["email"])) {
            $this->model->emptyEmailErr = "Email address is required";
        } else {
            $this->model->email = $this->testInput($_POST["email"]);
        }
    }

    private function getUnvalidEmailErrorMsg()
    {
        if (!filter_var($this->model->email, FILTER_VALIDATE_EMAIL) && $this->model->email != "") {
            $this->model->unvalidEmailErr = "Please provide a valid e-mail address";
        } elseif (substr($this->model->email, -3) == ".co") {
            $this->model->colombiaEmailErr = "We are not accepting subscriptions from Colombia emails";
        }
    }

	private function getPhpValidationMessages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->getEmptyEmailErrorMsg();    
            $this->getUnvalidEmailErrorMsg();
            $this->getCheckboxErrorMessage();
        }
    }

	public function checkIfEmailAdded()
        {
            if (isset($_POST["email"])) {
                $this->model->checkEmail();
            }
        }

	public function callFunctions()
	{
		$this->getPhpValidationMessages();
		$this->model->addToDataBase();
		$this->checkIfEmailAdded();
	}
}
					 