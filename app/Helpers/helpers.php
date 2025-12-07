<?php

if (!function_exists('rupiah')) {
    /**
     * Format number as Indonesian Rupiah currency
     *
     * @param float|int $amount
     * @param bool $withPrefix
     * @return string
     */
    function rupiah($amount, $withPrefix = true)
    {
        $formatted = number_format($amount, 0, ',', '.');
        return $withPrefix ? 'Rp ' . $formatted : $formatted;
    }
}

if (!function_exists('rupiah_short')) {
    /**
     * Format number as short Indonesian Rupiah (e.g., 1.5K, 2.3M)
     *
     * @param float|int $amount
     * @return string
     */
    function rupiah_short($amount)
    {
        if ($amount >= 1000000000) {
            return 'Rp ' . number_format($amount / 1000000000, 1, ',', '.') . 'M';
        } elseif ($amount >= 1000000) {
            return 'Rp ' . number_format($amount / 1000000, 1, ',', '.') . 'Jt';
        } elseif ($amount >= 1000) {
            return 'Rp ' . number_format($amount / 1000, 1, ',', '.') . 'K';
        }
        
        return rupiah($amount);
    }
}
