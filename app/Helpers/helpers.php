<?php

if (!function_exists('formatIDR')) {
    function formatIDR($price)
    {
        return 'IDR ' . number_format($price, 0, ',', '.');
    }
}