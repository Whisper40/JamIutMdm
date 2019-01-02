<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Tableau de bord";
$nomsouscat = "NULL";
require_once('includes/head.php');
ini_set('display_errors', 1);

?>

<body>
    <div class="wrapper">

  <!-- DEBUT CODE -->

            <?php
            require_once('includes/navbar.php');

            $inscritsjam = $db->prepare("SELECT * FROM users WHERE status = 'MEMBRE'");
            $inscritsjam->execute();
            $countinscritsjam = $inscritsjam->rowCount();

            $inscritstotal = $db->prepare("SELECT id FROM users");
            $inscritstotal->execute();
            $countinscritstotal = $inscritstotal->rowCount();

            $totalparticipants = $db->prepare("SELECT * FROM participe");
            $totalparticipants->execute();
            $counttotalparticipants = $totalparticipants->rowCount();

            $totalvisiteurs = $db->prepare("SELECT * FROM visiteurs");
            $totalvisiteurs->execute();
            $counttotalvisiteurs = $totalvisiteurs->rowCount();

             ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">weekend</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Membres (Jam / Inscrit) :</p>
                                    <h3 class="card-title"><?php echo $countinscritsjam;?> / <?php echo $countinscritstotal;?></h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="rose">
                                    <i class="material-icons">equalizer</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Visiteurs ( < 30 scd ):</p>
                                    <h3 class="card-title"><?php echo $counttotalvisiteurs; ?></h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Participants : </p>
                                    <h3 class="card-title"><?php echo $counttotalparticipants; ?></h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-chart">
                                <div class="card-header" data-background-color="rose">
                                    <div id="roundedLineChart" class="ct-chart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Montant total des transactions</h4>
                                    <p class="category">Mensuel</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card-chart">
                                <div class="card-header" data-background-color="red">
                                    <div id="roundedLineChart2" class="ct-chart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Nombre d'inscriptions</h4>
                                    <p class="category">Mensuel</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="blue">
                                    <i class="material-icons">timeline</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Nombre de connexions
                                        <small> - Journalière</small>
                                    </h4>
                                </div>
                                <div id="colouredRoundedLineChart" class="ct-chart"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="red">
                                    <i class="material-icons">pie_chart</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Navigateurs Utilisés</h4>
                                </div>
                                <div id="chartPreferences" class="ct-chart"></div>
                                <div class="card-footer">
                                    <h6>Legende</h6>
                                    <i class="fa fa-circle text-danger"></i> Chrome
                                    <i class="fa fa-circle text-warning"></i> Firefox
                                    <i class="fa fa-circle text-info"></i> Autre
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php

$total = $db->prepare("SELECT * FROM histconnexion");
$total->execute();
$counttotal = $total->rowCount();

$chrome = $db->prepare("SELECT * FROM histconnexion WHERE navigateur = 'Google Chrome'");
$chrome->execute();
$countchrome = $chrome->rowCount();

$firefox = $db->prepare("SELECT * FROM histconnexion WHERE navigateur = 'Mozilla Firefox'");
$firefox->execute();
$countfirefox = $firefox->rowCount();

$autre = $db->prepare("SELECT * FROM histconnexion WHERE navigateur <> 'Mozilla Firefox' and 'Google Chrome'");
$autre->execute();
$countautre = $autre->rowCount();

$pourcentagenavigateurchrome = round(($countchrome*100)/$counttotal);
$pourcentagenavigateurfirefox = round(($countfirefox*100)/$counttotal);
$pourcentagenavigateurautre = round(($countautre*100)/$counttotal);


