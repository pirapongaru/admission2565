<?php
session_start();
// มีการจ่ายเงิน************************************************************************
$paypay = 1; //0 คือ ออกเลขเลย / 1 คือ มีการชำระเงิน
$_SESSION['where'] = 'administrator';
$_SESSION['page'] = 'administrator';
$admin_computer = $_SESSION['admin_computer'];

if ($_SESSION['admindo'] != 'm4') {
    session_destroy();
    header("Location: admin.php");
}

// header("refresh:60");
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
include 'includes/header.php';
?>

<?php
include 'includes/sidebar.php';
?>
<?php
// include 'connectdb.php';
// $sql = "SELECT * FROM studentm1";
// $result = mysqli_query($dbcon, $sql);
//mysqli_num_rows($result);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// while ($row = mysqli_fetch_assoc($result)) {
//     echo "std_id : " . $row['std_id'] . "<br>";
// }
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header ">
                <h1>
                    เจ้าหน้าที่ตรวจสอบข้อมูล ชั้นมัธยมศึกษาปีที่ 4
                </h1>
            </div><!-- /.page-header -->
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>


            <div class="row">
                <div class="col-12 cnbox bg-info text-center">
                    <div class="row">
                        <div class="col-lg-6 text-left"> <span class="badge badge-primary">
                                <h5><?php echo $admin_computer; ?></h5>
                            </span></div>
                        <div class="col-lg-6 text-right">
                            <a href="adminall/m4.php" class="btn btn-yellow">
                                <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>แก้ไขข้อมูลโดยรวม
                            </a>
                        </div>
                    </div>




                    <div>

                        <h1>สถานะผู้สมัคร ม.4</h1>
                        <hr style="border-color: green; width: 50%;">
                        <h2>ตรวจสอบข้อมูล</h2>
                        <form action="adminm4.php" method="GET">

                            <?php
                            if ($paypay == 1) {
                            ?>
                                <button class="btn btn-lg btn-primary" type="submit" name="std_status" value="0">
                                    <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>รอเจ้าหน้าที่ตรวจสอบ
                                </button>
                                <!-- <button class="btn btn-lg btn-info" type="submit" name="std_status" value="3">
                                    <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>นักเรียนแก้ไขแล้วรอตรวจซ้ำ
                                </button> -->
                                <button class="btn btn-lg btn-danger" type="submit" name="std_status" value="2">
                                    <i class="ace-icon glyphicon glyphicon-refresh bigger-100"></i>ไม่ผ่านรอแก้ไข
                                </button><br><br>
                                <hr style="border-color: green; width: 50%;">
                                <h2>ชำระเงิน / ออกเลขประจำตัวสอบ</h2>
                                <button class="btn btn-lg btn-primary" type="submit" name="std_status" value="4">
                                    <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>ตรวจสอบการชำระเงิน
                                </button>
                                <button class="btn btn-lg btn-success" type="submit" name="std_status" value="1">
                                    <i class="ace-icon glyphicon glyphicon-check bigger-100"></i>ตรวจสอบผ่านแล้ว
                                </button>
                                <br><br>

                                <br><br>
                            <?php
                            }
                            ?>

                            <?php

                            if ($paypay == 0) {
                            ?>

                                <button class="btn btn-lg btn-primary" type="submit" name="std_status" value="0">
                                    <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>รอเจ้าหน้าที่ตรวจสอบ/ออกหมายเลข
                                </button>
                                <!-- <button class="btn btn-lg btn-info" type="submit" name="std_status" value="3">
                                    <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>นักเรียนแก้ไขแล้วรอตรวจซ้ำ
                                </button> -->
                                <button class="btn btn-lg btn-danger" type="submit" name="std_status" value="2">
                                    <i class="ace-icon glyphicon glyphicon-refresh bigger-100"></i>ไม่ผ่านรอแก้ไข
                                </button>
                                <!-- <br><br>
                                <hr style="border-color: green; width: 50%;">
                                <h2>ชำระเงิน / ออกเลขประจำตัวสอบ</h2>
                                <button class="btn btn-lg btn-primary" type="submit" name="std_status" value="4">
                                    <i class="ace-icon fa fa fa-pencil-square-o bigger-100"></i>ตรวจสอบการชำระเงิน
                                </button> -->
                                <button class="btn btn-lg btn-success" type="submit" name="std_status" value="1">
                                    <i class="ace-icon glyphicon glyphicon-check bigger-100"></i>ตรวจสอบผ่านแล้ว
                                </button>
                                <br><br>

                                <br><br>

                            <?php
                            }
                            ?>



                            <?php
                            include 'includes/config.php';
                            $type_class = "ชั้นมัธยมศึกษาปีที่ 4";
                            $num = 1;
                            $sqltype = "SELECT * FROM registype WHERE type_status=1 AND type_class=:type_class";
                            $querytype = $dbcon->prepare($sqltype);
                            $querytype->bindParam(':type_class', $type_class, PDO::PARAM_STR);
                            $querytype->execute();
                            $resultstype = $querytype->fetchAll(PDO::FETCH_OBJ);
                            ?>

                            <?php
                            foreach ($resultstype as $rowtype) { ?>
                                <label>
                                    <input type="radio" class="ace input-lg" name="std_type" value="<?php echo $rowtype->type_id; ?>" onclick="show<?php echo $rowtype->type_id; ?>()">
                                    <span class="lbl bigger-150"> <?php echo $rowtype->type_name; ?></span>
                                </label>&nbsp;&nbsp;


                                <script>
                                    function show<?php echo $rowtype->type_id; ?>() {
                                        <?php foreach ($resultstype as $rowtypehide) { ?>
                                            document.getElementById('show<?php echo $rowtypehide->type_id; ?>').style.display = 'none';
                                        <?php
                                        }
                                        ?>
                                        document.getElementById('show<?php echo $rowtype->type_id; ?>').style.display = 'block';
                                    }
                                </script>




                            <?php
                                $num = $num + 1;
                            }
                            ?>


                            <br><br>




                        </form>
                    </div>
                </div>
            </div>







            <?php
            $num = 1;
            foreach ($resultstype as $rowtype) { ?>
                <div class="row" id="show<?php echo $rowtype->type_id; ?>">
                    <div class="col-12 cnbox text-center"><br>
                        <!-- Start Table -->
                        <div class="row cnbox">
                            <div class="col-12 cnbox bg-success text-center">
                                <div>
                                    <h1><?php echo $rowtype->type_name; ?></h1>
                                </div>
                            </div>
                        </div>
                        <table id="table-1" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr role="row">
                                    <th class="text-center sorting" width="10%">เวลาที่สมัคร</th>
                                    <th class="text-center sorting" width="5%">เลขประจำตัวสอบ</th>
                                    <th class="text-center sorting" width="5%">ห้องสอบ</th>
                                    <th class="text-center sorting" width="10%">เลขบัตรประชาชน</th>
                                    <th class="text-center sorting" width="5%">คำนำหน้า</th>
                                    <th class="text-center sorting" width="11%">ชื่อ</th>
                                    <th class="text-center sorting" width="11%">นามสกุล</th>
                                    <th class="text-center sorting" width="8%">เบอร์โทรนักเรียน</th>
                                    <th class="text-center sorting" width="15%">Comment</th>
                                    <th class="text-center sorting_disabled" width="10%">ตรวจสอบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $std_status = $_GET['std_status'];
                                if ($std_status == '') {
                                    $std_status = 0;
                                }
                                include 'includes/config.php';
                                // $sql = "SELECT * FROM studentm1 WHERE std_type='15'";
                                // $sql = "SELECT * FROM studentm4";
                                // $result = mysqli_query($dbcon, $sql);

                                $sql = "SELECT * FROM studentm4";
                                $query = $dbcon->prepare($sql);
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($result as $row) {

                                    if ($row->std_status == '0') {
                                        $std_checkstatus = '<td>' . '<a href="adminm4std.php?std_id=' . $row->std_id . '" class="badge badge-primary">ตรวจสอบ</a>' . '</td>';
                                    } else if ($row->std_status == '1') {
                                        $std_checkstatus = '<td>' .
                                            // '<a #href="#" class="btn btn-minier btn-success">ผ่าน</a>' .
                                            '<a href="adminm4std.php?std_id=' . $row->std_id . '" class="badge badge-success">&nbsp;ดูข้อมูล&nbsp;</a>&nbsp;' .
                                            '</td>';
                                    } else if ($row->std_status == '3') {
                                        $std_checkstatus = '<td>' . '<a href="adminm4std.php?std_id=' . $row->std_id . '" class="badge badge-primary">ตรวจสอบ (แก้ไขแล้ว)</a>' . '</td>';
                                    } else if ($row->std_status == '2') {
                                        $std_checkstatus = '<td>' . '<a href="adminm4std.php?std_id=' . $row->std_id . '" class="badge badge-danger">รอแก้ไข</a>' . '</td>';
                                    } else if ($row->std_status == '4') {
                                        $std_checkstatus = '<td>' . '<a href="adminm4std.php?std_id=' . $row->std_id . '" class="badge badge-primary">ยืนยันข้อมูล/ออกหมายเลข</a>' . '</td>';
                                    }







                                    if ($row->std_type == $rowtype->type_id && $row->std_status == $std_status) {
                                        echo '<tr><td>' . substr($row->std_registime, 0) . '</td>';
                                        echo "<td>" . $row->std_regisid . "</td>";
                                        echo "<td>" . $row->std_regisroom . "</td>";
                                        echo "<td>" . $row->std_id . "</td>";
                                        echo "<td class='text-right'>" . $row->std_prefix . "</td>";
                                        echo "<td class='text-left'>" . $row->std_fname . "</td>";
                                        echo "<td class='text-left'>" . $row->std_lname . "</td>";
                                        echo "<td>" . $row->std_phone . "</td>";
                                        echo "<td>" . $row->std_comment . "</td>";
                                        echo $std_checkstatus;
                                        echo '</tr>';
                                    }

                                    // Code เอา Status 3 มาแสดงในหน้าแรกด้วย
                                    if ($std_status == 0) {
                                        if ($row->std_type == $rowtype->type_id && $row->std_status == 3) {
                                            echo '<tr><td>' . substr($row->std_registime, 0) . '</td>';
                                            echo "<td>" . $row->std_regisid . "</td>";
                                            echo "<td>" . $row->std_regisroom . "</td>";
                                            echo "<td>" . $row->std_id . "</td>";
                                            echo "<td class='text-right'>" . $row->std_prefix . "</td>";
                                            echo "<td class='text-left'>" . $row->std_fname . "</td>";
                                            echo "<td class='text-left'>" . $row->std_lname . "</td>";
                                            echo "<td>" . $row->std_phone . "</td>";
                                            echo "<td>" . $row->std_comment . "</td>";
                                            echo $std_checkstatus;
                                            echo '</tr>';
                                        }
                                    }
                                    // Code เอา Status 3 มาแสดงในหน้าแรกด้วย


                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Start Table -->
                    </div>
                </div>



            <?php
                $num = $num + 1;
            }
            ?>











        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
            <small>Copyright &copy; <a href="https://pirapong.com">ครูพีระพงษ์ ปรีดาชม</a> โรงเรียนสวนกุหลาบวิทยาลัย รังสิต</small>
        </div>
    </div>
</div>
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">กลับด้านบน
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

</body>

</html>
<?php
// include 'footer.php';
?>

<script>
    $(document).ready(function() {
        $('#table-1,#table-2,#table-3').DataTable({
            "pageLength": 10
        });
    });
</script>



<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<!-- <script src="assets/js/buttons.flash.min.js"></script> -->
<!-- <script src="assets/js/buttons.html5.min.js"></script> -->
<!-- <script src="assets/js/buttons.print.min.js"></script> -->
<!-- <script src="assets/js/buttons.colVis.min.js"></script> -->
<!-- <script src="assets/js/dataTables.select.min.js"></script> -->