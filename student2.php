<?php
include 'includes/header.php';
date_default_timezone_set('Asia/Bangkok');
?>

<?php
session_start();
session_unset();
$_SESSION['where'] = '';
$std_class = $_GET['class'];

if ($std_class == 'm1') {
    $_SESSION['page'] = 'studentm1';
} else if ($std_class == 'm4') {
    $_SESSION['page'] = 'studentm4';
}


?>

<?php
include 'includes/sidebar.php';
?>

<!-- กำหนดวันทั้งหมดในรูปแบบ Array -->
<?php
$dayregis = array("2021-03-01", "2021-03-02");
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
                    รายงานการรับสมัครนักเรียน <?php echo $rowconfig->con_typeadmission; ?> ปีการศึกษา <?php echo $rowconfig->con_year; ?> <small><i>ข้อมูลปรับปรุงอัตโนมัติ (<?php echo date("Y/m/d H:i:s"); ?>)</i></small>
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





            $day1 = date("2021-02-27");


            // echo $rowconfig->com_m1m4only;
            ?>

            <!-- สถิติ -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <!-- <script src="assets2/jquery.min.js"></script> -->
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
            <!-- <link rel="stylesheet" href="assets2/bootstrap.min.css" /> -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <!-- <script src="assets2/bootstrap.min.js"></script> -->
            <script src="jquery.tabledit.min.js"></script>

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

            <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
            <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>







            <!-- <div class="row">
                <div class="col-sm-10 ">                
                <h1>ชั้นมัธยมศึกษาปีที่ 1</h1>
                    <table id="stdentm1table" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col" width="10%" class="text-center"> ชื่อ </th>
                                <th scope="col" width="10%" class="text-center"> นามสกุล</th>
                                <th scope="col" width="10%" class="text-center text-primary">ประเภทที่สมัคร</th>

                                <th scope="col" width="10%" class="text-center text-primary">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <th scope="row" class="text-center bg-success bigger-150">รวม</th>
                                    <td class="bg-warning bigger-150">หฟกหฟกห</td>
                                    <td class="bg-warning bigger-150">หฟกหฟกห</td>
                                    <td class="bg-success bigger-200 text-primary">ฟหกหฟก</td>
                                </tr>
                           

                        </tbody>
                    </table>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>
            </div> -->

            <div class="row">
                <div class="col-sm-12">
                <div  style="overflow-x:auto;">
              
                    <?php
                    if ($std_class == 'm1') {
                        echo '<h1>ชั้นมัธยมศึกษาปีที่ 1</h1>';
                        echo '<table id="stdentm1table" class="table table-bordered table-striped text-center">';
                    } else if ($std_class == 'm4') {
                        echo '<h1>ชั้นมัธยมศึกษาปีที่ 4</h1>';
                        echo '<table id="stdentm4table" class="table table-bordered table-striped text-center">';
                    }
                    ?>
                    
                        <thead>
                            <tr>
                                <th scope="col" width="5%" class="text-center"> เลขประจำตัวสอบ </th>
                                <th scope="col" width="5%" class="text-center"> ห้องสอบ </th>
                                <th scope="col" width="4%" class="text-center"> คำนำหน้า </th>
                                <th scope="col" width="10%" class="text-center"> ชื่อ </th>
                                <th scope="col" width="10%" class="text-center"> นามสกุล</th>
                                <th scope="col" width="5%" class="text-center text-primary">ประเภทที่สมัคร</th>                                
                                <th scope="col" width="10%" class="text-center text-primary">วันสมัคร</th>
                                <th scope="col" width="25%" class="text-center text-primary">สถานะ</th>
                                <th scope="col" width="22%" class="text-center text-primary">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($std_class == 'm1') {
                                $sql = "SELECT * FROM studentm1 INNER JOIN registype ON studentm1.std_type=registype.type_id";
                            } else if ($std_class == 'm4') {
                                $sql = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id";
                            }
                            $query = $dbcon->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                                echo '<tr>';
                                if ($row->std_status == 1) {
                                    echo '<td scope="row" class="text-center bg-success bigger-100">' . $row->std_regisid . '</td>';
                                    echo '<td scope="row" class="text-center bg-success bigger-100">' . $row->std_regisroom . '</td>';
                                } else {
                                    echo '<td scope="row" class="text-center bg-warning"><font size=1>รอตรวจสอบ</font></td>';
                                    echo '<td scope="row" class="text-center bg-warning">-</td>';
                                }
                                echo '<td scope="row" class="text-right bg-warning bigger-100">' . $row->std_prefix . '</td>';
                                echo '<td scope="row" class="text-left bg-warning bigger-100">' . $row->std_fname . '</td>';
                                echo '<td scope="row" class="text-left bg-warning bigger-100">' . $row->std_lname . '</td>';
                                echo '<td scope="row" class="text-center bg-warning bigger-100">' . substr($row->type_name,-5) . '</td>';                                
                                echo '<td scope="row" class="text-center bg-warning bigger-100">' . $row->std_registime . '</td>';
                                if ($row->std_status == 0) {
                                    echo '<td scope="row" class="text-center bg-warning bigger-100">รอเจ้าหน้าที่ตรวจสอบ</td>';
                                    echo '<td scope="row" class="text-center bg-warning bigger-100"></td>';
                                } else if ($row->std_status == 1) {
                                    echo '<td scope="row" class="text-center bg-success bigger-100">ตรวจสอบข้อมูลและชำระเงิน เรียบร้อยแล้ว&nbsp;<i class="fa fa-check text-success" aria-hidden="true"></i></td>';
                                    echo '<td scope="row" class="text-center bg-success bigger-100"><a href="print.php">คลิกที่นี่!! เพื่อพิมพ์บัตรประจำตัวสอบ</a></td>';
                                } else if ($row->std_status == 2) {
                                    echo '<td scope="row" class="text-center bg-danger bigger-100">ข้อมูลไม่ผ่าน!! โปรด<a href="edit.php">แก้ไขข้อมูล</a></td>';
                                    echo '<td scope="row" class="text-center bg-danger bigger-100"><i><b><u>' . $row->std_comment . '</u></b></i><a href="edit.php"> || คลิกที่นี่!! เพื่อแก้ไข</a></td>';
                                } else if ($row->std_status == 3) {
                                    echo '<td scope="row" class="text-center bg-warning bigger-100">แก้ไขข้อมูลแล้ว รอเจ้าหน้าที่ตรวจสอบข้อมูลอีกครั้ง</td>';
                                    echo '<td scope="row" class="text-center bg-warning bigger-100"></td>';
                                } if ($row->std_status == 4) {
                                    echo '<td scope="row" class="text-center bg-info bigger-100">ตรวจสอบข้อมูลผ่านแล้ว<i class="fa fa-check text-success" aria-hidden="true"></i> <a href="pay.php"><font color="red"><u>รอชำระเงิน</u> <i class="fa fa-arrow-left" aria-hidden="true"></i></font></a></td>';
                                    echo '<td scope="row" class="text-center bg-info bigger-100"><a href="pay.php">คลิกที่นี่!! เพื่อไปชำระเงิน</a></td>';
                                }


                                echo '</tr>';
                            }
                            ?>





                            <!--                            
                                <tr>
                                    <th scope="row" class="text-center bg-success bigger-150">รวม</th>
                                    <td class="bg-warning bigger-150">หฟกหฟกห</td>
                                    <td class="bg-warning bigger-150">หฟกหฟกห</td>
                                    <td class="bg-success bigger-200 text-primary">ฟหกหฟก</td>
                                </tr> -->

                        </tbody>
                    </table>
                </div>
                    <hr style="height:3px;border-width:0;color:gray;background-color:green;">
                </div>

            </div>














        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<?php
// include 'includes/footer.php';
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#stdentm1table,#stdentm4table').DataTable({
            "pageLength": 36,
            "order": [
                [0, "asc"]
            ],
            dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
            buttons: [{
                extend: 'excelHtml5',
                title: 'รายชื่อรับสมัครนักเรียน ม.1'
            }, {
                extend: 'print',
                title: 'รายชื่อรับสมัครนักเรียน ม.1'
            }, 'copy']
        });
    });
</script>


<?php 

// include 'includes/footer.php';
?>

<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
<!-- <script src="assets/js/jquery-2.1.4.min.js"></script> -->
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/jquery.sparkline.index.min.js"></script>
<script src="assets/js/jquery.flot.min.js"></script>
<script src="assets/js/jquery.flot.pie.min.js"></script>
<script src="assets/js/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>