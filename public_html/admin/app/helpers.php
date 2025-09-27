<?php
if (! function_exists('get_category_title')) {
    function get_category_title($slug) {
        return DB::table('categories')->where('slug', $slug)->first()->title ?? '';
    }
}