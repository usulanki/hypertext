<?php
    $logged_user_type = $this->session->userdata('user_type');
    $logged_user_name = $this->session->userdata('user_full_name');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <!-- Logo -->
    <a class="navbar-brand" href="#">
        <img 
            src="<?= base_url('assets/images/logo/hypertextdev.png');?>" 
            class="d-inline-block align-top header_logo " 
            alt="Logo">
    </a>

    <!-- collapse icon -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <?php
                //Company 
                if($logged_user_type == 'SUPER_ADMIN'){
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url('list_companies') ?>">
                            Companies
                        </a>
                     </li>
                    <?php
                }
            ?>
            
            
        </ul>
        
        <ul class="navbar-nav ml-auto">

            <!-- Displaying user name -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <small class="text-muted">
                        <?= $logged_user_type; ?> 
                    </small>
                    <?= $logged_user_name;?>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout'); ?>">
                    Logout
                </a>
            </li>

        </ul>

    </div>

</nav>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">