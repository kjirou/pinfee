<?php
require_once '../../config/index.php';

use Pinfee\Validation\Validation;


$inputs = array(
    'url' => '',
    'title' => '',
    'description' => '',
);
$errors = array(
    'url' => false,
    'title' => false,
);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        send_page_response('products/create.php', array(
            'inputs' => $inputs,
            'errors' => $errors,
        ));
        break;

    case 'POST':
        $inputs = array_merge($inputs, $_POST);

        if (!Validation::validateUrl($inputs['url'])) {
            $errors['url'] = true;
        }
        if ($inputs['title'] === '') {
            $errors['title'] = true;
        }

        if (array_any($errors) > 0) {
            send_page_response('products/create.php', array(
                'inputs' => $inputs,
                'errors' => $errors,
            ));
            break;
        }

        $db = get_db_object();
        $sql = '
            INSERT INTO products (
                created_at,
                url,
                title,
                description
            ) VALUES (
                datetime("now"),
                :url,
                :title,
                :description
            );
        ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':url', $inputs['url'], SQLITE3_TEXT);
        $stmt->bindValue(':title', $inputs['title'], SQLITE3_TEXT);
        $stmt->bindValue(':description', $inputs['description'], SQLITE3_TEXT);
        $stmt->execute();

        set_flash($FLASH_KEYS['pages.products.show.notification'], 'サービスを登録しました。');

        redirect("/products/show.php?id={$db->lastInsertRowID()}");
        break;
}
?>
