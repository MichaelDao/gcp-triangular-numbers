<?php
session_start();

function process()
{

    $value = intval($_POST['content']);

    if (5 <= $value && $value <= 25) {
        $url = "gs://s3668300-bucket/triangular-". $value .".txt";
        
        $handle = fopen($url, 'w');

        // this is our string of triangles
        $triString = "";
        $runningVal = 0;

        for ($row = 1; $row <= $value; $row++) {
            $runningVal = $runningVal + $row;
            $triString .= $runningVal;

            if ($row != $value) {
                $triString .= ",";
            }
        }

        fwrite($handle, $triString);

        fclose($handle);

        $_SESSION['arrayLength'] = $value;

        echo "<script>location.href='lastForm';</script>";
        exit;

    } else {
        validateError();
    }
}

function printError()
{
    echo '<div class="' . 'alert alert-danger' . '"';
    echo 'role="' . 'alert' . '">';
    echo '<strong>Oh snap!</strong> This number is not between 5 or 25.</div>';
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
      <div class="card-header">Pyramid Numbers</div>
      <div class="card-body">
        <h5 class="card-title">This is N:</h5>
        <p class="card-text">Please enter a number, we are gonna create a special pyramid.</p>
<?php
if (isset($_POST['submit'])) {
    process();
}

function validateError()
{
    printError();
}
?>
        <form action="/" method="post">
		      <input type="number" class="form-control mx-auto" style="width: 300px;" name="content" placeholder="N">
		      <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
        </form>

      </div>
      <div class="card-footer text-muted">Have a good time!</div>
    </div>
  </div>
</body>
</html>