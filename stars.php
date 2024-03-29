<div class="container mt-5">
		<style type="text/css">
			/* Styling for the star buttons */
		button
		{
			background:none;
			outline:none;
			border:none;
			width:50px;
			height:7vh;
			box-shadow:0px 4px 8px 0px grey;
			border-radius:10px;
			margin:5px;
		}
	</style>
<table>
	<tbody>
		<tr>
			<!-- Star buttons with onclick event -->
			<td><button type="button" onclick="test(0)" id="star0">&#9733;</button></td>
			<td><button type="button" onclick="test(1)" id="star1">&#9733;</button></td>
			<td><button type="button" onclick="test(2)" id="star2">&#9733;</button></td>
			<td><button type="button" onclick="test(3)" id="star3">&#9733;</button></td>
			<td><button type="button" onclick="test(4)" id="star4">&#9733;</button></td>
			<td><button type="button" onclick="test(5)" id="star5">&#9733;</button></td>
		</tr>
	</tbody>
</table>
</div>
<script type="text/javascript">
	 // JavaScript function to handle star rating
	function test(id)
	{  // Loop through each star button
		for (var i = 0; i <= 5; i++){
			  // If the current button is less than or equal to the clicked button
			if (i <= id){
				   // Set background color to tomato (selected)
				document.getElementById("star" + i).style.backgroundColor = "tomato";
			}
			else {
				// Set background color to default button face (not selected)
				document.getElementById("star" + i).style.backgroundColor = "buttonface";
			}
		}
	}
</script>
