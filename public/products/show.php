<?php
require_once '../../config/index.php';

$inputs = array_merge(array(
    'id' => 0,
), $_GET);

$db = get_db_object();
$sql = 'SELECT * FROM products WHERE id = :id;';
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', intval($inputs['id']), SQLITE3_INTEGER);
$cursor = $stmt->execute();
$product = $cursor->fetchArray(SQLITE3_ASSOC);

if (!$product) {
    redirect('/');
}

$stmt = $db->prepare('SELECT * FROM comments WHERE product_id = :product_id ORDER BY created_at DESC');
$stmt->bindValue(':product_id', $product['id'], SQLITE3_INTEGER);
$cursor = $stmt->execute();
$comments = array();
while ($row = $cursor->fetchArray(SQLITE3_ASSOC)) {
    $comments[] = $row;
}

$locals = create_locals(array(
    'product' => $product,
    'comments' => $comments,
    'notification' => get_flash($FLASH_KEYS['pages.products.show.notification']),
));
render_and_exit('products/show.php', $locals);
?>
