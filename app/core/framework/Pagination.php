<?php

namespace Core\Framework;

class Pagination {

    public static function create($urlTemplate, $currentPage = 1, $totalItems, $perPage = 10) {

        $totalPages = round($totalItems / $perPage);

        $tpl = '<ul class="pagination">';

        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                $tpl .= '<li class="active"><span>' . $i . '</span></li>';
            } else {
                $link = str_replace('#page', $i, $urlTemplate);
                $tpl .= '<li><a href="' . $link . '">' . $i . '</a></li>';
            }
        }
        $tpl .= '</ul>';
        return $tpl;
    }

}
