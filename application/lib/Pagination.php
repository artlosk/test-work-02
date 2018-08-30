<?php

namespace application\lib;

use application\core\View;

/**
 * Class Pagination
 * @package application\lib
 */
class Pagination
{
    /**
     * @var int
     */
    private $max = 10;
    /**
     * @var array
     */
    private $route;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var int
     */
    private $current_page;
    /**
     * @var int
     */
    private $total;
    /**
     * @var int
     */
    private $limit;

    /**
     * Pagination constructor.
     * @param $route
     * @param $total
     * @param int $limit
     */
    public function __construct($route, $total, $limit = 10)
    {
        $this->route = $route;
        $this->total = $total;
        $this->limit = $limit;
        $this->amount = $this->amount();
        $this->setCurrentPage();

        if (isset($this->route['page']) && (int)$this->route['page'] > (int)$this->amount) {
            View::errorCode(404);
        }
    }

    /**
     * @return string
     */
    public function get()
    {
        $links = null;
        $limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">' . $page . '</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, '<<') . $links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, '>>');
            }
        }
        $html .= $links . ' </ul></nav>';
        return $html;
    }

    /**
     * @param $page
     * @param null $text
     * @return string
     */
    private function generateHtml($page, $text = null)
    {
        if (!$text) {
            $text = $page;
        }

        $parts = parse_url($_SERVER['REQUEST_URI']) + array('query' => array());
        $query = '';

        if (isset($parts['query']) && !empty($parts['query']) != '') {
            parse_str($parts['query'], $query);
            if (!empty($query)) {
                $query = '?' . http_build_query(array_merge($query, array('page' => $page)));
            }
        } else {
            $query = '?page=' . $page;
        }


        $link = $parts['path'] . $query;

        return '<li class="page-item"><a class="page-link" href="' . $link . '">' . $text . '</a></li>';
    }

    /**
     * @return array
     */
    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return array($start, $end);
    }

    /**
     *
     */
    private function setCurrentPage()
    {
        if (!isset($this->route['page']) || !is_numeric($this->route['page']) || $this->route['page'] < 0) {
            $currentPage = 1;
        } else {
            $currentPage = $this->route['page'];
        }
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    /**
     * @return float
     */
    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}