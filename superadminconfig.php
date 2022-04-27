<?php
session_start();
$_SESSION['where'] = 'superadmin';
$_SESSION['page'] = 'superadmin';

if ($_SESSION['superadmin'] != '1') {
    session_destroy();
    header("Location: superadmin.php");
}
?>
<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>


<?php
if (isset($_POST['update'])) {
    echo ' <script src="assets/js/sweetalert2.min.js"></script>';
    echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';

    // เช็คไฟล์ตราโรงเรียนและรูปประชาสัมพันธ์
    $file_logo = "img/logo.png";
    $file_news = "img/news.jpg";

    if ($_FILES['file_logo']['name'] != '') {
        if (file_exists($file_logo)) {
            unlink($file_logo);
        }
        @copy($_FILES["file_logo"]["tmp_name"], $file_logo);
    }

    if ($_FILES['file_news']['name'] != '') {
        if (file_exists($file_news)) {
            unlink($file_news);
        }
        @copy($_FILES["file_news"]["tmp_name"], $file_news);
    }
    // เช็คไฟล์ตราโรงเรียนและรูปประชาสัมพันธ์
    // header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    // header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past


    include 'includes/config.php';
    //    รับค่า
    $con_schoolname = $_POST['con_schoolname'];
    $con_year = $_POST['con_year'];
    $con_typeadmission = $_POST['con_typeadmission'];
    $con_m1m4only_1 = $_POST['con_m1m4only-1'];
    $con_m1m4only_4 = $_POST['con_m1m4only-4'];
    $con_m1m4only = $con_m1m4only_4 + $con_m1m4only_1;
    $con_contact = $_POST['con_contact'];
    $encode_con_contact = base64_encode($con_contact);
    if ($con_m1m4only == 5) {
        $con_m1m4only = 0;
    }
    $con_m1open = $_POST['con_m1open'];
    $con_m4open = $_POST['con_m4open'];
    $con_m1print = $_POST['con_m1print'];
    $con_m4print = $_POST['con_m4print'];
    $con_statistic = $_POST['con_statistic'];
    $con_pay = $_POST['con_pay'];
    $con_editm1 = $_POST['con_editm1'];
    $con_editm4 = $_POST['con_editm4'];
    $con_news = "img/news.jpg";
    $con_logo = "img/logo.png";
    $sql = "UPDATE config
                SET con_schoolname='$con_schoolname',con_year='$con_year',con_typeadmission='$con_typeadmission',con_m1m4only='$con_m1m4only',
                con_m1open='$con_m1open',con_m4open='$con_m4open',con_editm1='$con_editm1',con_editm4='$con_editm4',con_m1print='$con_m1print',con_m4print='$con_m4print',
                con_statistic='$con_statistic',con_pay='$con_pay',con_news='$con_news',con_logo='$con_logo',con_contact='" . $encode_con_contact . "'
                WHERE con_id='1'";
    $stmt = $dbcon->prepare($sql);
    if ($stmt->execute()) {
        echo "<script language=\"JavaScript\">";
        echo "Swal.fire({  
            position: 'top',
            width: 600,            
            icon: 'success',
            title: '<h3>บันทึกข้อมูลเรียบร้อยแล้ว</h3>',
            confirmButtonText: `<h4> ปิด </h4>`
          }).then((result) => {        
                     window.location = 'superadminconfig.php';
             });";
        // echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location='superadminconfig.php';";
        echo "</script>";
    } else {
        echo "<script language=\"JavaScript\">";
        echo "Swal.fire({  
            position: 'top',
            width: 600,            
            icon: 'error',
            title: '<h3>ผิดพลาด บันทึกข้อมูลไม่สำเร็จ<br><br>โปรดตรวจสอบ</h3>',
            confirmButtonText: `<h4> ปิด </h4>`
          }).then((result) => {        
                     window.location = 'superadmin.php';
             });";
        // echo "alert('error');window.location='superadmin.php';";
        echo "</script>";
    }
} else {



?>

    <?php
    if (isset($_POST['addtype'])) {
        $type_id = $_POST['type_id'];
        $type_class = $_POST['type_class'];
        $type_name = $_POST['type_name'];
        $type_status = $_POST['type_status'];
        $type_talent = $_POST['type_talent'];
        $type_onet = $_POST['type_onet'];
        $type_plan = $_POST['type_plan'];
        if ($type_id == "") {
            $type_id = 0;
        }
        if ($type_status != 1) {
            $type_status = 0;
        }
        if ($type_talent != 1) {
            $type_talent = 0;
        }
        if ($type_onet != 1) {
            $type_onet = 0;
        }
        if ($type_doc != 1) {
            $type_doc = 0;
        }
        if ($type_pay != 1) {
            $type_pay = 0;
        }
        if ($type_plan != 1) {
            $type_plan = 0;
        }
        include 'includes/config.php';
        $sql = "INSERT INTO registype (type_id, type_class, type_name, type_status, type_talent, type_onet ,type_doc ,type_pay,type_cer,type_plan) 
            VALUES ('$type_id', '$type_class', '$type_name', '0', '0', '0', '0', '0', '0', '0')";
        $stmt = $dbcon->prepare($sql);

        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 2002 05:00:00 GMT"); // Date in the past

        echo ' <script src="assets/js/sweetalert2.min.js"></script>';
        echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';

        if ($stmt->execute()) {
            echo "<script language=\"JavaScript\">";
            echo "Swal.fire({  
                position: 'top',
                width: 600,            
                icon: 'success',
                title: '<h3>บันทึกข้อมูลเรียบร้อยแล้ว</h3>',
                confirmButtonText: `<h4> ปิด </h4>`
              }).then((result) => {        
                         window.location = 'superadminconfig.php';
                 });";
            // echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location='superadminconfig.php';";
            echo "</script>";
        } else {
            echo "<script language=\"JavaScript\">";
            echo "Swal.fire({  
                position: 'top',
                width: 600,            
                icon: 'error',
                title: '<h3>เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้</h3>',
                confirmButtonText: `<h4> ปิด </h4>`
              }).then((result) => {        
                         window.location = 'superadminconfig.php';
                 });";
            // echo "alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');window.location='superadminconfig.php';";
            echo "</script>";
        }
    }
    ?>

        <!-- toggle update db -->
    <?php
        if (isset($_POST['type_talent_check'])) {
            $type_talent_check = $_POST['type_talent_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
           SET type_talent = '$type_talent_check'
           WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
        if (isset($_POST['type_onet_check'])) {
            $type_onet_check = $_POST['type_onet_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
             SET type_onet = '$type_onet_check'
             WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
        if (isset($_POST['type_doc_check'])) {
            $type_doc_check = $_POST['type_doc_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
             SET type_doc = '$type_doc_check'
             WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
        if (isset($_POST['type_cer_check'])) {
            $type_cer_check = $_POST['type_cer_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
             SET type_cer = '$type_cer_check'
             WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
        if (isset($_POST['type_pay_check'])) {
            $type_pay_check = $_POST['type_pay_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
             SET type_pay = '$type_pay_check'
             WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
        if (isset($_POST['type_status_check'])) {
            $type_status_check = $_POST['type_status_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
             SET type_status = '$type_status_check'
             WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
        if (isset($_POST['type_plan_check'])) {
            $type_plan_check = $_POST['type_plan_check'];
            $type_id_check = $_POST['type_id_check'];

            include 'includes/config.php';
            $query = " UPDATE registype
             SET type_plan = '$type_plan_check'
             WHERE type_id='$type_id_check' ";
            $stmt = $dbcon->prepare($query);
            $stmt->execute();
            mysqli_close($dbcon);
        }
    
    ?>
    <!-- toggle update db -->


    <?php
    if (isset($_POST['deltype'])) {
        $deltype = $_POST['deltype'];
        include 'includes/config.php';
        $sql2 = "SELECT * FROM registype WHERE type_id='$deltype'";
        $query2 = $dbcon->prepare($sql2);
        $query2->execute();
        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
        foreach ($results2 as $row2) {
        }
    ?>
        <script type="text/javascript">
            var userselection = confirm("ต้องการลบข้อมูล\nรหัส <?php echo $row2->type_id; ?> <?php echo $row2->type_name; ?>");
            if (userselection == true) {
                <?php
                include 'includes/config.php';
                $sql3 = "DELETE FROM registype WHERE type_id='$row2->type_id'";
                $stmt3 = $dbcon->prepare($sql3);
                if ($stmt3->execute()) {
                    echo "alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='superadminconfig.php';";
                } else {
                    echo "alert('เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');window.location='superadminconfig.php';";
                }
                ?>
            } else {

            }
        </script>

    <?php
    }
    ?>







    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="page-header ">

                </div><!-- /.page-header -->





                <div class="row ">
                    <div class="col col-lg-12 cnbox bg-info text-center">
                        <?php
                        // include 'connectdb.php';
                        include 'includes/config.php';
                        $sql = "SELECT * FROM config";
                        $query = $dbcon->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($results as $config) {
                        }
                        mysqli_close($dbcon);
                        ?>
<!-- <div class="col-12 col-md-9"> -->
                        <img src="<?php echo $config->con_logo; ?>" width="150px">
                        <h2><?php echo $config->con_schoolname; ?></h2>
                        <h2>ประจำปีการศึกษา <?php echo $config->con_year; ?></h2>
                        <h4><?php echo $config->con_typeadmission; ?></h4>
                        <link rel="stylesheet" href="assets/css/inputwidth.css" />
<!-- </div> -->




                        <style>
                            input[type=radio] {
                                /* display: inline-block; */
                                /* padding-top: 2em; */
                                border: 0px;
                                width: 1.5em;
                                height: 1.5em;
                                margin-left: 3em;
                                /* vertical-align: middle; */
                            }

                            input[type=checkbox] {
                                /* display: inline-block; */
                                /* padding: auto; */
                                border: 0px;
                                width: 1.5em;
                                height: 1.5em;
                                margin-left: 3em;
                                /* vertical-align: middle; */
                            }

                            table,
                            th,
                            td {
                                /* border: 1px solid #d4d0d0d6; */
                                min-height: 100px;
                                height: 50px;
                            }
                        </style>
<div class="col-12 col-md-10">
                        <form method="post" enctype="multipart/form-data">

                            <table width="100%" class="text-left text-primary">
                                <tr>
                                    <td colspan="2">
                                        <h2 style="width: fit-content;color: white;text-align: left;background-color: #428BCA; border: 4px solid #ffffff;padding: 10px;border-radius: 50px 20px;">
                                            &nbsp; &nbsp;ข้อมูลพื้นฐาน&nbsp; &nbsp;</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%">
                                        <h4>ชื่อโรงเรียน &nbsp;</h4>
                                    </td>
                                    <td width="70%">
                                        <input type="text" class="form-control" name="con_schoolname" value="<?php echo $config->con_schoolname; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%">
                                        <h4>ปีการศึกษาที่เปิดรับสมัคร &nbsp;</h4>
                                    </td>
                                    <td width="70%">
                                        <input type="number" class="form-control" name="con_year" value="<?php echo $config->con_year; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%">
                                        <h4>ประเภทที่เปิดรับสมัคร &nbsp;</h4>
                                    </td>
                                    <td width="70%">
                                        <input type="text" class="form-control" name="con_typeadmission" value="<?php echo $config->con_typeadmission; ?>">
                                        <!-- <select type="text" class="form-control" name="con_typeadmission" required>
                                        <option selected><?php //echo $config->con_typeadmission; 
                                                            ?></option>
                                        <option disabled>------------</option>
                                        <option value="ประเภทห้องเรียนปกติ">ประเภทห้องเรียนปกติ</option>
                                        <option value="ประเภทห้องเรียนพิเศษ">ประเภทห้องเรียนพิเศษ (EP,GEP)</option>
                                        <option value="ประเภทนักเรียนโรงเรียนเดิม">ประเภทนักเรียนโรงเรียนเดิม</option>
                                    </select> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%">
                                        <h4>ข้อมูลติดต่อโรงเรียน &nbsp;</h4>
                                    </td>
                                    <td width="70%" style="background-color:white;">

                                        <script type="text/javascript" src="js/nicEdit-latest.js"></script>
                                        <script type="text/javascript">
                                            //<![CDATA[
                                            bkLib.onDomLoaded(function() {
                                                nicEditors.allTextAreas();


                                            });
                                            //]]>
                                        </script>
                                        <?php
                                        $_SESSION['textarea'] = '1';
                                        ?>
                                        <textarea rows="5" class="form-control" name="con_contact">
                                    <?php echo base64_decode($config->con_contact); ?>
                                    </textarea>








                                    </td>
                                </tr>







                                <tr style="max-height: 100px;padding-top: 200px;">
                                    <td class="text-right" width="30%">
                                        <h4>รูปตราโรงเรียน &nbsp;</h4>
                                    </td>
                                    <td width="20%" style="text-align: center;">
                                        <input type="file" id="file_logo" name="file_logo" accept="image/png">
                                        <!-- <button type="submit" name="update" class="btn btn-primary">อัพโหลด คลิก!!</button><br><br> -->
                                    </td>
                                </tr>
                                <script src="assets/js/jquery-2.1.4.min.js"></script>
                                <script src="assets/js/ace-elements.min.js"></script>
                                <script src="assets/js/ace.min.js"></script>
                                <script>
                                    $('#file_logo').ace_file_input({
                                        style: 'well',
                                        btn_choose: 'คลิกที่นี่!! เพื่ออัพรูปภาพตราโรงเรียน (PNG)',
                                        btn_change: null,
                                        no_icon: 'ace-icon fa fa-cloud-upload',
                                        droppable: true,
                                        thumbnail: 'large' //large | fit

                                    }).on('change', function() {
                                        //console.log($(this).data('ace_input_files'));
                                        //console.log($(this).data('ace_input_method'));
                                    });
                                </script>




                                <tr style="max-height: 100px;">
                                    <td class="text-right" width="30%">
                                        <h4>รูปภาพประชาสัมพันธ์ &nbsp;</h4>
                                    </td>
                                    <td width="20%" style="text-align: center;">
                                        <input type="file" id="file_news" name="file_news" accept="image/png, image/jpeg, image/jpg, image/bmp">
                                        <!-- <button type="submit" name="update" class="btn btn-primary">อัพโหลด คลิก!!</button><br><br> -->
                                    </td>
                                </tr>
                                <script src="assets/js/jquery-2.1.4.min.js"></script>
                                <script src="assets/js/ace-elements.min.js"></script>
                                <script src="assets/js/ace.min.js"></script>
                                <script>
                                    $('#file_news').ace_file_input({
                                        style: 'well',
                                        btn_choose: 'คลิกที่นี่!! เพื่ออัพรูปภาพประชาสัมพันธ์',
                                        btn_change: null,
                                        no_icon: 'ace-icon fa fa-cloud-upload',
                                        droppable: true,
                                        thumbnail: 'fit' //large | fit

                                    }).on('change', function() {
                                        //console.log($(this).data('ace_input_files'));
                                        //console.log($(this).data('ace_input_method'));
                                    });
                                </script>























                                <tr>
                                    <td colspan="2" class="text-center">
                                        <hr style="border: 1px solid black;">
                                        <!-- <h2 style="color: black;text-align: left;">การรับสมัคร</h2> -->
                                        <h2 style="width: fit-content;color: white;text-align: left;background-color: #428BCA; border: 4px solid #ffffff;padding: 10px;border-radius: 50px 20px;">
                                            &nbsp; &nbsp;ตั้งค่าการรับสมัคร&nbsp; &nbsp;</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3>เปิดรับสมัคร &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inlinet">
                                            <input class="form-check-input" name="con_m1m4only-1" type="checkbox" value="1" <?php if ($config->con_m1m4only != 4) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3>&nbsp;ม.1&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" name="con_m1m4only-4" type="checkbox" value="4" <?php if ($config->con_m1m4only != 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3>&nbsp;ม.4&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> กรอกข้อมูล ม.1 &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="con_m1open" value="1" <?php if ($config->con_m1open == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_m1open" value="0" <?php if ($config->con_m1open == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> กรอกข้อมูล ม.4 &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="con_m4open" value="1" <?php if ($config->con_m4open == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_m4open" value="0" <?php if ($config->con_m4open == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> แก้ไขข้อมูล ม.1 &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="con_editm1" value="1" <?php if ($config->con_editm1 == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_editm1" value="0" <?php if ($config->con_editm1 == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> แก้ไขข้อมูล ม.4 &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="con_editm4" value="1" <?php if ($config->con_editm4 == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>

                                            <!-- <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
                                        <script src="js/bootstrap-toggle.min.js"></script>
                                        <input data-width="100" data-size="large" value="1" data-onstyle="success" data-offstyle="danger" data-on="เปิด" data-off="ปิด"
                                        type="checkbox" name="con_editm4" data-toggle="toggle"> -->


                                            <input class="form-check-input" type="radio" name="con_editm4" value="0" <?php if ($config->con_editm4 == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>






                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> รายงานสถิติ &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="con_statistic" value="1" <?php if ($config->con_statistic == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_statistic" value="0" <?php if ($config->con_statistic == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> การชำระเงิน &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="con_pay" value="1" <?php if ($config->con_pay == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_pay" value="0" <?php if ($config->con_pay == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> พิมพ์บัตรประจำตัวสอบ ม.1 &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="con_m1print" value="1" <?php if ($config->con_m1print == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_m1print" value="0" <?php if ($config->con_m1print == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: top;" class="text-right" width="30%">
                                        <h3> พิมพ์บัตรประจำตัวสอบ ม.4 &nbsp;</h3>
                                    </td>
                                    <td width="70%" style="color: black;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="con_m4print" value="1" <?php if ($config->con_m4print == 1) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-success">&nbsp;เปิด&nbsp;&nbsp;</h3>
                                            </label>
                                            <input class="form-check-input" type="radio" name="con_m4print" value="0" <?php if ($config->con_m4print == 0) { ?>checked <?php } ?>>
                                            <label class="form-check-label">
                                                <h3 class="text-danger">&nbsp;ปิด&nbsp;&nbsp;</h3>
                                            </label>
                                        </div>
                                    </td>
                                </tr>








                                <tr>
                                    <td colspan="2" class="text-center">
                                        <hr style="border: 1px solid black;">
                                        <button type="submit" name="update" class="btn btn-primary btn-lg">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            &nbsp;บันทึกการเปลี่ยนแปลง</button>
                                        <hr style="border: 1px solid black;">
                                    </td>
                                </tr>

                            </table>

                            <br><br>


                        </form>
                        </div>
                        <br>

                    </div>
                </div>
                <br>
                <div class="row ">
                    <div class="col col-lg-12 cnbox bg-warning text-center"><br>


                        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous"> -->
                        <!-- ใช้กับ Toggle -->
                        <link href="assets/css/titatoggle-dist.css" rel="stylesheet">
                        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
                        <!-- ใช้กับ Toggle -->

                        <h2>ประเภทที่เปิดรับสมัคร</h2>
                        <form method="post">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">รหัสประเภท</th>
                                        <th class="text-center" width="15%">ระดับชั้น</th>
                                        <th class="text-center" width="20%">ประเภท</th>
                                        <th class="text-center" width="7%">ความสามารถพิเศษ</th>
                                        <th class="text-center" width="7%">ใบรับรอง (ปพ)</th>
                                        <th class="text-center" width="7%">เอกสาร</th>
                                        <th class="text-center" width="7%">ค่าสมัคร</th>
                                        <th class="text-center" width="7%">O-Net</th>
                                        <th class="text-center" width="7%">เลือกแผนการเรียน</th>
                                        <th class="text-center" width="7%">สถานะ</th>
                                        <th class="text-center" width="7%">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $numedit = 0;
                                    $sql = "SELECT * FROM registype";
                                    $query = $dbcon->prepare($sql);
                                    // $query->bindParam(':type_class', $type_class, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) { ?>
                                        <tr <?php if ($row->type_status == 1) {
                                                echo '#style="color: green;"';
                                            }
                                            ?>>

                                            <th class="text-center" scope="row"><?php echo $row->type_id; ?></th>
                                            <td class="text-center"><?php echo $row->type_class; ?></td>
                                            <td class="text-left"><?php echo $row->type_name; ?></td>



                                            <td>
                                                <div class="form-check checkbox-slider--b-flat" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_talent_check<?php echo $row->type_id; ?>" <?php if ($row->type_talent == 1) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_talent_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_talent_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_talent_check = 1;
                                                        } else {
                                                            type_talent_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_talent_check: type_talent_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>




                                            <td>
                                                <div class="form-check checkbox-slider--b-flat" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_cer_check<?php echo $row->type_id; ?>" <?php if ($row->type_cer == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_cer_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_cer_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_cer_check = 1;
                                                        } else {
                                                            type_cer_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_cer_check: type_cer_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>



                                            
<td>
                                                <div class="form-check checkbox-slider--b-flat" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_doc_check<?php echo $row->type_id; ?>" <?php if ($row->type_doc == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_doc_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_doc_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_doc_check = 1;
                                                        } else {
                                                            type_doc_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_doc_check: type_doc_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>

                                            





                                            <td>
                                                <div class="form-check checkbox-slider--b-flat" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_pay_check<?php echo $row->type_id; ?>" <?php if ($row->type_pay == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_pay_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_pay_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_pay_check = 1;
                                                        } else {
                                                            type_pay_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_pay_check: type_pay_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>





                                            <td class="text-center">
                                                <div class="form-check checkbox-slider--b-flat text-center" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_onet_check<?php echo $row->type_id; ?>" <?php if ($row->type_onet == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_onet_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_onet_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_onet_check = 1;
                                                        } else {
                                                            type_onet_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_onet_check: type_onet_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>


                                            <td class="text-center">
                                                <div class="form-check checkbox-slider--b-flat text-center" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_plan_check<?php echo $row->type_id; ?>" <?php if ($row->type_plan == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_plan_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_plan_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_plan_check = 1;
                                                        } else {
                                                            type_plan_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_plan_check: type_plan_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>





                                            <td class="text-center">
                                                <div class="form-check checkbox-slider--b-flat text-center" style="display: inline-block;">
                                                    <label>
                                                        <input type="checkbox" id="type_status_check<?php echo $row->type_id; ?>" <?php if ($row->type_status == 1) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                                        <span class="indicator-success"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <script>
                                                $(document).ready(function(e) {
                                                    $('#type_status_check<?php echo $row->type_id; ?>').change(function() {
                                                        if ($('#type_status_check<?php echo $row->type_id; ?>').prop('checked')) {
                                                            type_status_check = 1;
                                                        } else {
                                                            type_status_check = 0;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "superadminconfig.php",
                                                            data: {
                                                                type_status_check: type_status_check,
                                                                type_id_check: <?php echo $row->type_id; ?>
                                                            },
                                                        })
                                                    });
                                                });
                                            </script>

                                            <td>
                                                <button type="submit" name="deltype" value="<?php echo $row->type_id; ?>" href="" checked class="btn btn-sm btn-danger">ลบ</button>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                    <tr>
                                        <td colspan="9">
                                            <h2>เพิ่มประเภทการรับสมัคร<h2>
                                        </td>
                                    </tr>



                                    <tr>

                                        <th><input type="text" class="form-control form-control-sm" name="type_id"></th>
                                        <td>
                                            <select type="text" class="form-control form-control-sm" name="type_class">
                                                <option>ชั้นมัธยมศึกษาปีที่ 1</option>
                                                <option>ชั้นมัธยมศึกษาปีที่ 4</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm" name="type_name"></td>
                                        <!-- <td><input type="checkbox" class="form-control form-control-sm" name="type_talent" style="transform: scale(0.7);" value="1"></td>
                                    <td><input type="checkbox" class="form-control form-control-sm" name="type_doc" style="transform: scale(0.7);" value="1"></td>
                                    <td><input type="checkbox" class="form-control form-control-sm" name="type_pay" style="transform: scale(0.7);" value="1"></td>
                                    <td><input type="checkbox" class="form-control form-control-sm" name="type_onet" style="transform: scale(0.7);" value="1"></td>
                                    <td><input type="checkbox" class="form-control form-control-sm" name="type_status" style="transform: scale(0.7);" value="1"></td> -->

                                        <td><button type="submit" name="addtype" href="" checked class="btn btn-sm btn-success">เพิ่ม</button></td>
                                    </tr>
                                </tbody>
                                <!-- <tr>
                                <th class="text-center">รหัสประเภท</th>
                                <th class="text-center">ระดับชั้น</th>
                                <th class="text-center">ประเภท</th>
                                <th class="text-center">ความสามารถพิเศษ</th>
                                <th class="text-center">เอกสาร</th>
                                <th class="text-center">ค่าสมัคร</th>
                                <th class="text-center">O-Net</th>
                                <th class="text-center">เลือกแผนการเรียน</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ดำเนินการ</th>
                            </tr> -->
                            </table>
                        </form>

                    </div>
                </div>








            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->



    <?php
    include 'includes/footer.php';
    ?>

<?php
}
?>