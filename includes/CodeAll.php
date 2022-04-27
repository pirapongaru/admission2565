<!-- ส่วนนี้ ไฟล์ config.php -->
<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'mb');
define('DB_PASS', 'l3iw');
define('DB_NAME', '64regis1');
// Establish database connection.
try {
    $dbcon = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
<!-- ส่วนนี้ ไฟล์ config.php -->



<?php
if($_POST['user']==""){
    $us="";
}else{
    $us=$_POST['user'];
}
if($_POST['pass']==""){
    $ps="";
}else{
    $ps=$_POST['pass'];
}
// ตัวอย่าง

include 'config.php'; //ดึงใช้งานไฟล์ config.php

// รับค่า POST ใส่ตัวแปร
$std_id = $_POST['std_id'];
$std_dayb = $_POST['std_dayb'];
$std_monthb = $_POST['std_monthb'];
$std_yearb = $_POST['std_yearb'];
$std_class = $_POST['std_class'];
// รับค่า POST ใส่ตัวแปร

$sql = "SELECT * FROM $std_class WHERE std_id=:std_id AND std_dayb=:std_dayb AND std_monthb=:std_monthb AND std_yearb=:std_yearb"; //SQL ที่จะรัน
$query = $dbcon->prepare($sql); //ใส่เตรียมพร้อมไว้ในค่าตัวแปร query

// ระบุค่าตัวแปรที่ปรากฏใน SQl ด้านบน
$query->bindParam(':std_id', $std_id, PDO::PARAM_INT); //ระบุค่าชื่อ std_id รับค่ามาจากตัวแปร $std_id ชนิด int(ตัวเลข)
$query->bindParam(':std_dayb', $std_dayb, PDO::PARAM_INT); //ระบุค่าชื่อ std_dayb รับค่ามาจากตัวแปร $std_dayb ชนิด int(ตัวเลข)
$query->bindParam(':std_monthb', $std_monthb, PDO::PARAM_STR); //ระบุค่าชื่อ std_monthb รับค่ามาจากตัวแปร $std_monthb ชนิด STR(ตัวหนังสือ)
$query->bindParam(':std_yearb', $std_yearb, PDO::PARAM_INT); //ระบุค่าชื่อ std_yearb รับค่ามาจากตัวแปร $std_yearb ชนิด int(ตัวเลข)
$query->execute(); //เริ่มทำงาน sql




// ----------------------1-------------------------
//ดึงข้อมูลมาทั้งหมดด้วย $results **กรณีดึงทั้งหมด
$results = $query->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $row) { //ใช้loop นี้เพื่อดึงทีละบรรทัดจนครบ
    // ใส่สิ่งที่ต้องการดึง เช่นข้อมูล เบอร์โทรชื่อ std_phone
    echo $row->std_phone;
    //จะได้ดึงค่า stdphone ทุกๆรอบ จนหมดทุกบรรทัดของ Database
}



// ----------------------2-------------------------
// ดึงข้อมูลบรรทัดแรกเดียวเก็บไว้ที่ $row
$row = $query->fetch(PDO::FETCH_OBJ);
// เวลาใช้งานเหมือนด้านบนแต่ไม่ต้อง loop
echo $row->std_phone;
if ($query->rowCount() == 0) { // เช็คจำนวนแถวข้อมูลในกรณีดึงบรรทัดเดียว
}
?>







<!-- ตัวอย่างการเพิ่มข้อมูล -->
<!-- เอาข้อมูลใส่ตัวแแปรมาก่อน -->
<?php
// ตัวอย่างรับค่า POST ใส่ไว้ในตัวแปร
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
//

include 'config.php';

// ตัวอย่าง SQL ที่จะ เพิ่ม
$query = "INSERT INTO studentm4 (std_id, std_type, std_dayb, std_monthb, std_yearb, std_age, std_prefix,
                                    std_fname, std_lname, std_phone, std_religion, std_race, std_nation, std_blood, std_plan, std_eduschool, 
                                    std_edudistrict, std_eduprovince, std_homenum, std_homevill, std_homesubdistrict,
                                    std_homedistrict, std_homeprovince, std_homeposcode, std_father_name, std_father_career, std_father_work,
                                    std_father_phone, std_mother_name, std_mother_career, std_mother_work, std_mother_phone, std_parent_relation,
                                    std_parent_name, std_parent_career, std_parent_work, std_parent_phone, std_talent, std_doctalent, std_registime,
                                    std_photo, std_doccer, std_doccer_2, std_dochome1, std_dochome2, std_dochome3, std_dochome4, std_doconet)
                                  VALUES ('$std_id', '$std_type', '$std_dayb', '$std_monthb', '$std_yearb', '$std_age', '$std_prefix',
                                    '$std_fname', '$std_lname', '$std_phone', '$std_religion', '$std_race', '$std_nation', '$std_blood', '$std_plan', '$std_eduschool', 
                                    '$std_edudistrict', '$std_eduprovince', '$std_homenum', '$std_homevill', '$std_homesubdistrict',
                                    '$std_homedistrict', '$std_homeprovince', '$std_homeposcode', '$std_father_name', '$std_father_career', '$std_father_work',
                                    '$std_father_phone', '$std_mother_name', '$std_mother_career', '$std_mother_work', '$std_mother_phone', '$std_parent_relation',
                                    '$std_parent_name', '$std_parent_career', '$std_parent_work', '$std_parent_phone', '$std_talent', '$std_doctalent', '$std_registime',
                                    '$std_photo', '$std_doccer', '$std_doccer_2', '$std_dochome1', '$std_dochome2', '$std_dochome3', '$std_dochome4', '$std_doconet')";
$stmt = $dbcon->prepare($query);
if ($stmt->execute()) {
    echo "เพิ่มข้อมูลสำำเร็จ";
} else {
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}
?>


<!-- ตัวอย่างการแก้ไขข้อมูล (จะคล้ายๆกัน)-->
<!-- เอาข้อมูลใส่ตัวแแปรมาก่อน -->
<?php
// ตัวอย่างรับค่า POST ใส่ไว้ในตัวแปร
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
//ตัวแปรอื่นๆที่ต้องการ

include 'config.php';

// ตัวอย่าง SQL ที่จะ แก้ไข
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
std_talent='$std_talent', std_doctalent='$std_doctalent', std_doccer='$std_doccer', std_doccer_2='$std_doccer_2', std_dochome1='$std_dochome1',
std_dochome2='$std_dochome2', std_dochome3='$std_dochome3', std_dochome4='$std_dochome4', std_doconet='$std_doconet',
std_status='$std_status_up'
WHERE std_id='$std_id'";
$stmt = $dbcon->prepare($query);
if ($stmt->execute()) {
    echo "แก้ไขข้อมูลสำำเร็จ";
} else {
    echo "ไม่สำเร็จ";
}
?>