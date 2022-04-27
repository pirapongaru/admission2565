<?php
// $std_id=$_GET['std_id'];
// echo $std_id;
?>

<?php
session_start();
// มีการจ่ายเงิน************************************************************************
//$paypay = 1; //0 คือ ออกเลขเลย / 1 คือ มีการชำระเงิน
$mclass = 'm4';
$_SESSION['page'] = 'administrator';
$_SESSION['uploadphoto'] = '1';
$_SESSION['mode'] = 'administrator';
$admin_computer = $_SESSION['admin_computer'];

if ($_SESSION['where'] != 'administrator') {
    header("Location: admin.php");
}
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<?php
include 'includes/config.php';
?>

<?php
// เช็คเรื่องการชำระเงิน
include 'includes/config.php';
$sqlconfig = "SELECT * FROM config";
$queryconfig = $dbcon->prepare($sqlconfig);
$queryconfig->execute();
$row = $queryconfig->fetch(PDO::FETCH_OBJ);
// มีการจ่ายเงิน************************************************************************
if ($row->con_pay == 1) {
    $paypay = 1; //0 คือ ออกเลขเลย / 1 คือ มีการชำระเงิน
} else if ($row->con_pay == 0) {
    $paypay = 0; //0 คือ ออกเลขเลย / 1 คือ มีการชำระเงิน
}
?>



<?php
// echo "std_id : ".$_POST['std_id']."<br>";
// echo "std_dayb : ".$_POST['std_dayb']."<br>";
// echo "std_monthb : ".$_POST['std_monthb']."<br>";
// echo "std_yearb : ".$_POST['std_yearb']."<br>";

$std_id = $_GET['std_id'];
$sql = "SELECT * FROM student$mclass INNER JOIN registype ON student$mclass.std_type=registype.type_id  WHERE std_id=:std_id";
$query = $dbcon->prepare($sql);
$query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
$query->execute();
$row = $query->fetch(PDO::FETCH_OBJ);
if ($query->rowCount() == 0) { ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row cnbox">
                    <div class="col col-lg-10 cnbox bg-success text-center">
                        <div>
                            <h1>ไม่พบข้อมูล กรุณาตรวจสอบใหม่</h1>
                            <a class="btn btn-success btn-lg" href="admin<?php echo $mclass; ?>.php">ย้อนกลับ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>

    <?php
    include 'includes/footer.php';
    ?>
<?php
}
?>

