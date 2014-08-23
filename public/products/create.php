<?php
require_once '../../config/index.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $locals = create_locals(array(
        ));
        render('products/create.php', $locals);
        break;

    case 'POST':
        redirect('/');
        break;
}

finalize();
?>
