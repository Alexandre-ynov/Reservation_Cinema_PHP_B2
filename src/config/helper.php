<?php

/**
 * Global redirect function
 * Handles base path automatically for any deployment structure
 * @param string $path The path to redirect to (e.g., '/login', '/booking', etc.)
 * @return void
 */
function redirect($path) {
    $base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $full_path = $base_path . $path;
    header('Location: ' . $full_path);
    exit();
}
