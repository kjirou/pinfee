<?php
namespace Pinfee\Pagination;


class Paginator
{
    private $rows_per_page = null;
    private $total_row_count = null;
    private $page_number = null;

    function __construct($rows_per_page, $total_row_count, $page_number, $options = array())
    {
        $options = array_merge(array(
            // range の範囲, 現在ページから片辺へ何ページまで返すか
            // e.g. 現在 4 ページで range_width = 2 なら、[2, 3, 4, 5, 6]
            'range_width' => 2
        ), $options);

        $this->rows_per_page = $rows_per_page;
        $this->total_row_count = $total_row_count;
        $this->page_number = $page_number;
        $this->range_width = $options['range_width'];
    }

    public function compute()
    {
        $results = array(
            'rows_per_page' => $this->rows_per_page,
            'total_row_count' => $this->total_row_count,
            'page_number' => $this->page_number,
            'page_index' => null,
            'page_count' => intval(ceil($this->total_row_count / $this->rows_per_page)),
            'first' => 1,
            'last' => null,
            'previous' => null,
            'next' => null,
            'range' => array($this->page_number),
            'from_row_count' => 0,
            'to_row_count' => null
        );

        if ($results['page_number'] > 0) {
            $results['page_index'] = $results['page_number'] - 1;
        }

        if ($results['page_count'] > 0) {
            $results['last'] = $results['page_count'];
        }

        if ($results['page_number'] > 1) {
            $results['previous'] = $results['page_number'] - 1;
        }

        $next = $results['page_number'] + 1;
        if ($results['last'] >= $next) {
            $results['next'] = $next;
        }

        if ($results['page_index']) {
            $results['from_row_count'] = $results['rows_per_page'] * $results['page_index'];
        }

        return $results;
    }
}
