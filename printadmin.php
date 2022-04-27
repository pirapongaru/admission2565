<?php
if ($_GET['std_class'] != 'studentm1' && $_GET['std_class'] != 'studentm4') {
?>

    <?php
    include 'includes/header.php';
    ?>

    <?php
    session_start();
    session_unset();
    $_SESSION['where'] = '';
    $_SESSION['page'] = 'print';
    ?>

    <?php
    include 'includes/sidebar.php';
    ?>


    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        พิมพ์บัตรประจำตัวสอบ (สำหรับผู้ที่ผ่านการตรวจสอบแล้ว)
                    </h1>
                </div><!-- /.page-header -->
                <div class="row cnbox">
                    <div class="col col-lg-7 cnbox bg-info text-center">

                        <form action="print.php" method="GET">
                            <!-- <input type="radio" name="std_class" value="studentm1">ชั้น ม.1
                            <input type="radio" name="std_class" value="studentm4">ชั้น ม.4 -->

                            <h1 class="text-primary">เลือกระดับชั้น</h1><br>
                            <label>
                                <input type="radio" name="std_class" value="studentm1" class="ace input-lg">
                                <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                            </label><br><br>
                            <label>
                                <input type="radio" name="std_class" value="studentm4" class="ace input-lg">
                                <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                            </label><br><br>


                            <input type="text" name="std_id" class="ace input-lg" placeholder="- กรอกเลขบัตรประชาชน -"><br><br>
                            <button type="submit" class="btn btn-lg btn-primary">พิมพ์ใบสมัคร</button><br><br>
                        </form>
                    </div>
                </div>

                <div class="alert">
                    <img src="img/covid19-2.jpg" width="60%">
                </div>




                <div class="row cnbox">
                    <div class="col col-lg-7 cnbox bg-info text-center">

                        <img src="img/regis63-3.jpg" width="100%">
                    </div>
                </div>



            </div>
        </div>
    </div>


    <?php
    include 'includes/footer.php';
    ?>

<?php
} else {
?>

    <?php
    include 'includes/config.php';
    $std_id = $_GET['std_id'];
    $std_class = $_GET['std_class'];
    $sql = "SELECT * FROM $std_class INNER JOIN registype ON $std_class.std_type=registype.type_id WHERE std_id=:std_id";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);

    if ($query->rowCount() == 0) {

    ?>
        <!-- ไม่เจอข้อมูล -->
        <?php
        include 'includes/header.php';
        ?>

        <?php
        session_start();
        session_unset();
        $_SESSION['where'] = '';
        $_SESSION['page'] = 'print';
        ?>

        <?php
        include 'includes/sidebar.php';
        ?>


        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="page-header">
                        <h1>
                            พิมพ์บัตรประจำตัวสอบ (สำหรับผู้ที่ผ่านการตรวจสอบแล้ว)
                        </h1>
                    </div><!-- /.page-header -->
                    <div class="row cnbox">
                        <div class="col col-lg-5 cnbox bg-info text-center">

                            <form action="print.php" method="GET">
                                <!-- <input type="radio" name="std_class" value="studentm1">ชั้น ม.1
                            <input type="radio" name="std_class" value="studentm4">ชั้น ม.4 -->

                                <h1 class="text-primary">เลือกระดับชั้น</h1><br>
                                <label>
                                    <input type="radio" name="std_class" value="studentm1" class="ace input-lg">
                                    <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 1 </span>
                                </label><br><br>
                                <label>
                                    <input type="radio" name="std_class" value="studentm4" class="ace input-lg">
                                    <span class="lbl bigger-180"> ชั้นมัธยมศึกษาปีที่ 4 </span>
                                </label><br><br>


                                <input type="text" name="std_id" class="ace input-lg" placeholder="- กรอกเลขบัตรประชาชน -"><br><br>
                                <button type="submit" class="btn btn-lg btn-primary">พิมพ์ใบสมัคร</button><br><br>
                            </form>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                <strong>ไม่สามารถดำเนินการได้!</strong>&nbsp;เนื่องจากไม่พบข้อมูลในระบบ หรือ ข้อมูลยังไม่ผ่านการตรวจสอบ
                                <br>
                            </div><br><br>
                        </div>
                    </div>



                </div>
            </div>
        </div>


        <?php
        include 'includes/footer.php';
        ?>

        <!-- ไม่เจอข้อมูล -->


    <?php
    } else {
    ?>

        <!-- เจอข้อมูล -->

        <?php
        include 'includes/printdetail.php';
        
        ?>









        <!-- เจอข้อมูล -->

    <?php
    }
    ?>
<?php
}
?>