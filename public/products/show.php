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

$locals = create_locals(array(
    'product' => $product,
));
render_and_exit('products/show.php', $locals);
?>
