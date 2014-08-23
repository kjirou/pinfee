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

function compilte_template($file_path, $locals = array()) {
    extract($locals);
    ob_start();
    require $file_path;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function render($template_file_path, $locals = array()) {
    $file_path = TEMPLATES_ROOT . '/' . $template_file_path;
    echo compilte_template($file_path, $locals);
}

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, ENCODING);
}