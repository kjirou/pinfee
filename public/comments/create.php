<?php
require_once '../../config/index.php';

$inputs = array_merge(array(
    'product_id' => '',
    'body' => '',
), $_GET, $_POST);
$errors = array(
    'body' => false,
);

$get_product = function($product_id) {
    $db = get_db_object();
    $stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
    $stmt->bindValue($product_id, SQLITE3_INTEGER);
    $cursor = $stmt->execute();
    return $cursor->fetchArray(SQLITE3_ASSOC);
};

$product = $get_product(intval($inputs['product_id']));

if (!$product) {
    redirect('/');
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        render_and_exit('comments/create.php', create_locals(array(
            'inputs' => $inputs,
            'errors' => $errors,
            'product' => $product,
        )));
        break;

    case 'POST':
        if ($inputs['body'] === '') {
            $errors['body'] = true;
        }

        if (array_any($errors) > 0) {
            render_and_exit('comments/create.php', create_locals(array(
                'inputs' => $inputs,
                'errors' => $errors,
                'product' => $product,
            )));
            break;
        }

        $db = get_db_object();
        $sql = '
            INSERT INTO comments (
                created_at,
                product_id,
                body
            ) VALUES (
                datetime("now"),
                :product_id,
                :body
            );
        ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $inputs['product_id'], SQLITE3_INTEGER);
        $stmt->bindValue(':body', $inputs['body'], SQLITE3_TEXT);
        $stmt->execute();

        set_flash($FLASH_KEYS['pages.products.show.notification'], 'レビューを投稿しました。');

        redirect("/products/show.php?id={$product['id']}");
        break;
}
?>
