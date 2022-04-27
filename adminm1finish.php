<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>

<?php
session_start();
$_SESSION['page'] = 'administrator';
// $_SESSION['mode'] = 'administrator';
if ($_SESSION['where'] != 'administrator') {
    header("Location: admin.php");
}
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<?php




if ($_POST['std_regisid'] != '') {
    $std_regisid = $_POST['std_regisid'];
} else {
    $std_regisid = '0';
}

if ($_POST['std_regisroom'] != '') {
    $std_regisroom = $_POST['std_regisroom'];
} else {
    $std_regisroom = '0';
}

$std_id = $_POST['std_id'];
$std_type = $_POST['std_type'];
$std_dayb = $_POST['std_dayb'];
$std_monthb = $_POST['std_monthb'];
$std_yearb = $_POST['std_yearb'];
$std_age = $_POST['std_age'];
$std_prefix = $_POST['std_prefix'];
$std_fname = $_POST['std_fname'];
$std_lname = $_POST['std_lname'];
$std_phone = $_POST['std_phone'];
$std_religion = $_POST['std_religion'];
$std_race = $_POST['std_race'];
$std_nation = $_POST['std_nation'];
$std_blood = $_POST['std_blood'];
$std_eduschool = $_POST['std_eduschool'];
$std_edudistrict = $_POST['std_edudistrict'];
$std_eduprovince = $_POST['std_eduprovince'];
$std_homenum = $_POST['std_homenum'];
$std_homevill = $_POST['std_homevill'];
$std_homesubdistrict = $_POST['std_homesubdistrict'];
$std_homedistrict = $_POST['std_homedistrict'];
$std_homeprovince = $_POST['std_homeprovince'];
$std_homeposcode = $_POST['std_homeposcode'];
$std_father_name = $_POST['std_father_name'];
$std_father_career = $_POST['std_father_career'];
$std_father_work = $_POST['std_father_work'];
$std_father_phone = $_POST['std_father_phone'];
$std_mother_name = $_POST['std_mother_name'];
$std_mother_career = $_POST['std_mother_career'];
$std_mother_work = $_POST['std_mother_work'];
$std_mother_phone = $_POST['std_mother_phone'];
$std_parent_relation = $_POST['std_parent_relation'];
$std_talent = $_POST['std_talent'];
$std_talentname = $_POST['std_talentname'];
// $std_plan1 = $_POST['std_plan1'];
// $std_plan2 = $_POST['std_plan2'];
// $std_plan3 = $_POST['std_plan3'];
// $std_plan4 = $_POST['std_plan4'];
// $std_plan = $std_plan1 . $std_plan2 . $std_plan3 . $std_plan4;
$std_plan = '1234';

date_default_timezone_set('Asia/Bangkok');


$admin_computer = $_POST['admin_computer'].' / '.date("Y-m-d H:i:s");



