<html>
<head>
	<title>PHP Triangle!</title>
    <?php

$primes = explode(",",
    file_get_contents('gs://s3668300-bucket/triangular-n.txt')
);

$arrlength = count($primes);

echo "<pre>";
echo $primes;

echo $arrlength;
echo "</pre>";

$totalTri = 0;
for ($x = 0; $x < $arrlength; $x++) {
    $totalTri += $primes[$x];
}

echo $totalTri;
?>

    <?php
function display()
{
    $valueA = intval($_POST['content-a']);
    $valueB = intval($_POST['content-b']);
    $valueC = intval($_POST['content-c']);

    $valueS = $valueA + $valueB;

    $valueM = $valueS * $valueC;

    $valueT = $valueM + $totalTri;

    $valueR = $valueT / ($arrlength + 3);

    echo "Total Sum (S): " . $valueT;
    echo "Average (R): " . $valueR;
}

if (isset($_POST['submit'])) {
    display();
}
?>
	<style>
		.card {
        	margin: 0 auto;
        	float: none;
			margin-top: 100px;
        	margin-bottom: 10px;
		}
	</style>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<div class="form-group row">
	<div class="card text-center">
	<div class="card-header">
    Pyramid
  </div>
  <div class="card-body">
    <h5 class="card-title">Now for the last step:</h5>
    <p class="card-text">Provide three more numbers for variables a, b and c.</p>
	  <form action="/lastform" method="post">
		<input type="number" class="form-control mx-auto" style="width: 300px;" name="content-a" placeholder="A">
		<h2>+</h2>
		<input type="number" class="form-control mx-auto" style="width: 300px;" name="content-b" placeholder="B">
		<h2>x</h2>
		<input type="number" class="form-control mx-auto" style="width: 300px;" name="content-c" placeholder="C">
		<br />
		<input type="submit"  value="Submit" name="submit" class="btn btn-primary"/>
    </form>
  </div>

  <div class="card-footer text-muted">
	  Have a good time!
  </div>
</div>

</div>
</form>
</body>
</html>
