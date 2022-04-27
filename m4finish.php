<?php
include 'includes/header.php';

?>

<?php
session_start();
$_SESSION['page'] = 'm4-4';
if ($_SESSION['where'] != 'm4' && $_SESSION['where'] != 'edit') {
    header("Location: index.php");
}
$_SESSION['where'] != '';
?>

<?php
include 'includes/sidebar.php';
?>


<?php

$std_id = $_POST['std_id'];
$std_regisid = $_POST['std_regisid'];
$std_regisroom = $_POST['std_regisroom'];
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
$std_plan1 = $_POST['std_plan1'];
$std_plan2 = $_POST['std_plan2'];
$std_plan3 = $_POST['std_plan3'];
$std_plan4 = $_POST['std_plan4'];
$std_plan = $std_plan1 . $std_plan2 . $std_plan3 . $std_plan4;
// $std_plan = '1234';

date_default_timezone_set('Asia/Bangkok');
$std_registime = date("Y-m-d H:i:s");

// Upload DOC Location
$location = "stddoc/m4/";
$std_photo = 'stdphoto/m4/' . $std_id . '.jpg';



// บันทึกเอกสาร
if ($_SESSION['mode'] == "add") {

    // $std_doctalent = $_FILES['std_doctalent']['name'];
    if ($_FILES['std_doctalent']['type'] == "application/pdf") {
        $std_doctalent = $location . $std_id . "-doc-talent.pdf";
    } else {
        $std_doctalent = $location . $std_id . "-doc-talent.jpg";
    }
    @copy($_FILES["std_doctalent"]["tmp_name"], $std_doctalent);


    if ($_FILES['std_doccer']['type'] == "application/pdf") {
        $std_doccer = $location . $std_id . "-doc-cer.pdf";
    } else {
        $std_doccer = $location . $std_id . "-doc-cer.jpg";
    }
    @copy($_FILES["std_doccer"]["tmp_name"], $std_doccer);


    if ($_FILES['std_doccer_2']['type'] == "application/pdf") {
        $std_doccer_2 = $location . $std_id . "-doc-cer-2.pdf";
    } else {
        $std_doccer_2 = $location . $std_id . "-doc-cer-2.jpg";
    }
    @copy($_FILES["std_doccer_2"]["tmp_name"], $std_doccer_2);


    if ($_FILES['std_doccer_3']['type'] == "application/pdf") {
        $std_doccer_3 = $location . $std_id . "-doc-cer-3.pdf";
    } else {
        $std_doccer_3 = $location . $std_id . "-doc-cer-3.jpg";
    }
    @copy($_FILES["std_doccer_3"]["tmp_name"], $std_doccer_3);


    if ($_FILES['std_doccer_4']['type'] == "application/pdf") {
        $std_doccer_4 = $location . $std_id . "-doc-cer-4.pdf";
    } else {
        $std_doccer_4 = $location . $std_id . "-doc-cer-4.jpg";
    }
    @copy($_FILES["std_doccer_4"]["tmp_name"], $std_doccer_4);


    if ($_FILES['std_dochome1']['type'] == "application/pdf") {
        $std_dochome1 = $location . $std_id . "-doc-home1.pdf";
    } else {
        $std_dochome1 = $location . $std_id . "-doc-home1.jpg";
    }
    @copy($_FILES["std_dochome1"]["tmp_name"], $std_dochome1);


    if ($_FILES['std_dochome2']['type'] == "application/pdf") {
        $std_dochome2 = $location . $std_id . "-doc-home2.pdf";
    } else {
        $std_dochome2 = $location . $std_id . "-doc-home2.jpg";
    }
    @copy($_FILES["std_dochome2"]["tmp_name"], $std_dochome2);


    if ($_FILES['std_dochome3']['type'] == "application/pdf") {
        $std_dochome3 = $location . $std_id . "-doc-home3.pdf";
    } else {
        $std_dochome3 = $location . $std_id . "-doc-home3.jpg";
    }
    @copy($_FILES["std_dochome3"]["tmp_name"], $std_dochome3);



    // เอกสารผู้ปกครอง
    if ($std_parent_relation == "บิดา") {
        $std_parent_name = $_POST['std_father_name'];
        $std_parent_career = $_POST['std_father_career'];
        $std_parent_work = $_POST['std_father_work'];
        $std_parent_phone = $_POST['std_father_phone'];
        $std_parent_doc = 'std_dochome2';
    } else if ($std_parent_relation == "มารดา") {
        $std_parent_name = $_POST['std_mother_name'];
        $std_parent_career = $_POST['std_mother_career'];
        $std_parent_work = $_POST['std_mother_work'];
        $std_parent_phone = $_POST['std_mother_phone'];
        $std_parent_doc = 'std_dochome3';
    } else if ($std_parent_relation == "0") {
        $std_parent_relation = $_POST['std_parent_relation_orther'];
        $std_parent_name = $_POST['std_parent_name'];
        $std_parent_career = $_POST['std_parent_career'];
        $std_parent_work = $_POST['std_parent_work'];
        $std_parent_phone = $_POST['std_parent_phone'];
        $std_parent_doc = 'std_dochome4';
    }

    if ($_FILES[$std_parent_doc]['type'] == "application/pdf") {
        $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
    } else {
        $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
    }
    @copy($_FILES[$std_parent_doc]["tmp_name"], $std_dochome4);


    if ($_FILES['std_doconet']['type'] == "application/pdf") {
        $std_doconet = $location . $std_id . "-doc-onet.pdf";
    } else {
        $std_doconet = $location . $std_id . "-doc-onet.jpg";
    }
    @copy($_FILES["std_doconet"]["tmp_name"], $std_doconet);


    // $vars = get_defined_vars();  //ดึงค่าตัวแปรทั้งหมด
}




