<section id="title">

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="<?php echo base_url('Home'); ?>">SaveNotes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Home'); ?>">Home</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Notes'); ?>">Notes</a>

                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Settings
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('Settings/LoginHistory'); ?>">Login History</a>
                            <a class="dropdown-item" href="<?php echo base_url('Settings/ResetPassword'); ?>">Reset Password</a>
                            <a class="dropdown-item" href="" onclick="deleteAccount()">Delete Account</a>
                            <a class="dropdown-item" href="" onclick="delteAllNotes()">Delete All Notes</a>
                            <a class="dropdown-item" href="<?php echo base_url('Settings/Logout'); ?>">Logout</a>
                            <a class="dropdown-item" href="<?php echo base_url('Settings/LogoutAllDevices'); ?>">Logout From All Devices</a>

                            <!--<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"></a>-->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Home/Contact_Us'); ?>">Contact us</a>

                    </li>

            </div>
        </nav>
        <div class="row">
            <div class="login-heading col-lg">
                <h1>Welcome : <?php $username = $this->session->userdata('login_session');
                                echo $username['username']; ?></h1>
            </div>
        </div>
    </div>

</section>