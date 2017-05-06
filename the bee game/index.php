<!DOCTYPE html>
<html>
<head>
  <title>The bee game</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>


<?php
    $queen_healt = 100;
    $worker_healt = 75;
    $drone_healt = 50;

    $queen_hit = 8;
    $worker_hit = 10;
    $drone_hit = 12;

    $worker_nbr = 5;
    $drone_nbr = 8;

    $ended = false;

    if (isset($_GET['lives'])) {
        $lives = $_GET['lives'];
    }else{
        $lives = [$queen_healt];

        for ($i = 0; $i < $worker_nbr; $i++) {
            array_push($lives, $worker_healt);
        }
        for ($i = 0; $i < $drone_nbr; $i++) {
            array_push($lives, $drone_healt);
        }
    }

    if (isset($_GET['lives'])) {
        do {
            $rnd = rand(0, 13);
        } while($lives[$rnd]==0);

        if ($rnd == 0) {
            $lives[$rnd] -= $queen_hit;
            if ($lives[$rnd] < 0) {
                $lives[$rnd] = 0;
            }
        } elseif (0<$rnd && $rnd<6) {
            $lives[$rnd] -= $worker_hit;
            if ($lives[$rnd] < 0) {
                $lives[$rnd] = 0;
            }
        } else {
            $lives[$rnd] -= $drone_hit;
            if ($lives[$rnd] < 0) {
                $lives[$rnd] = 0;
            }
        }
    } else {
        $rnd = -1;
    }

    if ($lives[0] == 0) {
        $ended = true;
    }

    if ($ended) {
        echo "<h2>All the bees are dead, game ended</h2>";
        echo "<a href=\"index.php\">Reset"."</a>";
    } else {
        $query = http_build_query(array('lives' => $lives));

        echo "<div class=\"row\">";

        echo "<div class=\"col-xs-12\">";
        echo "<ul class=\"nav navbar-nav\">";
        echo "<li>";
        echo "<a href=\"index.php\"><h1>The Bee Game</h1>"."</a><br>";
        echo "</li>";
        echo "<li>";
        echo "<a href=\"index.php?".$query."\">Attack"."</a><br>";
        echo "</li>";
        echo "<li>";
        echo "<a href=\"index.php\">Reset"."</a><br>";
        echo "</li>";
        echo "</ul>";
        echo "</div>";

        for ($i = 0; $i < count($lives); $i++) {
            echo "<div class=\"col-md-1 col-sm-2 col-xs-2\">";
            if ($i == 0) {
                echo "<img class=\"img-circle img-responsive img-center\" src=\"images/queen.png\" alt=\"Queen\">";
            } elseif (0<$i && $i<6) {
                echo "<img class=\"img-circle img-responsive img-center\" src=\"images/worker.png\" alt=\"Worker\">";
            } else {
                echo "<img class=\"img-circle img-responsive img-center\" src=\"images/drone.png\" alt=\"Drone\">";
            }

            if ($i == $rnd) {
                echo "<h4 style=\"color:red;\" class=\"text-center\">".$lives[$i]."</h4>";
            } else {
                echo "<h4 class=\"text-center\">".$lives[$i]."</h4>";
            }

            echo "</div>";
        }
        echo "</div>";
    }



 ?>



</body>
</html>
<script src="http://localhost:35729/livereload.js"></script>