$day0 = date('Y-m-d');
$horodateurday0 = date('d/m');
$day1 = date('Y-m-d', strtotime("1 day ago" )); //hier
$horodateurday1 = date('d/m', strtotime("1 day ago" ));
$day2 = date('Y-m-d', strtotime("2 day ago" ));
$horodateurday2 = date('d/m', strtotime("2 day ago" ));
$day3 = date('Y-m-d', strtotime("3 day ago" ));
$horodateurday3 = date('d/m', strtotime("3 day ago" ));
$day4 = date('Y-m-d', strtotime("4 day ago" ));
$horodateurday4 = date('d/m', strtotime("4 day ago" ));
$day5 = date('Y-m-d', strtotime("5 day ago" ));
$horodateurday5 = date('d/m', strtotime("5 day ago" ));
$day6 = date('Y-m-d', strtotime("6 day ago" ));
$horodateurday6 = date('d/m', strtotime("6 day ago" ));
$day7 = date('Y-m-d', strtotime("7 day ago" ));
$horodateurday7 = date('d/m', strtotime("7 day ago" ));
$day8 = date('Y-m-d', strtotime("8 day ago" ));
$horodateurday8 = date('d/m', strtotime("8 day ago" ));
$day9 = date('Y-m-d', strtotime("9 day ago" ));
$horodateurday9 = date('d/m', strtotime("9 day ago" ));


$day0value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day0'");
$day0value->execute();
$countday0value = $day0value->rowCount();

$day1value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day1'");
$day1value->execute();
$countday1value = $day1value->rowCount();

$day2value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day2'");
$day2value->execute();
$countday2value = $day2value->rowCount();

$day3value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day3'");
$day3value->execute();
$countday3value = $day3value->rowCount();

$day4value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day4'");
$day4value->execute();
$countday4value = $day4value->rowCount();

$day5value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day5'");
$day5value->execute();
$countday5value = $day5value->rowCount();

$day6value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day6'");
$day6value->execute();
$countday6value = $day6value->rowCount();

$day7value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day7'");
$day7value->execute();
$countday7value = $day7value->rowCount();

$day8value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day8'");
$day8value->execute();
$countday8value = $day8value->rowCount();

$day9value = $db->prepare("SELECT * FROM histconnexion WHERE datesystem='$day9'");
$day9value->execute();
$countday9value = $day9value->rowCount();

$maxvalueconnection = max($countday9value,$countday8value,$countday7value,$countday6value,$countday5value,$countday4value,$countday3value,$countday2value,$countday1value,$countday0value);
$maxconnectionavecmarge = $maxvalueconnection + 1;

$valtotal11 = date('Y-m-d', strtotime("11 month ago" ));
$valmonth11 = substr($valtotal11, -5, 2);
$valyear11 = substr($valtotal11, -10, 4);

$valtotal10 = date('Y-m-d', strtotime("10 month ago" ));
$valmonth10 = substr($valtotal10, -5, 2);
$valyear10 = substr($valtotal10, -10, 4);

$valtotal9 = date('Y-m-d', strtotime("9 month ago" ));
$valmonth9 = substr($valtotal9, -5, 2);
$valyear9 = substr($valtotal9, -10, 4);

$valtotal8 = date('Y-m-d', strtotime("8 month ago" ));
$valmonth8 = substr($valtotal8, -5, 2);
$valyear8 = substr($valtotal8, -10, 4);

$valtotal7 = date('Y-m-d', strtotime("7 month ago" ));
$valmonth7 = substr($valtotal7, -5, 2);
$valyear7 = substr($valtotal7, -10, 4);

$valtotal6 = date('Y-m-d', strtotime("6 month ago" ));
$valmonth6 = substr($valtotal6, -5, 2);
$valyear6 = substr($valtotal6, -10, 4);


$valtotal5 = date('Y-m-d', strtotime("5 month ago" ));
$valmonth5 = substr($valtotal5, -5, 2);
$valyear5 = substr($valtotal5, -10, 4);

$valtotal4 = date('Y-m-d', strtotime("4 month ago" ));
$valmonth4 = substr($valtotal4, -5, 2);
$valyear4 = substr($valtotal4, -10, 4);

$valtotal3 = date('Y-m-d', strtotime("3 month ago" ));
$valmonth3 = substr($valtotal3, -5, 2);
$valyear3 = substr($valtotal3, -10, 4);

