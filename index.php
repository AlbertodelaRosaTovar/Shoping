<?php
$controller = "pages";
$action = "login";

if (isset($_GET['controller']) && isset($_GET['action'])) {
    // Check controller and actions are not empty
    if ($_GET['controller'] != "" && $_GET['action'] != "") {
        $controller = $_GET['controller'];
        $action = $_GET['action'];
    }
} else {
    header('Location: ./?controller=pages&action=viewCatalogo');
}

if (strpos($_GET['action'], 'get_') !== false || strpos($_GET['action'], 'set_') !== false) {
    include_once("router.php");
} else {
    require_once("views/template.php");
}
