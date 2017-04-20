


<body class="sticky-header">

    <section>

        <div class="main-content" >
            <div class="page-heading">
                <h3>
                     Materials <span class="fa fa-book"></span <span class="fa fa-video-camera"></span> <span class="fa fa-music"></span>
                </h3>
                <a id = "add_courses"></a>
                <ul class="breadcrumb">
                    <li>
                        <a href="#"> Materials </a>
                    </li>
                </ul>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a id ="existing_courses"></a>
                            <?php if(isset($viewing_expired)) {
                                echo "Expired  Materials";
                            }
                            else {
                                echo "Available  Materials";
                             }
                        ?>

                        </div>
                        <?php
                        if (count($existing_materials)) {
                            ?>
                            <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>  Material Category</th>
                                                <th>  Material Name</th>
                                                <th>  Material Description</th>
                                                <th>Material Type</th>
                                                <th>Material Expiry Date</th>
                                                <th>Material Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $sn = 1;
                                            foreach ($existing_materials as $data):
                                                ?>
                                                <tr class="">
                                                    <td> <?php echo $sn; ?> </td>
                                                    <td> <?php echo isset($data->category_name)?ucwords($data->category_name):'Uncategorized'; ?> </td>
                                                    <td> <?php echo ucwords($data->material_name); ?> </td>
                                                    <td> <?php echo ucwords($data->material_description); ?> </td>
                                                    <td> <?php echo ucwords($data->material_type); ?> </td>
                                                    <td> <?php echo ucwords($data->material_expiry_date); ?> <?php if (strtotime(date('Y-m-d')) > strtotime($data->material_expiry_date) ){ echo "( Expired )";}?> </td>
                                                    <td> <?php echo ucwords($data->material_status); ?> </td>
                                                    <td>
                                                            <div class="dropdown">
                                                             <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                             <span class="caret"></span></button>
                                                             <ul class="dropdown-menu">
                                                                <li><a href="<?php echo base_url($data->material_location)?>" target="_blank"> <span class="fa fa-download"></span> Download Material</a></li>
                                                             </ul>
                                                           </div>
                                                    </td>
                                                </tr>
                                                <?php $sn++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <?php
                        }
                        else {
                            if(isset($viewing_expired)) {
                                echo getAlertMessage('Sorry : You dont have any Expired materials yet');
                            }
                            else {
                                echo getAlertMessage('Sorry : You dont have any materials yet');
                            }

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

