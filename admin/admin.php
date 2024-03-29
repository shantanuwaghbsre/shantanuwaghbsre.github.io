<!-- include header file -->
<?php include 'header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="add-data" href="add-user.php">add new admin</a>
        </div>
    </div> 
</div>   
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                // database configuration
                include 'config.php';
                  // SQL query to select all admins
                $sql = "SELECT * FROM  admin ORDER BY admin_id DESC";
                $result = mysqli_query($conn, $sql);
                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                     // Display table header
                echo '<table>';
                echo '<tr><th>Admin_id</th><th>Admin_Name</th><th>Username</th><th>Admin_Role</th><th>Edit</th></tr>';
                 // Loop through each row
                while($row = mysqli_fetch_assoc($result)) {  
                      // Display admin data in table rows
                echo "<tr>
                        <td class='id'>{$row["admin_id"]}</td>
                        <td>{$row["admin_name"]}</td>
                        <td>{$row["username"]}</td>
                        <td>";
                         // Check admin role and display accordingly
                        if($row["admin_role"] == '1'){
                            echo "Admin";     
                        }else{
                            echo "Normal";     
                        }
                echo  "</td>
                        <td class='edit'><a href='update_admin.php?id={$row['admin_id']}'><i class='fa fa-edit'></i></a></td>
                    </tr>";               
                }  // Close table
                    echo '</table>'; 
                } else {
                    // If no results found
                    echo "0 results";
                }    
                // Close database connection
                mysqli_close($conn);
                include "footer.php"; 
            ?>    












            