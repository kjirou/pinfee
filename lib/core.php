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

/** SQLite3 の LIKE クエリをエスケープする */
function escape_like_query($query, $escape_character = '$') {
    return preg_replace('/([$%_])/', $escape_character . '$1', $query);
}

/** プロセスを終了する。バッチ終了時にも使用する */
function exit_process() {
    $db = get_db_object();
    $db->close();
    exit(0);
}

/** HTTP プロセスを終了する */
function exit_http() {
    $db = get_db_object();
    $db_result_code = $db->lastErrorCode();
    // Ref) http://www.sqlite.org/c3ref/c_abort.html
    if (0 < $db_result_code && $db_result_code < 100) {
      var_dump('SQLite3 error ocurred.', $db->lastErrorMsg);
    }

    exit_process();
}

/** セッションへ flash 変数(一度だけ抽出できる変数)を格納する */
function set_flash($key, $value) {
    $_SESSION[SESSION_FLASHES_NAMESPACE][$key] = $value;
}

/** セッションから flash 変数を取得する */
function get_flash($key) {
    $value = null;
    if (array_key_exists($key, $_SESSION[SESSION_FLASHES_NAMESPACE])) {
        $value = $_SESSION[SESSION_FLASHES_NAMESPACE][$key];
        unset($_SESSION[SESSION_FLASHES_NAMESPACE][$key]);
    }
    return $value;
}

function redirect($url_or_path, $options = array()) {
    $options = array_merge(array(
        'code' => null,
    ), $options);
    header("Location: $url_or_path", true, $options['code']);
    exit_http();
}

function compile_template($file_path, $locals = array()) {
    extract($locals, EXTR_SKIP);
    ob_start();
    require $file_path;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

/** render 時に必ず渡される変数を生成する */
function create_static_locals() {
    return array(
        'site_name' => SITE_NAME,
    );
}

function _render($template_file_path, $locals = array(), $options = array()) {
    $options = array_merge(array(
        'should_exit' => false,
    ), $options);
    $file_path = TEMPLATES_ROOT . '/' . $template_file_path;
    echo compile_template($file_path, array_merge($locals, create_static_locals()));
    if ($options['should_exit']) {
        exit_http();
    }
}

/** テンプレートを描画する、終了はしない */
function render($template_file_path, $locals = array()) {
    return _render($template_file_path, $locals);
}

/** テンプレートを描画して終了する */
function render_and_exit($template_file_path, $locals = array()) {
    return _render($template_file_path, $locals, array('should_exit' => true));
}

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, ENCODING);
}
