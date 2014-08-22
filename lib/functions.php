<?php

function get_db_object() {
    global $_DB;
    return $_DB;
}

function before_action() {
}

function after_action() {
  $db = get_db_object();
  $db->close();
}

function compilteTemplate($filePath, $locals = array()) {
    extract($locals);
    ob_start();
    require $filePath;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function render($templateFilePath, $locals = array()) {
    $filePath = TEMPLATES_ROOT . '/' . $templateFilePath;
    echo compilteTemplate($filePath, $locals);
}

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, ENCODING);
}
