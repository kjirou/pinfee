<?php

function compilteTemplate($filePath, $values = array()) {
    extract($values);
    ob_start();
    include($filePath);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function render($templateFilePath, $values = array()) {
    $filePath = TEMPLATES_ROOT . '/' . $templateFilePath;
    echo compilteTemplate($filePath, $values);
}
