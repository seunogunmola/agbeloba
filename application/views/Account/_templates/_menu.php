            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="<?php echo site_url('Account/dashboard') ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>Manage Your Account</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo site_url('Account/Accounts')?>"> View Your Account Details</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-money"></i> <span>Manage Payments</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo site_url('Account/Payments')?>"> Pending Payments</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span> Course Materials</span></a>
                    <ul class="sub-menu-list">
                        <?php if (isset($materials_category)):
                                foreach($materials_category as $category):
                        ?>

                        <li><a href="<?php echo site_url('Account/Materials/View_category/'.$category->uniqueid)?>"> <?php echo $category->material_category_name?></a></li>

                        <?php
                                endforeach;
                            endif;?>
                        <li><a href="<?php echo site_url('Account/Materials/View')?>"> View All Course Materials</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>