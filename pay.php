<?php
include 'includes/header.php';
?>

<?php
session_start();
$_SESSION['page'] = 'pay';
$_SESSION['where'] = 'pay';
?>

<?php
include 'includes/sidebar.php';
?>

<?php
if (isset($_POST['submit'])) {
    include 'includes/config.php';
    $std_id = $_POST['std_id'];
    // $std_dayb = $_POST['std_dayb'];
    // $std_monthb = $_POST['std_monthb'];
    // $std_yearb = $_POST['std_yearb'];
    $std_class = $_POST['std_class'];
    $sql = "SELECT * FROM $std_class WHERE std_id=:std_id";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
    // $query->bindParam(':std_dayb', $std_dayb, PDO::PARAM_INT);
    // $query->bindParam(':std_monthb', $std_monthb, PDO::PARAM_STR);
    // $query->bindParam(':std_yearb', $std_yearb, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    echo ' <script src="assets/js/sweetalert2.min.js"></script>';
    echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';

    if ($query->rowCount() == 0) {
        echo '<script language=\'JavaScript\'>';
        echo "Swal.fire({  
            position: 'top',
            width: 600,            
            icon: 'info',
            title: 'ไม่พบข้อมูลในระบบ',
            confirmButtonText: `<h4> ปิด </h4>`
          }).then((result) => {        
                     window.location = 'pay.php';
             });";
        echo '</script>';
    } else {
        foreach ($results as $row) {
            if ($row->std_status == 0 || $row->std_status == 2 || $row->std_status == 3) {
                echo '<script language=\'JavaScript\'>';
                echo "Swal.fire({   
                    position: 'top',
                    width: 600,           
                    icon: 'danger',
                    title: '" . $row->std_prefix . $row->std_fname . '  ' . $row->std_lname . "<br>ยังตรวจสอบไม่ผ่าน',                    
                    text: 'โปรดดำเนินการให้เรียบร้อยและได้ผ่านการตรวจสอบจากเจ้าหน้าที่ก่อน จึงจะสามารถดำเนินการชำระเงินได้',
                    confirmButtonText: `<h4> ปิด </h4>`
                  }).then((result) => {        
                             window.location = 'pay.php';
                     });";
                // echo "alert('ผ่านการตรวจสอบแล้ว ไม่สามารถแก้ไขข้อมูลได้');window.location='edit.php';";
                echo '</script>';
            } else if ($row->std_status == 1) {
                echo '<script language=\'JavaScript\'>';
                echo "Swal.fire({   
                    position: 'top',
                    width: 600,           
                    icon: 'success',
                    title: '" . $row->std_prefix . $row->std_fname . '  ' . $row->std_lname . "<br>ผ่านการตรวจสอบทุกขั้นตอนแล้ว',
                    confirmButtonText: `<h4> ปิด </h4>`
                  }).then((result) => {        
                             window.location = 'pay.php';
                     });";
                echo '</script>';
            }else if ($row->std_status == 4) {
                // $_SESSION['std_id'] = $std_id;
                // $_SESSION['std_class'] = $std_class;
                echo "<script type='text/javascript'> document.location = 'payprint.php?std_id=".$std_id."&std_class=".$std_class."'; </script>";
            }
        }
    }
    //std_status    0:รอตรวจสอบ 1:ตรวจสอบผ่านแล้ว 2:ไม่ผ่าน 3:แก้ไขแล้วรอตรวจสอบ 4:ผ่านแล้วรอชำระเงิน
    //std_pay       0:ยังไม่ได้จ่าย 1:จ่ายแล้ว
} else {
?>

    <div class='main-content'>
        <div class='main-content-inner'>
            <div class='page-content'>

                <div class='row cnbox'>
                    <div class='col-12 cnbox bg-success'>
                        <div>
                            <nav aria-label='breadcrumb'>
                                <ol class='breadcrumb'>
                                    <li class='breadcrumb-item'><a href='index.php'>หน้าหลัก</a></li>
                                    <li class='breadcrumb-item active' aria-current='page'>ชำระเงินค่าสมัคร</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class='row cnbox'>
                    <div class='col-12 cnbox bg-info text-center'>
                        <form method='post'>


                   <?php include 'includes/prakad.php'; ?>

                            <h2>ชำระเงินค่าสมัคร</h2>
                            <h3>สำหรับนักเรียนที่ผ่านการตรวจสอบข้อมูลแล้ว</h3>
                            
                            <!-- <h4 class="text-danger">เมื่อชำระเงินแล้ว ให้รอเจ้าหน้าตรวจสอบข้อมูลกับทางธนาคาร <br>(**<u>ใช้เวลาประมาณ 1-2 วันทำการ</u>)</h4> -->

                            <div class='row'>
                                <div class='col col-12 col-sm-3'>
                                </div>
                                <div class='col col-12 col-sm-6'>
                                    <!-- <script type = 'text/javascript' src = 'js/m1checkidmod.js'></script> -->

                                    <?php
                                    include 'includes/config.php';
                                    $sqlconfig = 'SELECT * FROM config';
                                    $queryconfig = $dbcon->prepare($sqlconfig);
                                    // $query->bindParam( ':std_id', $std_id, PDO::PARAM_STR );
                                    $queryconfig->execute();
                                    $rowconfig = $queryconfig->fetch(PDO::FETCH_OBJ);
                                    //ดึงค่าเดียว
                                    ?>

                                    <?php if ($rowconfig->con_m1m4only == 0 && $rowconfig->con_editm1 == 1 && $rowconfig->con_editm4 == 1) {
                                    ?>
                                        <h3 class='text-primary'>ระดับชั้น</h3><br>
                                        <label>
                                            <input type='radio' name='std_class' value='studentm1' class='ace input-lg' required>
                                            <span class='lbl bigger-130'> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label>
                                        <label style='margin-left: 10px;'>
                                            <input type='radio' name='std_class' value='studentm4' class='ace input-lg' required>
                                            <span class='lbl bigger-130'> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php }
                                    ?>

                                    <?php if ($rowconfig->con_m1m4only == 0 && $rowconfig->con_editm1 == 0 && $rowconfig->con_editm4 == 1) {
                                    ?>
                                        <h3 class='text-primary'>ระดับชั้น</h3><br>
                                        <label style='margin-left: 10px;'>
                                            <input type='radio' name='std_class' value='studentm4' class='ace input-lg' checked required>
                                            <span class='lbl bigger-130'> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php }
                                    ?>

                                    <?php if ($rowconfig->con_m1m4only == 0 && $rowconfig->con_editm1 == 1 && $rowconfig->con_editm4 == 0) {
                                    ?>
                                        <h3 class='text-primary'>ระดับชั้น</h3><br>
                                        <label>
                                            <input type='radio' name='std_class' value='studentm1' class='ace input-lg' checked required>
                                            <span class='lbl bigger-130'> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label><br><br>
                                    <?php }
                                    ?>

                                    <?php if ($rowconfig->con_m1m4only == 1 && $rowconfig->con_editm1 == 1) {
                                    ?>
                                        <h3 class='text-primary'>ระดับชั้น</h3><br>
                                        <label>
                                            <input type='radio' name='std_class' value='studentm1' class='ace input-lg' checked required>
                                            <span class='lbl bigger-130'> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                        </label><br><br>
                                    <?php }
                                    ?>

                                    <?php if ($rowconfig->con_m1m4only == 4 && $rowconfig->con_editm4 == 1) {
                                    ?>
                                        <h3 class='text-primary'>ระดับชั้น</h3><br>
                                        <label>
                                            <input type='radio' name='std_class' value='studentm4' class='ace input-lg' checked required>
                                            <span class='lbl bigger-130'> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                        </label><br><br>
                                    <?php }
                                    ?>

                                    <label for=''>โปรดกรอกเลขบัตรประชาชน</label>
                                    <input style='text-align: center;' class='form-control' type='number' placeholder='[XXXXXXXXXXXXX]' required name='std_id' autocomplete='off'>
                                    <br>
                                    
                                    <br>
                                    <button type='submit' name='submit' class='btn btn-info btn-lg'>ดำเนินการต่อ</button>
                        </form><br>
                    </div>
                    <div class='col col-12 col-sm-3'>
                    </div>
                </div>
            </div>
        </div>
        <div class='hr hr32 hr-dotted'></div>
    </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->

    <?php
    include 'includes/footer.php';
    ?>
<?php
}
?>