<?php
if ($query->rowCount() == 1 && $row->std_regisid != 0 && $row->std_status == 1) { ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row cnbox">
                    <div class="col col-lg-10 cnbox bg-success text-center">
                        <div>
                            <h1>ข้อมูลผ่านการตรวจสอบแล้ว</h1>
                            <img src="<?php echo $row->std_photo; ?>" alt="">
                            <h2> <b class="text-primary"><?php echo $row->std_prefix . $row->std_fname . " " . $row->std_lname; ?></b> </h2><br>
                            <h3> <?php echo $row->type_name; ?> </h3>
                            <h4> หมายเลขบัตรประชาชน : <b class="text-primary"><?php echo $row->std_id; ?></b> </h4>
                            <h4> เลขประจำตัวสอบ : <b class="text-primary"><?php echo $row->std_regisid; ?></b> </h4>
                            <h4> หมายเลขห้องสอบ : <b class="text-primary"><?php echo $row->std_regisroom; ?></b> </h4>
                            <a class="btn btn-success btn-lg" href="admin<?php echo $mclass; ?>.php">ย้อนกลับ</a>
                        </div>
                    </div>
                </div>


                <?php
                // ระดับชั้นที่เลือก
                $_SESSION['classhow'] = $mclass;
                include 'includes/viewstddata.php';

                ?>





            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <?php
    include 'includes/footer.php';
    ?>
<?php
} else {
?>


    <?php
    if ($query->rowCount() == 1 && $row->std_regisid == 0) { ?>

        <?php
        // list($std_doctalent_name, $std_doctalent_type) = explode(".", $row['std_doctalent']);
        // list($std_dochome1_name, $std_dochome1_type) = explode(".", $row['std_dochome1']);
        // list($std_dochome2_name, $std_dochome2_type) = explode(".", $row['std_dochome2']);
        // list($std_dochome3_name, $std_dochome3_type) = explode(".", $row['std_dochome3']);
        // list($std_dochome4_name, $std_dochome4_type) = explode(".", $row['std_dochome4']);
        // list($std_doccer_name, $std_doccer_type) = explode(".", $row['std_doccer']);
        // list($std_doccer_2_name, $std_doccer_2_type) = explode(".", $row['std_doccer_2']);
        // list($std_doconet_name, $std_doconet_type) = explode(".", $row['std_doconet']);
        ?>
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">


                    <?php
                    // echo "<pre>";
                    // print_r($row);
                    // echo "</pre>";
                    ?>

                    <form name="std_form" action="admin<?php echo $mclass; ?>finish.php" method="POST" enctype="multipart/form-data">
                        <!-- onsubmit="return validateForm()" -->

                        <div class="row cnbox">
                            <div class="col col-lg-12 cnbox bg-success text-center">
                                <div align="left">
                                    <a href="admin<?php echo $mclass; ?>.php" class="btn btn-primary" style="text-align:center;font-size: 13px;">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;ย้อนกลับ&nbsp;</a>&emsp;<span class="badge badge-primary">
                                        <h5><?php echo $admin_computer; ?></h5>
                                    </span>
                                </div>
                                <h1>ตรวจสอบข้อมูลการสมัครของนักเรียน</h1>

                                <?php
                                if ($row->std_status == 4) {
                                ?>
                                    <h2 class="text-danger">(**เจ้าหน้าที่<u>เช็คการชำระเงินให้เรียบร้อย</u> ก่อนออกหมายเลขในขั้นตอนนี้)</h2>
                                <?php
                                }
                                ?>


                                <?php
                                if ($row->std_status == 2) {
                                    echo '<h2 class="text-danger"><u>รอนักเรียนแก้ไขข้อมูล <small>(เจ้าหน้าที่ ' . $row->admin_computer . ')</small></u></h2>';
                                    echo '<h3 class="text-danger"></u>' . $row->std_comment . '</h3><hr style="border-top: 1px dashed red;">';
                                }
                                if ($row->std_status == 3) {
                                    echo '<h3 class="text-success"><u>ข้อมูลที่เจ้าหน้าที่แจ้งนักเรียนคนนี้ <small>(เจ้าหน้าที่ ' . $row->admin_computer . ')</small></u></h3>';
                                    echo '<h4 class="text-success"></u>' . $row->std_comment . '</h4><hr style="border-top: 1px dashed green;">';
                                }
                                ?>
                                <br>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-1">


                                    </div>


                                    <div class="col-12 col-sm-12 col-md-4">


                                        <?php

                                        if ($paypay == 1) {
                                        ?>

                                            <!-- ปุ่มเมื่อเช็คข้อมูลเบื้องต้น -->
                                            <?php
                                            if ($row->std_status == 0 || $row->std_status == 2 || $row->std_status == 3) {
                                            ?>
                                                <br><br>
                                                <h3>ข้อมูลนักเรียนครบถ้วน</h3><br><br>
                                                <button class="btn btn-success" type="submit" name="std_status" value="4" style="text-align:center;margin: 0 auto;font-size: 3vh;">
                                                    <i class="ace-icon fa fa-floppy-o bigger-100"></i>&nbsp;&nbsp;ข้อมูลถูกต้อง&nbsp;&nbsp;</button>
                                            <?php
                                            }
                                            ?>
                                            <!-- ปุ่มเมื่อเช็คข้อมูลเบื้องต้น -->


                                            <!-- ปุ่มเมื่อเช็คข้อมูลการชำระเงินของนักเรียน -->
                                            <?php
                                            if ($row->std_status == 4) {
                                            ?>
                                                <h2>เลขประจำตัวสอบ</h2>


                                                <span class="input-icon">
                                                    <input class="input-lg" type="number" name="std_regisid" id="std_regisid" style="padding-left: 5px;" value="<?php echo $row->std_type ?>">
                                                </span>


                                                <h2>ห้องสอบ</h2>
                                                <span class="input-icon">
                                                    <input class="input-lg" type="text" name="std_regisroom" id="std_regisroom" placeholder="ห้องสอบ" style="padding-left: 5px;">
                                                </span>

                                                <br><br><small>รหัสเครื่องเจ้าหน้าที่</small>
                                                <span class="input-icon">
                                                    <input #class="input-sm" type="text" name="admin_computer" value="<?php echo $admin_computer ?>" style="padding-left: 5px;text-align: center;width:60px;background: #000000!important;" readonly>
                                                </span>
                                                <br>

                                                <button class="btn btn-success" type="submit" name="std_status" value="1" style="text-align:center;margin: 0 auto;font-size: 25px;">
                                                    <i class="ace-icon fa fa-floppy-o bigger-160"></i>&nbsp;&nbsp;ยืนยันข้อมูลถูกต้องครบถ้วน&nbsp;&nbsp;</button><br><br>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($paypay == 0) {
                                        ?>
                                            <h2>เลขประจำตัวสอบ</h2>


                                            <span class="input-icon">
                                                <input class="input-lg" type="number" name="std_regisid" id="std_regisid" style="padding-left: 5px;" value="<?php echo $row->std_type ?>">
                                            </span>


                                            <h2>ห้องสอบ</h2>
                                            <span class="input-icon">
                                                <input class="input-lg" type="text" name="std_regisroom" id="std_regisroom" placeholder="ห้องสอบ" style="padding-left: 5px;">
                                            </span>

                                            <br><br><small>รหัสเครื่องเจ้าหน้าที่</small>
                                            <span class="input-icon">
                                                <input #class="input-sm" type="text" name="admin_computer" value="<?php echo $admin_computer ?>" style="padding-left: 5px;text-align: center;width:60px;background: #000000!important;" readonly>
                                            </span>


                                            <button class="btn btn-success" type="submit" name="std_status" value="1" style="text-align:center;margin: 0 auto;font-size: 25px;">
                                                <i class="ace-icon fa fa-floppy-o bigger-160"></i>&nbsp;&nbsp;ยืนยันข้อมูลถูกต้องครบถ้วน&nbsp;&nbsp;</button><br><br>
                                        <?php
                                        }
                                        ?>


                                        <!-- ปุ่มเมื่อเช็คข้อมูลการชำระเงินของนักเรียน -->
                                    </div>

                                    <script>
                                        // function autoregisroomdo() {
                                        //     if ($("#autoregisroom").is(":checked")) {
                                        //         document.getElementById("std_regisroom").disabled = true;
                                        //     } else {
                                        //         document.getElementById("std_regisroom").disabled = false;
                                        //     }
                                        // }

                                        // function autoregisiddo() {
                                        //     if ($("#autoregisid").is(":checked")) {
                                        //         document.getElementById("std_regisid").disabled = true;
                                        //     } else {
                                        //         document.getElementById("std_regisid").disabled = false;
                                        //     }
                                        // }

                                        // const checkbox = document.getElementById('checkboxstd_regisroom')
                                        // checkbox.addEventListener('change', (event) => {
                                        //     if (event.currentTarget.checked) {
                                        //         document.getElementById("std_regisroom").disabled = true;
                                        //     } else {
                                        //         document.getElementById("std_regisroom").disabled = false;
                                        //     }
                                        // })
                                        // const checkbox = document.getElementById('checkboxstd_regisid')
                                        // checkbox.addEventListener('change', (event) => {
                                        //     if (event.currentTarget.checked) {
                                        //         document.getElementById("std_regisid").disabled = true;
                                        //     } else {
                                        //         document.getElementById("std_regisid").disabled = false;
                                        //     }
                                        // })
                                    </script>




                                    <div class="col-12 col-sm-12 col-md-1">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-5" style=" border-left: 4px dotted pink;">

                                        <!-- คอมเม้นไม่ผ่าน แสดงเฉพาะตอนที่ตรวจสอบข้อมูล ตอนออกเลขให้ซ่อน -->
                                        <?php
                                        if ($row->std_status == 0 || $row->std_status == 2 || $row->std_status == 3) {
                                        ?>
                                            <h2>Comment<small>(ในกรณีไม่ผ่านให้เขียนข้อความอธิบายด้านล่าง)</small></h2>
                                            <textarea class="autosize-transition form-control input-lg" name="std_comment" rows="5"></textarea><br>
                                            <div style="text-align:center;margin: 0 auto;">

                                                <button class="btn btn-danger" type="submit" name="std_status" value="2" style="text-align:center;margin: 0 auto;font-size: 20px;">
                                                    <i class="ace-icon fa fa-floppy-o bigger-160"></i>&nbsp;&nbsp;ข้อมูลไม่ผ่าน!!&nbsp;&nbsp;</button>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                        <!-- คอมเม้นไม่ผ่าน แสดงเฉพาะตอนที่ตรวจสอบข้อมูล ตอนออกเลขให้ซ่อน -->

                                    </div>
                                </div>


                            </div>
                        </div>












                        <?php
                        $sqlstd = "SELECT * FROM student$mclass WHERE std_id=:std_id";
                        $querystd = $dbcon->prepare($sqlstd);
                        $querystd->bindParam(':std_id', $std_id, PDO::PARAM_INT);
                        $querystd->execute();
                        $rowstd = $querystd->fetch(PDO::FETCH_OBJ);
                        // foreach ($resultsstd as $rowstd) {
                        ?>

                        <div class="row cnbox">
                            <div class="col col-lg-12 cnbox bg-success text-center">

                                <h1>ตรวจสอบข้อมูลการสมัคร</h1>
                                <h2>ประเภทที่สมัคร</h2><br>

                                <?php
                                $type_class = "ชั้นมัธยมศึกษาปีที่ " . substr($mclass, -1, 1);
                                $num = 1;
                                $sql = "SELECT * FROM registype WHERE type_status=1 AND type_class=:type_class";
                                $query = $dbcon->prepare($sql);
                                $query->bindParam(':type_class', $type_class, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                ?>
                                <div class="row"><?php
                                                    foreach ($results as $row) { ?>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="alert alert-info" role="alert">
                                                <label>
                                                    <input type="radio" class="ace input-lg" name="std_type" value="<?php echo $row->type_id; ?>" onclick="showform<?php echo $num; ?>()" <?php if ($rowstd->std_type == $row->type_id) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>>


                                                    <span class="lbl bigger-120"> <?php echo $row->type_name; ?></span>

                                                </label>
                                            </div>

                                        </div>
                                        <script>
                                            function showform<?php echo $num; ?>() {
                                                document.getElementById('startform').style.display = 'block';


                                                <?php if ($row->type_talent == 1) { ?>
                                                    document.getElementById('formtalent').style.display = 'block';
                                                <?php
                                                        } else { ?>
                                                    document.getElementById('formtalent').style.display = 'none';
                                                <?php
                                                        }
                                                ?>

                                                <?php if ($row->type_onet == 1) { ?>
                                                    document.getElementById('formonet').style.display = 'block';
                                                <?php
                                                        } else { ?>
                                                    document.getElementById('formonet').style.display = 'none';
                                                <?php
                                                        }
                                                ?>

                                                <?php if ($row->type_doc == 1) { ?>
                                                    document.getElementById('formdoc').style.display = 'block';
                                                    document.getElementById('formdocfile').style.display = 'block';
                                                <?php
                                                        } else { ?>
                                                    document.getElementById('formdoc').style.display = 'none';
                                                    document.getElementById('formdocfile').style.display = 'none';
                                                <?php
                                                        }
                                                ?>
                                                <?php if ($row->type_cer == 1) { ?>
                                                    document.getElementById('formcer').style.display = 'block';
                                                    document.getElementById('doccerview').style.display = 'block';
                                                <?php
                                                        } else { ?>
                                                    document.getElementById('formcer').style.display = 'none';
                                                    document.getElementById('doccerview').style.display = 'none';
                                                <?php
                                                        }
                                                ?>

                                                <?php if ($row->type_plan == 1) { ?>
                                                    document.getElementById('formplan').style.display = 'block';
                                                    document.getElementById('formplanold').style.display = 'block';
                                                    document.getElementById("plan1").selectedIndex = <?php echo substr($rowstd->std_plan, 0, 1); ?>;
                                                    document.getElementById("plan2").selectedIndex = <?php echo substr($rowstd->std_plan, 1, 1); ?>;
                                                    document.getElementById("plan3").selectedIndex = <?php echo substr($rowstd->std_plan, 2, 1); ?>;
                                                    document.getElementById("plan4").selectedIndex = <?php echo substr($rowstd->std_plan, 3, 1); ?>;
                                                    document.getElementById("plan1show").selectedIndex = <?php echo substr($rowstd->std_plan, 0, 1); ?>;
                                                    document.getElementById("plan2show").selectedIndex = <?php echo substr($rowstd->std_plan, 1, 1); ?>;
                                                    document.getElementById("plan3show").selectedIndex = <?php echo substr($rowstd->std_plan, 2, 1); ?>;
                                                    document.getElementById("plan4show").selectedIndex = <?php echo substr($rowstd->std_plan, 3, 1); ?>;
                                                    document.getElementById("plan1req").required = true;
                                                    document.getElementById("plan2req").required = true;
                                                    document.getElementById("plan3req").required = true;
                                                    document.getElementById("plan4req").required = true;
                                                <?php
                                                        } else { ?>
                                                    document.getElementById('formplan').style.display = 'none';
                                                    document.getElementById("plan1req").required = false;
                                                    document.getElementById("plan2req").required = false;
                                                    document.getElementById("plan3req").required = false;
                                                    document.getElementById("plan4req").required = false;
                                                <?php
                                                        }
                                                ?>

                                            }
                                        </script>
                                        <?php if ($rowstd->std_type == $row->type_id) {
                                                            echo '<body onload="showform' . $num . '()"></body>';
                                                        }
                                        ?>
                                    <?php

                                                        $num = $num + 1;
                                                    }
                                    ?>

                                </div>
                            </div>
                        </div>










                        <div id="startform" style="display:none;">
                            <link rel="stylesheet" href="assets/css/inputwidth.css" />

                            <div class="row cnbox">
                                <div class="col col-lg-12 cnbox bg-success">
                                    <!-- <h3 class="text-center">กรอกข้อมูลนักเรียน</h3> -->
                                    <div class="row">
                                        <div class="col col-12 col-md-6" style="border-style: hidden double hidden hidden;border-color: #ffc1c1;">
                                            <!-- คอลัมน์ 1 -->

                                            <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลนักเรียน</p>
                                            <label>รหัสบัตรประชาชน</label>
                                            <input type="text" class="form-control w100" value="<?php echo $rowstd->std_id; ?>" name="std_id" readonly>

                                            <div class="row">
                                                <div class="col col-12 col-md-3">
                                                    <label>วันที่เกิด</label></label>
                                                    <input type="number" class="form-control w100" name="std_dayb" value="<?php echo $rowstd->std_dayb; ?>" readonly>

                                                </div>
                                                <div class="col col-12 col-md-3">
                                                    <label>เดือนเกิด</label></label>
                                                    <input type="text" class="form-control w100" id="std_monthb" name="std_monthb" value="<?php echo $rowstd->std_monthb; ?>" readonly>

                                                </div>
                                                <div class="col col-12 col-md-3">
                                                    <label>ปีเกิด</label>
                                                    <input type="number" class="form-control w100" name="std_yearb" value="<?php echo $rowstd->std_yearb; ?>" readonly>

                                                </div>
                                                <div class="col col-12 col-md-3">
                                                    <label>อายุ</label>
                                                    <input type="text" class="form-control w100" name="std_age" value="<?php echo $rowstd->std_age; ?>" readonly>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col col-12 col-md-3">
                                                    <label>คำนำหน้า</label>
                                                    <input type="text" class="form-control w100" name="std_prefix" value="<?php echo $rowstd->std_prefix; ?>" readonly>

                                                </div>
                                                <div class="col col-12 col-md-4">
                                                    <label>ชื่อ</label>
                                                    <input type="text" class="form-control w100" name="std_fname" value="<?php echo $rowstd->std_fname; ?>" readonly>
                                                </div>
                                                <div class="col col-12 col-md-5">
                                                    <label>นามสกุล</label>
                                                    <input type="text" class="form-control w100" name="std_lname" value="<?php echo $rowstd->std_lname; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col col-12 col-md-4">
                                                    <label>ศาสนา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_religion; ?>" name="std_religion" readonly>
                                                </div>
                                                <div class="col col-12 col-md-4">
                                                    <label>เชื้อชาติ</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_race; ?>" name="std_race" readonly>
                                                </div>
                                                <div class="col col-12 col-md-4">
                                                    <label>สัญชาติ</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_nation; ?>" name="std_nation" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col col-12 col-md-5">
                                                    <label>หมู่เลือด</label>
                                                    <input type="text" class="form-control w100" name="std_blood" value="<?php echo $rowstd->std_blood; ?>" readonly>

                                                </div>
                                                <div class="col col-12 col-md-7">
                                                    <label>เบอร์โทรที่สามารถติดต่อนักเรียนได้</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_phone; ?>" name="std_phone" readonly>
                                                </div>
                                            </div>



                                            <div id="formplan" style="display:none;">
                                                <div class="hr dotted hr-double"></div>
                                                <p class="alert alert-info text-right" style="font-size: 25px;">เลือกลำดับแผนการเรียน
                                                    <br>
                                                    <font size="2">(**เลือก 4 ลำดับห้ามซ้ำกัน)</font>
                                                </p>
                                                <?php
                                                include 'includes/config.php';
                                                $sqlplan = "SELECT * FROM stdplan";
                                                $queryplan = $dbcon->prepare($sqlplan);
                                                $queryplan->execute();
                                                $resultsplan = $queryplan->fetchAll(PDO::FETCH_OBJ);
                                                ?>

                                                <script>
                                                    //มา่โค๊ดตัดลำดับ
                                                    var x1 = 0;
                                                    var x2 = 0;

                                                    function hide_plan1(id) {
                                                        var i = 1;
                                                        x1 = id;
                                                        var plannum = <?php echo $queryplan->rowCount();  ?>;
                                                        for (i = 1; i <= plannum; i++) {
                                                            if (i != x1) {
                                                                document.getElementById('plan2_' + i).style.display = 'block';
                                                                document.getElementById('plan3_' + i).style.display = 'block';
                                                                document.getElementById('plan4_' + i).style.display = 'block';
                                                                document.getElementById("plan2block").style.display = 'block';
                                                                document.getElementById('plan2_' + i).disabled = false;
                                                                document.getElementById('plan3_' + i).disabled = false;
                                                                document.getElementById('plan4_' + i).disabled = false;
                                                                // document.createElement("plan2_"+i);
                                                            }
                                                        }
                                                        document.getElementById('plan2_' + id).style.display = 'none';
                                                        document.getElementById('plan3_' + id).style.display = 'none';
                                                        document.getElementById('plan4_' + id).style.display = 'none';
                                                        document.getElementById('plan2_' + id).disabled = true;
                                                        document.getElementById('plan3_' + id).disabled = true;
                                                        document.getElementById('plan4_' + id).disabled = true;
                                                        document.getElementById("plan2").selectedIndex = 0;
                                                        document.getElementById("plan3").selectedIndex = 0;
                                                        document.getElementById("plan4").selectedIndex = 0;
                                                        document.getElementById("plan3block").style.display = 'none';
                                                        document.getElementById("plan4block").style.display = 'none';

                                                    }

                                                    function hide_plan2(id) {

                                                        var i = 1;
                                                        var plannum = <?php echo $queryplan->rowCount();  ?>;
                                                        for (i = 1; i <= plannum; i++) {
                                                            if (i != x1 && i != id) {
                                                                document.getElementById('plan3_' + i).style.display = 'block';
                                                                document.getElementById('plan4_' + i).style.display = 'block';
                                                                document.getElementById("plan3block").style.display = 'block';
                                                                document.getElementById('plan3_' + i).disabled = false;
                                                                document.getElementById('plan4_' + i).disabled = false;
                                                            }
                                                        }
                                                        x2 = id;
                                                        document.getElementById('plan3_' + id).style.display = 'none';
                                                        document.getElementById('plan4_' + id).style.display = 'none';
                                                        document.getElementById('plan3_' + id).disabled = true;
                                                        document.getElementById('plan4_' + id).disabled = true;
                                                        document.getElementById("plan3").selectedIndex = 0;
                                                        document.getElementById("plan4").selectedIndex = 0;
                                                        document.getElementById("plan4block").style.display = 'none';
                                                    }

                                                    function hide_plan3(id) {
                                                        var i = 1;
                                                        var plannum = <?php echo $queryplan->rowCount();  ?>;
                                                        for (i = 1; i <= plannum; i++) {
                                                            if (i != x1 && i != x2 && i != id) {
                                                                document.getElementById('plan4_' + i).style.display = 'block';
                                                                document.getElementById("plan4block").style.display = 'block';
                                                                document.getElementById('plan4_' + i).disabled = false;
                                                            }
                                                        }
                                                        document.getElementById('plan4_' + id).style.display = 'none';
                                                        document.getElementById('plan4_' + id).disabled = true;
                                                        document.getElementById("plan4").selectedIndex = 0;
                                                    }
                                                </script>

                                                <script>
                                                    function formplanedit() {
                                                        document.getElementById('formplanedit').style.display = 'block';
                                                        document.getElementById('formplaneditshow').style.display = 'none';
                                                        document.getElementById("plan1").selectedIndex = 0;
                                                        document.getElementById("plan2").selectedIndex = 0;
                                                        document.getElementById("plan3").selectedIndex = 0;
                                                        document.getElementById("plan4").selectedIndex = 0;
                                                    }
                                                </script>


                                                <div id="formplanold" style="display:block;">
                                                    <a class="btn btn-sm btn-primary btn-block" onclick="formplanedit()">คลิกที่นี่ เพื่อต้องการแก้ไขการเลือกแผนการเรียน</a>
                                                </div>




                                                <!-- สำหรับโชว์ขอเก่าไม่ส่งค่า -->
                                                <div id="formplaneditshow" style="display:block;">
                                                    <label>เลือกลำดับ 1</label>
                                                    <select id="plan1show" class="form-control" disabled>
                                                        <option value="" disabled>- เลือก -</option>
                                                        <?php
                                                        foreach ($resultsplan as $row) {
                                                        ?>
                                                            <option><?php echo $row->plan_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                    <label>เลือกลำดับ 2</label>
                                                    <select id="plan2show" class="form-control" disabled>
                                                        <option value="" disabled>- เลือก -</option>
                                                        <?php
                                                        foreach ($resultsplan as $row) {
                                                        ?>
                                                            <option><?php echo $row->plan_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label>เลือกลำดับ 3</label>
                                                    <select id="plan3show" class="form-control" disabled>
                                                        <option value="" disabled>- เลือก -</option>
                                                        <?php
                                                        foreach ($resultsplan as $row) {
                                                        ?>
                                                            <option><?php echo $row->plan_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label>เลือกลำดับ 4</label>
                                                    <select id="plan4show" class="form-control" disabled>
                                                        <option value="" disabled>- เลือก -</option>
                                                        <?php
                                                        foreach ($resultsplan as $row) {
                                                        ?>
                                                            <option><?php echo $row->plan_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- สำหรับโชว์ขอเก่าไม่ส่งค่า -->


                                                <!-- เลือกลำดับจริงใส่ค่าเดิมแล้วซ่อนไว้ -->
                                                <div id="formplanedit" style="display:none;">
                                                    <label>เลือกลำดับ 1</label>
                                                    <select id="plan1" class="form-control" id="plan1req" data-placeholder="- เลือก -" name="std_plan1" onchange="hide_plan1(this.value)">
                                                        <option value="" disabled>- เลือก -</option>
                                                        <?php
                                                        foreach ($resultsplan as $row) {
                                                        ?>
                                                            <option value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                    <div id="plan2block" style="display:none;">
                                                        <label>เลือกลำดับ 2</label>
                                                        <select id="plan2" class="form-control" id="plan2req" data-placeholder="- เลือก -" name="std_plan2" onchange="hide_plan2(this.value)">
                                                            <option value="" disabled>- เลือก -</option>
                                                            <?php
                                                            foreach ($resultsplan as $row) {
                                                            ?>
                                                                <option id="plan2_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div id="plan3block" style="display:none;">
                                                        <label>เลือกลำดับ 3</label>
                                                        <select id="plan3" class="form-control" id="plan3req" data-placeholder="- เลือก -" name="std_plan3" onchange="hide_plan3(this.value)">
                                                            <option value="" disabled>- เลือก -</option>
                                                            <?php
                                                            foreach ($resultsplan as $row) {
                                                            ?>
                                                                <option id="plan3_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div id="plan4block" style="display:none;">
                                                        <label>เลือกลำดับ 4</label>
                                                        <select id="plan4" class="form-control" id="plan4req" data-placeholder="- เลือก -" name="std_plan4">
                                                            <option value="" disabled>- เลือก -</option>
                                                            <?php
                                                            foreach ($resultsplan as $row) {
                                                            ?>
                                                                <option id="plan4_<?php echo $row->plan_id; ?>" value="<?php echo $row->plan_id; ?>"><?php echo $row->plan_name; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <!-- เลือกลำดับจริงใส่ค่าเดิมแล้วซ่อนไว้ -->
                                                </div>


                                            </div>





                                            <div class="hr dotted hr-double"></div>
                                            <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลการศึกษา</p>
                                            <label>ปัจจุบันสำเร็จการศึกษาจาก (ชื่อโรงเรียนเดิม)</label>
                                            <input type="text" class="form-control w100" value="<?php echo $rowstd->std_eduschool; ?>" name="std_eduschool" readonly>
                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>อำเภอ รร.เดิม</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_edudistrict; ?>" name="std_edudistrict" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>จังหวัด รร.เดิม</label>
                                                    <input class="form-control" required="" name="std_eduprovince" value="<?php echo $rowstd->std_eduprovince; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="hr dotted hr-double"></div>

                                            <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลที่อยู่นักเรียน</p>
                                            <div class="row">
                                                <div class="col col-12 col-md-3">
                                                    <label>บ้านเลขที่</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_homenum; ?>" name="std_homenum" readonly>
                                                </div>
                                                <div class="col col-12 col-md-3">
                                                    <label>หมู่ที่</label>
                                                    <input type="number" class="form-control w100" value="<?php echo $rowstd->std_homevill; ?>" name="std_homevill" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>ตำบล/แขวง</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_homesubdistrict; ?>" name="std_homesubdistrict" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>อำเภอ/เขต</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_homedistrict; ?>" name="std_homedistrict" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>จังหวัด</label>
                                                    <input class="form-control" name="std_homeprovince" readonly value="<?php echo $rowstd->std_homeprovince; ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>รหัสไปรษณีย์</label>
                                                    <input type="number" class="form-control w100" value="<?php echo $rowstd->std_homeposcode; ?>" name="std_homeposcode" readonly>
                                                </div>
                                            </div>


                                            <div class="hr dotted hr-double"></div>

                                            <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลบิดา - มารดา</p>
                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>ชื่อ-นามสกุล บิดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_name; ?>" name="std_father_name" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>อาชีพ บิดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_career; ?>" name="std_father_career" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>สถานที่ทำงาน บิดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_work; ?>" name="std_father_work" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>เบอร์โทรศัพท์ บิดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_father_phone; ?>" name="std_father_phone" readonly>
                                                </div>
                                            </div>
                                            <div class="hr dotted hr-double"></div>
                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>ชื่อ-นามสกุล มารดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_name; ?>" name="std_mother_name" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>อาชีพ มารดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_career; ?>" name="std_mother_career" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-12 col-md-6">
                                                    <label>สถานที่ทำงาน มารดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_work; ?>" name="std_mother_work" readonly>
                                                </div>
                                                <div class="col col-12 col-md-6">
                                                    <label>เบอร์โทรศัพท์ มารดา</label>
                                                    <input type="text" class="form-control w100" value="<?php echo $rowstd->std_mother_phone; ?>" name="std_mother_phone" readonly>
                                                </div>
                                            </div>
                                            <div class="hr dotted hr-double"></div>

                                            <p class="alert alert-info text-right" style="font-size: 25px;">ข้อมูลผู้ปกครอง</p>

                                            <div class="row">
                                                <div class="radio">
                                                    <label class="mt-3">ผู้ปกครอง :</label><label>


                                                        <input type="radio" class="ace w50" name="std_parent_relation" value="บิดา" onclick="javascript: return false;hideparent();" <?php if ($rowstd->std_parent_relation == "บิดา") {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?>>
                                                        <span class="lbl bigger-100">&nbsp;บิดา</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="ace" name="std_parent_relation" value="มารดา" onclick="javascript: return false;hideparent();" <?php if ($rowstd->std_parent_relation == "มารดา") {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                                        <span class="lbl bigger-100">&nbsp;มารดา</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="ace" name="std_parent_relation" value="0" onclick="javascript: return false;showparent();" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                                        <span class="lbl bigger-100">&nbsp;บุคคลอื่น</span>
                                                    </label>

                                                </div>
                                            </div>


                                            <div id="parent" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
                                                                    echo 'style="display:block;"';
                                                                } else {
                                                                    echo 'style="display:none;"';
                                                                }
                                                                ?>>
                                                <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_relation; ?>" name="std_parent_relation_orther" readonly>
                                                <div class="row">
                                                    <div class="col col-12 col-md-6">
                                                        <label>ชื่อ-นามสกุล ผู้ปกครอง</label>
                                                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_name; ?>" name="std_parent_name" #placeholder="- ชื่อ-นามสกุล ผู้ปกครอง ภาษาไทย -" readonly>
                                                    </div>
                                                    <div class="col col-12 col-md-6">
                                                        <label>อาชีพ ผู้ปกครอง</label>
                                                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_career; ?>" name="std_parent_career" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col col-12 col-md-6">
                                                        <label>สถานที่ทำงาน ผู้ปกครอง</label>
                                                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_work; ?>" name="std_parent_work" #placeholder="- ระบุสั้นๆ เช่น ชื่อบริษัท... หรือชื่อจังหวัด.. -" readonly>
                                                    </div>
                                                    <div class="col col-12 col-md-6">
                                                        <label>เบอร์โทรศัพท์ ผู้ปกครอง</label>
                                                        <input type="text" class="form-control w100" value="<?php echo $rowstd->std_parent_phone; ?>" name="std_parent_phone" #placeholder="- กรอกเพียง1หมายเลขที่สามารถติดต่อได้ -" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hr dotted hr-double"></div>


                                            <div id="formtalent" style="display:none;">
                                                <p class="alert alert-info text-right" style="font-size: 25px;">ความสามารถพิเศษ</p>
                                                <label>ความสามารถพิเศษ (ตามเกณฑ์ที่โรงเรียนประกาศไว้)</label>
                                                <!-- <a #href="https://drive.google.com/open?id=18GkPDG946ujpZ5HM2rvnlG05hUCxM15W" target="_blank">(ดูรายละเอียดได้ที่ประกาศรับสมัคร ข้อที่ 7.3)</a></label> -->

                                                <!-- <input type="text" class="form-control" name="std_talent"> -->
                                                <input class="form-control" #id="form-field-select-3" name="std_talent" value="<?php echo $rowstd->std_talent; ?>" readonly>
                                                <label style="padding-top: 10px;">โปรดระบุความสามารถพิเศษ 1 อย่าง ตามประเภทที่เลือกไว้ด้านบน (เช่น "ตะกร้อ")</label><i class="text-danger">*</i>

                                                <input type="text" id="std_talentname" class="form-control w100" value="<?php echo $rowstd->std_talentname; ?>" name="std_talentname" readonly>
                                                <div class="hr dotted hr-double"></div>



                                                <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                    <h3>หลักฐานความสามารถพิเศษ</h3>
                                                    <?php
                                                    if (file_exists($rowstd->std_doctalent)) {
                                                        if (substr($rowstd->std_doctalent, -3) == "pdf") { ?>
                                                            <embed src="<?php echo $rowstd->std_doctalent; ?>" type="application/pdf" width="90%" height="600" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="<?php echo $rowstd->std_doctalent; ?>" width="90%">
                                                    <?php
                                                        }
                                                    } else {
                                                        echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                    }
                                                    ?>
                                                </div>


                                            </div>

                                            <!-- คอลัมน์ 1 -->
                                        </div>
                                        <div class="col col-12 col-md-6">
                                            <!-- คอลัมน์ 2 -->




                                            <!-- อัพรูป -->
                                            <script src="js/jquery.min.js"></script>
                                            <!-- <script src="js/bootstrap.min.js"></script> -->
                                            <script src="js/croppie.js"></script>
                                            <!-- <link rel="stylesheet" href="js/bootstrap.min.css" /> -->
                                            <link rel="stylesheet" href="js/croppie.css" />


                                            <p class="alert alert-info text-right" style="font-size: 25px;">รูปถ่ายชุดนักเรียนหน้าตรง</p>
                                            <div class="row justify-content-md-center">
                                                <div style="height: 230px;width: 200px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;background-image: url('<?php echo $rowstd->std_photo . '?' . (rand(10, 100)); ?>');">
                                                    <div id="uploaded_image" class=""></div>
                                                </div>

                                            </div>

                                            <div class="row justify-content-md-center mt-3" style="width: 80%;margin: 0 auto;padding-top: 1em;font-size:20px;">
                                                <!-- <input type="file" id="upload_image" accept="image/png, image/jpeg, image/bmp"> -->
                                                <!-- <label>อัพโหลดรูปถ่ายหน้าตรง <br><b>สวมเครื่องแบบนักเรียนปัจจุบัน</b></label> -->
                                                <!-- <input type="file" id="upload_image" accept="image/png, image/jpeg, image/jpg, image/bmp"> -->

                                            </div>
                                            <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>







                                            <!-- เอกสารทั้งหมด ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

                                            <div id="doccerview" style="display:none;">
                                                <p class="alert alert-info text-right" style="font-size: 25px;">เอกสารทั้งหมด</p>
                                                <div class="row text-center">
                                                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                        <h4>ใบรับรองการเป็นนักเรียน(ปพ.7) <br>หรือ ระเบียนผลการเรียน(ปพ.1)</h4>
                                                        <?php
                                                        if (file_exists($rowstd->std_doccer)) {
                                                            if (substr($rowstd->std_doccer, -3) == "pdf") { ?>
                                                                <embed src="<?php echo $rowstd->std_doccer. '?' . date("y-m-d-h-i-s"); ?>" type="application/pdf" width="90%" height="600" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="<?php echo $rowstd->std_doccer . '?' . date("y-m-d-h-i-s"); ?>" target="_blank" rel="noopener noreferrer">
                                                                <img src="<?php echo $rowstd->std_doccer . '?' . date("y-m-d-h-i-s"); ?>" width="90%"></a>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                        }
                                                        ?>
                                                        <br><br>
                                                        <?php
                                                        if (file_exists($rowstd->std_doccer_2)) {
                                                            if (substr($rowstd->std_doccer_2, -3) == "pdf") { ?>
                                                                <embed src="<?php echo $rowstd->std_doccer_2. '?' . date("y-m-d-h-i-s"); ?>" type="application/pdf" width="90%" height="600" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="<?php echo $rowstd->std_doccer_2 . '?' . date("y-m-d-h-i-s"); ?>" target="_blank" rel="noopener noreferrer">
                                                                <img src="<?php echo $rowstd->std_doccer_2 . '?' . date("y-m-d-h-i-s"); ?>" width="90%"></a>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div id="formdocfile" style="display:none;">
                                                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                        <h3>สำเนาทะเบียนบ้าน นักเรียน</h3>
                                                        <?php
                                                        if (file_exists($rowstd->std_dochome1)) {
                                                            if (substr($rowstd->std_dochome1, -3) == "pdf") { ?>
                                                                <embed src="<?php echo $rowstd->std_dochome1; ?>" type="application/pdf" width="90%" height="600" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="<?php echo $rowstd->std_dochome1. '?' . date("y-m-d-h-i-s"); ?>" target="_blank">
                                                                <img src="<?php echo $rowstd->std_dochome1 . '?' . date("y-m-d-h-i-s"); ?>" width="90%"></a>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                        <h3>สำเนาทะเบียนบ้าน บิดา</h3>
                                                        <?php
                                                        if (file_exists($rowstd->std_dochome2)) {
                                                            if (substr($rowstd->std_dochome2, -3) == "pdf") { ?>
                                                                <embed src="<?php echo $rowstd->std_dochome2; ?>" type="application/pdf" width="90%" height="600" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="<?php echo $rowstd->std_dochome2 . '?' . date("y-m-d-h-i-s"); ?>" target="_blank" rel="noopener noreferrer">
                                                                    <img src="<?php echo $rowstd->std_dochome2 . '?' . date("y-m-d-h-i-s"); ?>" width="90%">
                                                                </a>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                        <h3>สำเนาทะเบียนบ้าน มารดา</h3>
                                                        <?php
                                                        if (file_exists($rowstd->std_dochome3)) {
                                                            if (substr($rowstd->std_dochome3, -3) == "pdf") { ?>
                                                                <embed src="<?php echo $rowstd->std_dochome3; ?>" type="application/pdf" width="90%" height="600" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="<?php echo $rowstd->std_dochome3 . '?' . date("y-m-d-h-i-s"); ?>" target="_blank" rel="noopener noreferrer">
                                                                    <img src="<?php echo $rowstd->std_dochome3 . '?' . date("y-m-d-h-i-s"); ?>" width="90%">
                                                                </a>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                    if ($rowstd->std_parent_relation != 'บิดา' && $rowstd->std_parent_relation != 'มารดา') { ?>
                                                        <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                            <h3>สำเนาทะเบียนบ้าน ผู้ปกครอง</h3>
                                                            <?php
                                                            if (file_exists($rowstd->std_dochome4)) {
                                                                if (substr($rowstd->std_dochome4, -3) == "pdf") { ?>
                                                                    <embed src="<?php echo $rowstd->std_dochome4; ?>" type="application/pdf" width="90%" height="600" />
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <a href="<?php echo $rowstd->std_dochome4 . '?' . date("y-m-d-h-i-s"); ?>" target="_blank" rel="noopener noreferrer">
                                                                        <img src="<?php echo $rowstd->std_dochome4 . '?' . date("y-m-d-h-i-s"); ?>" width="90%">
                                                                    </a>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                            }
                                                            ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <div style="display: none;">
                                                        <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                            <h3>ฟหกฟหกใบแสดงผลคะแนน O-NET</h3>
                                                            <?php
                                                            if (file_exists($rowstd->std_doconet)) {
                                                                if (substr($rowstd->std_doconet, -3) == "pdf") { ?>
                                                                    <embed src="<?php echo $rowstd->std_doconet; ?>" type="application/pdf" width="90%" height="600" />
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo $rowstd->std_doconet . '?' . rand(111, 999); ?>" width="90%">
                                                            <?php
                                                                }
                                                            } else {
                                                                echo '<img src="stddoc/nofile.png" width="20%"><br>ไม่พบเอกสารนี้<br>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>





                                                    <?php
                                                    if (file_exists($rowstd->std_doccer_3)) {
                                                        echo '<div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">';
                                                        echo '<h3>เอกสารอื่นๆ</h3>';
                                                        if (substr($rowstd->std_doccer_3, -3) == "pdf") { ?>
                                                            <embed src="<?php echo $rowstd->std_doccer_3; ?>" type="application/pdf" width="90%" height="600" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="<?php echo $rowstd->std_doccer_3 . '?' . rand(111, 999); ?>" target="_blank" rel="noopener noreferrer">
                                                                <img src="<?php echo $rowstd->std_doccer_3 . '?' . rand(111, 999); ?>" width="90%">
                                                            </a>
                                                    <?php
                                                        }
                                                        echo '</div>';
                                                    }
                                                    ?>

                                                    <?php
                                                    if (file_exists($rowstd->std_doccer_4)) {
                                                        echo '<div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">';
                                                        echo '<h3>เอกสารอื่นๆ</h3>';
                                                        if (substr($rowstd->std_doccer_4, -3) == "pdf") { ?>
                                                            <embed src="<?php echo $rowstd->std_doccer_4; ?>" type="application/pdf" width="90%" height="600" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="<?php echo $rowstd->std_doccer_4 . '?' . rand(111, 999); ?>" target="_blank" rel="noopener noreferrer">
                                                                <img src="<?php echo $rowstd->std_doccer_4 . '?' . rand(111, 999); ?>" width="90%">
                                                            </a>
                                                    <?php
                                                        }
                                                        echo '</div>';
                                                    }
                                                    ?>







                                                </div>
                                            </div>
                                            <!-- เอกสารทั้งหมด ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
























                                            <div id="formcer" style="display:none;">
                                                <div style="display:none;">
                                                    <p class="alert alert-info text-right" style="font-size: 25px;">อัพโหลดเอกสาร<br>
                                                        <font size="2">(ใช้รูปภาพหรือPDFเท่านั้น ขนาดไม่เกิน 3MB)</font>
                                                    </p>









                                                    <div class="row text-center">
                                                        <div clpoass="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                            <h4>ใบรับรองการเป็นนักเรียน(ปพ.7) <br>หรือ ระเบียนผลการเรียน(ปพ.1)</h4>
                                                            <h5 class="text-danger">-<u>ถ้ามี 1 ไฟล์ให้อัพเฉพาะหมายเลข ( 1 ) </u><br>-<u>ถ้ามี 2 ไฟล์ให้อัพทั้งหมายเลข ( 1 ) และ ( 2 )</u></h5>
                                                        </div>
                                                        <div class="col col-12 col-md-6">
                                                            <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                                                                <input type="file" id="upload_doc1" name="std_doccer" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                                <h2 class="text-primary" style="margin-top: 0px;">( 1 )</h2>
                                                                <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5>
                                                                <?php
                                                                if (file_exists($rowstd->std_doccer)) {
                                                                ?>
                                                                    <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                        <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                        <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                        <a href="<?php echo $rowstd->std_doccer; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                        <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                    </div>
                                                                <?php } ?>
                                                            </div><br>

                                                        </div>
                                                        <div class="col col-12 col-md-6">
                                                            <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                                                                <input type="file" id="upload_doc2" name="std_doccer_2" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                                <h2 class="text-primary" style="margin-top: 0px;">( 2 )</h2>
                                                                <h5 class="text-primary"><b>ใบรับรองหรือระเบียนผลการเรียน</b></h5>
                                                                <?php
                                                                if (file_exists($rowstd->std_doccer_2)) {
                                                                ?>
                                                                    <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                        <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                        <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                        <a href="<?php echo $rowstd->std_doccer_2; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                        <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>
                                                </div>
                                            </div>






                                            <div id="formdoc" style="display:none;">
                                                <div style="display:none;">
                                                    <div class="row text-center">
                                                        <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                            <h4>สำเนาทะเบียนบ้าน</h4>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-12 col-md-5">
                                                            <div class="text-center">
                                                                <h4>ตัวอย่างสำเนาทะเบียนบ้าน</h4>
                                                                <img src="stddoc/home-ex.jpg" width="90%" style="border:2px solid black">
                                                            </div><br><br>
                                                        </div>
                                                        <div class="col col-12 col-md-7">

                                                            <div class="row text-center">
                                                                <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 10px solid #bce8f1;">
                                                                    <input type="file" id="upload_doc3" name="std_dochome1" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                                    <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน นักเรียน</b></h4>
                                                                    <?php
                                                                    if (file_exists($rowstd->std_dochome1)) {
                                                                    ?>
                                                                        <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                            <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                            <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                            <a href="<?php echo $rowstd->std_dochome1; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                            <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div><br>
                                                            </div>

                                                            <div class="row text-center">
                                                                <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                                                                    <input type="file" id="upload_doc4" name="std_dochome2" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                                    <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน บิดา</b></h4>
                                                                    <?php
                                                                    if (file_exists($rowstd->std_dochome2)) {
                                                                    ?>
                                                                        <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                            <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                            <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                            <a href="<?php echo $rowstd->std_dochome2; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                            <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div><br>
                                                            </div>

                                                            <div class="row text-center">
                                                                <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                                                                    <input type="file" id="upload_doc5" name="std_dochome3" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                                    <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน มารดา</b></h4>
                                                                    <?php
                                                                    if (file_exists($rowstd->std_dochome3)) {
                                                                    ?>
                                                                        <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                            <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                            <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                            <a href="<?php echo $rowstd->std_dochome3; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                            <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>

                                                            <!-- <div id="parentdoc" style="display:none;"> -->
                                                            <div id="parentdoc" <?php if ($rowstd->std_parent_relation != "บิดา" && $rowstd->std_parent_relation != "มารดา") {
                                                                                    echo 'style="display:block;"';
                                                                                } else {
                                                                                    echo 'style="display:none;"';
                                                                                }
                                                                                ?>>
                                                                <div class="row text-center"><br>
                                                                    <div class="bg-danger" style="width: 90%; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                                                                        <input type="file" id="upload_doc6" name="std_dochome4" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                                        <h4 class="text-primary"><b>สำเนาทะเบียนบ้าน ผู้ปกครอง</b></h4>
                                                                        <?php
                                                                        if (file_exists($rowstd->std_dochome4)) {
                                                                        ?>
                                                                            <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                                <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                                <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                                <a href="<?php echo $rowstd->std_dochome4; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                                <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div id="formonet" style="display:none;">
                                                <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>

                                                <div class="row text-center">
                                                    <div class="col-12 bg-info" style="text-align:center;margin: 5px;border: 2px solid #bce8f1;">
                                                        <h4>ใบแสดงผลคะแนน O-NET ปีการศึกษา&nbsp;<?php echo $thisyear - 1; ?></h4>
                                                    </div>
                                                    <div class="col col-12 col-md-5">
                                                        <h5><a href="http://www.newonetresult.niets.or.th/Individualweb/notice/frEnquireStudentGraphScore.aspx" target="_blank">
                                                                คลิกที่นี่เพื่อดาวน์โหลดจากเว็บสทศ.</a><br>ตัวอย่างใบแสดงผลคะแนน O-NET</h5>
                                                        <img src="stddoc/onet-ex.jpg" width="80%" style="border:2px solid black"><br><br>
                                                    </div>
                                                    <div class="col col-12 col-md-7">
                                                        <div class="bg-danger" style="width:90%;text-align:center;margin: 0 auto;border: 2px solid #bce8f1;">
                                                            <input type="file" id="upload_doc7" name="std_doconet" accept="image/png, image/jpeg, image/jpg, image/bmp, application/pdf">
                                                            <h4 class="text-primary"><b>ใบแสดงผลคะแนน O-NET<br>ปีการศึกษา&nbsp;<?php echo $thisyear - 1; ?></b></h4>
                                                            <?php
                                                            if (file_exists($rowstd->std_doconet)) {
                                                            ?>
                                                                <div style="text-align:right;margin-right: 5px;background-color: #cbf9fa;border-top: double #e96b6b;">
                                                                    <i class="menu-icon fa fa-check-circle-o text-success bigger-180"></i>
                                                                    <i class="text-success bigger-120">มีเอกสารในระบบแล้ว</i>
                                                                    <a href="<?php echo $rowstd->std_doconet; ?>" target="_blank" class="badge badge-primary">ดูเอกสาร&nbsp;<i class="fa fa-hand-o-left"></i></a>
                                                                    <br><i class="text-danger bigger-110">อัพโหลดใหม่!! ถ้าต้องการแก้ไข</i>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr dotted hr-double" style="border: 2px solid #bce8f1;"></div>
                                            </div>



                                        </div>





                                        <!-- คอลัมน์ 2 -->
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- <div class="row cnbox">
                            <div class="col col-lg-10 cnbox bg-success text-center">

                                <div style="width:80%;text-align:center;margin: 0 auto;">
                                    <label>
                                        <input type="checkbox" class="ace input-lg" name="confirm" value="1" required #oninvalid="this.setCustomValidity('โปรดคลิกที่เครื่องหมาย เพื่อยืนยันข้อมูล')">
                                        <span class="lbl bigger-150 text-primary" #style="color: #dff0d8;"> ยืนยันแก้ไขข้อมูล</span>
                                    </label>
                                    <br><span class="lbl bigger-130 text-danger">ข้อความและเอกสารข้างต้นเป็นจริงทุกประการ <br>หากข้อมูลเป็นเท็จทางโรงเรียนมีสิทธิ์<u>ตัดสิทธิ์การสมัคร</u>เข้าเรียนในครั้งนี้ของท่าน และ<u>ดำเนินคดีตามกฏหมาย</u>
                                        <br>เพื่อให้เจ้าหน้าที่ตรวจสอบข้อมูลได้ถูกต้องรวดเร็ว <u>โปรดตรวจสอบข้อมูลให้ครบถ้วนชัดเจนตามความจริง</u></span>

                                </div>


                            </div <div class="row cnbox">
                            <div class="col col-lg-10 cnbox bg-success text-center">

                                <div style="text-align:center;margin: 0 auto;">
                                    <button class="btn btn-block btn-warning" type="submit" style="text-align:center;margin: 0 auto;font-size: 20px;">
                                        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>&nbsp;&nbsp;ยืนยันการแก้ไขข้อมูล&nbsp;&nbsp;</button>

                                </div>


                            </div>
                        </div> -->

                </div>
                </form>

                <!-- อัพรูป -->
                <!-- modal crop -->
                <div id="uploadimageModal2" class="modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">โปรดเลือกส่วนของรูปถ่าย</h4>

                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col col-12 col-md-6 text-center">
                                        <div id="image_demo" #style="width:350px; margin-top:30px"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-12 col-md-12" #style="padding-top:30px;">

                                        <button class="btn btn-lg btn-success crop_image" onClick=reload();>ยืนยัน</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- modal crop -->

            </div>
        </div>
        </div>




        <script>
            $(document).ready(function() {

                $image_crop = $('#image_demo').croppie({
                    enableExif: true,
                    viewport: {
                        width: 200,
                        height: 230,
                        type: 'square' //circle
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });

                $('#upload_image').on('change', function() {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $image_crop.croppie('bind', {
                            url: event.target.result
                        }).then(function() {
                            console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#uploadimageModal').modal('show');
                });

                $('.crop_image').click(function(event) {
                    $image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(response) {
                        $.ajax({
                            url: "<?php echo $mclass; ?>editdata.php",
                            type: "POST",
                            data: {
                                "image": response
                            },
                            success: function(data) {
                                $('#uploadimageModal').modal('hide');
                                imgsrc = "<img id='capt' src='stdphoto/<?php echo $mclass; ?>/<?php echo $std_id; ?>.jpg'>";
                                $('#uploaded_image').html(imgsrc);
                                reload();
                            }
                        });
                    })
                });
            });
        </script>
        <!-- upload image script -->
        <img src="">
        <script type="text/javascript">
            function reload() {
                img = document.getElementById("capt");
                img.src = "stdphoto/<?php echo $mclass; ?>/" + "<?php echo $std_id; ?>" + ".jpg?" + Math.random();
                document.getElementById("upload_image").value = "";

            }
        </script>




        <?php
        include "includes/footer.php";
        ?>

        <script type="text/javascript">
            function hideparent() {
                // document.getElementById('parent').style.display = 'none';
                // document.getElementById('parentdoc').style.display = 'none';
            }

            function showparent() {
                // document.getElementById('parent').style.display = 'block';
                // document.getElementById('parentdoc').style.display = 'block';
            }
        </script>
        <script>
            $('#upload_image , #id-input-file-1 , #id-input-file-2').ace_file_input({
                no_file: 'คลิกเลือกรูปที่นี่',
                btn_choose: 'เลือก',
                btn_change: 'เปลี่ยน',
                droppable: false,
                onchange: null,
                //thumbnail: false,
                icon_remove: null, //| true | large
                whitelist: 'gif|png|jpg|jpeg',
                blacklist: 'exe|php',
                //onchange:''
                //
            });
            $('#upload_doc0,#upload_doc1,#upload_doc2,#upload_doc3,#upload_doc4,#upload_doc5,#upload_doc6,#upload_doc7').ace_file_input({
                style: 'well',
                btn_choose: 'คลิกที่นี่เพื่อเลือกไฟล์',
                btn_change: null,
                no_icon: 'ace-icon fa fa-cloud-upload',
                droppable: false,
                maxSize: 3145728,
                alert: 'asdasd',
                allowExt: ["jpeg", "jpg", "png", "gif", "pdf"],
                allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "application/pdf"],
                thumbnail: 'large'
            });
            $('#upload_doc0,#upload_doc1,#upload_doc2,#upload_doc3,#upload_doc4,#upload_doc5,#upload_doc6,#upload_doc7').on('file.error.ace', function(ev, info) {
                if (info.error_count['ext'] || info.error_count['mime']) alert('กรุณาเลือกไฟล์รูปภาพ หรือ ไฟล์PDF เท่านั้น');
                if (info.error_count['size']) alert('ไฟล์มีขนาดใหญ่เกินไป!! กรุณาอัพโหลดไฟล์ที่มีขนาดน้อยกว่า 3MB');

                //you can reset previous selection on error
                //ev.preventDefault();
                //file_input.ace_file_input('reset_input');
            });
        </script>

        <!-- pop up check file -->

    <?php
    }
    ?>
<?php
}
?>