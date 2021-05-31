<?php

require_once("./app/views/frontPageView.php");
require_once("./app/models/frontPageModel.php");
require_once("./app/controllers/frontPageController.php");
require_once('./app/models/emailsModel.php');
require_once('./app/controllers/emailsController.php');
require_once('./app/views/emailsView.php');

$page = $_GET["page"];
if (!empty($page)) {

    $data = array(
        'index' => array('model' => 'FrontPage\Model', 'view' => 'FrontPage\View', 'controller' => 'FrontPage\Controller'),
        'result' => array('model' => 'SubmittedEmails\Model', 'view' => 'SubmittedEmails\View', 'controller' => 'SubmittedEmails\Controller')
    );

    foreach($data as $key => $components){
        if ($page == $key) {
            $model = $components['model'];
            $view = $components['view'];
            $controller = $components['controller'];
            break;
        }
    }

    if (isset($model)) {
        $m = new $model();
        $c = new $controller($m);
        $v = new $view($m);
        $c->callFunctions();
        $v->output();
    }
}
