
<!-- START NAVBAR -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="<?php echo $img . 'logo.png'?>" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo isset($admin['name'])? ucwords($admin['name']): '';?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="user_edit.php?id=<?php echo $admin['id']?>">Profile</a>
                <a class="dropdown-item" href="#">Vist Website</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">LogOut</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END NAVBAR -->

<!-- Start The Content -->
<div class="left-side" id="door">
    <div class="menu-col">
        <div class="tools">
        <!-- START TOOL -->
        <div class="tool hover">
                <a href="roles_view.php" class="">
                    <i class="fas fa-plus"></i>
                    <span class="text"><b>Roles</b></span>
                </a>
                <ul class="hide sub-ul">
                    <li><a href="role_create.php"> - Create</a></li>
                    <li><a href="roles_view.php?active=off"> - Not Active</a></li>
                </ul>
        </div>	
        <!-- START TOOL -->
        <!-- START TOOL -->
        <div class="tool hover">
            <a href="users_view.php" class="">
                <i class="fas fa-user"></i>
                <span class="text"><b>Users</b></span>
            </a>
            <ul class="hide sub-ul">
                <li><a href="user_create.php"> - Create</a></li>
                <li><a href="users_view.php?active=off"> - Not Active</a></li>
            </ul>
        </div>	
        <!-- START TOOL -->
        </div>
    </div>
</div>