if ($_SESSION['mode'] == "update") {

    include 'includes/config.php';
    $sqlupdate = "SELECT * FROM studentm4 WHERE std_id=:std_id";
    $queryupdate = $dbcon->prepare($sqlupdate);
    $queryupdate->bindParam(':std_id', $std_id, PDO::PARAM_STR);
    $queryupdate->execute();
    //$row = $queryupdate->fetchAll(PDO::FETCH_OBJ); //ดึงออกมาหลายค่าจะติดอะเล
    $row = $queryupdate->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว



    // $std_comment = $row['comment'];

    // ปรับสถานะ
    if ($row->std_status == '0') {
        $std_status_up = '0';
    } elseif ($row->std_status == '2' || $row->std_status == '3') {
        $std_status_up = '3';
    }

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


    if ($_FILES['std_doccer_3']['name'] != '') {
        if (file_exists($row->std_doccer_3)) {
            unlink($row->std_doccer_3);
        }
        if ($_FILES['std_doccer_3']['type'] == "application/pdf") {
            $std_doccer_3 = $location . $std_id . "-doc-cer-3.pdf";
        } else {
            $std_doccer_3 = $location . $std_id . "-doc-cer-3.jpg";
        }
        @copy($_FILES["std_doccer_3"]["tmp_name"], $std_doccer_3);
    } else {
        $std_doccer_3 = $row->std_doccer_3;
    }


    if ($_FILES['std_doccer_4']['name'] != '') {
        if (file_exists($row->std_doccer_4)) {
            unlink($row->std_doccer_4);
        }
        if ($_FILES['std_doccer_4']['type'] == "application/pdf") {
            $std_doccer_4 = $location . $std_id . "-doc-cer-4.pdf";
        } else {
            $std_doccer_4 = $location . $std_id . "-doc-cer-4.jpg";
        }
        @copy($_FILES["std_doccer_4"]["tmp_name"], $std_doccer_4);
    } else {
        $std_doccer_4 = $row->std_doccer_4;
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


    // รอปรับ
    // if ($_FILES[$std_parent_doc]['name'] != '') {
    //     if (file_exists($row->std_dochome4)) {
    //         unlink($row->std_dochome4);
    //     }
    //     if ($_FILES[$std_parent_doc]['type'] == "application/pdf") {
    //         $std_dochome4 = $location . $std_id . "-doc-home4.pdf";
    //     } else {
    //         $std_dochome4 = $location . $std_id . "-doc-home4.jpg";
    //     }
    //     @copy($_FILES[$std_parent_doc]["tmp_name"], $std_dochome4);
    // } else {
    //     $std_dochome4 = $row->std_dochome4;
    // }
    // รอปรับ

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


    // mysqli_close($dbcon);


    if($std_plan<=1000){
        $std_plan=$row->std_plan;
    }
}


?>





<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="row cnbox">
                <div class="col-12 cnbox bg-success text-center">

                    <?php
                    if ($_SESSION['mode'] == "add") {
                        // echo 'POST VALUES';
                        // echo '<pre>';
                        // print_r($vars);
                        // echo '</pre>';
                        include 'includes/config.php';
                        $query = "INSERT INTO studentm4 (std_id, std_type, std_dayb, std_monthb, std_yearb, std_age, std_prefix,
                                    std_fname, std_lname, std_phone, std_religion, std_race, std_nation, std_blood, std_plan, std_eduschool, 
                                    std_edudistrict, std_eduprovince, std_homenum, std_homevill, std_homesubdistrict,
                                    std_homedistrict, std_homeprovince, std_homeposcode, std_father_name, std_father_career, std_father_work,
                                    std_father_phone, std_mother_name, std_mother_career, std_mother_work, std_mother_phone, std_parent_relation,
                                    std_parent_name, std_parent_career, std_parent_work, std_parent_phone, std_talent, std_talentname, std_doctalent, std_registime,
                                    std_photo, std_doccer, std_doccer_2, std_doccer_3, std_doccer_4, std_dochome1, std_dochome2, std_dochome3, std_dochome4, std_doconet)
                                  VALUES ('$std_id', '$std_type', '$std_dayb', '$std_monthb', '$std_yearb', '$std_age', '$std_prefix',
                                    '$std_fname', '$std_lname', '$std_phone', '$std_religion', '$std_race', '$std_nation', '$std_blood', '$std_plan', '$std_eduschool', 
                                    '$std_edudistrict', '$std_eduprovince', '$std_homenum', '$std_homevill', '$std_homesubdistrict',
                                    '$std_homedistrict', '$std_homeprovince', '$std_homeposcode', '$std_father_name', '$std_father_career', '$std_father_work',
                                    '$std_father_phone', '$std_mother_name', '$std_mother_career', '$std_mother_work', '$std_mother_phone', '$std_parent_relation',
                                    '$std_parent_name', '$std_parent_career', '$std_parent_work', '$std_parent_phone', '$std_talent', '$std_talentname', '$std_doctalent', '$std_registime',
                                    '$std_photo', '$std_doccer', '$std_doccer_2', '$std_doccer_3', '$std_doccer_4', '$std_dochome1', '$std_dochome2', '$std_dochome3', '$std_dochome4', '$std_doconet')";
                        $stmt = $dbcon->prepare($query);
                        if ($stmt->execute()) {
                            mysqli_close($dbcon); ?>

                            <div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                                        <li class="breadcrumb-item"><a href="m4start.php">ชั้นมัธยมศึกษาปีที่ 4</a></li>
                                        <li class="breadcrumb-item"><a href="#">กรอกข้อมูล</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">เสร็จสิ้นการกรอกข้อมูล</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="row">
                                <h2>บันทึกข้อมูลสำเร็จแล้ว</h2><br>
                            </div>
                            <div class="row">
                                <div class="col col-12 col-md-6">
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
                                <div class="col col-12 col-md-6">
                                    <div style="text-align:center;margin: 0 auto;">
                                        <br>
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> ชื่อ - นามสกุล </div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php echo "<h4>" . $std_prefix . $std_fname . "&nbsp;" . $std_lname . "<h4>"; ?>
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
                                                    include 'includes/config.php';
                                                    $sqltype = "SELECT * FROM registype WHERE type_id=:type_id";
                                                    $querytype = $dbcon->prepare($sqltype);
                                                    $querytype->bindParam(':type_id', $std_type, PDO::PARAM_STR);
                                                    $querytype->execute();
                                                    $resultstype = $querytype->fetchAll(PDO::FETCH_OBJ);
                                                    foreach ($resultstype as $rowtype) {
                                                        echo "<h4>" . $rowtype->type_name . "<h4>";
                                                    }
                                                    mysqli_close($dbcon);
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> วันเดือนปีเกิด </div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php echo "<h4>" . $std_dayb . "&nbsp;" . $std_monthb . "&nbsp;" . $std_yearb . "<h4>"; ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> สถานะ </div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php echo "<h3 class=\"text-danger\">รอเจ้าหน้าที่ตรวจสอบข้อมูล</h3>"; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div style="text-align:center;margin: 0 auto;">
                                    <br>
                                    <a class="btn btn-success btn-lg" href="index.php">เสร็จสิ้น</a>

                                </div><br>
                            </div>



                        <?php
                            // $_SESSION['mode'] = "";
                        } else {
                            mysqli_close($dbcon);
                            // $_SESSION['mode'] = "";
                        ?>
                            <h1 class="text-primary">บันทึกข้อมูลไม่สำเร็จ</h1>
                            <h3 class="text-danger">โปรดตรวจสอบข้อมูลและกรอกข้อมูลใหม่</h3>
                            <a href="index.php" class="btn btn-yellow">กลับ</a>
                    <?php
                        }
                    }
                    ?>




                    <?php
                    if ($_SESSION['mode'] == "update") {
                        include 'includes/config.php';
                        if ($std_comment != '') {
                            $std_comment_update = "<i>แก้ไขแล้วรอเจ้าหน้าที่ตรวจสอบอีกครั้ง</i>..[" . $std_comment . "]";
                        } else {
                            $std_comment_update = '';
                        }


                        $query = "UPDATE studentm4
                              SET std_type='$std_type', std_dayb='$std_dayb', std_monthb='$std_monthb',
                              std_yearb='$std_yearb', std_age='$std_age', std_prefix='$std_prefix', std_fname='$std_fname',
                              std_lname='$std_lname', std_phone='$std_phone', std_religion='$std_religion', std_race='$std_race',
                              std_nation='$std_nation', std_blood='$std_blood', std_plan='$std_plan', std_eduschool='$std_eduschool',std_edudistrict='$std_edudistrict',
                              std_eduprovince='$std_eduprovince', std_homenum='$std_homenum', std_homevill='$std_homevill',
                              std_homesubdistrict='$std_homesubdistrict', std_homedistrict='$std_homedistrict', std_homeprovince='$std_homeprovince', std_homeposcode='$std_homeposcode',
                              std_father_name='$std_father_name', std_father_career='$std_father_career', std_father_work='$std_father_work', std_father_phone='$std_father_phone',
                              std_mother_name='$std_mother_name', std_mother_career='$std_mother_career', std_mother_work='$std_mother_work', std_mother_phone='$std_mother_phone',
                              std_parent_relation='$std_parent_relation', std_parent_name='$std_parent_name', std_parent_career='$std_parent_career', std_parent_work='$std_parent_work', std_parent_phone='$std_parent_phone',
                              std_talent='$std_talent', std_talentname='$std_talentname', std_doctalent='$std_doctalent', std_doccer='$std_doccer', std_doccer_2='$std_doccer_2', std_doccer_3='$std_doccer_3', std_doccer_4='$std_doccer_4', std_dochome1='$std_dochome1',
                              std_dochome2='$std_dochome2', std_dochome3='$std_dochome3', std_dochome4='$std_dochome4', std_doconet='$std_doconet',
                              std_status='$std_status_up'
                              WHERE std_id='$std_id'";


                        $stmt = $dbcon->prepare($query);
                        if ($stmt->execute()) {
                            mysqli_close($dbcon); ?>

                            <div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                                        <li class="breadcrumb-item"><a href="m4start.php">ชั้นมัธยมศึกษาปีที่ 4</a></li>
                                        <li class="breadcrumb-item"><a href="#">กรอกข้อมูล</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">เสร็จสิ้นการกรอกข้อมูล</li>
                                    </ol>
                                </nav>
                            </div>
                            <?php
                            include 'includes/config.php';
                            $sql = "SELECT * FROM studentm4 INNER JOIN registype ON studentm4.std_type=registype.type_id WHERE std_id=:std_id";
                            $query = $dbcon->prepare($sql);
                            $query->bindParam(':std_id', $std_id, PDO::PARAM_STR);
                            $query->execute();
                            $row = $query->fetch(PDO::FETCH_OBJ); //ดึงค่าเดียว
                            ?>
                            <div class="row">
                                <h2>แก้ไขข้อมูลสำเร็จข้อมูลสำเร็จแล้ว</h2><br>
                            </div>
                            <div class="row">
                                <div class="col col-12 col-md-6">
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
                                <div class="col col-12 col-md-6">
                                    <div style="text-align:center;margin: 0 auto;">
                                        <br>
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> ชื่อ - นามสกุล </div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php echo "<h4>" . $row->std_prefix . $row->std_fname . "&nbsp;" . $row->std_lname . "<h4>"; ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">บัตรประชาชน</div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php echo "<h4>" . $row->std_id . "</h4>"; ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">ประเภท</div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php
                                                    echo "<h4>".$row->type_name."</h4>";
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> วันเดือนปีเกิด </div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php echo "<h4>" . $row->std_dayb . "&nbsp;" . $row->std_monthb . "&nbsp;" . $row->std_yearb . "<h4>"; ?>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> สถานะ </div>
                                                <div class="profile-info-value text-primary" style="background-color: white;">
                                                    <?php
                                                    echo "<h3 class=\"text-danger\">รอเจ้าหน้าที่ตรวจสอบข้อมูล</h3>";
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
                                    <a class="btn btn-success btn-lg" href="index.php">เสร็จสิ้น</a>

                                </div><br>
                            </div>



                        <?php
                            // $_SESSION['mode'] = "";
                        } else {
                            // mysqli_close($dbcon);
                            // $_SESSION['mode'] = "";
                        ?>
                            <h1 class="text-primary">บันทึกข้อมูลไม่สำเร็จ</h1>
                            <h3 class="text-danger">โปรดตรวจสอบข้อมูลและกรอกข้อมูลใหม่</h3>
                            <a href="index.php" class="btn btn-yellow">กลับ</a>
                    <?php
                        }
                    }

                    ?>

                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->



<?php
include 'includes/footer.php';
?>