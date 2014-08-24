<?php
require_once '../config/index.php';

$db = get_db_object();
$sql = 'SELECT * FROM products;';
$cursor = $db->query($sql);
$products = array();
while ($row = $cursor->fetchArray(SQLITE3_ASSOC)) {
    $products[] = $row;
}

$locals = create_locals(array(
    'products' => $products,
    'notification' => get_flash($FLASH_KEYS['pages.index.notification']),
));
render_and_exit('index.php', $locals);
?>
