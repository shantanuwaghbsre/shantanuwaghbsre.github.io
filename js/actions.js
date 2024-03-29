$(document).ready(function(){

     // Function to handle adding items to the wishlist
    $('.add-to-wishlist').click(function(e){
        e.preventDefault(); // Prevent default behavior of anchor tag
        var p_id = $(this).attr('data-id'); // Get the product ID from the data attribute
        $.ajax({ // Ajax request
            url: 'actions.php', // Target URL
            method: 'POST',  // HTTP method
            data: {addWishlist:p_id},  // Data to be sent to the server
            success: function(data){ // Success callback function
                location.reload(); // Reload the page after successful addition to the wishlist
            }
        });
    });

    $('.add-to-cart').click(function(e){
        e.preventDefault(); // Prevent default behavior of anchor tag
        var p_id = $(this).attr('data-id');  // Get the product ID from the data attribute
        $.ajax({  // Ajax request
            url: 'actions.php',  // Target URL
            method: 'POST',  // HTTP method
            data: {addCart:p_id}, // Data to be sent to the server
            success: function(data){ // Success callback function
                // console.log(data);
                location.reload(); // Reload the page after successfully adding the item to the cart
            }
        });
    });

    $('.remove-cart-item').click(function(e){
        e.preventDefault(); // Prevent default behavior of anchor tag
        var p_id = $(this).attr('data-id'); // Get the product ID from the data attribute
        $.ajax({  // Ajax request
            url: 'actions.php', // Target URL
            method: 'POST', // HTTP method
            data: {removeCartItem:p_id}, // Data to be sent to the server
            success: function(data){ // Success callback function
                location.reload(); // Reload the page after successfully removing the item from the cart
            }
        });
    });


    $('.remove-wishlist-item').click(function(e){
        e.preventDefault(); // Prevent default behavior of anchor tag
        var p_id = $(this).attr('data-id'); // Get the product ID from the data attribute
        $.ajax({ // Ajax request
            url: 'actions.php', // Target URL
            method: 'POST',  // HTTP method
            data: {removeWishlistItem:p_id},  // Data to be sent to the server
            success: function(data){ // Success callback function
                location.reload();  // Reload the page after successfully removing the item from the wishlist
            }
        });
    });


    $('.proceed-to-cart').click(function(e){
        e.preventDefault(); // Prevent default behavior of anchor tag
        var goToCart = 1;  // Flag to indicate proceeding to cart
        $.ajax({ // Ajax request
            url: 'actions.php', // Target URL
            method: 'POST', // HTTP method
            data: {proceedCart:goToCart}, // Data to be sent to the server
            success: function(data){ // Success callback function
                window.location.href = 'cart.php'; // Redirect to the cart page after proceeding to cart
            }
        });
    });



    function net_amount(){
        var amount = 0;  // Initialize total amount
        $('.sub-total').each(function(){ // Iterate over each element with class 'sub-total'
            var val = $(this).html(); // Get the HTML content of the current element
            var total = parseInt(amount) + parseInt(val); // Calculate total amount
            amount = total;  // Update total amount
        });
        $('.total-amount').html(amount); // Display the total amount in the HTML element with class 'total-amount'
        $('.checkout-form').children('.total-price').val(amount);  // Set the total amount value in the input field with class 'total-price'
    }
    net_amount(); // Call the function to calculate and display the net amount

    $('.item-qty').change(function(){
        var qty = $(this).val(); // Get the updated quantity value
        var price = $(this).siblings('.item-price').val();  // Get the price of the item
        var new_price = (qty * price); // Calculate the new subtotal based on quantity and price
        $(this).parent().siblings().children('.sub-total').html(new_price);  // Update the subtotal for the item
        net_amount();  // Recalculate and update the total amount
        net_qty(); // Recalculate and update the total quantity
    });

    function net_qty(){
        var val = ''; // Initialize an empty string to store the concatenated quantities
        $('.item-qty').each(function(){
            val = (val + $(this).val()+',');  // Concatenate the quantity of each item
        })
        $('.checkout-form').children('.total-qty').val(val); // Update the total quantity input field with the concatenated values
    }
    net_qty(); // Call the function to initialize the total quantity on page load


    $('#loginUser').submit(function(e){
        e.preventDefault(); // Prevent the default form submission behavior
         // Retrieve username and password values
        var username = $('.username').val();
        var password = $('.password').val();
         // Check if username or password is empty
        if(username == '' || password == ''){
            $('#userLogin_form .modal-body').append('<div class="alert alert-danger">Please Fill All The Fields.</div>');
        }else{// Perform AJAX request to handle user login
            $.ajax({
                url: 'php_files/user.php',
                method: 'POST',
                data: {login:'1',username:username,password:password},
                dataType: 'json',
                success: function(response){
                    $('.alert').hide(); // Hide any existing alerts
                    console.log(response);
                    var res = response;   // Check the response from the server
                    if(res.hasOwnProperty('success')){
                        $('#userLogin_form .modal-body').append('<div class="alert alert-success">LoggedIn Successfully.</div>');
                        setTimeout(function(){ location.reload(); }, 1000);
                    }else if(res.hasOwnProperty('error')){
                        $('#userLogin_form .modal-body').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }

                }
            });
        }
    });



  
    $('.user_logout').click(function(e){
        e.preventDefault(); // Prevent the default click behavior
         // Set user_logout flag to 1
        var user_logout = 1;
         // Perform AJAX request to handle user logout
        $.ajax({
            url: 'php_files/user.php',
            method: 'POST',
            data: {user_logout:user_logout},
            success: function(response){
                 // Check if the response indicates successful logout
                if(response == 'true'){
                    location.reload();
                }
            }
        });
    });

    
    $('#register_sign_up').submit(function(e){
        e.preventDefault(); // Prevent the default form submission
        $('.alert').hide(); // Hide any existing alerts
        // Retrieve form field values
        var f_name = $(".first_name").val();
        var l_name = $(".last_name").val();
        var username = $(".user_name").val();
        var password = $(".pass_word").val();
        var mobile = $(".mobile").val();
        var address = $(".address").val();
        var city = $(".city").val();
         // Check if any required field is empty
        if (f_name == '' || l_name == '' || username == '' || password == '' || mobile == '' || address == '' || city == ''){
            $('#register_sign_up').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
        }else{
             // Create a FormData object to send form data asynchronously
            var formdata = new FormData(this);
            formdata.append('create','1'); // Add a flag indicating user creation
            // Send an AJAX request to the PHP script
            $.ajax({
            url:"php_files/user.php",
            type:"POST",
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(response){
                $('.alert').hide(); // Hide any existing alerts
                var res = response;
                if(res.hasOwnProperty('success')){
                    $('#register_sign_up').append('<div class="alert alert-success">'+res.success+'</div>');
                     // Redirect to user profile page after a delay
                    setTimeout(function(){ window.location.href = 'user_profile.php'; }, 1500);
                }else if(res.hasOwnProperty('error')){
                    $('#register_sign_up').append('<div class="alert alert-danger">'+res.error+'</div>');
                }
            }
        });
        }
    });

    $('#modify-user').submit(function(e){
        e.preventDefault();  // Prevent the default form submission
         // Retrieve form field values
        var f_name = $(".first_name").val();
        var l_name = $(".last_name").val();
        var mobile = $(".mobile").val();
        var address = $(".address").val();
        var city = $(".city").val();
         // Check if any required field is empty
        if (f_name == '' || l_name == '' || mobile == '' || address == '' || city == ''){
            $('#modify-user').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
        }else{   // Create a FormData object to send form data asynchronously
            var formdata = new FormData(this);
            formdata.append('update','1');
             // Send an AJAX request to the PHP script
            $.ajax({
                url:"php_files/user.php",
                type:"POST",
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(response){
                    $('.alert').hide(); // Hide any existing alerts
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#modify-user').append('<div class="alert alert-success">Modified Successfully.</div>');
                        // Redirect to user profile page after a delay
                        setTimeout(function(){ window.location.href = 'user_profile.php'; }, 1500);
                    }else if(res.hasOwnProperty('error')){
                        $('#modify-user').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                    
                }
            });
        }
    });


    $('#modify-password').submit(function(e){
        e.preventDefault(); // Prevent the default form submission
        $('.alert').hide();  // Hide any existing alerts
         // Retrieve old and new password values
        var old_pass = $(".old_pass").val();
        var new_pass = $(".new_pass").val();
         // Check if both old and new passwords are provided
        if (old_pass == '' || new_pass == ''){
            $('#modify-password').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
        }else{
            // Create a FormData object to send form data asynchronously
            var formdata = new FormData(this);
            formdata.append('modifyPass','1');
              // Send an AJAX request to the PHP script
            $.ajax({
                url:"php_files/user.php",
                type:"POST",
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(response){
                    $('.alert').hide();  // Hide any existing alerts
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#modify-password').append('<div class="alert alert-success">Password Modified Successfully.</div>');
                         // Redirect to user profile page after a delay
                        setTimeout(function(){ window.location.href = 'user_profile.php'; }, 1500);
                    }else if(res.hasOwnProperty('error')){
                        $('#modify-password').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                    
                }
            });
        }
    });

   


});