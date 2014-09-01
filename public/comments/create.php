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
    $stmt->bindValue('id', $product_id, SQLITE3_INTEGER);
    $cursor = $stmt->execute();
    return $cursor->fetchArray(SQLITE3_ASSOC);
};

$product = $get_product(intval($inputs['product_id']));

if (!$product) {
    redirect('/');
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        send_page_response('comments/create.php', array(
            'inputs' => $inputs,
            'errors' => $errors,
            'product' => $product,
        ));
        break;

    case 'POST':
        if ($inputs['body'] === '') {
            $errors['body'] = true;
        }

        if (array_any($errors) > 0) {
            send_page_response('comments/create.php', array(
                'inputs' => $inputs,
                'errors' => $errors,
                'product' => $product,
            ));
            break;
        }

        // コメントの登録
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
        $stmt->bindValue(':product_id', $product['id'], SQLITE3_INTEGER);
        $stmt->bindValue(':body', $inputs['body'], SQLITE3_TEXT);
        $stmt->execute();

        // 現コメント数を取得
        $stmt = $db->prepare('SELECT count(id) FROM comments WHERE product_id = :product_id;');
        $stmt->bindValue(':product_id', $product['id'], SQLITE3_INTEGER);
        $cursor = $stmt->execute();
        // PHP5.3対応 Ref) #29
        //$comment_count = $cursor->fetchArray()[0];
        $_tmp = $cursor->fetchArray();
        $comment_count = $_tmp[0];

        // コメント数を更新
        $stmt = $db->prepare('UPDATE products SET comment_count = :comment_count WHERE id = :id');
        $stmt->bindValue(':comment_count', $comment_count, SQLITE3_INTEGER);
        $stmt->bindValue(':id', $product['id'], SQLITE3_INTEGER);
        $stmt->execute();

        set_flash($FLASH_KEYS['pages.products.show.notification'], 'レビューを投稿しました。');

        redirect("/products/show.php?id={$product['id']}");
        break;
}
?>
