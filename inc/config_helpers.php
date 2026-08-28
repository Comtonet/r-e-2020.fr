<?php
$GLOBALS['site_config'] = require __DIR__ . '/config.php';

function cfg($key, $default = null) {
    return array_key_exists($key, $GLOBALS['site_config']) ? $GLOBALS['site_config'][$key] : $default;
}

function working_days_label($days) {
    $days = (int)$days;
    return $days . ' jour' . ($days > 1 ? 's' : '') . ' ouvré' . ($days > 1 ? 's' : '');
}

function hours_label($hours) {
    $hours = (int)$hours;
    return $hours . ' heure' . ($hours > 1 ? 's' : '') . ' ouvrée' . ($hours > 1 ? 's' : '');
}

function standard_delay_label() {
    return working_days_label(cfg('delay_standard_days', 1));
}

function eco_delay_label() {
    return working_days_label(cfg('delay_eco_days', 2));
}

function small_extension_delay_label() {
    return hours_label(cfg('delay_small_extension_hours', 2));
}

function price_ttc_label($key, $default = 0) {
    return number_format((float)cfg($key, $default), 0, ',', ' ') . ' € TTC';
}

function projects_label() {
    return number_format((int)cfg('projects_count', 0), 0, ',', ' ');
}

function google_rating_label() {
    return number_format((float)cfg('google_rating', 0), 1, ',', '');
}

function google_reviews_label() {
    return number_format((int)cfg('google_reviews', 0), 0, ',', ' ');
}

function apply_dynamic_site_vars($html) {
    $delay = standard_delay_label();
    $projects = projects_label();
    $rating = google_rating_label();
    return str_replace(
        ['89 000+', '89 000', '1 jour ouvré', '1J ouvré', '>1 jour<', '4.7/5', '4,7/5'],
        [$projects . '+', $projects, $delay, $delay, '>' . $delay . '<', $rating . '/5', $rating . '/5'],
        $html
    );
}