$std_status = $_POST['std_status']; //ถ้ากดผ่าน
if ($std_status == '1') {
    $std_comment = ' '; // Clear Comment  เมื่อผ่าน
    // วันสุดท้ายแก้ไขจุดนี้
    // $std_dateok = date("Y-m-d");
    $std_dateok = "2022-03-13";
    $std_regisid = $_POST['std_regisid'];
    $std_regisroom = $_POST['std_regisroom'];


    // $autoregisid = $_POST['autoregisid'];
    // if ($autoregisid == 1) {
    //     $std_regisid = ($std_type * 1000) + 1;
    //     while (true) {    
    //         $sqlregisid = "SELECT std_regisid FROM studentm4 WHERE std_type='$std_type' AND std_regisid='$std_regisid'";
    //         $queryregisid = $dbcon->prepare($sqlregisid);
    //         $queryregisid->execute();
    //         $rowsregisid = $queryregisid->fetch(PDO::FETCH_OBJ);
    //         if ($queryregisid->rowCount() == 0) {
    //             break;
    //         } else {
    //             $std_regisid = $std_regisid + 1;
    //         }
    //     }
    // } else {
    //     $std_regisid = $_POST['std_regisid'];
    // }


    // $autoregisroom = $_POST['autoregisroom'];
    // if ($autoregisid == 1) { 
    //คือไม่กำหนด
    //$std_regisroom = '0'; //คือไม่กำหนด

    // เพิ่มเลขห้องแบบกำหนดเอง SKR
    //     if($std_regisid>=43001&&$std_regisid<=43036){
    //         $std_regisroom=1702;
    //     }else if($std_regisid>=43037&&$std_regisid<=43072){
    //         $std_regisroom=1703;
    //     }else if($std_regisid>=43073&&$std_regisid<=43108){
    //         $std_regisroom=1704;
    //     }else if($std_regisid>=43109&&$std_regisid<=43144){
    //         $std_regisroom=1705;
    //     }else if($std_regisid>=43145&&$std_regisid<=43180){
    //         $std_regisroom=1707;
    //     }else if($std_regisid>=43181&&$std_regisid<=43216){
    //         $std_regisroom=1708;
    //     }else if($std_regisid>=43217&&$std_regisid<=43252){
    //         $std_regisroom=1709;
    //     }else if($std_regisid>=43253&&$std_regisid<=43288){
    //         $std_regisroom=1710;
    //     }else if($std_regisid>=43289&&$std_regisid<=43324){
    //         $std_regisroom=1711;
    //     }else if($std_regisid>=43325&&$std_regisid<=43360){
    //         $std_regisroom=1712;
    //     }else if($std_regisid>=43361&&$std_regisid<=43396){
    //         $std_regisroom=1802;
    //     }else if($std_regisid>=43397&&$std_regisid<=43432){
    //         $std_regisroom=1803;
    //     }else if($std_regisid>=43433&&$std_regisid<=43468){
    //         $std_regisroom=1804;
    //     }else if($std_regisid>=43469&&$std_regisid<=43504){
    //         $std_regisroom=1805;
    //     }else if($std_regisid>=43505&&$std_regisid<=43540){
    //         $std_regisroom=1807;
    //     }else if($std_regisid>=43541){
    //         $std_regisroom=1808;
    //     }
    // } else {
    //     $std_regisroom = $_POST['std_regisroom'];
    // }



} else if ($std_status == '2') { //ถ้ากดไม่ผ่าน
    $std_regisid = '0'; //เป็น 0 ถ้ากดไม่ผ่าน
    $std_regisroom = '0'; //เป็น 0 ถ้ากดไม่ผ่าน
    if ($_POST['std_comment'] != '') {  // ควบคุมคอมเม้นเมื่อมีการกดไม่ผ่าน comment 
        $std_comment = $_POST['std_comment'];
        $std_dateok = ' ';
    } else {
        $std_comment = ' ';
        $std_dateok = ' ';
    }
} else if ($std_status == '4') { //ถ้ากดไม่ผ่าน
    $std_regisid = '0'; //เป็น 0 ถ้ากดไม่ผ่าน
    $std_regisroom = '0'; //เป็น 0 ถ้ากดไม่ผ่าน
    $std_comment = ' ';
    $std_dateok = ' ';
}









// Upload DOC
$location = "stddoc/m1/";
$std_photo_up = 'stdphoto/m1/' . $std_id . '.jpg';
$std_photo = $std_photo_up;

?>



<?php

