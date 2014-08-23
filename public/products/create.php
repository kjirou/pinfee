<?php
require_once '../../config/index.php';

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
        render('products/create.php', create_locals(array(
            'inputs' => $inputs,
            'errors' => $errors,
        )));
        break;

    case 'POST':
        $inputs = array_merge($inputs, $_POST);

        if (!validate_url($inputs['url'])) {
            $errors['url'] = true;
        }
        if ($inputs['title'] === '') {
            $errors['title'] = true;
        }

        if (array_any($errors) > 0) {
            render('products/create.php', create_locals(array(
                'inputs' => $inputs,
                'errors' => $errors,
            )));
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

        redirect('/');
        break;
}

finalize();
?>
