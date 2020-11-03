<?php
  $dbConfig->unauthorizedRedirect();
	include '../classes/user.php';
 ?>
    <section class="section">
        <div class="section-header">
            <h1>All Customers</h1>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
	                <div class="card">
	                    <div class="card-header">
	                        <h4>All Customers</h4>
	                    </div>
	                    <div class="card-body">
	                        <div class="table-responsive">
	                            <table class="table table-striped v_center" id="table-2">
	                                <thead>
	                                    <tr>
	                                    <th>#</th>
	                                    <th>First Name</th>
	                                    <th>Last Name</th>
	                                    <th>Email</th>
	                                    <th>Last Login</th>
	                                    <th>Details</th>
	                                    <!-- <th>Edit</th> -->
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php 
	                                		$customer_query = $user->getAllCustomers();

	                                		$i = 0;
	                                		while($customer_data = mysqli_fetch_assoc($customer_query)){
	                                			$i += 1;

	                                	 ?>
	                                    <tr>
	                                    <td><?=$i; ?></td>
	                                    <td><?=$customer_data['first_name'];  ?></td>
	                                    <td><?=$customer_data['last_name'];  ?></td>
	                                    <td><?=$customer_data['email'];  ?></td>
	                                    <td><?php echo date('l jS F\, Y', strtotime($customer_data['last_login'])) . ' | ' . date('g:iA', strtotime($customer_data['last_login'])); ?></td>
	                                    <td><a href="index.php?user_single=<?=$customer_data['id'] ?>" class="btn btn-sm btn-primary"data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-eye"></i></a></td>
	                                    <!-- <td><a href="customer_register.php?customer_edit=<?=$customer_data['id'] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td> -->
	                                    </tr>
	                                  <?php } ?>
	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
    </section>