if ($_SESSION['mode'] == "administrator") {
    include 'includes/config.php';
    $sqlupdate = "SELECT * FROM studentm1 WHERE std_id=:std_id";
    $queryupdate = $dbcon->prepare($sqlupdate);
    $queryupdate->bindParam(':std_id', $std_id, PDO::PARAM_STR);
    $queryupdate->execute();
    //$row = $queryupdate->fetchAll(PDO::FETCH_OBJ); //ดึงออกมาหลายค่าจะติดอะเล
    $row = $queryupdate->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว


    if ($_FILES['std_doctalent']['name'] != '') {
        if (file_exists($row->std_doctalent)) {
            unlink($row->std_doctalent);
        }
        if ($_FILES['std_doctalent']['type'] == "application/pdf") {
            $std_doctalent = $location . $std_id . "-doc-talent.pdf";
        } else {
            $std_doctalent = $location . $std_id . "-doc-talent.jpg";
        }
        @copy($_FILES["std_doctalent"]["tmp_name"], $std_doctalent);
    } else {
        $std_doctalent = $row->std_doctalent;
    }

    if ($_FILES['std_doccer']['name'] != '') {
        if (file_exists($row->std_doccer)) {
            unlink($row->std_doccer);
        }
        if ($_FILES['std_doccer']['type'] == "application/pdf") {
            $std_doccer = $location . $std_id . "-doc-cer.pdf";
        } else {
            $std_doccer = $location . $std_id . "-doc-cer.jpg";
        }
        @copy($_FILES["std_doccer"]["tmp_name"], $std_doccer);
    } else {
        $std_doccer = $row->std_doccer;
    }


    if ($_FILES['std_doccer_2']['name'] != '') {
        if (file_exists($row->std_doccer_2)) {
            unlink($row->std_doccer_2);
        }
        if ($_FILES['std_doccer_2']['type'] == "application/pdf") {
            $std_doccer_2 = $location . $std_id . "-doc-cer-2.pdf";
        } else {
            $std_doccer_2 = $location . $std_id . "-doc-cer-2.jpg";
        }
        @copy($_FILES["std_doccer_2"]["tmp_name"], $std_doccer_2);
    } else {
        $std_doccer_2 = $row->std_doccer_2;
    }


    if ($_FILES['std_dochome1']['name'] != '') {
        if (file_exists($row->std_dochome1)) {
            unlink($row->std_dochome1);
        }
        if ($_FILES['std_dochome1']['type'] == "application/pdf") {
            $std_dochome1 = $location . $std_id . "-doc-home1.pdf";
        } else {
            $std_dochome1 = $location . $std_id . "-doc-home1.jpg";
        }
        @copy($_FILES["std_dochome1"]["tmp_name"], $std_dochome1);
    } else {
        $std_dochome1 = $row->std_dochome1;
    }

    if ($_FILES['std_dochome2']['name'] != '') {
        if (file_exists($row->std_dochome2)) {
            unlink($row->std_dochome2);
        }
        if ($_FILES['std_dochome2']['type'] == "application/pdf") {
            $std_dochome2 = $location . $std_id . "-doc-home2.pdf";
        } else {
            $std_dochome2 = $location . $std_id . "-doc-home2.jpg";
        }
        @copy($_FILES["std_dochome2"]["tmp_name"], $std_dochome2);
    } else {
        $std_dochome2 = $row->std_dochome2;
    }

    if ($_FILES['std_dochome3']['name'] != '') {
        if (file_exists($row->std_dochome3)) {
            unlink($row->std_dochome3);
        }
        if ($_FILES['std_dochome3']['type'] == "application/pdf") {
            $std_dochome3 = $location . $std_id . "-doc-home3.pdf";
        } else {
            $std_dochome3 = $location . $std_id . "-doc-home3.jpg";
        }
        @copy($_FILES["std_dochome3"]["tmp_name"], $std_dochome3);
    } else {
        $std_dochome3 = $row->std_dochome3;
    }




    // // เอกสารผู้ปกครอง
    if ($std_parent_relation == "บิดา") {
        $std_parent_name = $_POST['std_father_name'];
        $std_parent_career = $_POST['std_father_career'];
        $std_parent_work = $_POST['std_father_work'];
        $std_parent_phone = $_POST['std_father_phone'];
        $std_parent_doc = 'std_dochome2';
        if ($_FILES['std_dochome2']['name'] == '') { //ไม่ส่งไฟล์มา
            if (file_exists($row->std_dochome4)) {
                unlink($row->std_dochome4);
            }
            if (substr($row->std_dochome3, -3) == "pdf") {
                $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
            } else {
                $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
            }
            @copy($row->std_dochome3, $std_dochome4);
        } else { //ถ้าส่งไฟล์มา
            if (file_exists($row->std_dochome4)) {
                unlink($row->std_dochome4);
            }
            if ($_FILES['std_dochome2']['type'] == "application/pdf") {
                $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
            } else {
                $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
            }
            @copy($_FILES['std_dochome2']["tmp_name"], $std_dochome4);
        }
    } else if ($std_parent_relation == "มารดา") {
        $std_parent_name = $_POST['std_mother_name'];
        $std_parent_career = $_POST['std_mother_career'];
        $std_parent_work = $_POST['std_mother_work'];
        $std_parent_phone = $_POST['std_mother_phone'];
        $std_parent_doc = 'std_dochome3';
        if ($_FILES['std_dochome3']['name'] == '') { //ไม่ส่งไฟล์มา
            if (file_exists($row->std_dochome4)) {
                unlink($row->std_dochome4);
            }
            if (substr($row->std_dochome3, -3) == "pdf") {
                $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
            } else {
                $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
            }
            @copy($row->std_dochome3, $std_dochome4);
        } else { //ถ้าส่งไฟล์มา
            if (file_exists($row->std_dochome4)) {
                unlink($row->std_dochome4);
            }
            if ($_FILES['std_dochome3']['type'] == "application/pdf") {
                $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
            } else {
                $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
            }
            @copy($_FILES['std_dochome3']["tmp_name"], $std_dochome4);
        }
    } else if ($std_parent_relation == "0") {
        $std_parent_relation = $_POST['std_parent_relation_orther'];
        $std_parent_name = $_POST['std_parent_name'];
        $std_parent_career = $_POST['std_parent_career'];
        $std_parent_work = $_POST['std_parent_work'];
        $std_parent_phone = $_POST['std_parent_phone'];
        $std_parent_doc = 'std_dochome4';
        if ($_FILES['std_dochome4']['name'] != '') {
            if (file_exists($row->std_dochome4)) {
                unlink($row->std_dochome4);
            }
            if ($_FILES['std_dochome4']['type'] == "application/pdf") {
                $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
            } else {
                $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
            }
            @copy($_FILES['std_dochome4']["tmp_name"], $std_dochome4);
        } else {
            $std_dochome4 = $row->std_dochome4;
        }
    }




    if ($_FILES['std_doconet']['name'] != '') {
        if (file_exists($row->std_doconet)) {
            unlink($row->std_doconet);
        }
        if ($_FILES['std_doconet']['type'] == "application/pdf") {
            $std_doconet = $location . $std_id . "-doc-onet.pdf";
        } else {
            $std_doconet = $location . $std_id . "-doc-onet.jpg";
        }
        @copy($_FILES["std_doconet"]["tmp_name"], $std_doconet);
    } else {
        $std_doconet = $row->std_doconet;
    }


    mysqli_close($dbcon);
}





