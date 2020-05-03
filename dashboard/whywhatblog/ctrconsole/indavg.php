
<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "hcurve";

// Create connection
try {
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
} 
catch(PDOException $e) {
    
    die("Connection Failed: " . $e->getMessage()); 
}

    $hcavgctr = null;
    $indctr = null;
    $inputctr = null;
    $resultlow = null;
    $resulthigh = null;

    $stmt = $conn->prepare(' SELECT * FROM industryavg ');
    $stmt->execute();
    $data = $stmt->fetchAll();


    if ( isset($_POST['vertical']) ) {

        $vertical = $_POST['vertical'];
        $inputctr = $_POST['inputctr'];

    $stmts = $conn->prepare(' SELECT * FROM industryavg WHERE vertical = :vertical');
    $stmts->execute(array(':vertical' => $vertical));

    $totalRows = $stmts->rowCount();
    
    if($totalRows > 0 ){ 

        while($row = $stmts->fetch()) {

            $vertical = $row['vertical'];
            $hcctr = $row['hcctr']; 
            $avgctr = $row['avgctr'];

        }

        $forgraph = array(
            "$inputctr",
            "$avgctr",
            "$hcctr"
        );

        $indctr = 'Industry Avg - ' . $avgctr . '%';
        $hcavgctr =  'Hockeycurve Avg - ' . $hcctr . '%';

        if ($hcctr > $inputctr) {
            $diff = round((($hcctr-$inputctr)/$inputctr) * 100) . '%';
            $resultlow = "Your Click-through Rate (CTR) for " . $vertical . " is " . $diff . " lower than the Hockeycurve average.";
            $diff = null;
        } else {
            $diff = round((($inputctr-$hcctr)/$inputctr) * 100) . '%';
            $resulthigh = "Your Click-through Rate (CTR) for " . $vertical . " is " . $diff . " highr than the Hockeycurve average.";
            $diff = null;
        }
        
    } 

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<style>
    .double {
        display: flex;
        width: 100%;
        justify-content: space-evenly;
        align-items: center;
        padding: 2% 0;
    }
    .double > div {
        display: flex;
        width: 50%
        justify-self: center;
    }
    .single {
        display: flex;
        justify-content: center;
        padding: 2% 0;

    }
    .reslow {
        color: red;
    }
    .reshigh {
        color: green;
    }
</style>
<body>
<form id="indusctr" name="indusctr" method="POST"
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="double">
        <div>
                <select name="vertical">
                        <option>Your Industry</option>
                        <?php
                            if (! empty($data)) {
                                foreach ($data as $key => $value) {
                                    echo '<option value="' . $data[$key]['vertical'] . '">' . $data[$key]['vertical'] . '</option>';
                                }
                            }
                        ?>
                </select>            
        </div>
        <div>
            <div><input type="text" name="inputctr" placeholder="Your CTR" required></div>
        </div>
    </div>
    <div class="single">
        <input type="submit" id="submit">
    </div>
    <!-- <div class="double">    
        <div>
            <div><?php echo $hcavgctr;?></div>
        </div>
        <div>
            <div><?php echo $indctr;?></div>
        </div>
    </div> -->
    <div class="single">
        <div>
            <div class="reslow"><?php echo $resultlow ?></div>
            <div class="reshigh"><?php echo $resulthigh ?></div>
        </div>
    </div>

    <div class="single" id="chart-container">
        <canvas id="bar-chart"  width="500" height="400"></canvas>
    </div>
<script>

new Chart(document.getElementById("bar-chart"), {

    type: 'bar',
    data: {
      labels: ["Your CTR", "Industry AVG", "Hockeycurve"],
      datasets: [
        {
          backgroundColor: ["red","grey","blue"],
          data: <?php echo json_encode($forgraph); ?>
        }
      ]
    },
    options: {
    scales: {
        yAxes: [{
            gridLines: {
                display: false,
                drawOnChartArea: false,
                drawTicks: false
            },
            ticks: {
                beginAtZero: true,
                padding: 20
            }
        }],
        xAxes: [{
            ticks: {
                padding: 20
            },
            gridLines: {
                display: false,
                drawOnChartArea: false,
                drawTicks: false
            },
        }]
    },
    responsive: false,
    legend: { display: false }
}
});

</script>

</form>
</body>
</html>
