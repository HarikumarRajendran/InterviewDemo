<!DOCTYPE html>
<html>
<head>
	<title>nScript</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<style type="text/css">
		.hide{
			display: none;
		}
		.err{
			color: red;
		}
		.success{
			color: green;
		}
		.tableData{
			text-align: center;
			height:30em;
			overflow: auto;
		}
	</style>
</head>
<body>
<div class="container">
	<h3 class="text-center">Demo Project</h3>
	<div class="err"></div>
	<div class="success"></div>
	<div class="row mt-5">
		<div class="col-md-4 text-center">
			 <form method="post" onsubmit="return false;">
	          	<input type="hidden" id="fetchData" name="fetchData" value="ok">
				<button class="btn btn-primary fetchBtn">Fetch Data</button>
			</form>
		</div>
		<div class="col-md-4 text-center">
			 <form method="post" onsubmit="return false;">
	          	<input type="hidden" id="viewData" name="viewData" value="ok">
				<button class="btn btn-secondary viewData">View Data</button>
			</form>
		</div>
		<div class="col-md-4 text-center">
			<button class="btn btn-warning chartData">Chart</button>
		</div>
	</div>
	<div class="row tableData mt-3 hide">
		 <table class="table table-bordered">
		    <thead class="text-center">
		      <tr>
		        <th>S.No</th>
		        <th>Open</th>
		        <th>High</th>
		        <th>Low</th>
		        <th>Close</th>
		        <th>Volume</th>
		        <th>Date</th>
		        <th>Status</th>
		        <th>Change Status</th>
		      </tr>
		    </thead>
		    <tbody id="bodyData">
		     
		    </tbody>
		  </table>
	</div>
	<div class="chartContainer mt-3" style="height: 300px; width: 100%;"></div>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>