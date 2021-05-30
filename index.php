<?php

require_once("./app/views/indexView.php");
require_once("./app/models/indexModel.php");
require_once("./app/controllers/indexController.php");
require_once('./app/models/resultModel.php');
require_once('./app/controllers/resultController.php');
require_once('./app/views/resultView.php');

$page = $_GET["page"];
if (!empty($page)) {

    $data = array(
        'index' => array('model' => 'IndexModel', 'view' => 'IndexView', 'controller' => 'IndexController'),
        'result' => array('model' => 'ResultModel', 'view' => 'ResultView', 'controller' => 'ResultController')
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