$valtotal2 = date('Y-m-d', strtotime("2 month ago" ));
$valmonth2 = substr($valtotal2, -5, 2);
$valyear2 = substr($valtotal2, -10, 4);
//
$valtotal1 = date('Y-m-d', strtotime("1 month ago" ));
$valmonth1 = substr($valtotal1, -5, 2);
$valyear1 = substr($valtotal1, -10, 4);
//
$valmonth0 = date("m");
$valyear0 = date("Y");


    $month5 = $db->query("SELECT SUM(amount) AS totalamount5 FROM transactions WHERE MONTH(datesystem) = '$valmonth5' and YEAR(datesystem) = '$valyear5'");
    $r5 = $month5->fetch(PDO::FETCH_OBJ);
    $countmonth5 = $r5->totalamount5;
    if (is_null($countmonth5)){
      $countmonth5 = 0;
    }

    $month4 = $db->query("SELECT SUM(amount) AS totalamount4 FROM transactions WHERE MONTH(datesystem) = '$valmonth4' and YEAR(datesystem) = '$valyear4'");
    $r4 = $month4->fetch(PDO::FETCH_OBJ);
    $countmonth4 = $r4->totalamount4;

    if (is_null($countmonth4)){
      $countmonth4 = 0;
    }

    $month3 = $db->query("SELECT SUM(amount) AS totalamount3 FROM transactions WHERE MONTH(datesystem) = '$valmonth3' and YEAR(datesystem) = '$valyear3'");
    $r3 = $month3->fetch(PDO::FETCH_OBJ);
    $countmonth3 = $r3->totalamount3;

    if (is_null($countmonth3)){
      $countmonth3 = 0;
    }
    $month2 = $db->query("SELECT SUM(amount) AS totalamount2 FROM transactions WHERE MONTH(datesystem) = '$valmonth2' and YEAR(datesystem) = '$valyear2'");
    $r2 = $month2->fetch(PDO::FETCH_OBJ);
    $countmonth2 = $r2->totalamount2;

    if (is_null($countmonth2)){
      $countmonth2 = 0;
    }
    $month1 = $db->query("SELECT SUM(amount) AS totalamount1 FROM transactions WHERE MONTH(datesystem) = '$valmonth1' and YEAR(datesystem) = '$valyear1'");
    $r1 = $month1->fetch(PDO::FETCH_OBJ);
    $countmonth1 = $r1->totalamount1;

    if (is_null($countmonth1)){
      $countmonth1 = 0;
    }

    $month0 = $db->query("SELECT SUM(amount) AS totalamount0 FROM transactions WHERE MONTH(datesystem) = '$valmonth0' and YEAR(datesystem) = '$valyear0'");
    $r0 = $month0->fetch(PDO::FETCH_OBJ);
    $countmonth0 = $r0->totalamount0;

    if (is_null($countmonth0)){
      $countmonth0 = 0;
    }




$maxvalue = max($countmonth5,$countmonth4,$countmonth3,$countmonth2,$countmonth1,$countmonth0);
$maxavecmarge = round($maxvalue + 1);


//simpleBarChart
$barmonth11 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth11' and YEAR(subscribe) = '$valyear11'");
$barmonth11->execute();
$barcountmonth11 = $barmonth11->rowCount();


$barmonth10 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth10' and YEAR(subscribe) = '$valyear10'");
$barmonth10->execute();
$barcountmonth10 = $barmonth10->rowCount();

$barmonth9 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth9' and YEAR(subscribe) = '$valyear9'");
$barmonth9->execute();
$barcountmonth9 = $barmonth9->rowCount();

$barmonth8 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth8' and YEAR(subscribe) = '$valyear8'");
$barmonth8->execute();
$barcountmonth8 = $barmonth8->rowCount();

$barmonth7 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth7' and YEAR(subscribe) = '$valyear7'");
$barmonth7->execute();
$barcountmonth7 = $barmonth7->rowCount();

$barmonth6 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth6' and YEAR(subscribe) = '$valyear6'");
$barmonth6->execute();
$barcountmonth6 = $barmonth6->rowCount();

$barmonth5 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth5' and YEAR(subscribe) = '$valyear5'");
$barmonth5->execute();
$barcountmonth5 = $barmonth5->rowCount();

$barmonth4 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth4' and YEAR(subscribe) = '$valyear4'");
$barmonth4->execute();
$barcountmonth4 = $barmonth4->rowCount();

