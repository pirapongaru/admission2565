<?php
include 'includes/header.php';
date_default_timezone_set('Asia/Bangkok');
// header("refresh:10");
?>






<?php
session_start();
session_unset();
$_SESSION['where'] = '';
$_SESSION['page'] = 'statistic';
?>

<?php
include 'includes/sidebar.php';
?>

<!-- กำหนดวันทั้งหมดในรูปแบบ Array -->
<?php
$dayregis = array("2022-03-09", "2022-03-10", "2022-03-11", "2022-03-12", "2022-03-13");
?>
<?php
include 'includes/config.php';
$sqlconfig = "SELECT * FROM config";
$queryconfig = $dbcon->prepare($sqlconfig);
$queryconfig->execute();
$rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว
// print_r($rowconfig);
// echo $rowconfig->con_m1m4only;
?>


<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    รายงานการรับสมัครนักเรียน<?php echo $rowconfig->con_typeadmission; ?> ปีการศึกษา <?php echo $rowconfig->con_year; ?> <small><i>ข้อมูลปรับปรุงอัตโนมัติ (<?php echo date("Y/m/d H:i:s"); ?>)</i></small>
                </h1>
            </div><!-- /.page-header -->











            <!-- สถิติ -->
            <?php
            // if ($rowconfig->com_m1m4only != 0) {
            // }
            // include 'includes/config.php';
            // $sql = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id WHERE std_status='1'";
            // $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
            // $query->execute(); //เริ่มทำงาน sql
            // $results = $query->fetchAll(PDO::FETCH_OBJ);
            // foreach ($results as $row) { 
            // }





            // $day1 = date("2021-02-27");


            // echo $rowconfig->com_m1m4only;
            ?>

            <!-- สถิติ -->
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div align="left" class="bigger-150 text-primary">รายงานจำนวนผู้สมัคร</div>
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%" class="text-center"> </th>
                                    <?php
                                    if ($rowconfig->con_m1m4only != 4) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            // $sqlcount = "SELECT * FROM studentm1 WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";

                                            echo '<th scope="col" width="10%" class="text-center">' . $row->type_name . '</th>';
                                        }
                                        echo ' <th scope="col" width="10%" class="text-center text-primary">รวม ม.1</th>';
                                    }
                                    ?>

                                    <?php
                                    if ($rowconfig->con_m1m4only != 1) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 4' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            echo '<th scope="col" width="10%" class="text-center">' . $row->type_name . '</th>';
                                        }
                                        echo ' <th scope="col" width="10%" class="text-center text-primary">รวม ม.4</th>';
                                    }
                                    ?>
                                    <th scope="col" width="10%" class="text-center text-primary">รวมทั้งหมด</th>




                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-center bg-success bigger-150">รวม</th>
                                    <?php
                                    if ($rowconfig->con_m1m4only != 4) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id WHERE std_type='$row->type_id'";
                                            $querycount = $dbcon->prepare($sqlcount);
                                            $querycount->execute();
                                            // $results = $querycount->fetchAll(PDO::FETCH_OBJ);
                                            echo '<td class="bg-warning bigger-150">' . $querycount->rowCount() . '</td>';
                                        }
                                        $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id";
                                        $querycount = $dbcon->prepare($sqlcount);
                                        $querycount->execute();

                                        echo '<td class="bg-success bigger-200 text-primary">' . $querycount->rowCount() . '</td>';
                                    }
                                    ?>




                                    <?php
                                    if ($rowconfig->con_m1m4only != 1) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 4' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_type='$row->type_id'";
                                            $querycount = $dbcon->prepare($sqlcount);
                                            $querycount->execute();
                                            // $results = $querycount->fetchAll(PDO::FETCH_OBJ);
                                            echo '<td class="bg-warning bigger-150">' . $querycount->rowCount() . '</td>';
                                        }
                                        $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id";
                                        $querycount = $dbcon->prepare($sqlcount);
                                        $querycount->execute();

                                        echo '<td class="bg-success bigger-200 text-primary">' . $querycount->rowCount() . '</td>';
                                    }
                                    ?>


                                    <?php
                                    $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id";
                                    $querycount = $dbcon->prepare($sqlcount);
                                    $querycount->execute();
                                    $allm4 = $querycount->rowCount();
                                    $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id";
                                    $querycount = $dbcon->prepare($sqlcount);
                                    $querycount->execute();
                                    $allm1 = $querycount->rowCount();
                                    if ($rowconfig->con_m1m4only == 1) {
                                        $all = $allm1;
                                    }
                                    if ($rowconfig->con_m1m4only == 4) {
                                        $all = $allm4;
                                    }
                                    if ($rowconfig->con_m1m4only == 0) {
                                        $all = $allm1 + $allm4;
                                    }

                                    ?>
                                    <td class="bg-success bigger-200 text-primary"><?php echo $all; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div align="left" class="text-primary bigger-150">รายงานจำนวนผู้สมัครที่เจ้าหน้าที่ตรวจสอบข้อมูลแล้ว<br>
                        <font size=2><i class="text-success">ข้อมูลปรับปรุงอัตโนมัติ (<?php echo date("Y/m/d H:i:s"); ?>)</i></font>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%" class="text-center">วันที่</th>
                                    <?php
                                    if ($rowconfig->con_m1m4only != 4) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            // $sqlcount = "SELECT * FROM studentm1 WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";

                                            echo '<th scope="col" width="10%" class="text-center">' . $row->type_name . '</th>';
                                        }
                                        echo ' <th scope="col" width="10%" class="text-center text-primary">รวม ม.1</th>';
                                    }
                                    ?>

                                    <?php
                                    if ($rowconfig->con_m1m4only != 1) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 4' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            echo '<th scope="col" width="10%" class="text-center">' . $row->type_name . '</th>';
                                        }
                                        echo ' <th scope="col" width="10%" class="text-center text-primary">รวม ม.4</th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($dayregis as $day) {
                                    $thisday = substr($day, -2);
                                    $thismonth = substr($day, 5, 2);
                                    $thisyear = substr($day + 543, 0, 4);
                                    echo '<tr class="bg-warning">';
                                    echo '<th scope="row" class="text-center bg-info bigger-120">' . $thisday . '/' . $thismonth . '/' . $thisyear . '</th>';



                                    if ($rowconfig->con_m1m4only != 4) {

                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id WHERE std_status='1' 
                                        AND std_type='$row->type_id' AND std_dateok='$day'";
                                            $querycount = $dbcon->prepare($sqlcount);
                                            $querycount->execute();
                                            // $results = $querycount->fetchAll(PDO::FETCH_OBJ);
                                            if ($row->type_id == 15 && $thisday == '28') {
                                                echo '<td class="bigger-140 text-danger" style="color:#f9bfbf;background:#f9bfbf;">' . ' - ' . '</td>';
                                            } else {
                                                echo '<td class="bigger-140">' . $querycount->rowCount() . '</td>';
                                            }
                                        }
                                        $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id WHERE std_status='1' 
                                    AND std_dateok='$day'";
                                        $querycount = $dbcon->prepare($sqlcount);
                                        $querycount->execute();

                                        echo '<td class="bg-success bigger-200 text-primary">' . $querycount->rowCount() . '</td>';
                                    }


                                    if ($rowconfig->con_m1m4only != 1) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 4' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_status='1' 
                                        AND std_type='$row->type_id' AND std_dateok='$day'";
                                            $querycount = $dbcon->prepare($sqlcount);
                                            $querycount->execute();
                                            // $results = $querycount->fetchAll(PDO::FETCH_OBJ);
                                            if ($row->type_id == 46 && $thisday == '28') {
                                                echo '<td class="bigger-140" style="color:#f9bfbf;background:#f9bfbf;">' . ' - ' . '</td>';
                                            } else {
                                                echo '<td class="bigger-140">' . $querycount->rowCount() . '</td>';
                                            }
                                        }
                                        $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_status='1' 
                                    AND std_dateok='$day'";
                                        $querycount = $dbcon->prepare($sqlcount);
                                        $querycount->execute();

                                        echo '<td class="bg-success bigger-200 text-primary">' . $querycount->rowCount() . '</td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>








                                <tr>
                                    <th scope=" row" class="text-center bg-success bigger-150">รวม</th>
                                    <?php
                                    if ($rowconfig->con_m1m4only != 4) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 1' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id WHERE std_status='1' 
                                        AND std_type='$row->type_id'";
                                            $querycount = $dbcon->prepare($sqlcount);
                                            $querycount->execute();
                                            // $results = $querycount->fetchAll(PDO::FETCH_OBJ);
                                            echo '<td class="bg-success bigger-150">' . $querycount->rowCount() . '</td>';
                                        }
                                        $sqlcount = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id WHERE std_status='1'";
                                        $querycount = $dbcon->prepare($sqlcount);
                                        $querycount->execute();

                                        echo '<td class="bg-success bigger-200 text-primary">' . $querycount->rowCount() . '</td>';
                                    }
                                    ?>




                                    <?php
                                    if ($rowconfig->con_m1m4only != 1) {
                                        $sql = "SELECT * FROM registype WHERE type_class='ชั้นมัธยมศึกษาปีที่ 4' AND type_status='1'";
                                        $query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query
                                        $query->execute(); //เริ่มทำงาน sql
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_status='1' 
                                        AND std_type='$row->type_id'";
                                            $querycount = $dbcon->prepare($sqlcount);
                                            $querycount->execute();
                                            // $results = $querycount->fetchAll(PDO::FETCH_OBJ);
                                            echo '<td class="bg-success bigger-150">' . $querycount->rowCount() . '</td>';
                                        }
                                        $sqlcount = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_status='1'";
                                        $querycount = $dbcon->prepare($sqlcount);
                                        $querycount->execute();

                                        echo '<td class="bg-success bigger-200 text-primary">' . $querycount->rowCount() . '</td>';
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div align="right" class="text-primary bigger-150"><i>ข้อมูลปรับปรุงอัตโนมัติ (<?php echo date("Y/m/d H:i:s"); ?>)</i></div> -->
                </div>
            </div>




            <?php
            $m1_13 = 0;
            $m1_14 = 0;
            $m1_15 = 0;
            $m1_all = 0;
            $m1_percent = 0;

            $m4_44 = 0;
            $m4_45 = 0;
            $m4_46 = 0;
            $m4_all = 0;
            $m4_percent = 0;
            // นับ ep gep m1
            include 'includes/config.php';
            $sqlchart = "SELECT * FROM studentm1 WHERE std_status='1'";
            $querychart = $dbcon->prepare($sqlchart);
            $querychart->execute();
            $resultschart = $querychart->fetchAll(PDO::FETCH_OBJ);
            foreach ($resultschart as $row) {
                if ($row->std_type == '13') {
                    $m1_13 = $m1_13 + 1;
                } else if ($row->std_type == '14') {
                    $m1_14 = $m1_14 + 1;
                } else if ($row->std_type == '15') {
                    $m1_15 = $m1_15 + 1;
                }
                $m1_all = $m1_all + 1;
            }


            // นับ ep gep m4
            include 'includes/config.php';
            $sqlchart = "SELECT * FROM studentm4 WHERE std_status=1";
            $querychart = $dbcon->prepare($sqlchart);
            $querychart->execute();
            $resultschart = $querychart->fetchAll(PDO::FETCH_OBJ);
            foreach ($resultschart as $row) {
                if ($row->std_type == '44') {
                    $m4_44 = $m4_44 + 1;
                } else if ($row->std_type == '45') {
                    $m4_45 = $m4_45 + 1;
                } else if ($row->std_type == '46') {
                    $m4_46 = $m4_46 + 1;
                }
                $m4_all = $m4_all + 1;
            }



            //  $m1ep=$query->rowCount();

            $dataPointsm1 = array(
                array("label" => "นักเรียนในเขตบริการ", "y" => $m1_13, "z" => $m1_13 * 100 / $m1_all),
                array("label" => "นักเรียนนอกเขตบริการ", "y" => $m1_14, "z" => $m1_14 * 100 / $m1_all),
                array("label" => "นักเรียนความสามารถพิเศษ", "y" => $m1_15, "z" => $m1_15 * 100 / $m1_all),
                array("label" => "EP", "y" => 1, "z" => 1),
                array("label" => "GEP", "y" => 1, "z" => 100 - 1),

            );

            $dataPointsm4 = array(
                array("label" => "นักเรียน สกร.", "y" => $m4_44, "z" => $m4_44 * 100 / $m4_all),
                array("label" => "นักเรียนทั่วไป", "y" => $m4_45, "z" => $m4_45 * 100 / $m4_all),
                array("label" => "นักเรียนความสามารถพิเศษ", "y" => $m4_46, "z" => $m4_46 * 100 / $m4_all),
                array("label" => "EP", "y" => 1, "z" => 1),
                array("label" => "GEP", "y" => 1, "z" => 100 - 1),

            );


            ?>

            <script>
                window.onload = function() {


                    var chartm1 = new CanvasJS.Chart("charttypem1", {
                        animationEnabled: true,
                        title: {
                            text: "สถิติประเภทการรับสมัคร ม.1"
                        },
                        subtitles: [{
                            text: "ประเภทห้องเรียนพิเศษ"
                        }],
                        data: [{
                            type: "pie",
                            yValueFormatString: " #,##0 \"คน\"",
                            zValueFormatString: " #,##0.00 \"%\"",
                            indexLabel: "{label} ({y} : {z})",
                            dataPoints: <?php echo json_encode($dataPointsm1, JSON_NUMERIC_CHECK); ?>
                        }]
                    });

                    var chartm4 = new CanvasJS.Chart("charttypem4", {
                        animationEnabled: true,
                        title: {
                            text: "สถิติประเภทการรับสมัคร ม.4"
                        },
                        subtitles: [{
                            text: "ประเภทห้องเรียนพิเศษ"
                        }],
                        data: [{
                            // type: "doughnut",
                            type: "pie",
                            yValueFormatString: " #,##0 \"คน\"",
                            zValueFormatString: " #,##0.00 \"%\"",
                            indexLabel: "{label} ({y} : {z})",
                            dataPoints: <?php echo json_encode($dataPointsm4, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chartm1.render();
                    chartm4.render();

                }
            </script>


          



        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->



<?php
include 'includes/footer.php';
?>