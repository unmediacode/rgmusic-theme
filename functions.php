<?php
/**
 * Tema hijo YOOtheme RGMUSIC
 * 
 * Este archivo carga los estilos del tema padre y del tema hijo.
 * Personaliza colores, tipografías y otros estilos en /css/custom.css
 */

// Incluir el sistema de actualización automática desde GitHub
require_once get_stylesheet_directory() . '/includes/theme-updater.php';

// Cargar estilos del tema padre y tema hijo
add_action('wp_enqueue_scripts', 'yootheme_pareli_enqueue_styles', 20);
function yootheme_pareli_enqueue_styles() {
    // Cargar la hoja de estilos del tema padre YOOtheme Pro
    wp_enqueue_style(
        'yootheme-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    // Cargar la hoja de estilos del tema hijo
    wp_enqueue_style(
        'yootheme-pareli-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['yootheme-parent-style'],
        wp_get_theme()->get('Version')
    );
    
    // Cargar estilos personalizados
    wp_enqueue_style(
        'yootheme-pareli-custom',
        get_stylesheet_directory_uri() . '/css/custom.css',
        ['yootheme-pareli-style'],
        wp_get_theme()->get('Version')
    );
    
    // Cargar JavaScript del reproductor de vinilo
    wp_enqueue_script(
        'yootheme-pareli-vinyl-player',
        get_stylesheet_directory_uri() . '/js/vinyl-player.js',
        [], // Sin dependencias
        wp_get_theme()->get('Version'),
        true // Cargar en el footer
    );
}

// Puedes añadir aquí tus propias funciones PHP para extender
// funcionalidades de YOOtheme Pro sin modificar el tema padre.
