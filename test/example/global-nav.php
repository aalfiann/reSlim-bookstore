                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (Core::getRole($datalogin['token']) == 1) { // SuperUser Only
                            echo '<li>
                                <a href="modul-settings.php?m=8">
                                    <i class="ti-settings"></i>
            						<p>'.Core::lang('settings').'</p>
                                </a>
                            </li>'; 
                            };?>

                        <?php if (pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-book-library" || 
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-book-showroom" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-author-library" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-publisher-library" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-tags-library" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-title-library" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-translator-library" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-type-library" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-author-showroom" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-publisher-showroom" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-tags-showroom" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-title-showroom" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-translator-showroom" ||
                        pathinfo(basename($_SERVER['REQUEST_URI']), PATHINFO_FILENAME) == "modul-index-type-showroom") {
                            echo '<li>
                                <a href="#" data-toggle="modal" data-target="#index">
                                    <i class="ti-align-justify"></i>
            						<p>'.Core::lang('index_menu').'</p>
                                </a>
                            </li>'; 
                        }?>
                        
                        <?php if (!empty($datalogin['username'])) {
                            echo '<li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-user"></i>
                                    
									<p>'.$datalogin['username'].'</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="modul-user-profile.php?m=4">'.Core::lang('my_profile').'</a></li>
                                <li><a href="modul-faq.php?m=20">'.strtolower(Core::lang('faq')).'</a></li>
                                <li><a href="logout.php">'.Core::lang('logout').'</a></li>
                              </ul>
                        </li>';
                        }?>
                    </ul>

                </div>