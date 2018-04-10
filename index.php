<?php
// including the config file
include('config.php');
$pdo = connect();

include('getsql.php');
// select all members
// $sql = 'SELECT * FROM members ORDER BY id ASC';
$query = $pdo->prepare($sql);
$query->execute();
$list = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Import CSV to MySQL and Export from MySQL to CSV in PHP</title>
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>


<script>
function resetForm() {
    confirm("Bạn có chắc là muốn làm lại từ đầu không?");
}
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</head>

<body>
    <div class="container1">
        <div class="header">
            <a href="index.php">
            <img src="images/BeWebDeveloper.png" alt="BeWebDeveloper" />
            </a>
        </div><!-- header -->
            <h2> 
                <p class="text-center bg-warning" style="padding: 10px;">Chào mừng anh em đã gia nhập Nhóm Đại Gia </p>
            </h2>
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-8" title="Anh em có thể chọn theo name, niche hoặc nước để thu gọn tệp cho chuẩn">
                    <fieldset class="field_container">
                    <legend> <img src="images/arrow.gif"> Bộ lọc</legend>
                    <form action="search.php" method="POST">
                    <table class="table table-striped">
                        <tr>
                            <th>First Name</th>
                            <th>Niche</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="first_name" class="form-control" placeholder="Nhập first name" value="<?php echo $first_name; ?>"/>
                            </td>
                            <td>
                                <input type="text" name="niche" class="form-control" placeholder="Nhập niche" value="<?php echo $niche; ?>"/>
                            </td>
                            <td>
                                <input type="text" name="country" class="form-control" placeholder="Nhập Country" value="<?php echo $country; ?>"/>
                            </td>
                            <td>
                                <input type="submit" class="btn btn-default" value="Search" />
                                <a href="index.php" onclick="resetForm()">Reset</a>
                            </td>
                        </tr>
                    </table>
                        
                    </form>
                </fieldset>
                </div>
                <div class="col-xs-6 col-md-4">
                    <fieldset class="field_container" title="Anh em có thể nhập xuất dữ liệu sau khi đã Lọc qua bộ lọc bên kia.">
                        <legend> <img src="images/arrow.gif">Các hoạt động</legend>
                        <span class="import" onclick="show_popup('popup_upload')">Nhập file CSV</span>
                        <a href="export.php" class="export">Xuất ra file CSV để chạy</a>
                    </fieldset>
                    <fieldset class="field_container" title="Hiển thị số email mà anh em đã lọc.">
                        <legend> <img src="images/arrow.gif"> Số email </legend>
                        <center>
                            <button type="button" class="btn btn-info"><h3><?php echo sizeof($list); ?></h3></button>
                        </center>
                    </fieldset>
                </div>
            </div>
            

            
            <fieldset class="field_container">
                <legend> <img src="images/arrow.gif"> Danh sách con vịt để trạc tiền :D </legend>
                <div id="list_container">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Niche</th>
                                <th>Country</th>
                                <th>Birthday</th>
                                <th>Mobile</th>
                                <th>Create</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($list as $rs) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $rs['full_name']; ?></td>
                                        <td><?php echo $rs['first_name']; ?></td>
                                        <td><?php echo $rs['last_name']; ?></td>
                                        <td><?php echo $rs['email']; ?></td>
                                        <td><?php echo $rs['niche']; ?></td>
                                        <td><?php echo $rs['country']; ?></td>
                                        <td><?php echo $rs['birthday']; ?></td>
                                        <td><?php echo $rs['mobile']; ?></td>
                                        <td><?php echo $rs['created']; ?></td>
                                    </tr>
                            <?php  
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Niche</th>
                                <th>Country</th>
                                <th>Birthday</th>
                                <th>Mobile</th>
                                <th>Create</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- list_container -->
            </fieldset>
        </div><!-- content -->
        <div class="footer">
            Powered by HHAL Team. Copyright 2018
        </div><!-- footer -->
    </div><!-- container -->

    <!-- The popup for upload a csv file -->
    <div id="popup_upload">
        <div class="form_upload">
            <span class="close btn btn-default" onclick="close_popup('popup_upload')">x</span>
            <h2>Upload CSV file</h2>
            <form action="import.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputFile">Chọn File</label>
                    <input type="file" name="csv_file" id="csv_file" class="file_input">
                </div>
                <button type="submit" value="Upload file" id="upload_btn" class="btn btn-default">Submit</button>
                
            </form>  
        </div>
    </div>


    

</body>
</html>
