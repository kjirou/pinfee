<?php
require_once '../../config/index.php';

use Pinfee\Validation\Validation;


$inputs = array_merge(array(
    'email' => '',
), $_POST);
$errors = array(
    'email' => false,
);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        send_page_response('recipients/create.php', array(
            'inputs' => $inputs,
            'errors' => $errors,
        ));
        break;

    case 'POST':
        if (!Validation::validateEmail($inputs['email'])) {
            $errors['email'] = true;
        }

        if (array_any($errors) > 0) {
            send_page_response('recipients/create.php', array(
                'inputs' => $inputs,
                'errors' => $errors,
            ));
            break;
        }

        $db = get_db_object();
        $sql = '
            INSERT INTO recipients (
                created_at,
                email
            ) VALUES (
                datetime("now"),
                :email
            );
        ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $inputs['email'], SQLITE3_TEXT);
        $stmt->execute();

        set_flash($FLASH_KEYS['pages.index.notification'], 'メールマガジンへ登録しました。');

        redirect('/');
        break;
}
?>
