<?php
include 'includes/header.php';
?>

<?php session_start();
$_SESSION['page'] = 'checkpage';
if ($_SESSION['where'] != 'm4') {
    header("Location: index.php");
}
?>

<?php
$std_id = $_SESSION['std_id'];
?>

<?php
include 'includes/sidebar.php';
?>


<!-- โชว์ข้อมูลเมื่อเจอข้อมูลในระบบ -->
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="row cnbox">
                <div class="col-12 cnbox bg-success">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ตรวจสอบผลการสมัคร</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>



            <div class="row cnbox">
                <div class="col-12 cnbox bg-info text-center">



                    <?php
                    include 'includes/config.php';
                    $sql = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_id=:std_id";
                    $query = $dbcon->prepare($sql);
                    $query->bindParam(':std_id', $std_id, PDO::PARAM_STR);
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว

                    // ค่า config
                    $sqlconfig = "SELECT * FROM config";
                    $queryconfig = $dbcon->prepare($sqlconfig);
                    $queryconfig->execute();
                    $rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว
                    ?>
                    <div class="row">
                        <h2>ตรวจสอบผลการสมัคร</h2><br>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <div style="height: 305px;width: 265px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;">
                                <div>
                                    <img src="<?php
                                                if (file_exists($row->std_photo)) {
                                                    echo $row->std_photo . "?" . (rand(1, 100));
                                                } else {
                                                    echo "stdphoto/nophoto.jpg";
                                                }
                                                ?>" width="260px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-6 col-md-12">
                            <div style="text-align:center;margin: 0 auto;">
                                <br>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name" style="width: 200px;">
                                            <h4>ชื่อ - นามสกุล</h4>
                                        </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php echo "<h3>" . $row->std_prefix . $row->std_fname . "&nbsp;" . $row->std_lname . "<h3>"; ?>
                                        </div>
                                    </div>
                                    <!-- <div class="profile-info-row">
                                        <div class="profile-info-name" style="width: 200px;">
                                            <h4>หมายเลขบัตรประชาชน</h4>
                                        </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php //echo '<h3>' . substr($row->std_id, 0, 1) . '-' . substr($row->std_id, 1, 4) . '-' . substr($row->std_id, 5, 5) .
                                                //'-' . substr($row->std_id, 10, 2) . '-' . substr($row->std_id, 12, 1) . '</h3>'; ?>
                                        </div>
                                    </div> -->
                                    <div class="profile-info-row">
                                        <div class="profile-info-name" style="width: 200px;">
                                            <h4>ประเภท</h4>
                                        </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php
                                            echo "<h3>" . $row->type_name . "<h3>";
                                            ?>
                                        </div>
                                    </div>


                                    <?php
                                    // if ($row->type_pay == '1') { 
                                    ?>
                                    <!-- <div class="profile-info-row">
                                            <div class="profile-info-name" style="width: 200px;">
                                                <h4> การชำระเงิน</h4>
                                            </div>
                                            <div class="profile-info-value text-primary" style="background-color: white;">
                                                <?php
                                                // if ($row->std_conpay == '0') {
                                                //     echo "<h3 class=\"text-danger\">ยังไม่ได้รับการยืนยันการชำระเงิน</h3>(ถ้าชำระเงินแล้วโปรดรอเจ้าหน้าที่ตรวจสอบ)";
                                                // }
                                                // if ($row->std_conpay == '1') {
                                                //     echo "<h3 class=\"text-success\">ชำระเงินเรียบร้อยแล้ว</h3>";
                                                // }
                                                // if ($row->std_conpay == '2') {
                                                //     echo "<h4 class=\"text-warning\">นักเรียนส่งหลักฐานยืนยันการชำระเงินแล้ว รอเจ้าหน้าที่ตรวจสอบ</h4>";
                                                // }
                                                // if ($row->std_conpay == '3') {
                                                //     echo "<h3 class=\"text-danger\">ยืนยันไม่ผ่าน!! กรุณาตรวจสอบและยืนยันใหม่อีกครั้ง</h3>";
                                                // }
                                                ?>
                                            </div>
                                        </div> -->
                                    <?php
                                    // }
                                    ?>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name" style="width: 200px;">
                                            <h4> สถานะ </h4>
                                        </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php
                                            if ($row->std_status == '0') {
                                                echo "<h3 class=\"text-danger\">  รอเจ้าหน้าที่ตรวจสอบข้อมูล </h3>";
                                            } else if ($row->std_status == '1') {
                                                echo "<h3 class=\"text-success\">การตรวจสอบข้อมูล ผ่านแล้ว</h3>
                                                <h4 class='text-danger'>ขอให้ผู้สมัครเข้าระบบอีกครั้งหลังวันที่ปิดรับสมัครแล้ว เพื่อพิมพ์บัตรเข้าห้องสอบ</h4>";
                                            } else if ($row->std_status == '2') {
                                                echo "<h3 class=\"text-danger\">ข้อมูลไม่ผ่าน!! โปรดแก้ไขข้อมูล</h3>";
                                                echo "<h4 class=\"text-primary\">" . $row->std_comment . "</h4>";
                                            } else if ($row->std_status == '3') {
                                                echo "<h3 class=\"text-danger\">นักเรียนแก้ไขข้อมูลแล้ว รอเจ้าหน้าที่ตรวจสอบข้อมูลอีกครั้ง</h3>";
                                            } else if ($row->std_status == '4') {
                                                echo "<h3 class=\"text-success\">ข้อมูลนักเรียนผ่านการตรวจสอบแล้ว <font color=\"orange\">สามารถชำระเงินได้</font> </h3> <h4 class=\"text-primary\"><a href=\"pay.php\"><u>โปรดดำเนินการชำระเงิน <font color=red>(และรอเจ้าหน้าที่ตรวจสอบ)</u></font></a></h4>";
                                            }
                                            ?>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="row">
                        <div style="text-align:center;margin: 0 auto;">
                            <br>
                            <a class="btn btn-primary btn-lg" href="index.php">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;กลับไปหน้าหลัก</a>

                            <?php
                            // if ($row->type_pay == '1') { 
                            ?>
                            <!-- <a class="btn btn-primary btn-lg" href="payin.php">
                                    <i class="fa fa-money" aria-hidden="true"></i>&nbsp;ชำระเงิน</a> -->
                            <?php
                            // }
                            ?>

                            <?php
                            if ($row->std_status == '2') { 
                            ?>
                            <a class="btn btn-warning btn-lg" href="edit.php">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;แก้ไขข้อมูล</a>
                            <?php
                            }
                            ?>


                            <?php
                            include 'includes/config.php';
                            $sqlconfig = "SELECT * FROM config";
                            $queryconfig = $dbcon->prepare($sqlconfig);
                            $queryconfig->execute();
                            $rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ);
                            if ($rowconfig->con_m4print == '1') {
                                if ($row->std_status == '1') { ?>
                                    <a class="btn btn-success btn-lg" href="print.php">
                                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;พิมพ์บัตรสอบ</a>
                            <?php
                                }
                            }
                            ?>
                            <?php
                            if ($row->std_status == '4') {
                            ?>
                                <a class="btn btn-success btn-lg" href="pay.php">
                                    <i class="fa fa-money" aria-hidden="true"></i>&nbsp;คลิกที่นี่!! เพื่อไปหน้าชำระเงิน</a>
                            <?php
                            }

                            ?>

                        </div><br>
                    </div>

                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->



<?php
include 'includes/footer.php';
?>

<!-- โชว์ข้อมูลเมื่อเจอข้อมูลในระบบ -->