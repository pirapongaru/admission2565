<?php
session_start();
$_SESSION['page'] = 'print';
$_SESSION['where'] = 'print';
?>



<?php
if (isset($_POST['submit'])) {
    include 'includes/config.php';
    $std_id = $_POST['std_id'];
    $std_class = $_POST['std_class'];
    $sql = "SELECT * FROM $std_class INNER JOIN registype ON $std_class.std_type=registype.type_id WHERE std_id=:std_id";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);
    if ($query->rowCount() == 0) {
        include 'includes/header.php';
        include 'includes/sidebar.php';
        echo ' <script src="assets/js/sweetalert2.min.js"></script>';
        echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';
        echo "<script language=\"JavaScript\">";
        echo "Swal.fire({  
            position: 'top',
            width: 800,            
            icon: 'info',
            title: 'ไม่พบข้อมูลในระบบ',
            text: 'กรุณาตรวจสอบข้อมูลใหม่',            
            confirmButtonText: '<h4> ปิด </h4>'
          }).then((result) => {        
                     window.location = 'print.php';
             });";
        // echo "alert('ไม่พบข้อมูลในระบบ กรุณาตรวจสอบข้อมูลใหม่');window.location='print.php';";
        echo "</script>";
    } else {
        if ($row->std_status == 4) {
            include 'includes/header.php';
            include 'includes/sidebar.php';
            echo ' <script src="assets/js/sweetalert2.min.js"></script>';
            echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';
            echo "<script language=\"JavaScript\">";
            echo "Swal.fire({  
                position: 'top',
                width: 1000,            
                icon: 'danger',
                title: '" . $row->std_prefix . $row->std_fname . " " . $row->std_lname . "<br>โปรดชำระเงินค่าสมัครก่อน',
                text: 'ถ้าชำระเงินแล้ว โปรดรอเจ้าหน้าที่ตรวจสอบจึงจะสามารถพิมพ์บัตรประจำตัวสอบได้',
                confirmButtonText: '<h4>- ปิด -</h4>'
              }).then((result) => {        
                         window.location = 'print.php';
                 });";
            // echo "alert('ยังไม่ผ่านการตรวจสอบ');window.location='print.php';";
            echo "</script>";
        } else if ($row->std_status != 1) {
            include 'includes/header.php';
            include 'includes/sidebar.php';
            echo ' <script src="assets/js/sweetalert2.min.js"></script>';
            echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';
            echo "<script language=\"JavaScript\">";
            echo "Swal.fire({  
                position: 'top',
                width: 800,            
                icon: 'info',
                title: '" . $row->std_prefix . $row->std_fname . " " . $row->std_lname . "',
                text: 'ยังไม่ผ่านการตรวจสอบ',
                confirmButtonText: '<h4>- ปิด -</h4>'
              }).then((result) => {        
                         window.location = 'print.php';
                 });";
            // echo "alert('ยังไม่ผ่านการตรวจสอบ');window.location='print.php';";
            echo "</script>";
        } else {

            echo "<script type='text/javascript'> document.location = 'printcard.php?std_id=".$std_id."&std_class=".$std_class."'; </script>";
        }
    }
} else {

?>



    <?php
    include 'includes/header.php';
    include 'includes/sidebar.php';
    ?>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">

                <div class="row cnbox">
                    <div class="col-12 cnbox bg-success">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">พิมพ์บัตรประจำตัวสอบ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row cnbox">
                    <div class="col-12 cnbox bg-info text-center">
                        <form method="post">
                            <h2>พิมพ์บัตรประจำตัวสอบ</h2>

                            <div class="row">
                                <div class="col col-12 col-sm-3">
                                </div>
                                <div class="col col-12 col-sm-6">
                                    <!-- <script type="text/javascript" src="js/m1checkidmod.js"></script> -->



                                    <?php
                                    include 'includes/config.php';
                                    $sqlconfig = "SELECT * FROM config";
                                    $queryconfig = $dbcon->prepare($sqlconfig);
                                    // $query->bindParam(':std_id', $std_id, PDO::PARAM_STR);
                                    $queryconfig->execute();
                                    $rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว
                                    ?>


                                    <?php //if ($rowconfig->con_m1print == 1 && $rowconfig->con_m4print == 1) { ?>
                                        <h3 class="text-primary">ระดับชั้น</h3><br>
                                        <label>
                                            <input type="radio" name="std_class" value="studentm1" class="ace input-lg" required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label><br><br>
                                        <label style="margin-left: 10px;">
                                            <input type="radio" name="std_class" value="studentm4" class="ace input-lg" required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php //} ?>

                                    

                                    <label for="">โปรดกรอกเลขบัตรประชาชน</label>
                                    <input style="text-align: center;" class="form-control" type="number" placeholder="[XXXXXXXXXXXXX]" required name="std_id" autocomplete="off">
                                    <br>

                                    <br>
                                    <button type="submit" name="submit" class="btn btn-info btn-lg">ดำเนินการต่อ</button>
                        </form><br>
                    </div>
                    <div class="col col-12 col-sm-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="hr hr32 hr-dotted"></div>
    </div><!-- /.page-content -->




    <?php
    include 'includes/footer.php';
    ?>

<?php } ?>