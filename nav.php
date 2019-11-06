 <a class="navbar-brand" href="/">VPD Calculator</a>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <?php if(isset($_SESSION["loggedin"])){?>
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="mod1.php">Calculate VPD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mod2.php">Calculate VPD'</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uploadcsv.php">Upload CSV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="get_charts1.php">Get Charts</a>
                    </li>
                    
                </ul>
                                <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle"
                            data-toggle="dropdown" id="navbarDropdownMenuLink">Settings</a>
                            <div class="dropdown-menu">
                                <a href="change_pwd.php" class="dropdown-item">Change Password</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>

                </ul>
                <?php } else{?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="register.php" class="nav-link">Register</a>
                        </li>

                </ul>
                <?php } ?>
                </div>
                           

        </div>
    </nav>