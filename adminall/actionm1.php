<?php  
//action.php
include 'connectdb.php';

$input = filter_input_array(INPUT_POST);

$std_id = mysqli_real_escape_string($dbcon, $input["std_id"]);
$std_dayb = mysqli_real_escape_string($dbcon, $input["std_dayb"]);
$std_monthb = mysqli_real_escape_string($dbcon, $input["std_monthb"]);
$std_yearb = mysqli_real_escape_string($dbcon, $input["std_yearb"]);
$std_type = mysqli_real_escape_string($dbcon, $input["std_type"]);
$std_regisid = mysqli_real_escape_string($dbcon, $input["std_regisid"]);
$std_regisroom = mysqli_real_escape_string($dbcon, $input["std_regisroom"]);
$std_prefix = mysqli_real_escape_string($dbcon, $input["std_prefix"]);
$std_fname = mysqli_real_escape_string($dbcon, $input["std_fname"]);
$std_lname = mysqli_real_escape_string($dbcon, $input["std_lname"]);
$std_phone = mysqli_real_escape_string($dbcon, $input["std_phone"]);
$std_status = mysqli_real_escape_string($dbcon, $input["std_status"]);
$std_comment = mysqli_real_escape_string($dbcon, $input["std_comment"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE studentm1 
 SET std_type = '".$std_type."',
 std_dayb = '".$std_dayb."',
 std_monthb = '".$std_monthb."',
 std_yearb = '".$std_yearb."',
 std_regisid = '".$std_regisid."',
 std_regisroom = '".$std_regisroom."',
 std_prefix = '".$std_prefix."',
 std_fname = '".$std_fname."',
 std_lname = '".$std_lname."',
 std_phone = '".$std_phone."',
 std_status = '".$std_status."', 
 std_comment = '".$std_comment."' 
 WHERE std_id = '".$input["std_id"]."'
 ";

 mysqli_query($dbcon, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM studentm1 
 WHERE std_id = '".$input["std_id"]."'
 ";
 mysqli_query($dbcon, $query);
}

echo json_encode($input);


?>


