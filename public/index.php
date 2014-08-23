<?php
require_once '../config/index.php';

before_action();

$db = get_db_object();
$sql = 'SELECT * FROM products;';
$cursor = $db->query($sql);
$products = array();
while ($row = $cursor->fetchArray(SQLITE3_ASSOC)) {
    $products[] = $row;
}

$locals = create_locals(array(
    'products' => $products,
));
render('index.php', $locals);

after_action();
?>
