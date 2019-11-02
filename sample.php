<!DOCTYPE html>
<html>
<head>
	<title>sample</title>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<style>
		.child{
			display: none;
		}
	</style>
	<script>

		$(document).ready(function(){
  			$('.pc-box').change(function() {
    		$(this).next().children().prop('checked', $(this).prop('checked')); 
			});

  			$('.p1').click(function(){
  				$('.child').toggle();
  			});	

		});
	</script>		

</head>
<body>
		
		<form>
			<div>
				<span class="p1">Parent1</span>
				<input name="parent" class="pc-box" type="checkbox">
				<div class="child">
		        	Child 1<input class="check" name="child" type="checkbox">
		        	Child 2<input class="check" name="child" type="checkbox">
		        	Child 3<input class="check" name="child" type="checkbox">
		        	<br class="pc-box">
	        	</div>
        	</div>
        
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>


		