$barmonth3 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth3' and YEAR(subscribe) = '$valyear3'");
$barmonth3->execute();
$barcountmonth3 = $barmonth3->rowCount();

$barmonth2 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth2' and YEAR(subscribe) = '$valyear2'");
$barmonth2->execute();
$barcountmonth2 = $barmonth2->rowCount();

$barmonth1 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth1' and YEAR(subscribe) = '$valyear1'");
$barmonth1->execute();
$barcountmonth1 = $barmonth1->rowCount();

$barmonth0 = $db->prepare("SELECT * FROM users WHERE MONTH(subscribe) = '$valmonth0' and YEAR(subscribe) = '$valyear0'");
$barmonth0->execute();
$barcountmonth0 = $barmonth0->rowCount();

$maxvaluebar = max($barcountmonth5,$barcountmonth4,$barcountmonth3,$barcountmonth2,$barcountmonth1,$barcountmonth0);
$maxavecmargebar = $maxvaluebar + 1;


//FinSimpleBartChart

require_once('includes/javascript.php');

 ?>

<script>

kevin = {

    initDocumentationCharts: function(){
        /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

        dataDailySalesChart = {
            labels: ['Oct', 'Nov', 'W', 'T', 'F', 'S', 'S'],
            series: [
                [12, 17, 7, 17, 23, 18, 38]
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
        }

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

        var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);
    },

    initCharts: function(){

        /* ----------==========    Rounded Line Chart initialization    ==========---------- */

        dataRoundedLineChart = {
            labels: ['<?php echo $valmonth5;?>/<?php echo substr("$valyear5", -2);?>','<?php echo $valmonth4;?>/<?php echo substr("$valyear4", -2);?>','<?php echo $valmonth3;?>/<?php echo substr("$valyear3", -2);?>','<?php echo $valmonth2;?>/<?php echo substr("$valyear2", -2);?>','<?php echo $valmonth1;?>/<?php echo substr("$valyear1", -2);?>','<?php echo $valmonth0;?>/<?php echo substr("$valyear0", -2);?>'],
            series: [
                [<?php echo $countmonth5;?>,<?php echo $countmonth4;?>,<?php echo $countmonth3;?>, <?php echo $countmonth2;?>, <?php echo $countmonth1;?>, <?php echo $countmonth0;?>]
            ]
        };

        optionsRoundedLineChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 10

            }),
            axisX: {
                showGrid: true,

            },
            low: 0,
            high: <?php echo $maxavecmarge;?>, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            showPoint: true


        }

        var RoundedLineChart = new Chartist.Line('#roundedLineChart', dataRoundedLineChart, optionsRoundedLineChart);

        md.startAnimationForLineChart(RoundedLineChart);


        /*  **************** Straight Lines Chart - single line with points ******************** */


        /* ----------==========    Rounded Line Chart initialization    ==========---------- */


        dataRoundedLineChart2 = {
            labels: ['<?php echo $valmonth5;?>/<?php echo substr("$valyear5", -2);?>','<?php echo $valmonth4;?>/<?php echo substr("$valyear4", -2);?>','<?php echo $valmonth3;?>/<?php echo substr("$valyear3", -2);?>','<?php echo $valmonth2;?>/<?php echo substr("$valyear2", -2);?>','<?php echo $valmonth1;?>/<?php echo substr("$valyear1", -2);?>','<?php echo $valmonth0;?>/<?php echo substr("$valyear0", -2);?>'],
            series: [
                [<?php echo $barcountmonth5;?>,<?php echo $barcountmonth4;?>,<?php echo $barcountmonth3;?>, <?php echo $barcountmonth2;?>, <?php echo $barcountmonth1;?>, <?php echo $barcountmonth0;?>]
            ]
        };

        optionsRoundedLineChart2 = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0

            }),
            axisX: {
                showGrid: true,

            },
            low: 0,
            high: <?php echo $maxavecmargebar;?>, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            showPoint: true


        }

        var RoundedLineChart2 = new Chartist.Line('#roundedLineChart2', dataRoundedLineChart2, optionsRoundedLineChart2);

        md.startAnimationForLineChart(RoundedLineChart2);


        /*  **************** Straight Lines Chart - single line with points ******************** */

        dataStraightLinesChart = {
          labels: ['\'07','\'08','\'09', '\'10', '\'11', '\'12', '\'13', '\'14', '\'15'],
          series: [
            [10, 16, 8, 13, 20, 15, 20, 34, 30]
          ]
        };

        optionsStraightLinesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            classNames: {
                point: 'ct-point ct-white',
                line: 'ct-line ct-white'
            }
        }

        var straightLinesChart = new Chartist.Line('#straightLinesChart', dataStraightLinesChart, optionsStraightLinesChart);

        md.startAnimationForLineChart(straightLinesChart);


        /*  **************** Coloured Rounded Line Chart - Line Chart ******************** */


        dataColouredRoundedLineChart = {
          labels: ['<?php echo $horodateurday9;?>','<?php echo $horodateurday8;?>','<?php echo $horodateurday7;?>','<?php echo $horodateurday6;?>', '<?php echo $horodateurday5;?>', '<?php echo $horodateurday4;?>', '<?php echo $horodateurday3;?>', '<?php echo $horodateurday2;?>', '<?php echo $horodateurday1;?>','<?php echo $horodateurday0;?>'],
          series: [
            [<?php echo $countday9value;?>, <?php echo $countday8value;?>, <?php echo $countday7value;?>, <?php echo $countday6value;?>, <?php echo $countday5value;?>, <?php echo $countday4value;?>, <?php echo $countday3value;?>, <?php echo $countday2value;?>, <?php echo $countday1value;?>, <?php echo $countday0value;?>]
          ]
        };

        optionsColouredRoundedLineChart = {
          lineSmooth: Chartist.Interpolation.cardinal({
              tension: 10
          }),
          axisY: {
              showGrid: true,
              offset: 40
          },
          axisX: {
              showGrid: true,
          },
          low: 0,
          high: <?php echo $maxconnectionavecmarge;?>,
          showPoint: true,
          height: '300px'
        };


        var colouredRoundedLineChart = new Chartist.Line('#colouredRoundedLineChart', dataColouredRoundedLineChart, optionsColouredRoundedLineChart);

        md.startAnimationForLineChart(colouredRoundedLineChart);


        /*  **************** Coloured Rounded Line Chart - Line Chart ******************** */


        dataColouredBarsChart = {
          labels: ['\'06','\'07','\'08','\'09', '\'10', '\'11', '\'12', '\'13', '\'14','\'15'],
          series: [
            [287, 385, 490, 554, 586, 698, 695, 752, 788, 846, 944],
            [67, 152, 143,  287, 335, 435, 437, 539, 542, 544, 647],
            [23, 113, 67, 190, 239, 307, 308, 439, 410, 410, 509]
          ]
        };

        optionsColouredBarsChart = {
          lineSmooth: Chartist.Interpolation.cardinal({
              tension: 10
          }),
          axisY: {
              showGrid: true,
              offset: 40
          },
          axisX: {
              showGrid: false,
          },
          low: 0,
          high: 1000,
          showPoint: true,
          height: '300px'
        };


        var colouredBarsChart = new Chartist.Line('#colouredBarsChart', dataColouredBarsChart, optionsColouredBarsChart);

        md.startAnimationForLineChart(colouredBarsChart);



        /*  **************** Public Preferences - Pie Chart ******************** */

        var dataPreferences = {
            labels: ['<?php echo $pourcentagenavigateurautre;?>%','<?php echo $pourcentagenavigateurchrome;?>%','<?php echo $pourcentagenavigateurfirefox;?>%'],
            series: [<?php echo $pourcentagenavigateurautre;?>, <?php echo $pourcentagenavigateurchrome;?>, <?php echo $pourcentagenavigateurfirefox;?>]
        };

        var optionsPreferences = {
            height: '230px'
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        /*  **************** Simple Bar Chart - barchart ******************** */



        var dataSimpleBarChart = {
          labels: ['<?php echo $valmonth10;?>/<?php echo substr("$valyear10", -2);?>','<?php echo $valmonth10;?>/<?php echo substr("$valyear10", -2);?>','<?php echo $valmonth11;?>/<?php echo substr("$valyear11", -2);?>','<?php echo $valmonth10;?>/<?php echo substr("$valyear10", -2);?>','<?php echo $valmonth9;?>/<?php echo substr("$valyear9", -2);?>','<?php echo $valmonth8;?>/<?php echo substr("$valyear8", -2);?>','<?php echo $valmonth7;?>/<?php echo substr("$valyear7", -2);?>','<?php echo $valmonth6;?>/<?php echo substr("$valyear6", -2);?>','<?php echo $valmonth5;?>/<?php echo substr("$valyear5", -2);?>', '<?php echo $valmonth4;?>/<?php echo substr("$valyear4", -2);?>', '<?php echo $valmonth3;?>/<?php echo substr("$valyear3", -2);?>', '<?php echo $valmonth2;?>/<?php echo substr("$valyear2", -2);?>', '<?php echo $valmonth1;?>/<?php echo substr("$valyear1", -2);?>', '<?php echo $valmonth0;?>/<?php echo substr("$valyear0", -2);?>'],
          series: [
            [<?php echo $barcountmonth10;?>, <?php echo $barcountmonth10;?>,<?php echo $barcountmonth11;?>, <?php echo $barcountmonth10;?>, <?php echo $barcountmonth9;?>, <?php echo $barcountmonth8;?>, <?php echo $barcountmonth7;?>, <?php echo $barcountmonth6;?>, <?php echo $barcountmonth5;?>, <?php echo $barcountmonth4;?>, , <?php echo $barcountmonth3;?>, <?php echo $barcountmonth2;?>, <?php echo $barcountmonth1;?>, <?php echo $barcountmonth0;?>]
          ]
        };

        var optionsSimpleBarChart = {
          seriesBarDistance: 10,
          axisX: {
            showGrid: true
          }
        };

        var responsiveOptionsSimpleBarChart = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        var simpleBarChart = Chartist.Bar('#simpleBarChart', dataSimpleBarChart, optionsSimpleBarChart, responsiveOptionsSimpleBarChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(simpleBarChart);


        //TEST

        /*  **************** Simple Bar Chart - barchart ******************** */

        var data2SimpleBarChart = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]
          ]
        };

        var options2SimpleBarChart = {
          seriesBarDistance: 10,
          axisX: {
            showGrid: false
          }
        };

        var responsive2OptionsSimpleBarChart = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        var simple2BarChart = Chartist.Bar('#simple2BarChart', data2SimpleBarChart, options2SimpleBarChart, responsive2OptionsSimpleBarChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(simple2BarChart);




//FIN TEST

        var dataMultipleBarsChart = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
            [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
          ]
        };

        var optionsMultipleBarsChart = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: '300px'
        };

        var responsiveOptionsMultipleBarsChart = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        var multipleBarsChart = Chartist.Bar('#multipleBarsChart', dataMultipleBarsChart, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(multipleBarsChart);
    },

    initDashboardPageCharts: function(){

        /* ----------==========     Daily Sales Chart initialization    ==========---------- */

        dataDailySalesChart = {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            series: [
                [12, 17, 7, 17, 23, 18, 38]
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
        }

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

        md.startAnimationForLineChart(dailySalesChart);



        /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

        dataCompletedTasksChart = {
            labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
            series: [
                [230, 750, 450, 300, 280, 240, 200, 190]
            ]
        };

        optionsCompletedTasksChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0}
        }

        var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

        // start animation for the Completed Tasks Chart - Line Chart
        md.startAnimationForLineChart(completedTasksChart);


        /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

        var dataWebsiteViewsChart = {
          labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
          series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

          ]
        };
        var optionsWebsiteViewsChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: 1000,
            chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
        };
        var responsiveOptions = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];
        var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(websiteViewsChart);

    },
}

</script>

<!-- IMPORTANT -->
<script>
    $(document).ready(function() {
        kevin.initCharts();
    });
</script>

</html>
