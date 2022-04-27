<?php
include 'includes/header.php';
?>


<?php
session_start();
$_SESSION['page'] = 'updatepage';
$_SESSION['where'] = 'edit';
?>

<?php
include 'includes/sidebar.php';
?>




<?php
if (isset($_POST['submit'])) {
    include 'includes/config.php';
    $std_id = $_POST['std_id'];
    $std_dayb = $_POST['std_dayb'];
    $std_monthb = $_POST['std_monthb'];
    $std_yearb = $_POST['std_yearb'];
    $std_class = $_POST['std_class'];
    $sql = "SELECT * FROM $std_class WHERE std_id=:std_id AND std_dayb=:std_dayb AND std_monthb=:std_monthb AND std_yearb=:std_yearb";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
    $query->bindParam(':std_dayb', $std_dayb, PDO::PARAM_INT);
    $query->bindParam(':std_monthb', $std_monthb, PDO::PARAM_STR);
    $query->bindParam(':std_yearb', $std_yearb, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo ' <script src="assets/js/sweetalert2.min.js"></script>';
    echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';
  

    if ($query->rowCount() == 0) {
        echo "<script language=\"JavaScript\">";
        echo "Swal.fire({  
            position: 'top',
            width: 800,            
            icon: 'info',
            title: 'ไม่พบข้อมูลในระบบ',
            text: 'กรุณาตรวจสอบข้อมูลใหม่',
            confirmButtonText: `<h4> ปิด </h4>`
          }).then((result) => {        
                     window.location = 'edit.php';
             });";
        echo "</script>";
    } else {
        foreach ($results as $row) {
            if ($row->std_status == 1) {
                echo "<script language=\"JavaScript\">";
                echo "Swal.fire({   
                    position: 'top',
                    width: 800,           
                    icon: 'success',
                    title: '".$row->std_prefix . $row->std_fname. "  " . $row->std_lname."<br>ข้อมูลนักเรียนผ่านทุกขั้นตอนแล้ว',                    
                    text: 'ไม่สามารถแก้ไขข้อมูลได้',
                    confirmButtonText: `<h4> ปิด </h4>`
                  }).then((result) => {        
                             window.location = 'edit.php';
                     });";
                // echo "alert('ผ่านการตรวจสอบแล้ว ไม่สามารถแก้ไขข้อมูลได้');window.location='edit.php';";
                echo "</script>";
            } else if ($row->std_status == 4) {
                echo "<script language=\"JavaScript\">";
                echo "Swal.fire({   
                    position: 'top',
                    width: 800,           
                    icon: 'info',
                    title: '".$row->std_prefix . $row->std_fname. "  " . $row->std_lname."<br>ผ่านการตรวจสอบแล้ว',                    
                    text: 'อยู่ในขั้นตอนการชำระเงิน (และรอเจ้าหน้าที่ตรวจสอบการชำระเงิน)',
                    confirmButtonText: `<h4> ปิด </h4>`
                  }).then((result) => {        
                             window.location = 'edit.php';
                     });";
                // echo "alert('ผ่านการตรวจสอบแล้ว ไม่สามารถแก้ไขข้อมูลได้');window.location='edit.php';";
                echo "</script>";
            } else {
                $_SESSION['std_id'] = $std_id;
                if ($std_class == "studentm1") {
                    echo "<script type='text/javascript'> document.location = 'm1editdata.php'; </script>";
                }
                if ($std_class == "studentm4") {
                    echo "<script type='text/javascript'> document.location = 'm4editdata.php'; </script>";
                }
            }
        }
    }
} else {
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
                                    <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูล</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row cnbox">
                    <div class="col-12 cnbox bg-warning text-center">
                        <form method="post">

                        <?php include 'includes/prakad.php'; ?>

                            <h2>แก้ไข ข้อมูล/เอกสาร</h2>

                            <div class="row">
                                <div class="col-12 col-sm-3">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <!-- <script type="text/javascript" src="js/m1checkidmod.js"></script> -->



                                    <?php
                                    include 'includes/config.php';
                                    $sqlconfig = "SELECT * FROM config";
                                    $queryconfig = $dbcon->prepare($sqlconfig);
                                    // $query->bindParam(':std_id', $std_id, PDO::PARAM_STR);
                                    $queryconfig->execute();
                                    $rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว
                                    ?>


                                    <?php if ($rowconfig->con_m1m4only == 0 && $rowconfig->con_editm1 == 1 && $rowconfig->con_editm4 == 1) { ?>
                                        <h3 class="text-primary">ระดับชั้น</h3><br>
                                        <label>
                                            <input type="radio" name="std_class" value="studentm1" class="ace input-lg" required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label>
                                        <label style="margin-left: 10px;">
                                            <input type="radio" name="std_class" value="studentm4" class="ace input-lg" required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php } ?>

                                    <?php if ($rowconfig->con_m1m4only == 0 && $rowconfig->con_editm1 == 0 && $rowconfig->con_editm4 == 1) { ?>
                                        <h3 class="text-primary">ระดับชั้น</h3><br>
                                        <label style="margin-left: 10px;">
                                            <input type="radio" name="std_class" value="studentm4" class="ace input-lg" checked required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php } ?>

                                    <?php if ($rowconfig->con_m1m4only == 0 && $rowconfig->con_editm1 == 1 && $rowconfig->con_editm4 == 0) { ?>
                                        <h3 class="text-primary">ระดับชั้น</h3><br>
                                        <label>
                                            <input type="radio" name="std_class" value="studentm1" class="ace input-lg" checked required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label><br><br>
                                    <?php } ?>


                                    <?php if ($rowconfig->con_m1m4only == 1 && $rowconfig->con_editm1 == 1) { ?>
                                        <h3 class="text-primary">ระดับชั้น</h3><br>
                                        <label>
                                            <input type="radio" name="std_class" value="studentm1" class="ace input-lg" checked required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label><br><br>
                                    <?php } ?>

                                    <?php if ($rowconfig->con_m1m4only == 4 && $rowconfig->con_editm4 == 1) { ?>
                                        <h3 class="text-primary">ระดับชั้น</h3><br>
                                        <label>
                                            <input type="radio" name="std_class" value="studentm4" class="ace input-lg" checked required>
                                            <span class="lbl bigger-130"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php } ?>


                                    <label for="">โปรดกรอกเลขบัตรประชาชน</label>
                                    <input style="text-align: center;" class="form-control" type="number" placeholder="[XXXXXXXXXXXXX]" required name="std_id" autocomplete="off">
                                    <br><label for="">วันเดือนปีเกิด</label>
                                    <div class="row">
                                        <div class="col col-12 col-md-3">
                                            <label>วันที่เกิด</label></label>
                                            <select type="number" class="form-control w100" name="std_dayb" required>
                                                <option disabled selected>- วันที่ -</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    echo '<option>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col col-12 col-md-6">
                                            <label>เดือนเกิด</label></label>
                                            <select type="text" class="form-control w100" name="std_monthb" required>
                                                <option disabled selected>- เดือน -</option>
                                                <option>มกราคม</option>
                                                <option>กุมภาพันธ์</option>
                                                <option>มีนาคม</option>
                                                <option>เมษายน</option>
                                                <option>พฤษภาคม</option>
                                                <option>มิถุนายน</option>
                                                <option>กรกฎาคม</option>
                                                <option>สิงหาคม</option>
                                                <option>กันยายน</option>
                                                <option>ตุลาคม</option>
                                                <option>พฤศจิกายน</option>
                                                <option>ธันวาคม</option>
                                            </select>
                                        </div>
                                        <div class="col col-12 col-md-3">
                                            <label>ปีเกิด</label></label>
                                            <select type="number" class="form-control w100" name="std_yearb" required>
                                                <option disabled selected>- ปี -</option>
                                                <?php
                                                $thisyear = date("Y") + 543;
                                                for ($i = $thisyear - 25; $i <= $thisyear; $i++) {
                                                    echo '<option>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-info btn-lg">ดำเนินการต่อ</button>
                        </form><br>
                    </div>
                    <div class="col-12 col-sm-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="hr hr32 hr-dotted"></div>
    </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->



    <?php
    include 'includes/footer.php';
    ?>
<?php
}
?>