if ($_SESSION['mode'] == "administrator") {
    include 'includes/config.php';

    //
    // $query = "UPDATE studentm4
    //                           SET std_type='$std_type', std_dayb='$std_dayb', std_monthb='$std_monthb',
    //                           std_yearb='$std_yearb', std_age='$std_age', std_prefix='$std_prefix', std_fname='$std_fname',
    //                           std_lname='$std_lname', std_phone='$std_phone', std_religion='$std_religion', std_race='$std_race',
    //                           std_nation='$std_nation', std_blood='$std_blood', std_eduschool='$std_eduschool',std_edudistrict='$std_edudistrict',
    //                           std_eduprovince='$std_eduprovince', std_homenum='$std_homenum', std_homevill='$std_homevill',
    //                           std_homesubdistrict='$std_homesubdistrict', std_homedistrict='$std_homedistrict', std_homeprovince='$std_homeprovince',
    //                           std_father_name='$std_father_name', std_father_career='$std_father_career', std_father_work='$std_father_work', std_father_phone='$std_father_phone',
    //                           std_mother_name='$std_mother_name', std_mother_career='$std_mother_career', std_mother_work='$std_mother_work', std_mother_phone='$std_mother_phone',
    //                           std_parent_relation='$std_parent_relation', std_parent_name='$std_parent_name', std_parent_career='$std_parent_career', std_parent_work='$std_parent_work', std_parent_phone='$std_parent_phone',
    //                           std_talent='$std_talent', std_doctalent='$std_doctalent', std_doccer='$std_doccer', std_doccer_2='$std_doccer_2', std_dochome1='$std_dochome1',
    //                           std_dochome2='$std_dochome2', std_dochome3='$std_dochome3', std_dochome4='$std_dochome4', std_doconet='$std_doconet',
    //                           std_comment='$std_comment', std_status='$std_status', std_regisid='$std_regisid', std_regisroom='$std_regisroom', std_dateok='$std_dateok'
    //                           WHERE std_id='$std_id'";
    // //

    // $query = "UPDATE studentm4
    //                           SET std_type='$std_type', std_dayb='$std_dayb', std_monthb='$std_monthb',
    //                           std_yearb='$std_yearb', std_age='$std_age', std_prefix='$std_prefix', std_fname='$std_fname',
    //                           std_lname='$std_lname', std_phone='$std_phone', std_religion='$std_religion', std_race='$std_race',
    //                           std_nation='$std_nation', std_blood='$std_blood', std_plan='$std_plan', std_eduschool='$std_eduschool',std_edudistrict='$std_edudistrict',
    //                           std_eduprovince='$std_eduprovince', std_homenum='$std_homenum', std_homevill='$std_homevill',
    //                           std_homesubdistrict='$std_homesubdistrict', std_homedistrict='$std_homedistrict', std_homeprovince='$std_homeprovince', std_homeposcode='$std_homeposcode',
    //                           std_father_name='$std_father_name', std_father_career='$std_father_career', std_father_work='$std_father_work', std_father_phone='$std_father_phone',
    //                           std_mother_name='$std_mother_name', std_mother_career='$std_mother_career', std_mother_work='$std_mother_work', std_mother_phone='$std_mother_phone',
    //                           std_parent_relation='$std_parent_relation', std_parent_name='$std_parent_name', std_parent_career='$std_parent_career', std_parent_work='$std_parent_work', std_parent_phone='$std_parent_phone',
    //                           std_talent='$std_talent', std_doctalent='$std_doctalent', std_doccer='$std_doccer', std_doccer_2='$std_doccer_2', std_dochome1='$std_dochome1',
    //                           std_dochome2='$std_dochome2', std_dochome3='$std_dochome3', std_dochome4='$std_dochome4', std_doconet='$std_doconet',
    //                           std_status='$std_status', std_comment='$std_comment', std_regisid='$std_regisid', std_regisroom='$std_regisroom', std_dateok='$std_dateok'
    //                           WHERE std_id='$std_id'";

    $query = "UPDATE studentm1    
    SET std_status='$std_status', std_type='$std_type', std_comment='$std_comment', std_regisid='$std_regisid', std_regisroom='$std_regisroom', std_dateok='$std_dateok', admin_computer='$admin_computer'
    WHERE std_id='$std_id'";

    $stmt = $dbcon->prepare($query);
    if ($stmt->execute()) {
        mysqli_close($dbcon); ?>

        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">

                    <div class="row">
                        <h2>บันทึกข้อมูลสำเร็จแล้ว</h2><br>
                    </div>
                    <div class="row">
                        <div class="col col-12 col-md-3">
                            <br>
                            <div style="height: 230px;width: 200px; text-align:center;margin: 0 auto;border: 2px solid #bce8f1;background-color: #fff;">
                                <div>
                                    <img src="<?php
                                                if (file_exists($std_photo)) {
                                                    echo $std_photo . "?" . (rand(1, 100));
                                                } else {
                                                    echo "stdphoto/nophoto.jpg";
                                                }
                                                ?>" width="200px">
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-md-9">
                            <div style="text-align:center;margin: 0 auto;">
                                <br>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> ชื่อ - นามสกุล </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php echo "<h1>" . $std_prefix . $std_fname . "&nbsp;" . $std_lname . "</h1>"; ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">บัตรประชาชน</div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php echo "<h4>" . $std_id . "<h4>"; ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">ประเภท</div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php
                                            $type_class = "ชั้นมัธยมศึกษาปีที่ 1";
                                            $num = 1;
                                            $sql = "SELECT * FROM registype WHERE type_status=1 AND type_class=:type_class";
                                            $query = $dbcon->prepare($sql);
                                            $query->bindParam(':type_class', $type_class, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($results as $row) {
                                                if ($std_type == $row->type_id) {
                                                    echo "<h4>" . $row->type_name . "<h4>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> เลขประจำตัวสอบ </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php
                                            if ($std_status == '1') {
                                                echo "<h4>" . $std_regisid . "<h4>";
                                            } else {
                                                echo "<h4>" . "รอตรวจสอบ" . "<h4>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> หมายเลขห้องสอบ </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php
                                            if ($std_status == '1') {
                                                if ($std_regisroom == 0) {
                                                    echo "<h4> - <h4>";
                                                } else {
                                                    echo "<h4>" . $std_regisroom . "<h4>";
                                                }
                                            } else {
                                                echo "<h4>" . "รอตรวจสอบ" . "<h4>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> สถานะ </div>
                                        <div class="profile-info-value text-primary" style="background-color: white;">
                                            <?php
                                            if ($std_status == '1') {
                                                echo "<br><h3 class=\"text-success\">ผ่านการตรวจสอบแล้ว</h3>";
                                            } else if ($std_status == '0') {
                                                echo "<br><h3 class=\"text-primary\">รอเจ้าหน้าที่ตรวจสอบข้อมูล</h3>(โปรดตรวจสอบสถานะได้ที่เมนูตรวจสอบ ได้ภายหลัง)";
                                            } else if ($std_status == '2') {
                                                echo "<br><h3 class=\"text-danger\">ตรวจสอบไม่ผ่าน</h3>(รอตรวจสอบใหม่ปรับปรุงข้อมูล)";
                                            } else if ($std_status == '3') {
                                                echo "<br><h3 class=\"text-danger\">นักเรียนแก้ไขข้อมูลแล้ว</h3>(โปรดรอตรวจสอบซ้ำ)";
                                            } else if ($std_status == '4') {
                                                echo "<br><h3 class=\"text-success\">ตรวจสอบข้อมูลผ่านแล้ว รอนักเรียนชำระเงิน</h3>";
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div style="text-align:center;margin: 0 auto;">
                            <br>
                            <a class="btn btn-success btn-lg" href="adminm1.php">กลับ</a>

                        </div><br>
                    </div>



                <?php
                // $_SESSION['mode'] = "";
            } else {
                mysqli_close($dbcon);
                // $_SESSION['mode'] = "";
                ?>
                    <h1 class="text-primary">บันทึกข้อมูลไม่สำเร็จ</h1>
                    <a href="adminm1.php" class="btn btn-yellow">กลับ</a>
            <?php
                echo "<h4>" . $autoregisid . "<h4>";
            }
        }
            ?>

                </div>
            </div>
        </div>
        <!-- /.page-content -->
        <!-- </div>
        </div> -->
        <!-- /.main-content -->



        <?php
        mysqli_close($dbcon);
        include 'includes/footer.php';
        ?>