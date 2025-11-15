<?php
/**
 * Theme Updater - GitHub Integration
 * Detecta y actualiza automáticamente el tema desde GitHub Releases
 */

if (!defined('ABSPATH')) {
    exit;
}

class RGMUSIC_Theme_Updater {
    
    private $theme_slug;
    private $theme_data;
    private $username;
    private $repository;
    private $github_response;
    
    public function __construct() {
        $this->theme_slug = get_stylesheet();
        $this->theme_data = wp_get_theme($this->theme_slug);
        
        // Configuración del repositorio GitHub
        $this->username = 'unmediacode';
        $this->repository = 'rgmusic-theme'; // Cambiar al nombre de tu repositorio
        
        add_filter('pre_set_site_transient_update_themes', array($this, 'check_for_update'));
        add_filter('upgrader_source_selection', array($this, 'fix_source_folder'), 10, 3);
    }
    
    /**
     * Obtener información del repositorio desde GitHub
     */
    private function get_repository_info() {
        if (is_null($this->github_response)) {
            $request_uri = sprintf('https://api.github.com/repos/%s/%s/releases/latest', 
                $this->username, 
                $this->repository
            );
            
            $response = wp_remote_get($request_uri);
            
            if (is_wp_error($response)) {
                return false;
            }
            
            $response = json_decode(wp_remote_retrieve_body($response), true);
            
            if (is_array($response)) {
                $this->github_response = $response;
            }
        }
        
        return $this->github_response;
    }
    
    /**
     * Verificar si hay actualizaciones disponibles
     */
    public function check_for_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }
        
        $this->get_repository_info();
        
        if (isset($this->github_response['tag_name'])) {
            $remote_version = str_replace('v', '', $this->github_response['tag_name']);
            $local_version = $this->theme_data->get('Version');
            
            if (version_compare($remote_version, $local_version, '>')) {
                $transient->response[$this->theme_slug] = array(
                    'theme' => $this->theme_slug,
                    'new_version' => $remote_version,
                    'url' => $this->github_response['html_url'],
                    'package' => $this->github_response['zipball_url'],
                );
            }
        }
        
        return $transient;
    }
    
    /**
     * Corregir el nombre de la carpeta después de la instalación
     */
    public function fix_source_folder($source, $remote_source, $upgrader) {
        global $wp_filesystem;
        
        // Solo aplicar para nuestro tema
        if (!isset($upgrader->skin->theme_info) || 
            $upgrader->skin->theme_info->get_stylesheet() !== $this->theme_slug) {
            return $source;
        }
        
        // Corregir el nombre de la carpeta extraída de GitHub
        $corrected_source = trailingslashit($remote_source) . trailingslashit($this->theme_slug);
        
        if ($wp_filesystem->move($source, $corrected_source)) {
            return $corrected_source;
        }
        
        return $source;
    }
}

// Inicializar el updater solo en el admin
if (is_admin()) {
    new RGMUSIC_Theme_Updater();
}
