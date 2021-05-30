<?php

class VariablesController extends ResultController
{
    public function getProviderVariable()
    {
        foreach ($this->model->uniqueEmailEndings as $value) {
            $dotPos = strpos($value, ".");
            $afterDot = substr($value, $dotPos);
            $buttonText = str_replace($afterDot, "", $value);
            $capitalised = ucwords($buttonText);
    
            if (isset($_POST[$capitalised])) {
                $_SESSION['provider'] = $value;
                $this->model->provider = $_SESSION['provider'];
            }
        }
    }

    public function setSessionInput()
    {
        if (isset($_SESSION['input'])) {
            $this->input = $_SESSION['input'];
        } else {
            $this->input = "";
        }
    
        if (isset($_POST["search"])) {
            $this->input = htmlspecialchars($_POST["search-input"]);
            $_SESSION['input'] = $this->input;
        }
    }
}
