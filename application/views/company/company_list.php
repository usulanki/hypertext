<section class="content-header">
	<div class="container-fluid">
		<div class="col-md-12 mt-1 page_heading_div">
	        <h3>Company List</h3>
	    </div>
	</div>
</section>



<section class="content">
	<div class="container-fluid">
		<div class="col-md-12 page_body_div">
	        <table class="table datatable table-bordered table-striped">
                <thead>
	                <tr>
	                	<th>Sl.No</th>
	                  	<th>Company Name</th>
	                  	<th>Admin Name</th>
                        <th>Admin Email-id</th>
	                  	<th>Validation Start Date</th>
	                  	<th>Validation End Date</th>
                        <th>Total Employees</th>
	                  	<th>Status</th>
	                </tr>
                </thead>
                <tbody>
                    <?php 
                        $sl_no = 1;
                        if(isset($company_list)){
                            foreach ($company_list as $key => $value) {
                                ?>
                                <tr>
                                    <td><?= $sl_no++ ; ?></td>
                                    <td><?= $value['company_name'] ; ?></td>
                                    <td><?= $value['company_admin_name'] ; ?></td>
                                    <td><?= $value['company_admin_email_id'] ; ?></td>
                                    <td><?= $value['company_validity_start_date'] ; ?></td>
                                    <td><?= $value['company_validity_end_date'] ; ?></td>
                                    <td><?= $value['company_validity_end_date'] ; ?></td>
                                    <td><?= $value['company_status'] ; ?></td>
                                    <!-- <td>
                                        <div class="text-center">
                                            <button class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-warning"><i class="fa fa-eye"></i></button>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
              </table>
	    </div>
	</div>
</section>
 