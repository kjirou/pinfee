<?php
require_once '../config/index.php';

use Pinfee\Pagination\Paginator;


$inputs = array_merge(array(
    'q' => null,
    'page' => '1'
), $_GET);

$db = get_db_object();

// 1 ページの最大件数
$rows_per_page = 5;

// 現在ページ数
$page = intval($inputs['page']);
if ($page < 1) {
    $page = 1;
}

$query_sql = '';
$query = '';
if ($inputs['q']) {
    $query_sql = '
      AND (
        title LIKE :query ESCAPE \'$\' OR
        description LIKE :query ESCAPE \'$\'
      )
    ';
    $query = '%' . escape_like_query($inputs['q']) . '%';
}

// 総件数の抽出
$total_count_sql = "
  SELECT
    count(*)
  FROM
    products
  WHERE
    1 = 1
  {$query_sql}
";
$stmt = $db->prepare($total_count_sql);
$stmt->bindValue(':query', $query, SQLITE3_TEXT);
$cursor = $stmt->execute();
// PHP5.3対応 Ref) #29
$_tmp = $cursor->fetchArray();
$product_total_count = $_tmp[0];

// ページネーション
$paginator = new Paginator($rows_per_page, $product_total_count, $page);
$pagination = $paginator->compute();

// プロダクトリストを抽出
$rows_sql = "
  SELECT
    *
  FROM
    products
  WHERE
    1 = 1
  {$query_sql}
  ORDER BY
    created_at DESC
  LIMIT
    {$rows_per_page}
  OFFSET
    {$pagination['from_row_count']}
";
$stmt = $db->prepare($rows_sql);
$stmt->bindValue(':query', $query, SQLITE3_TEXT);
$cursor = $stmt->execute();
$products = array();
while ($row = $cursor->fetchArray(SQLITE3_ASSOC)) {
    $products[] = $row;
}

render_and_exit('index.php', array(
    'products' => $products,
    'pagination' => $pagination,
    'notification' => get_flash($FLASH_KEYS['pages.index.notification']),
));
?>
