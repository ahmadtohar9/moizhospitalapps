<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SecurityHook
{

    public function check_access()
    {
        $CI =& get_instance();

        // 1. Skip check for CLI requests
        if (is_cli()) {
            return;
        }

        // 2. Skip check for Auth controller (Login/Logout) to prevent infinite loops
        // Also skip 'Welcome' or default controller if public
        $class = strtolower($CI->router->fetch_class());
        if ($class === 'auth' || $class === 'welcome') {
            return;
        }

        // WHITELIST: Bypass security check untuk Dashboard Controller (User & Admin)
        // Menggunakan Class Name lebih aman daripada URI string
        if ($class === 'usercontroller' || $class === 'admincontroller' || $class === 'dashboard' || $class === 'rekammedisralancontroller') {
            return;
        }

        // 3. User must be logged in to access other controllers
        // Note: Individual controllers might handle this, but for menu security, 
        // we generally assume protected area.
        $user_id = $CI->session->userdata('user_id');
        $role_id = $CI->session->userdata('role_id');

        // If not logged in, we let the controller handle it OR strict block.
        // For now, if no user_id, we just return and let controller redirect to login
        // because some controllers might be public. 
        // However, if the URL is a MENU item, it implies it's a feature.
        if (!$user_id) {
            return;
        }

        // 4. Admin (Role ID 1) generally has full access (Super User)
        // Adjust this logic if Admins also need specific assignments.
        if ($role_id == 1) {
            return;
        }

        // 5. Get current URI path
        $current_uri = $CI->uri->uri_string();

        // Normalize URI: plain string comparison is often enough, 
        // but let's be case-insensitive for robustness.
        $current_uri_lower = strtolower($current_uri);

        // 6. Load Models
        // We need to verify if models are loaded. If not, load them.
        if (!isset($CI->MenuModel)) {
            $CI->load->model('MenuModel');
        }
        if (!isset($CI->UserAccessModel)) {
            $CI->load->model('UserAccessModel');
        }

        // 7. Get List of ALL Menus (Potentially Restricted Areas)
        // Optimization: In production, caching this result is recommended.
        $all_menus = $CI->MenuModel->get_all_menus();

        // 8. Get User's Assigned Menus
        $user_menu_ids = $CI->UserAccessModel->get_user_menus($user_id);

        $is_known_menu_url = false;
        $has_permission = false;

        foreach ($all_menus as $menu) {
            $menu_url = trim($menu['menu_url']);

            // Skip empty or placeholder URLs
            if (empty($menu_url) || $menu_url === '#' || $menu_url === 'javascript:void(0);') {
                continue;
            }

            // CHECK: Does current URL start with this Menu URL?
            // Case insensitive comparison
            $menu_url_lower = strtolower($menu_url);

            // We use strpos to check if the current URI is a "child" of the menu URL 
            // e.g. Menu: "users", Current: "users/add" -> Match.
            // Using a trailing slash check prevents partial matches like "user" matching "users"
            if ($current_uri_lower === $menu_url_lower || strpos($current_uri_lower, $menu_url_lower . '/') === 0) {

                $is_known_menu_url = true;

                // We found a menu definition for this path.
                // Now check if user has the right ID.
                if (in_array($menu['id'], $user_menu_ids)) {
                    $has_permission = true;
                    // User has access to at least one menu item covering this URL.
                    // We can stop searching and ALLOW access.
                    break;
                }
            }
        }

        // 9. Enforcement
        // If it looks like a menu item (is_known_menu_url) but user has NO permission assignment:
        if ($is_known_menu_url && !$has_permission) {

            // Handle AJAX requests gracefully
            if ($CI->input->is_ajax_request()) {
                $CI->output
                    ->set_status_header(403)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'error',
                        'message' => '⛔ Akses Ditolak: Anda tidak memiliki izin untuk fitur ini.'
                    ]));
                $CI->output->_display();
                exit;
            } else {
                // Show Error Page
                show_error(
                    '<h3>⛔ Akses Ditolak</h3>
                     <p>Anda tidak memiliki hak akses untuk membuka halaman ini.</p>
                     <p>URL: <code>' . html_escape($current_uri) . '</code></p>
                     <hr>
                     <a href="' . base_url('user/dashboard') . '" class="btn">Kembali ke Dashboard</a>',
                    403,
                    '403 Forbidden'
                );
                exit;
            }
        }

        // Implicit Else:
        // If URL is NOT in the menu table (e.g. valid internal controller like 'tools/download'), 
        // we ALLOW it by default (assuming it doesn't need menu-level protection or has its own checks).
        // OR
        // User has permission.
    }
}
