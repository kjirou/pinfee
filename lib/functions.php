<?php

function array_all($array) {
    foreach ($array as $value) {
        if (!$value) {
            return false;
        }
    }
    return true;
}

function array_any($array) {
    foreach ($array as $value) {
        if ($value) {
            return true;
        }
    }
    return false;
}

function get_db_object() {
    global $_DB;
    return $_DB;
}

function finalize() {
    $db = get_db_object();
    $db->close();
    exit(0);
}

function redirect($url_or_path, $options = array()) {
    $options = array_merge(array(
        'code' => null,
    ), $options);
    header("Location: $url_or_path", true, $options['code']);
    finalize();
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

function validate_url($string) {
    return preg_match('/^https?:\\/\\//', $string) > 0;
}
