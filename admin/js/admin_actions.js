$(document).ready(function(){
    // Get the origin of the current URL 
    var origin = window.location.origin;
    // Split the pathname of the current URL by '/' to extract the path segments
    var path = window.location.pathname.split( '/' );
    // Combine the origin and the first path segment to construct the base URL
    var URL = origin+'/'+path[1]+'/';

    
    // check user login
    // =======================
    // Listen for form submission
    $('#adminLogin').submit(function(e){
         // Prevent default form submission
        e.preventDefault();
          // Get the values of username and password fields
        var username = $('.username').val();
        var password = $('.password').val();
         // Check if username or password is empty
        if(username == '' || password == ''){
             // Append error message if either field is empty
            $('#adminLogin').append('<div class="alert alert-danger">Please Fill All The Fields.</div>');
        }else{  // If both fields are filled, make an AJAX request
            $.ajax({
                 // URL to send the request to
                url    : "./php_files/check_login.php",
                type   : "POST",   // Request type
                data   : {login:'1',name:username,pass:password},// Data to send with the request
                // Callback function to handle successful response
                success: function(response){
                    // Hide any existing alerts
                    $('.alert').hide();
                     // Parse the response as JSON
                    var res = JSON.parse(response);
                     // Check if the response contains 'success' property
                    if(res.hasOwnProperty('success')){
                           // If 'success' property exists, show success message
                        $('#adminLogin').append('<div class="alert alert-success">Logged In Successfully.</div>');
                         // Redirect to the dashboard after a delay
                        setTimeout(function(){ window.location = origin +'/admin/dashboard.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        // If 'error' property exists, show error message
                        $('#adminLogin').append('<div class="alert alert-danger">Username and Password not Matched.</div>');
                    }
                }
            });
        }
    });

    // Listen for form submission
    $('#changePassword').submit(function(e){
        // Prevent default form submission
        e.preventDefault();
        // Hide any existing alerts
        $('.alert').hide();
         // Get the values of old password and new password fields
        var oldPass = $('.old_pass').val();
        var newPass = $('.new_pass').val();
           // Check if old password or new password is empty
        if(oldPass == '' || newPass == ''){
              // Prepend error message if either field is empty
            $('#changePassword').prepend('<div class="alert alert-danger">Please Fill All The Fields.</div>');
        }else{
             // Create a new FormData object with the form data
            var formdata = new FormData(this);
              // Append 'changePass' field to the form data
            formdata.append('changePass','1')
               // Make an AJAX request
            $.ajax({
                 // URL to send the request to
                url    : "./php_files/check_login.php",
                  // Request type
                type   : "POST",
                 // Set contentType and processData to false for handling FormData
                contentType: false,
                processData: false,
                // Data to send with the request
                data   : formdata,
                // Callback function to handle successful response
                success: function(response){
                     // Hide any existing alerts
                    $('.alert').hide();
                     // Log the response to console
                    console.log(response);
                      // Parse the response as JSON
                    var res = JSON.parse(response);
                     // Check if the response contains 'success' property
                    if(res.hasOwnProperty('success')){
                        // If 'success' property exists, prepend success message
                        $('#changePassword').prepend('<div class="alert alert-success">Password Changed Successfully.</div>');
                        // Redirect to the dashboard after a delay
                        setTimeout(function(){ window.location = URL+'admin/dashboard.php'; }, 1000);
                    }else if(res.hasOwnProperty('error')){
                        // If 'error' property exists, prepend error message
                        $('#changePassword').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            });
        }
    });


    // show sub categories
    // Show sub categories based on selected product category
    $('.product_category').change(function(){
         // Get the selected product category ID
        var id = $('.product_category option:selected').val();
         // Send an AJAX request to fetch sub categories and brands
        $.ajax({
              // URL to send the request to
            url    : "./php_files/products.php",
             // Request type
            type   : "POST",
            // Data to send with the request (product category ID)
            data   : {p_cat:id},
                 // Callback function to handle successful response
            success: function(response){
                  // Parse the response as JSON
                var res = JSON.parse(response);
                   // Check if the response contains sub categories
                if(res.hasOwnProperty('sub_category')){
                     // Initialize a variable to store sub category options
                    var sub_cat = '<option value="" selected disabled>Select Sub Category</option>';
                       // Get the length of the sub category array
                    var sub_cat_length = res.sub_category.length;
                      // Loop through each sub category
                    for(var i = 0;i<sub_cat_length;i++){
                         // Append each sub category option to the variable
                        sub_cat += '<option value="'+res.sub_category[i].sub_cat_id+'">'+res.sub_category[i].sub_cat_title+'</option>';
                    }  // Set the HTML content of the sub category select element
                    $('.product_sub_category').html(sub_cat);
                }// Check if the response contains brands
                if(res.hasOwnProperty('brands')){
                     // Initialize a variable to store brand options
                    var brand = '<option value="" selected disabled>Select Brand</option>';
                         // Get the length of the brands array
                    var brand_length = res.brands.length;
                     // Check if brands are found
                    if(brand_length > 0){
                         // Loop through each brand
                        for(var j = 0;j<brand_length;j++){
                            // Append each brand option to the variable
                            brand += '<option value="'+res.brands[j].brand_id+'">'+res.brands[j].brand_title+'</option>';
                        }
                    }else{
                          // If no brands are found, display a message
                        brand = '<option value="" selected disabled>No Brands Found</option>';
                    }
                      // Set the HTML content of the brand select element
                    $('.product_brands').html(brand);
                }
            }
        });
    });

    // load product image with jquery
    $('.product_image').change(function(){
        readURL(this);
    })

    // add product
    $('#createProduct').submit(function(e){
        e.preventDefault();
        $('.alert').hide();
        // Get form input values
        var title = $('.product_title').val();
        var cat = $('.product_category option:selected').val();
        var sub_cat = $('.product_sub_category option:selected').val();
        var des = $('.product_description').val();
        var price = $('.product_price').val();
        var qty = $('.product_qty').val();
        var status = $('.product_status').val();
        var image = $('.product_image').val();
         // Check for empty fields
        if(title == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        }else if(cat == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
        }else if(sub_cat == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Sub Category Field is Empty.</div>');
        }else if(des == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
        }else if(price == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
        }else if(qty == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
        }else if(image == ''){
            $('#createProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
        }else{
             // If all fields are filled, prepare form data
            var formdata = new FormData(this);
            formdata.append('create',1);
             // Send AJAX request to add product
            $.ajax({
                url    : "./php_files/products.php",
                type   : "POST",
                data   : formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide();
                    console.log(response);
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#createProduct').prepend('<div class="alert alert-success">Product Added Successfully.</div>');
                         // Redirect to product page after 1 second
                        setTimeout(function(){ window.location = URL+'admin/products.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#createProduct').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            });
        }

    });

    // update product
    $('#updateProduct').submit(function(e){
        e.preventDefault();
        $('.alert').hide();
        // Get form input values
        var title = $('.product_title').val();
        var cat = $('.product_category option:selected').val();
        var sub_cat = $('.product_sub_category option:selected').val();
        var des = $('.product_description').val();
        var price = $('.product_price').val();
        var qty = $('.product_qty').val();
        var status = $('.product_status').val();
        var image = $('.product_image').val();
        var old_image = $('.old_image').val();
        // Check for empty fields
        if(title == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        }else if(cat == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
        }else if(sub_cat == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Sub Category Field is Empty.</div>');
        }else if(des == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
        }else if(price == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
        }else if(qty == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
        }else if(image == '' && old_image == ''){
            $('#updateProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
        }else{
            // If all fields are filled, prepare form data
            var formdata = new FormData(this);
            formdata.append('update',1);
              // Send AJAX request to update product
            $.ajax({
                url    : "./php_files/products.php",
                type   : "POST",
                data   : formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide();
                    console.log(response);
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#updateProduct').prepend('<div class="alert alert-success">Product Added Successfully.</div>');
                         // Redirect to product page after 1 second
                        setTimeout(function(){ window.location = URL+'admin/products.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#updateProduct').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            });
        }

    });


    // delete product
    $('.delete_product').click(function(){
        var tr = $(this);
        var id = $(this).attr('data-id');
        var sub_cat = $(this).attr('data-subcat');
        if(confirm('Are you Sure want to delete this')){
            $.ajax({
                url: './php_files/products.php',
                type: 'POST',
                data: {delete_id:id,p_subcat:sub_cat},
                dataType: 'json',
                success: function(response){
                    var res = response;
                    if(res.hasOwnProperty('success')){
                         // Remove the product row from the table upon successful deletion
                        tr.parent().parent('tr').remove();
                        
                    }else if(res.hasOwnProperty('error')){
                           // Handle error if any
                        // $('#updateProduct').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            });
        }
    });

    // add category
    $('#createCategory').submit(function(e){
        e.preventDefault();  // Prevent the default form submission
         // Retrieve the category value
        var cat = $('.category').val();
         // Check if the category field is empty
        if(cat == ''){
            $('#createCategory').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
        }else{
             // Create a FormData object to send form data asynchronously
            var formdata = new FormData(this);
            formdata.append('create','1'); // Add a flag indicating category creation
               // Send an AJAX request to the PHP script
            $.ajax({
                url: './php_files/category.php',
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide(); // Hide any existing alerts
                    console.log(response);
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#createCategory').prepend('<div class="alert alert-success">Category Added Successfully.</div>');
                         // Redirect to the category page after a delay
                        setTimeout(function(){ window.location = URL+'admin/category.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#createCategory').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            })
        }
    });

    // update category
    // Handle category update form submission
    $('#updateCategory').submit(function(e){
        e.preventDefault();  // Prevent default form submission
         // Retrieve the category value
        var cat = $('.cat_name').val();
         // Check if the category field is empty
        if(cat == ''){
            $('#updateCategory').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
        }else{
            // Create a FormData object to send form data asynchronously
            var formdata = new FormData(this);
            formdata.append('update','1');
             // Send an AJAX request to the PHP script
            $.ajax({
                url: './php_files/category.php',
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide();  // Hide any existing alerts
                    console.log(response);
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#updateCategory').prepend('<div class="alert alert-success">Category Modified Successfully.</div>');
                        // Redirect to the category page after a delay
                        setTimeout(function(){ window.location = URL+'admin/category.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#updateCategory').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            })
        }
    });

    // delete category
    // Handle category deletion
    $('.delete_category').click(function(){
        var tr = $(this);  // Reference to the clicked delete button
        var id = $(this).attr('data-id'); // Get the category ID from the data attribute
         // Confirm the deletion action with the user
        if(confirm('Are you Sure want to delete this')){
              // Send an AJAX request to delete the category
            $.ajax({
                url: './php_files/category.php',
                type: 'POST',
                data: {delete_id:id}, // Send the category ID to be deleted
                dataType: 'json',
                success: function(response){
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        tr.parent().parent('tr').remove(); // Remove the deleted category row from the table
                    }
                }
            });
        }
    });



    // add sub category
    // Handle submission of the create subcategory form
    $('#createSubCategory').submit(function(e){
        e.preventDefault(); // Prevent default form submission
        $('.alert').hide(); // Hide any existing alert messages
         // Retrieve input values
        var title = $('.sub_category').val();
        var parent = $('.parent_cat option:selected').val();
          // Validate input fields
        if(title == ''){
            $('#createSubCategory').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        }else if(parent == ''){
            $('#createSubCategory').prepend('<div class="alert alert-danger">Parent Category Field is Empty.</div>');
        }else{ // If input fields are valid, prepare form data for AJAX submission
            var formdata = new FormData(this);
            formdata.append('create','1');
             // Send AJAX request to create subcategory
            $.ajax({
                url: './php_files/sub_category.php',
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide(); // Hide any existing alert messages
                    console.log(response);  // Log the response to the console for debugging
                    var res = response;  // Handle response from the server
                    if(res.hasOwnProperty('success')){
                        $('#createSubCategory').prepend('<div class="alert alert-success">Sub Category Added Successfully.</div>');
                        setTimeout(function(){ window.location = URL+'admin/sub_category.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#createSubCategory').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            })
        }
    });

    // update sub category
    // Handle submission of the update subcategory form
    $('#updateSubCategory').submit(function(e){
        e.preventDefault(); // Prevent default form submission
         // Retrieve input values
        var title = $('.sub_category').val();
        var parent = $('.parent_cat option:selected').val();
         // Validate input fields
        if(title == ''){
            $('#updateSubCategory').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        }else if(parent == ''){
            $('#updateSubCategory').prepend('<div class="alert alert-danger">Parent Category Field is Empty.</div>');
        }else{
            // If input fields are valid, prepare form data for AJAX submission
            var formdata = new FormData(this);
            formdata.append('update','1');
            // Send AJAX request to update subcategory
            $.ajax({
                url: './php_files/sub_category.php',
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide(); // Hide any existing alert messages
                    console.log(response); // Log the response to the console for debugging
                    // Handle response from the server
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#updateSubCategory').prepend('<div class="alert alert-success">Sub Category Modified Successfully.</div>');
                        setTimeout(function(){ window.location = URL+'admin/sub_category.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#updateSubCategory').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            })
        }
    });

    // delete sub category
    // Handle deletion of subcategory
    $('.delete_subCategory').click(function(){
        var tr = $(this); // Get reference to the clicked element
        var id = $(this).attr('data-id'); // Get the ID of the subcategory to be deleted
         // Display confirmation dialog to confirm deletion
        if(confirm('Are you Sure want to delete this')){
              // If user confirms deletion, send AJAX request to delete subcategory
            $.ajax({
                url: './php_files/sub_category.php',
                type: 'POST',
                data: {delete_id:id}, // Send the ID of the subcategory to be deleted
                dataType: 'json',
                success: function(response){
                    var res = response; // Store the response from the server
                      // Check if the response contains a success message
                    if(res.hasOwnProperty('success')){
                        tr.parent().parent('tr').remove(); // Remove the deleted subcategory from the table
                    }else if(res.hasOwnProperty('error')){
                        alert("You Don't Delete This"); // Display error message if deletion fails
                    }
                }
            });
        }
    });

    // script for show categories in header
    // Handle showing subcategory in header
    $('.showCat_Header').click(function(){
        var id = $(this).attr('data-id'); // Get the ID of the subcategory
        var status = ''; // Variable to store the status of the checkbox
         // Check if the checkbox is checked or unchecked
        if($(this).prop("checked") == true){
            status = '1'; // Set status to '1' if checked
        }else if($(this).prop("checked") == false){
            status = '0'; // Set status to '0' if unchecked
        }
         // Send AJAX request to update the status of the subcategory
        $.ajax({
                url: './php_files/sub_category.php',
                type: 'post',
                data: {id:id,showInHeader:status}, // Send the ID and status to the server
                success: function(response){
                     // Handle success response if needed
                }
            })
    });

    // script for show categories in footer
    // Handle showing subcategory in footer
    $('.showCat_Footer').click(function(){
        var id = $(this).attr('data-id'); // Get the ID of the subcategory
        var status = '';  // Variable to store the status of the checkbox
          // Check if the checkbox is checked or unchecked
        if($(this).prop("checked") == true){
            status = '1'; // Set status to '1' if checked
        }else if($(this).prop("checked") == false){
            status = '0';  // Set status to '0' if unchecked
        }
         // Send AJAX request to update the status of the subcategory
        $.ajax({
                url: './php_files/sub_category.php',
                type: 'post',
                data: {id:id,showInFooter:status}, // Send the ID and status to the server
                success: function(response){
                     // Handle success response if needed
                    // console.log(response);
                }
            })
    });

    // add brand
    // Handle brand creation form submission
    $('#createBrand').submit(function(e){
        e.preventDefault(); // Prevent the default form submission behavior
        $('.alert').hide(); // Hide any existing alert messages
        var title = $('.brand_name').val();  // Get the brand name from the input field
        var parent = $('.brand_category option:selected').val(); // Get the selected parent category
        // Validate if the brand name and parent category are not empty
        if(title == ''){
            $('#createBrand').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        }else if(parent == ''){
            $('#createBrand').prepend('<div class="alert alert-danger">Parent Category Field is Empty.</div>');
        }else{
            var formdata = new FormData(this); // Create form data object to send to the server
            formdata.append('create','1'); // Append additional data to the form data object
           // Send AJAX request to create the brand
            $.ajax({
                url: './php_files/brands.php',
                type: 'post',
                data: formdata, // Send form data
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from automatically setting the content type
                dataType: 'json', // Specify data type of the response
                success: function(response){
                    $('.alert').hide(); // Hide any existing alert messages
                    console.log(response); // Log the response for debugging purposes
                    var res = response;  // Assign the response to a variable
                      // Check if the response contains a success property
                    if(res.hasOwnProperty('success')){
                        $('#createBrand').prepend('<div class="alert alert-success">Brand Added Successfully.</div>');
                        setTimeout(function(){ window.location = URL+'admin/brands.php'; }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#createBrand').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            })
        }
    });

    // update brand
    // Handle brand update form submission
    $('#updateBrand').submit(function(e){
        e.preventDefault(); // Prevent the default form submission behavior
        $('.alert').hide(); // Hide any existing alert messages
        var title = $('.brand_name').val(); // Get the brand name from the input field
        var parent = $('.brand_category option:selected').val(); // Get the selected parent category
         // Validate if the brand name and parent category are not empty
        if(title == ''){
            $('#updateBrand').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        }else if(parent == ''){
            $('#updateBrand').prepend('<div class="alert alert-danger">Parent Category Field is Empty.</div>');
        }else{
            var formdata = new FormData(this); // Create form data object to send to the server
            formdata.append('update','1'); // Append additional data to the form data object
            // Send AJAX request to update the brand
            $.ajax({
                url: './php_files/brands.php',
                type: 'post',
                data: formdata,  // Send form data
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from automatically setting the content type
                dataType: 'json', // Specify data type of the response
                success: function(response){
                    $('.alert').hide(); // Hide any existing alert messages
                    var res = response;  // Assign the response to a variable
                    // Check if the response contains a success property
                    if(res.hasOwnProperty('success')){
                        $('#updateBrand').prepend('<div class="alert alert-success">Brand Modified Successfully.</div>'); // Show a success message
                        setTimeout(function(){ window.location = URL+'admin/brands.php'; }, 1000); // Redirect to the brands page after a short delay
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#updateBrand').prepend('<div class="alert alert-danger">'+res.error+'</div>'); 
                    }
                }
            })
        }
    });

    // delete_brand
    // Handle brand deletion
    $('.delete_brand').click(function(){
        var tr = $(this); // Get the parent table row element
        var id = $(this).attr('data-id');  // Get the ID of the brand to be deleted
        // Display a confirmation dialog to confirm deletion
        if(confirm('Are you Sure want to delete this')){
            $.ajax({
                url: './php_files/brands.php',
                type: 'POST',
                data: {delete_id:id}, // Send the ID of the brand to be deleted to the server
                dataType: 'json', // Specify the data type of the response
                success: function(response){
                    var res = response; // Assign the response to a variable
                       // Check if the response contains a success property
                    if(res.hasOwnProperty('success')){
                        tr.parent().parent('tr').remove(); // Remove the table row from the DOM if deletion is successful
                    }else if(res.hasOwnProperty('error')){
                        alert("You Don't Delete This");  // Show an error message if the response contains an error property
                    }
                }
            });
        }
    });

    // view user details
    $('.user-view').click(function(e) {
        e.preventDefault(); // Prevent the default action of the anchor tag
        var id = $(this).attr('data-id'); // Get the user ID from the data attribute of the clicked element
          // Send an AJAX request to fetch user details
        $.ajax({
            url: './php_files/users.php', // URL of the PHP file handling the request
            method: 'POST', // HTTP method
            data: { user_view:id }, // Data to be sent in the request (user ID)
            dataType: 'json',  // Expected data type of the response
            success: function (response) { // Callback function to handle successful response
                console.log(response); // Log the response to the console for debugging
                // Construct HTML for displaying user details
                var tr = '<table class="table table-bordered">'+
                            '<h3>User Details</h3>'+
                            '<tr>'+
                                '<td>First Name</td>'+
                                '<td>'+response[0].f_name+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Last Name</td>'+
                                '<td>'+response[0].l_name+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Username</td>'+
                                '<td>'+response[0].username+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Mobile</td>'+
                                '<td>'+response[0].mobile+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Address</td>'+
                                '<td>'+response[0].address+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>City</td>'+
                                '<td>'+response[0].city+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>User Status</td>'+
                                '<td>';
                                  // Check user role and append status accordingly
                                    if(response[0].user_role == '1'){
                                        tr += 'Activated';
                                    }else{
                                        tr += 'Blocked';
                                    }
                        tr += '</td>'+
                            '</tr>'+
                        '</table>';
                         // Append user details HTML to the modal body and show the modal
                $('#user-detail .modal-body').append(tr);
                $('#user-detail').modal('show');
            }
        });
    });

    // change user status
    $('.user-status').click(function(e) {
        e.preventDefault(); // Prevent the default action of the anchor tag

        var id = $(this).attr('data-id'); // Get the user ID from the data attribute of the clicked element
        var status = $(this).attr('data-status'); // Get the new status from the data attribute of the clicked element
          // Send an AJAX request to change the user status
        $.ajax({
            url: './php_files/users.php', // URL of the PHP file handling the request
            method: 'POST', // HTTP method
            data: { user_id:id,status_id:status }, // Data to be sent in the request (user ID and new status)
            success: function (data) { // Callback function to handle successful response
                location.reload(); // Reload the page to reflect the updated user status
            }
        });
    });

    // delete user
    $('.delete_user').click(function(){
        var tr = $(this); // Get the reference to the clicked element (delete button)
        var id = $(this).attr('data-id'); // Get the ID of the user to be deleted from the data attribute
        // Confirm the deletion with a confirmation dialog
        if(confirm('Are you Sure want to delete this')){
            $.ajax({
                url: './php_files/users.php', // URL of the PHP file handling the request
                type: 'POST', // HTTP method
                data: {delete_id:id}, // Data to be sent in the request (user ID)
                dataType: 'json',  // Expected data type of the response
                success: function(response){  // Callback function to handle successful response
                    var res = response; // Store the response data
                    console.log(response);  // Log the response to the console for debugging
                    // Check if the response contains a 'success' property
                    if(res.hasOwnProperty('success')){
                        tr.parent().parent('tr').remove();// Remove the row corresponding to the deleted user
                    } // If the response contains an 'error' property, show an alert
                    else if(res.hasOwnProperty('error')){
                        alert("You Don't Delete This");// Display an alert indicating the deletion cannot be performed
                    }
                }
            });
        }
    });

    // update site options
    $('#updateOptions').submit(function(e){
        e.preventDefault(); // Prevent the default form submission behavior
        $('.alert').hide();  // Hide any existing alert messages
         // Retrieve values from form fields
        var site_name = $('.site_name').val();
        var site_title = $('.site_title').val();
        var old_logo = $('.old_logo').val();
        var new_logo = $('.new_logo').val();
        var footer_text = $('.footer_text').val();
        var currency = $('.currency').val();
        var desc = $('.site_desc').val();
        var phone = $('.phone').val();
        var email = $('.email').val();
        var address = $('.address').val();
         // Perform validation for each field
        if(site_name == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Site Name Field is Empty.</div>');
        }if(site_title == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Site Title Field is Empty.</div>');
        }else if(footer_text == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Footer Text Field is Empty.</div>');
        }else if(currency == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Currency Format Field is Empty.</div>');
        }else if(desc == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Site Description is empty Field is Empty.</div>');
        }else if(phone == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Phone Field is Empty.</div>');
        }else if(email == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Email Field is Empty.</div>');
        }else if(address == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Address Field is Empty.</div>');
        }else{// If all fields are filled, proceed with AJAX request
            var formdata = new FormData(this);
            formdata.append('update',1);// Append a flag to indicate update operation
            $.ajax({
                url    : "./php_files/options.php",// URL of the PHP file handling the request
                type   : "POST", // HTTP method
                data   : formdata, // Data to be sent in the request (form data)
                processData: false,  // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                dataType: 'json',  // Expected data type of the response
                success: function(response){ // Callback function to handle successful response
                    $('.alert').hide();  // Hide any existing alert messages
                    console.log(response); // Log the response to the console for debugging
                    var res = response;  // Store the response data
                     // Check if the response contains a 'success' property
                    if(res.hasOwnProperty('success')){
                        $('#updateOptions').prepend('<div class="alert alert-success">Options Updates Successfully.</div>');
                        // Display success message
                        setTimeout(function(){ window.location(); }, 1000);
                         // Reload the page after a short delay
                         // If the response contains an 'error' property, display the error message
                    }else if(res.hasOwnProperty('error')){
                        $('#updateOptions').prepend('<div class="alert alert-danger">'+res.error+'</div>'); // Display error message
                    }
                }
            });
        }

    });

    // load image with jquery
    $('.new_logo').change(function(){
        readURL(this);
    })

    // change order delivery status

    $('.order_complete').click(function(e) {
         e.preventDefault(); // Prevent default link behavior
        var order_id = $(this).attr('data-id');  // Get the order ID from the clicked element
        $.ajax({
            url: './php_files/orders.php',  // URL of the PHP file handling the request
            method: 'POST', // HTTP method
            data: { complete: order_id }, // Data to be sent in the request
            success: function (data) { // Callback function to handle successful response
                location.reload(); // Reload the page after changing the order status
            }
        });
    });

// preview image before upload
function readURL(input) {
  if (input.files && input.files[0]) {
     // Check if files are selected
    var reader = new FileReader(); // Create a new FileReader object
    reader.onload = function(e) {
         // Define a callback function to be executed when the file is loaded
      $('#image').attr('src', e.target.result); // Set the 'src' attribute of the '#image' element to the result of the FileReader
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
    // Read the selected file and convert it to a base64-encoded URL
  }
}

});

