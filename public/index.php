<?php
require_once '../config/index.php';

before_action();

$db = get_db_object();
$sql = 'SELECT * FROM products;';
$result = $db->query($sql);
$products = array();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  $products[] = $row;
}

$locals = array(
  'products' => $products,
);
render('index.php', $locals);

after_action();
?>
