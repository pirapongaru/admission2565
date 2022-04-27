<?php
include 'includes/config.php';
$sql = "SELECT * FROM config";
$query = $dbcon->prepare($sql);
$query->execute();
$config = $query->fetch(PDO::FETCH_OBJ);
// foreach ($results as $config) {
// }
// mysqli_close($dbcon);
?>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar" style="background-color:#38a767;width: fit-content;height: 50px;">

                <a style="color: white;font-size: large;">&nbsp;&nbsp;<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>&nbsp;เมนูหลัก&nbsp;&nbsp;</a>
                <!-- <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>  -->
            </button>
            <div class="navbar-header pull-left">
                <a #href="index.php" class="navbar-brand">
                    <small>
                        <!-- <i class="fa fa-leaf"></i> -->
                        ระบบรับสมัครนักเรียน - Admission System (<?php echo $config->con_typeadmission; ?>)
                    </small>
                </a>
            </div>
        </div>
    </div>
    <div class="main-container ace-save-state" id="main-container">
        <div id="sidebar" class="sidebar responsive ace-save-state">
            <div class="text-center">


                <img src="<?php echo $config->con_logo; ?>" width="70%" style="padding: 10px;">
            </div>
            <ul class="nav nav-list">
                <li class="<?php if ($_SESSION['page'] == 'index') {
                                echo "active";
                            } ?>">
                    <a href="index.php">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> หน้าหลัก </span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <!-- <li class="<?php //if ($_SESSION['page'] == 'howto') {
                                //echo "active";
                            //} ?>">
                    <a href="howto.php">
                        <font size="4">&nbsp;<i class="menu fa fa-play-circle-o"></i></font>&nbsp;
                        <span class="menu-text"> ขั้นตอนการสมัคร </span>
                    </a>
                    <b class="arrow"></b>
                </li> -->


                <?php if ($config->con_statistic == 1) { ?>
                    <li class="<?php if ($_SESSION['page'] == 'statistic') {
                                    echo "active";
                                } ?>">
                        <a href="statistic.php">
                            <i class="menu-icon fa fa-bar-chart-o"></i>
                            <span class="menu-text"> สถิติการสมัคร </span>
                            <!-- <font color=red>//ปิด</font> -->
                        </a>
                        <b class="arrow"></b>
                    </li>
                <?php } ?>

                <hr style="margin-top: 0px;margin-bottom: 15px;">
                <p class="text-center text-danger"> กรอกข้อมูลนักเรียน </p>
                <!-- ม1 -->
                <?php if ($config->con_m1m4only != 4) { ?>
                    <?php if ($config->con_m1open == 1) { ?>

                        <li class="<?php if ($_SESSION['page'] == 'm1-1') {
                                        echo "active";
                                    } ?>">
                            <a href="m1start.php?openExternalBrowser=1">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> สมัคร ม.1 </span>
                            </a>
                            <b class="arrow"></b>
                        </li>

                    <?php } else { ?>
                        <li>
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text">
                                    สมัคร ม.1 <i class="text-danger">//ปิดระบบ</i>
                                </span>
                            </a>
                            <b class="arrow"></b>
                        </li>
                    <?php } ?>
                <?php } ?>
                <!-- ม1 -->

                <!-- ม4 -->
                <?php if ($config->con_m1m4only != 1) { ?>
                    <?php if ($config->con_m4open == 1) { ?>
                        <li class="<?php if ($_SESSION['page'] == 'm4-1') {
                                        echo "active";
                                    } ?>">
                            <a href="m4start.php?openExternalBrowser=1">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text">สมัคร ม.4</span>
                            </a>
                            <!-- <b class="arrow"></b> -->
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text">
                                    สมัคร ม.4 <i class="text-danger">//ปิดระบบ</i>
                                </span>
                            </a>
                            <b class="arrow"></b>
                        </li>
                    <?php } ?>
                <?php } ?>

                <?php if ($config->con_editm1 == 1 || $config->con_editm4 == 1) { ?>
                    <li class="<?php if ($_SESSION['page'] == 'updatepage') {
                                    echo "active";
                                } ?>">
                        <a href="edit.php?openExternalBrowser=1">
                            <i class="menu-icon fa fa-edit"></i>
                            แก้ไข ข้อมูล/เอกสาร
                        </a>
                        <b class="arrow"></b>
                    </li>
                <?php } ?>
                <!-- ม4 -->

                <hr style="margin-top: 0px;margin-bottom: 15px;">
                <p class="text-center text-danger"> ตรวจสอบผล </p>


                <li class="<?php if ($_SESSION['page'] == 'checkpage') {
                                echo "active";
                            } ?>">
                    <a href="check.php">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        ตรวจสอบผลการสมัคร
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php if ($config->con_statistic == 1) { ?>
                <!-- <li class="<?php //if ($_SESSION['page'] == 'studentshow') {
                                //echo "active";
                            //} ?>">
                    <a href="student.php">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        รายชื่อผู้สมัคร
                    </a>
                    <b class="arrow"></b>
                </li> -->
                <?php } ?>





                <?php if ($config->con_pay == 99) { ?>
                    <?php
                    include 'includes/config.php';
                    $sql2 = "SELECT * FROM registype WHERE type_pay=1 AND type_status=1";
                    $query2 = $dbcon->prepare($sql2);
                    $query2->execute();
                    // $results = $query2->fetchAll(PDO::FETCH_OBJ);
                    if ($query2->rowCount() != 0) { ?>
                        <hr style="margin-top: 0px;margin-bottom: 15px;">
                        <p class="text-center text-danger"> การชำระเงิน </p>
                        <li class="<?php if ($_SESSION['page'] == 'pay') {
                                        echo "active";
                                    } ?>">
                            <a href="pay.php">                                
                                <i class="menu-icon fa fa-money"></i>
                                <span class="menu-text"> ชำระเงินค่าสมัคร </span>
                            </a>
                            <b class="arrow"></b>
                        </li>
                        
                        <!-- <li class="">
                            <a href="print.php">
                            <i class="menu-icon fa fa-usd"></i>
                                <i class="menu-icon fa fa-money"></i>
                                <span class="menu-text"> ยืนยันการชำระเงิน </span>
                            </a>
                            <b class="arrow"></b>
                        </li> -->

                    <?php
                    }
                    // mysqli_close($dbcon);
                    ?>

                <?php } ?>




                <hr style="margin-top: 0px;margin-bottom: 15px;">
                <p class="text-center text-danger">พิมพ์บัตรสอบ</p>
                <li class="<?php if ($_SESSION['page'] == 'print') {
                                echo "active";
                            } ?>">
                    <a href="print.php">
                        <i class="menu-icon glyphicon glyphicon-print"></i>
                        <span class="menu-text"> พิมพ์บัตรสอบ </span>
                    </a>
                    <b class="arrow"></b>
                </li>



                <hr style="margin-top: 0px;margin-bottom: 15px;">
                <p class="text-center text-danger">สำหรับเจ้าหน้าที่</p>
                <li class="<?php if ($_SESSION['page'] == 'administrator') {
                                echo "active";
                            } ?>">
                    <a href="admin.php">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> เจ้าหน้าที่ตรวจสอบ </span>
                    </a>
                    <b class="arrow"></b>
                </li>
              



                <li class="<?php if ($_SESSION['page'] == 'superadmin') {
                                echo "active";
                            } ?>">
                    <a href="superadmin.php">
                        <i class="menu-icon fa fa-cogs"></i>
                        <span class="menu-text"> ตั้งค่าระบบ </span>
                    </a>
                    <b class="arrow"></b>
                </li>


              
                




            </ul>
            <!-- /.nav-list -->
            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
            <hr>
            <!-- 1190500038845<br>1190500038888<br><br> -->
            <!-- <div class="text-center"><img src="img/skrlogo.png" width="100px"></div> -->
            <hr>
        </div>