<?php
// include header file
    include 'header.php'; ?>
    <div class="admin-content-container">
           <!-- Display heading for user management -->
        <h2 class="admin-heading">All Users</h2>
        <?php
        // Set limit for pagination
        $limit = 10;
        $db = new Database();
          // Select user data with pagination
        $db->select('user','*',null,null,'user_id DESC',2);
        $result = $db->getResult();
        // Check if any users found
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
                    <!-- Display user information -->
                    <tr>
                        <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td>
                              <!-- Buttons for viewing, blocking/unblocking, and deleting users -->
                            <a href="" class="btn btn-xs btn-primary user-view" data-id="<?php echo $row['user_id']; ?>" data-toggle="modal" data-target="#user-detail"><i class="fa fa-eye"></i></a>
                            <?php
                            if($row['user_role'] == '1'){ ?>
                                <a href="" class="btn btn-xs btn-primary user-status" data-id="<?php echo $row['user_id']; ?>" data-status="<?php echo $row['user_role'] ?>">Block</a>
                            <?php }else{ ?>
                                <a href="" class="btn btn-xs btn-primary user-status" data-id="<?php echo $row['user_id']; ?>" data-status="<?php echo $row['user_role'] ?>"    >Unblock</a>
                            <?php   } ?>
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
             <!-- Display pagination -->
            <div class="pagination-outer">
                <?php echo $db->pagination('user',null,null,$limit); ?>
            </div>
    </div>
<!-- Modal -->
<!-- Modal for displaying user details -->
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
