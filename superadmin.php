<?php
session_start();
$_SESSION['where'] = 'superadmin';
$_SESSION['page'] = 'superadmin';
$_SESSION['superadmin'] = '';
?>
<?php
include 'includes/header.php';
?>


<?php
include 'includes/sidebar.php';
?>


<?php
if (isset($_POST['login'])) {
    echo ' <script src="assets/js/sweetalert2.min.js"></script>';
    echo ' <link rel="stylesheet" href="assets/css/sweetalert2.min.css">';

    include 'includes/config.php';
    $uname = $_POST['user_username'];
    $password = $_POST['user_password'];
    $user_type = 2;
    $sql = "SELECT * FROM user WHERE user_username=:uname and user_password=:pass and user_type=:type";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':pass', $password, PDO::PARAM_STR);
    $query->bindParam(':type', $user_type, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() == 0) {
        echo "<script language=\"JavaScript\">";
        echo "Swal.fire({  
            position: 'top',
            width: 600,            
            icon: 'error',
            title: '<h3>ข้อมูลไม่ถูกต้อง</h3>',
            confirmButtonText: `<h4> ปิด </h4>`
          }).then((result) => {        
                     window.location = 'superadmin.php';
             });";
        // echo "alert('ข้อมูลไม่ถูกต้อง');window.location='superadmin.php';";
        echo "</script>";
    } else {
        $_SESSION['superadmin'] = '1';
        echo "<script type='text/javascript'> document.location = 'superadminconfig.php'; </script>";
    }
} else {
?>






    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="page-header ">

                </div><!-- /.page-header -->



                <div class="row cnbox">
                    <div class="col col-lg-12 cnbox bg-warning text-center"><br>
                        <?php
                        include 'includes/config.php';
                        $sql = "SELECT * FROM config";
                        $query = $dbcon->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($results as $config) {
                        }
                        mysqli_close($dbcon);
                        ?>

                        <img src="<?php echo $config->con_logo; ?>" width="20%">
                        <link rel="stylesheet" href="assets/css/inputwidth.css" />
                        <form method="POST">
                            <h1>ผู้ดูแลระบบ</h1>
                            <fieldset>
                                <span class="input-icon">
                                    <input class="input-lg" type="text" id="form-field-icon-1" name="user_username" placeholder="ชื่อผู้ใช้" autocomplete="off" style="padding-left: 30px;" required>
                                    <i class="ace-icon glyphicon glyphicon-user blue" style="line-height: 45px; vertical-align: middle;"></i>
                                </span>
                                <br> <br>
                                <span class="input-icon">
                                    <input class="input-lg" type="password" id="form-field-icon-1" name="user_password" placeholder="รหัสผ่าน" autocomplete="off" style="padding-left: 30px;" required>
                                    <i class="ace-icon glyphicon glyphicon-lock blue" style="line-height: 45px; vertical-align: middle;"></i>
                                </span>
                                <br><br>
                                <button type="submit" name="login" class="btn btn-success">
                                    <i class="ace-icon fa fa-sign-in bigger-150"></i>
                                    เข้าสู่ระบบ
                                    </a>
                            </fieldset>
                        </form><br>


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