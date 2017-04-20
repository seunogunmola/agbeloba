s

<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    User Management
                </h3>
                <a id = "add_users"></a>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Manage Users</a>
                    </li>
                    <li class="active"> <a href="#existing_users"> View All Users </a></li>
                </ul>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo!empty($user->username) ? '<i class = "fa fa-edit"></i> Editing User : ' . $user->username : '<i class = "fa fa-plus"></i> Add New User' ?>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php echo $message ?>
                                    <?php echo form_open('') ?>
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" name = "username" type = "text" required ="" placeholder="Username" value = "<?php echo set_value('username', $user->username) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name = "password" placeholder="Enter text" type = "password" <?php echo empty($user->username) ? 'required = ""' : '' ?>>
                                        </div>

                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input class="form-control"  name = "fullname" type = "text" placeholder="Enter User's Fullname" value = "<?php echo set_value('fullname', $user->fullname) ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="slide-toggle">
                                                <div class="col-md-12">
                                                    <?php
                                                    $privilege = array();
                                                    if (isset($user->privileges)):
                                                        if ($user->privileges == 'superadmin') {
                                                            $privilege[] = $user->privileges;
                                                        }
                                                        else {
                                                            $privilege = explode('-', $user->privileges);
                                                        }
                                                    endif;

                                                    ?>
                                                    <input type="checkbox" name ="superadmin" id="selecctall" class="js-switch-red" onchange="check_all()"  <?php echo in_array('superadmin', $privilege) ? 'checked' : '' ?>   />
                                                    <label>Super Admin</label

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <br/>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <input type="checkbox"  name = "privileges[]" value ="website_management" class="js-switch" onclick=""  <?php echo in_array('website_management', $privilege) || in_array('superadmin', $privilege) ? 'checked' : '' ?> />
                                                        <label>Website Management</label>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <input type="checkbox" name = "privileges[]" value ="client_management" class="js-switch-blue" <?php echo in_array('client_management', $privilege) || in_array('superadmin', $privilege) ? 'checked' : '' ?>  />
                                                        <label>Client Management</label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="checkbox" name = "privileges[]" value ="resource_management" class="js-switch-pink" <?php echo in_array('resource_management', $privilege) || in_array('superadmin', $privilege) ? 'checked' : '' ?>/>
                                                        <label>Resource Management</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="form-control" name = "email_address" type = "text" placeholder="Enter User's email Address" value = "<?php echo set_value('email_address', $user->email_address) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" name = "phone_number" type = "text" placeholder="Enter User's Phone Number" required="" value = "<?php echo set_value('phone_number', $user->phone_number) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <?php
                                        $options = array('1' => 'Enabled',
                                            '2' => 'Disabled');
                                        echo form_dropdown('status', $options, set_value('status', $user->status), 'class = "form-control"')
                                        ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary"><?php echo!empty($user->username) ? '<i class = "fa fa-edit"></i> Update User' : '<i class = "fa fa-plus"></i> Add User'; ?></button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>


<?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a id ="existing_users"></a>
                            Existing Users
                        </div>
                        <?php
                        if (count($users)) {
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <a href = "<?php echo site_url('admin/users') ?>#add_users" > <button class ="btn btn-primary" style = "margin-bottom:10px"> <i class ="fa fa-plus"></i> Add New User </button> </a>

                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Username</th>
                                                <th> Fullname</th>
                                                <th>Email Address</th>
                                                <th>Phone Number</th>
                                                <th>Access Level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sn = 1;
                                            foreach ($users as $userdata):
                                                ?>
                                                <tr class="">
                                                    <td> <?php echo $sn; ?> </td>
                                                    <td> <?php echo $userdata->username; ?> </td>
                                                    <td> <?php echo ucwords($userdata->fullname); ?> </td>
                                                    <td> <?php echo $userdata->email_address; ?> </td>
                                                    <td> <?php echo $userdata->phone_number; ?> </td>
                                                    <td> <?php echo $userdata->privileges; ?> </td>
                                                    <td> <?php echo $userdata->status == 1? '<span class="label label-success"> Enabled </span>' : '<span class="label label-danger"> Disabled </span>'; ?> </td>
                                                    <td>
                                                        <?php echo getBtn('view/' . $userdata->id, 'view') ?>
        <?php echo getBtn('index/' . $userdata->id, 'edit') ?>
                                                <?php echo getBtn('delete/' . $userdata->id, 'delete') ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $sn++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <?php
                        }
                        else {
                            echo getAlertMessage('Sorry : You dont have any registered users yet');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

