<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-notes-medical"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPOSYANDU</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <!-- Heading -->
    <?php
    $roleid = $this->session->userdata('role_id');
    $queryMenu = "SELECT user_menu.id,user_menu.menu FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE user_access_menu.role_id=$roleid ORDER BY user_access_menu.menu_id ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading text-gray-100">
            <?= $m['menu'];
            // echo $m['id']; 
            ?>

        </div>

        <!-- LOOPING SUB MENU -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * FROM user_sub_menu JOIN user_menu ON user_menu.id = user_sub_menu.menu_id WHERE user_sub_menu.menu_id=$menuId AND user_sub_menu.is_active = 1 ORDER BY user_sub_menu.id ASC";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        foreach ($subMenu as $sub) :
        ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url($sub['url']); ?>">
                    <i class="<?= $sub['icon']; ?>"></i>
                    <span><?= $sub['title']; ?></span></a>
            </li>
        <?php endforeach; ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    <?php endforeach; ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('about'); ?>">
                            <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                            About
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->