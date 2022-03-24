<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logical/Analytical Assessment</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container min-vh-100 py-2">
	    <div class="container network_wrapper col-sm p-2 ">
	        <div class="card">
	            <div class="card-header">
	                <h5 class="card-title text-center">Logical/Analytical Assessment</h5>

	                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
	                    <li class="nav-item">
	                        <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#tab-1">Valid Parentheses</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Huge Sale</a>
	                    </li>
	                </ul>
	            </div>
	            <div class="card-body">
	            	<div class="tab-content">
	            		<div class="tab-pane active" id="tab-1">
	            			<?php 
							/*Start Valid Parentheses*/
							$valid_parentheses_string_error = "";
							$str_array = array();
							//Check valid parentheses form submit
							if(isset($_POST['valid_parentheses_submit'])){
								$valid_string = $_POST['parentheses_string'];
								//if input not empty
								if(isset($_POST['parentheses_string']) && empty($_POST['parentheses_string'])){
									$valid_parentheses_string_error = '<div class="invalid-feedback" style="display:block">Input can not be empty.</div>';
								//check string characters limit
								}else if(isset($_POST['parentheses_string']) && strlen($valid_string) < 1 && strlen($valid_string) > 1000000){
									echo strlen($_POST['parentheses_string']);
									$valid_parentheses_string_error = '<div class="invalid-feedback" style="display:block">Characters limit greater then 1 less then to 1000000</div>';
								//check string only not contains uppercase
								}else if(isset($_POST['parentheses_string']) && preg_match('/[A-Z]/', $_POST['parentheses_string'])){
									$valid_parentheses_string_error = '<div class="invalid-feedback" style="display:block">Uppercase characters not acceptable.</div>';
								//check string not contains number
								}else if(isset($_POST['parentheses_string']) && preg_match('/[0-9]/', $_POST['parentheses_string'])){
									$valid_parentheses_string_error = '<div class="invalid-feedback" style="display:block">Numbers not acceptable.</div>';
								}else{
									//Split string in array
									$str_array = str_split($valid_string);
									$visit = array();
									for($i=0; $i < strlen($valid_string); $i++){
										if ($str_array[$i] == '('){
								            $visit[] = $i;
										}else if ($str_array[$i] == ')'){
								            if(count($visit)){
								            	array_pop($visit);
								            }else{
								            	$str_array[$i] = ""; 
								            }
										}
									}

									foreach($visit AS $key => $value){
										$str_array[$value] = "";
									}
								}
							}	
							/*End Valid Parentheses*/
							?>
							<form id="valid-parentheses" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>#tab-1">
								<div class="mb-3">
									<label for="" class="form-label">Input</label>
									<input type="text" class="form-control" name="parentheses_string" placeholder="Enter...." value="<?= (isset($_POST['parentheses_string']) ? $_POST['parentheses_string'] : ""); ?>" minlength="1" required="required">
									<?= $valid_parentheses_string_error; ?>
								</div>

								<div class="mb-3">
									<label for="" class="form-label">Output</label>
									<h4 id="valid-parentheses-output" class="card-text">
										<?= implode($str_array); ?>
									</h4>
								</div>
								<input type="submit" class="btn btn-primary" name="valid_parentheses_submit" value="Submit">
							</form>
		                </div>
		                <div class="tab-pane" id="tab-2">
		                <?php 
							/*Start Huge Sale*/
							$huge_sale_carry_items_error = "";
							$huge_sale_sale_items_error = "";
							$huge_sale_prices_items_error = "";
							$huge_sale_carry_items = 0;
							$huge_sale_sale_items = 0;
							$huge_sale_prices_items = array();
							$max_earn_money = 0;
							//Check huge sale form submit
							if(isset($_POST['huge_sale_submit'])){
								//if input not empty
								if(isset($_POST['carry_items']) && empty($_POST['carry_items'])){
									$huge_sale_carry_items_error = '<div class="invalid-feedback" style="display:block">No. of items can carry in truck can not be empty.</div>';
								//check min & max of items
								}else if(isset($_POST['carry_items']) && $_POST['carry_items'] < 1 && $_POST['carry_items'] > 100){
									$huge_sale_carry_items_error = '<div class="invalid-feedback" style="display:block">No. of items for carry less then equal to 100 and greater then equal to 1.</div>';
								}else{
									$huge_sale_carry_items = $_POST['carry_items'];
								}

								//if input not empty
								if(isset($_POST['sale_items']) && empty($_POST['sale_items'])){
									$huge_sale_sale_items_error = '<div class="invalid-feedback" style="display:block">No. of items for sale can not be empty.</div>';
								//check min & max of items
								}else if(isset($_POST['carry_items']) && $_POST['sale_items'] < 1 && $_POST['sale_items'] > 100){
									$huge_sale_sale_items_error = '<div class="invalid-feedback" style="display:block">No. of items for sales less then equal to 100 and greater then equal to 1.</div>';
								}else{
									$huge_sale_sale_items = $_POST['sale_items'];
								}

								//if input not empty
								if(isset($_POST['prices_items']) && empty($_POST['prices_items'])){
									$huge_sale_prices_items_error = '<div class="invalid-feedback" style="display:block">Prices of available items can not be empty.</div>';
								}else{
									$huge_sale_prices_items = explode(" ", $_POST['prices_items']);
									$max_earn_array = array();
									//check no. of items prices equal to no. of items
									if(count($huge_sale_prices_items) < $huge_sale_sale_items){
										$huge_sale_prices_items_error = '<div class="invalid-feedback" style="display:block">No. of prices can not be less then no. of sales items.</div>';
									}else{
										//Sort prices in assending
										sort($huge_sale_prices_items);
										//Get prices equal to no. of iteam which can carry in truck
										$max_earn_array = array_slice($huge_sale_prices_items, 0, $huge_sale_carry_items);
										//Sum prices of items which can carry
										$max_earn_money = array_sum($max_earn_array);
									}
								}
							}	
							/*End Huge Sale*/
						?>
		                    <form id="huge-sale" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>#tab-2">
								<div class="mb-3">
									<label for="" class="form-label">No. of items can carry in truck</label>
									<input type="number" class="form-control integer" id="carry_items" name="carry_items" placeholder="Enter...." value="<?= (isset($_POST['carry_items']) ? $_POST['carry_items'] : ""); ?>" required="required" min="1" max="100" step="0">
									<?= $huge_sale_carry_items_error; ?>
								</div>

								<div class="mb-3">
									<label for="" class="form-label">No. of items for sale</label>
									<input type="number" class="form-control integer" id="sale_items" name="sale_items" placeholder="Enter...." value="<?= (isset($_POST['sale_items']) ? $_POST['sale_items'] : ""); ?>" required="required" min="1" max="100" step="0">
									<?= $huge_sale_sale_items_error; ?>
								</div>

								<div class="mb-3">
									<label for="" class="form-label">Prices of available items</label>
									<input type="text" class="form-control" name="prices_items" placeholder="Enter...." value="<?= (isset($_POST['prices_items']) ? $_POST['prices_items'] : ""); ?>" required="required">
									<?= $huge_sale_prices_items_error; ?>
									<div id="" class="form-text">Input contains space-separated integers for items price</div>
								</div>

								<div class="mb-3">
									<label for="" class="form-label">Output</label>
									<h4 id="huge-sale-output" class="card-text">
										<?= $max_earn_money; ?>
									</h4>
								</div>
								<input type="submit" class="btn btn-primary" name="huge_sale_submit" value="Submit">
							</form>
		                </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
</body>
<script type="text/javascript">
document.getElementById("carry_items").addEventListener("keypress", onlyNumber);

function onlyNumber(){
    if (event.target.which < 48 || event.target.which > 57) {
        alert("Integer values only");
        return(false);
    }
}
</script>
</html>