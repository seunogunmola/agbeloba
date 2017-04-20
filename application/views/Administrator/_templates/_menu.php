            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="<?php echo site_url('Administrator/dashboard') ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-users"></i> <span>Manage Farmers</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo site_url('Administrator/Farmers/Register')?>"> Create Farmer</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-shopping-cart"></i> <span>Manage Farm Produce</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo site_url('Administrator/Produce/Types')?>"> Manage Produce Types</a></li>
                        <li><a href="<?php echo site_url('Administrator/Produce/Categories')?>"> Manage Produce Categories</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-cogs"></i> <span>Configuration</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo site_url('Administrator/Config/Lgas')?>"> Manage LGAs</a></li>
                        <li><a href="<?php echo site_url('Administrator/Config/States')?>"> Manage States</a></li>
                        <li><a href="<?php echo site_url('Administrator/Config/Countries')?>"> Manage Countries</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>