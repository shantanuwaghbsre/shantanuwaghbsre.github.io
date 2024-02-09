<?php 
include 'config.php';
$db = new Database(); 
include 'header.php'; 
?>
<br><br>
<h1 style="margin-left:45px; margin-bottom:2%;">Drop your Review</h1>
<div class="w3-container">
    <!-- Form for submitting reviews -->
    <form id="reviewForm" class="w3-container w3-margin-bottom" method="POST" action="review_submit.php">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label for="name">Name:</label>
                <input type="text" id="name" class="w3-input w3-border" placeholder="Enter your name" required>
            </div>
            <div class="w3-half">
                <label for="rating">Rating:</label>
                <input type="number" id="rating" class="w3-input w3-border" placeholder="Rating 0/5" min="1" max="5" required>
            </div>
        </div>
        <div style="margin-left:15px;">
        <label for="comment">Comment:</label>
        <textarea id="comment" class="w3-input w3-border" placeholder="Drop your review" rows="3" required></textarea>
        <button type="submit" class="w3-button w3-blue w3-margin-top" name="save_btn">Submit Review</button>
    </div>
    </form>
</div>

<div id="reviews" class="w3-container w3-margin-top" style="margin-left:25px;">
    <h2>Reviews</h2>
    <!-- Display area for existing reviews -->
</div>

<script>
document.getElementById("reviewForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission
    submitReview();
});

function submitReview() {
    var name = document.getElementById("name").value;
    var rating = document.getElementById("rating").value;
    var comment = document.getElementById("comment").value;
    
    // Create review element
    var review = document.createElement("div");
    review.classList.add("review");
    review.innerHTML = "<strong>" + name + " - Rating: " + rating + "</strong><br>" + comment;
    
    // Append review to reviews container
    document.getElementById("reviews").appendChild(review);
    
    // Clear form fields
    document.getElementById("name").value = "";
    document.getElementById("rating").value = "";
    document.getElementById("comment").value = "";
}
</script>