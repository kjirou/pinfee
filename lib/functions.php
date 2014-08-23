<?php

function get_db_object() {
    global $_DB;
    return $_DB;
}

function initialize() {
}

function finalize() {
    $db = get_db_object();
    $db->close();
    exit(0);
}

function redirect($url, $options = array()) {
    $options = array_merge(array(
        'code' => null,
    ), $options);
    header("Location: $url", true, $options['code']);
    exit(0);
}

function create_locals($locals = array()) {
    $defaults = array();
    return array_merge($locals, $defaults);
}

function compile_template($file_path, $locals = array()) {
    extract($locals, EXTR_SKIP);
    ob_start();
    require $file_path;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function render($template_file_path, $locals = array()) {
    $file_path = TEMPLATES_ROOT . '/' . $template_file_path;
    echo compile_template($file_path, $locals);
}

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, ENCODING);
}
