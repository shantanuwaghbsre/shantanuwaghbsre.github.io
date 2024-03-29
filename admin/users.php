<?php
// include header file
    include 'header.php'; ?>
    <!-- Start admin-content-container -->
    <div class="admin-content-container">
        <!-- Heading for All Users -->
        <h2 class="admin-heading">All Users</h2>
        <?php
        // Define limit for pagination
        $limit = 10;
         // Initialize Database object
        $db = new Database();
         // Select all user details, ordered by user_id in descending order, limited to 10 records per page
        $db->select('user','*',null,null,'user_id DESC',2);
         // Get the result of the query
        $result = $db->getResult();
        // Check if there are any users
        if (count($result) > 0) { ?>
             <!-- Display users in a table -->
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th >Action</th>
                </thead>
                <tbody>
                <?php foreach($result as $row) { ?>
                    <tr>
                        <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td>
                             <!-- Button to view user details in a modal -->
                            <a href="" class="btn btn-xs btn-primary user-view" data-id="<?php echo $row['user_id']; ?>" data-toggle="modal" data-target="#user-detail"><i class="fa fa-eye"></i></a>
                            <?php
                             // Check user role to display appropriate action button
                            if($row['user_role'] == '1'){ ?>
                                <a href="" class="btn btn-xs btn-primary user-status" data-id="<?php echo $row['user_id']; ?>" data-status="<?php echo $row['user_role'] ?>">Block</a>
                            <?php }else{ ?>
                                <a href="" class="btn btn-xs btn-primary user-status" data-id="<?php echo $row['user_id']; ?>" data-status="<?php echo $row['user_role'] ?>"    >Unblock</a>
                            <?php   } ?>
                            <!-- Button to delete user -->
                            <a class="btn btn-xs btn-danger delete_user" href="javascript:void();" data-id="<?php echo $row['user_id']; ?>"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php }else{ ?>
                <!-- Display message if no users found -->
            <div class="not-found clearfix">!!! No Users Found !!!</div>
            <?php  }  ?>
             <!-- Pagination section -->
            <div class="pagination-outer">
                <?php echo $db->pagination('user',null,null,$limit); ?>
            </div>
    </div>
<!-- Modal -->
<!-- Modal for user detail -->
<div class="modal fade" id="user-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
<?php
//    include footer file
include "footer.php";
?>
