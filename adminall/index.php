<?php
include 'connectdb.php';
$query1 = "SELECT * FROM studentm1 ORDER BY std_type ASC";
$result1 = mysqli_query($dbcon, $query1);
$query4 = "SELECT * FROM studentm4 ORDER BY std_type ASC";
$result4 = mysqli_query($dbcon, $query4);
?>

<?php
include '../header.php';
// include '../sidebar.php';
?>

<html>
<head>
    <title>Live Table Data Edit Delete using Tabledit Plugin in PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="jquery.tabledit.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
        <br />
        <br />
        <br />
        <div class="table-responsive">
            <h3 align="center">รายชื่อนักเรียนที่สมัครเข้าศึกษาต่อ<br>ชั้นมัธยมศึกษาปีที่ 1</h3><br />
            <table id="editable_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>เลขบัตรประชาชน</th>
                        <th>ประเภท</th>
                        <th>ประเภท</th>
                        <th>เลขประจำตัวสอบ</th>
                        <th>หมายเลขห้องสอบ</th>
                        <th>คำนำหน้า</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>เบอร์โทร</th>
                        <th>สถานะ</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row1 = mysqli_fetch_array($result1)) {
                        if($row1["std_type"]=='13'){
                            $std_type_text1='นักเรียนในเขตบริการ';
                        }else if($row1["std_type"]=='14'){
                            $std_type_text1='นักเรียนนอกเขตบริการ';
                        }else if($row1["std_type"]=='15'){
                            $std_type_text1='นักเรียนความสามารถพิเศษ';
                        }
                        echo '
                            <tr>
                            <td>' . $row1["std_id"] . '</td>
                            <td>' . $row1["std_type"] . '</td>
                            <td>' . $std_type_text1 . '</td>
                            <td>' . $row1["std_regisid"] . '</td>
                            <td>' . $row1["std_regisroom"] . '</td>
                            <td>' . $row1["std_prefix"] . '</td>
                            <td>' . $row1["std_fname"] . '</td>
                            <td>' . $row1["std_lname"] . '</td>
                            <td>' . $row1["std_phone"] . '</td>
                            <td>' . $row1["std_status"] . '</td>
                            <td>' . $row1["std_comment"] . '</td>
                            </tr>
                            ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <br />
        <br />
        <br />
        <div class="table-responsive">
            <h3 align="center">รายชื่อนักเรียนที่สมัครเข้าศึกษาต่อ<br>ชั้นมัธยมศึกษาปีที่ 1</h3><br />
            <table id="editable_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>เลขบัตรประชาชน</th>
                        <th>ประเภท</th>
                        <th>ประเภท</th>
                        <th>เลขประจำตัวสอบ</th>
                        <th>หมายเลขห้องสอบ</th>
                        <th>คำนำหน้า</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>เบอร์โทร</th>
                        <th>สถานะ</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row4 = mysqli_fetch_array($result4)) {
                        if($row4["std_type"]=='13'){
                            $std_type_text4='นักเรียนในเขตบริการ';
                        }else if($row4["std_type"]=='14'){
                            $std_type_text4='นักเรียนนอกเขตบริการ';
                        }else if($row4["std_type"]=='15'){
                            $std_type_text4='นักเรียนความสามารถพิเศษ';
                        }
                        echo '
                            <tr>
                            <td>' . $row4["std_id"] . '</td>
                            <td>' . $row4["std_type"] . '</td>
                            <td>' . $std_type_text4 . '</td>
                            <td>' . $row4["std_regisid"] . '</td>
                            <td>' . $row4["std_regisroom"] . '</td>
                            <td>' . $row4["std_prefix"] . '</td>
                            <td>' . $row4["std_fname"] . '</td>
                            <td>' . $row4["std_lname"] . '</td>
                            <td>' . $row4["std_phone"] . '</td>
                            <td>' . $row4["std_status"] . '</td>
                            <td>' . $row4["std_comment"] . '</td>
                            </tr>
                            ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#editable_table1').Tabledit({
            url: 'actionm1.php',
            columns: {
                identifier: [0, "std_id"],
                editable: [
                    [1, 'std_type'],
                    [3, 'std_regisid'],
                    [4, 'std_regisroom'],
                    [5, 'std_prefix'],
                    [6, 'std_fname'],
                    [7, 'std_lname'],
                    [8, 'std_phone'],
                    [9, 'std_status'],
                    [10, 'std_comment']
                ]
            },
            restoreButton: false,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.std_id).remove();
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#editable_table4').Tabledit({
            url: 'actionm4.php',
            columns: {
                identifier: [0, "std_id"],
                editable: [
                    [1, 'std_type'],
                    [3, 'std_regisid'],
                    [4, 'std_regisroom'],
                    [5, 'std_prefix'],
                    [6, 'std_fname'],
                    [7, 'std_lname'],
                    [8, 'std_phone'],
                    [9, 'std_status'],
                    [10, 'std_comment']
                ]
            },
            restoreButton: false,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.std_id).remove();
                }
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#editable_table1,#editable_table4').DataTable();
    });
</script>
