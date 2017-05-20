<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?php echo Core::getInstance()->basepath;?>" class="simple-text">
                    <?php echo Core::getInstance()->title?>
                </a>
                <div class="text-center">v.<?php echo Core::getInstance()->version?></div>
            </div>

            <ul class="nav">
            <?php if (!empty($datalogin['username'])) 
            { ?>
                <?php if (Core::getRole($datalogin['token']) != 3) { // SuperUser and Admin Menu ?>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==3) echo 'class="active"';?> >
                        <a href="modul-dashboard.php?m=3&page=1&itemsperpage=10&search=">
                            <i class="ti-panel"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==5) echo 'class="active"';?> >
                        <a href="modul-data-user.php?m=5&page=1&itemsperpage=10&search=">
                            <i class="ti-id-badge"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==6) echo 'class="active"';?> >
                        <a href="modul-explore.php?m=6&page=1&itemsperpage=12&search=">
                            <i class="ti-cloud-up"></i>
                            <p>Explore</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==7) echo 'class="active"';?> >
                        <a href="modul-data-api.php?m=7&page=1&itemsperpage=10&search=">
                            <i class="ti-lock"></i>
                            <p>API Keys</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==8) echo 'class="active"';?> >
                        <a href="modul-data-author.php?m=8&page=1&itemsperpage=10&search=">
                            <i class="ti-id-badge"></i>
                            <p>Data Author</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==9) echo 'class="active"';?> >
                        <a href="modul-data-language.php?m=9&page=1&itemsperpage=10&search=">
                            <i class="ti-world"></i>
                            <p>Data Language</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==10) echo 'class="active"';?> >
                        <a href="modul-data-translator.php?m=10&page=1&itemsperpage=10&search=">
                            <i class="ti-infinite"></i>
                            <p>Data Translator</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==11) echo 'class="active"';?> >
                        <a href="modul-book-type.php?m=11&page=1&itemsperpage=10&search=">
                            <i class="ti-tag"></i>
                            <p>Book Type</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==23) echo 'class="active"';?> >
                        <a href="modul-data-publisher.php?m=23&page=1&itemsperpage=10&search=">
                            <i class="ti-agenda"></i>
                            <p>Data Publisher</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==21) echo 'class="active"';?> >
                        <a href="modul-manage-withdrawal.php?m=21&page=1&itemsperpage=10&search=">
                            <i class="ti-money"></i>
                            <p>Withdrawal</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==12) echo 'class="active"';?> >
                        <a href="modul-book-showroom.php?m=12&page=1&itemsperpage=12&search=">
                            <i class="ti-shopping-cart"></i>
                            <p>Showroom</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==13) echo 'class="active"';?> >
                        <a href="modul-book-library.php?m=13&page=1&itemsperpage=12&search=">
                            <i class="ti-book"></i>
                            <p>Library</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==14) echo 'class="active"';?> >
                        <a href="modul-pending-library.php?m=14&page=1&itemsperpage=10&search=">
                            <i class="ti-bell"></i>
                            <p>Pending Library</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==15) echo 'class="active"';?> >
                        <a href="modul-release-book.php?m=15&page=1&itemsperpage=10&search=">
                            <i class="ti-check-box"></i>
                            <p>Release Book</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==16) echo 'class="active"';?> >
                        <a href="modul-submit-book-manage.php?m=16&page=1&itemsperpage=10&search=">
                            <i class="ti-pencil-alt"></i>
                            <p>Submit Book</p>
                        </a>
                    </li>
                <?php } else {  // Member Menu ?>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==3) echo 'class="active"';?> >
                        <a href="modul-dashboard.php?m=3&page=1&itemsperpage=10&search=">
                            <i class="ti-panel"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==12) echo 'class="active"';?> >
                        <a href="modul-book-showroom.php?m=12&page=1&itemsperpage=10&search=">
                            <i class="ti-shopping-cart"></i>
                            <p>Showroom</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==13) echo 'class="active"';?> >
                        <a href="modul-book-library.php?m=13&page=1&itemsperpage=10&search=">
                            <i class="ti-book"></i>
                            <p>Library</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==17) echo 'class="active"';?> >
                        <a href="modul-submit-book.php?m=17&page=1&itemsperpage=10&search=">
                            <i class="ti-pencil-alt"></i>
                            <p>Submit Book</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==18) echo 'class="active"';?> >
                        <a href="modul-data-withdrawal.php?m=18&page=1&itemsperpage=10&search=">
                            <i class="ti-money"></i>
                            <p>Withdrawal</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==19) echo 'class="active"';?> >
                        <a href="modul-user-settings.php?m=19">
                            <i class="ti-settings"></i>
                            <p>User Settings</p>
                        </a>
                    </li>
                    <li <?php if (!empty($_GET['m'])) if($_GET['m']==20) echo 'class="active"';?> >
                        <a href="modul-faq.php?m=20">
                            <i class="ti-info-alt"></i>
                            <p>F.A.Q</p>
                        </a>
                    </li>
                <?php } ?>
        <?php } else if (pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-view-profile") { // Guest ?>
                    <li class="active">
                        <a href="<?php basename($_SERVER['REQUEST_URI'])?>">
                            <i class="ti-search"></i>
                            <p>View Profile</p>
                        </a>
                    </li>
        <?php } else { ?>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==22) echo 'class="active"';?> >
                    <a href="modul-public-showroom.php?m=22&page=1&itemsperpage=10&search=">
                        <i class="ti-shopping-cart"></i>
                        <p>Showroom</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==1) echo 'class="active"';?> >
                    <a href="modul-login.php?m=1">
                        <i class="ti-user"></i>
                        <p>Login</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==2) echo 'class="active"';?> >
                    <a href="modul-register.php?m=2">
                        <i class="ti-pencil-alt"></i>
                        <p>Register</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==7) echo 'class="active"';?> >
                    <a href="modul-contact.php?m=7">
                        <i class="ti-email"></i>
                        <p>Contact</p>
                    </a>
                </li>
            <?php } ?>
            </ul>
    	</div>