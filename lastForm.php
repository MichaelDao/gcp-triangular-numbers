<?php
session_start();

function display()
{
    $findUrl = "gs://s3668300-bucket/triangular-" . $_SESSION['arrayLength'] . ".txt";

    $primes = explode(",", file_get_contents($findUrl));

    $arrlength = count($primes);

    $totalTri = 0;
    for ($x = 0; $x < $arrlength; $x++) {
        $totalTri += $primes[$x];
    }

    // values from the textboxes
    $valueA = intval($_POST['content-a']);
    $valueB = intval($_POST['content-b']);
    $valueC = intval($_POST['content-c']);

    // S is the sum of A and B
    $valueS = $valueA + $valueB;

    // M is S multiplied by C
    $valueM = $valueS * $valueC;

    // T is the total sum of M and triangle text combined
    $valueT = $valueM + $totalTri;

    // R is the average of a + b + c + triangle text
    $valueR = ($valueA + $valueB + $valueC +  $totalTri) / ($arrlength + 3);

    printResult($valueT, $valueR);

    $url = "gs://s3668300-bucket/result-" . $arrlength . ".txt";
    $handle = fopen($url, 'w');

    $writeString = "S: ".$valueM.
        "\nA: ".$valueA.
        "\nB: ".$valueB.
        "\nC: ".$valueC.
        "\nT: ".$valueT.
        "\nR: ".$valueR;

    fwrite($handle, $writeString);

    fclose($handle);
}

?>

<html>
<head>
	<title>PHP Triangle!</title>

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

    <?php

if (isset($_POST['submit'])) {
    display();
}

function printResult($valueT, $valueR)
{
    echo "<pre>";
    echo "Total Sum (T): " . $valueT;
    echo "\nAverage (R): " . $valueR;
    echo "</pre>";
}
?>

  </div>

  <div class="card-footer text-muted">
	  Have a good time!
  </div>
</div>

</div>
</form>
</body>
</html>
