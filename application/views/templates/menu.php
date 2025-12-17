<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $nama_user; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <?php
            if (!empty($menus)):

                // Ambil menu utama yang tidak memiliki parent (NULL atau 0)
                // Ambil menu utama yang tidak memiliki parent (NULL atau 0)
                $mainMenus = array_filter($menus, function ($m) {
                    // Parent menu valid kalau tidak punya parent_id 
                    // DAN punya nama menu. URL boleh kosong (misal parent yg cuma dropdown).
                    return (!isset($m['parent_id']) || intval($m['parent_id']) === 0)
                        && !empty($m['menu_name']);
                });

                // Helper to check if url is active
                $current_uri = $this->uri->uri_string();

                foreach ($mainMenus as $menu): ?>
                    <?php if (!empty($menu['is_active']) && $menu['is_active'] == 1): ?>
                        <?php
                        // Get Submenus
                        $subMenus = array_filter($menus, function ($s) use ($menu) {
                            return isset($s['parent_id']) && intval($s['parent_id']) === intval($menu['id']) && $s['is_active'] == 1;
                        });

                        // Check active state for parent (if any child is active)
                        $isActiveParent = false;

                        // Check self if no submenu or url match
                        if (!empty($menu['menu_url']) && $menu['menu_url'] != '#' && strpos($current_uri, $menu['menu_url']) === 0) {
                            $isActiveParent = true;
                        }

                        // Check children
                        foreach ($subMenus as $sub) {
                            if (!empty($sub['menu_url']) && strpos($current_uri, $sub['menu_url']) === 0) {
                                $isActiveParent = true;
                                break;
                            }
                        }

                        $parentClass = '';
                        if (!empty($menu['has_submenu']) && $menu['has_submenu'] > 0) {
                            $parentClass .= 'treeview';
                        }
                        if ($isActiveParent) {
                            $parentClass .= ' active menu-open';
                        }
                        ?>
                        <li class="<?= $parentClass; ?>">
                            <a href="<?= !empty($menu['menu_url']) ? base_url($menu['menu_url']) : '#'; ?>">
                                <i class="fa <?= !empty($menu['icon']) ? $menu['icon'] : 'fa-circle-o'; ?>"></i>
                                <span><?= $menu['menu_name']; ?></span>
                                <?php if (!empty($menu['has_submenu'])): ?>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                <?php endif; ?>
                            </a>

                            <?php if (!empty($subMenus)): ?>
                                <ul class="treeview-menu">
                                    <?php foreach ($subMenus as $submenu): ?>
                                        <?php
                                        // Active state for submenu
                                        $isSubActive = (!empty($submenu['menu_url']) && strpos($current_uri, $submenu['menu_url']) === 0) ? 'active' : '';
                                        // Handle special exact match for dashboard to avoid partial match false positives if needed, but usually prefix is fine.
                                        ?>
                                        <li class="<?= $isSubActive; ?>">
                                            <a href="<?= !empty($submenu['menu_url']) ? base_url($submenu['menu_url']) : '#'; ?>">
                                                <i class="fa <?= !empty($submenu['icon']) ? $submenu['icon'] : 'fa-circle-o'; ?>"></i>
                                                <?= $submenu['menu_name']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php else: ?>
                <li class="text-center text-danger">⚠ Tidak ada menu yang tersedia</li>
            <?php endif; ?>

            <!-- Admin Menu Management -->
            <?php if ($this->session->userdata('role_id') == 1): ?>
                <li class="header">ADMIN MENU</li>
                <li><a href="<?= base_url('menu-manager'); ?>"><i class="fa fa-cogs"></i> <span>Kelola Menu</span></a></li>
                <li><a href="<?= base_url('rme-menu'); ?>"><i class="fa fa-list-alt"></i> <span>Master Menu RME</span></a>
                </li>
                <li><a href="<?= base_url('user-manager'); ?>"><i class="fa fa-users"></i> <span>Kelola User</span></a></li>
                <li><a href="<?= base_url('user-access'); ?>"><i class="fa fa-lock"></i> <span>Hak Akses User</span></a>
                </li>
            <?php endif; ?>

            <!-- Log Out Menu -->
            <li class="header">USER MENU</li>
            <li>
                <a href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Apakah Anda yakin ingin logout?');">
                    <i class="fa fa-sign-out"></i> <span>Log Out</span>
                </a>
            </li>
        </ul>
    </section>
</aside>