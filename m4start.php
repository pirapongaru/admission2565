<?php
session_start();
$_SESSION['page'] = 'm4-1';
$_SESSION['where'] = 'm4';
$_SESSION['std_id'] = ''; //เคลีย session
?>
<?php

include 'includes/header.php';
include 'includes/sidebar.php';
?>


<?php

include 'includes/config.php';
$sqlcheck = "SELECT * FROM config";
$querycheck = $dbcon->prepare($sqlcheck);
$querycheck->execute();
$configcheck = $querycheck->fetch(PDO::FETCH_OBJ);

if ($configcheck->con_m4open == 0) {
  echo ' <script src="assets/js/sweetalert2.min.js"></script>';
  echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';
  echo "<script language=\"JavaScript\">";
    echo "Swal.fire({ 
      position: 'top',
      width: 800,          
      icon: 'error',
      title: 'ปิดระบบ',
      confirmButtonText: `<h4> ปิด </h4>`
    }).then((result) => {        
               window.location = 'index.php';
       });";
    echo "</script>";
}

?>





<?php
if (isset($_POST['submit'])) {
  echo ' <script src="assets/js/sweetalert2.min.js"></script>';
  echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';

  include 'includes/config.php';
  $sqlcheck = "SELECT * FROM config";
  $querycheck = $dbcon->prepare($sqlcheck);
  $querycheck->execute();
  $configcheck = $querycheck->fetch(PDO::FETCH_OBJ);
  $std_id = $_POST['std_id'];
  if (strlen($std_id) != 13) {
    echo "<script language=\"JavaScript\">";
    echo "Swal.fire({ 
      position: 'top',
      width: 800,          
      icon: 'info',
      title: 'รูปแบบข้อมูลไม่ถูกต้อง',
      text: 'กรุณากรอกหมายเลขประชาชน 13 หลักใหม่',
      confirmButtonText: `<h4> ปิด </h4>`
    }).then((result) => {        
               window.location = 'm4start.php';
       });";
    // echo "alert('รูปแบบข้อมูลไม่ถูกต้อง กรุณากรอกหมายเลขประชาชน 13 หลักใหม่');window.location='m4start.php';";
    echo "</script>";
  } else {
    $sql = "SELECT * FROM studentm4 WHERE std_id=:std_id";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() != 0) {
      echo "<script language=\"JavaScript\">";
      foreach ($results as $row) {
        echo "Swal.fire({ 
          position: 'top',
          width: 600,         
          icon: 'success',
          title: 'พบข้อมูลในระบบแล้ว<br><br>" . $row->std_prefix . $row->std_fname . "  " . $row->std_lname . "',
          confirmButtonText: `<h4> ปิด </h4>`
        }).then((result) => {        
                   window.location = 'm4start.php';
           });";
        // echo "alert('พบข้อมูลในระบบแล้ว \\n" . $row->std_prefix . $row->std_fname . "  " . $row->std_lname . "\\nกรุณาไปเมนูตรวจสอบผลการสมัคร');window.location='m4start.php';";
      }
      echo "</script>";
    } else {

      $_SESSION['std_id'] = $std_id;
      echo "<script type='text/javascript'> document.location = 'm4frm.php'; </script>";
    }
  }
} else {
?>


  <?php
  include 'includes/config.php';
  $sql = "SELECT * FROM config";
  $query = $dbcon->prepare($sql);
  $query->execute();
  $config = $query->fetch(PDO::FETCH_OBJ);
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
                  <li class="breadcrumb-item active" aria-current="page">ชั้นมัธยมศึกษาปีที่ 4</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>


        <div class="row cnbox">
          <div class="col-12 cnbox bg-info text-center">
            <h2>สมัครนักเรียนเพื่อเข้าศึกษาต่อ</h2>
            <h2>ชั้นมัธยมศึกษาปีที่ 4</h2>
            <h4><?php echo $config->con_typeadmission; ?></h4>
            <!-- <h4 class="text-danger">ปิดรับสมัคร<u>ความสามารถพิเศษ</u> วันที่ 10 มีนาคม 2565</h4> -->
            <h4 class="text-danger">ปิดระบบรับสมัคร วันที่ 13 มีนาคม 2565 เวลา 16.30 น.</h4><br>


            <label for="">โปรดกรอกเลขบัตรประชาชน</label>
            <div class="row">
              <div class="col col-12 col-sm-4">
              </div>
              <div class="col col-12 col-sm-4">
                <form class="" id="form1" name="form1" method="post" #onSubmit="checkData()">
                  <input style="text-align: center;" class="form-control inputcenter" type="number" placeholder="XXXXXXXXXXXXX" required name="std_id" id="data" autofocus>
                  <br>
                  <button class="btn btn-success btn-lg" type="submit" name="submit">ดำเนินการต่อ</button>
                </form><br>
              </div>
              <div class="col col-12 col-sm-4">
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