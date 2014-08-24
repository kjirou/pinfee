<?php
require_once '../../config/index.php';


$inputs = array_merge(array(
    'email' => '',
), $_POST);
$errors = array(
    'email' => false,
);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        render_and_exit('recipients/create.php', array(
            'inputs' => $inputs,
            'errors' => $errors,
        ));
        break;

    case 'POST':
        if (!validation\validate_email($inputs['email'])) {
            $errors['email'] = true;
        }

        if (array_any($errors) > 0) {
            render_and_exit('recipients/create.php', array(
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
