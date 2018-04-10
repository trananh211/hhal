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
<script>
function resetForm() {
    confirm("Bạn có chắc là muốn làm lại từ đầu không?");
}
</script>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="index.php">
            <img src="images/BeWebDeveloper.png" alt="BeWebDeveloper" />
            </a>
        </div><!-- header -->
        <div style=" border:1px solid red; text-align: center;">
            <h2 class="main_title">Chào mừng anh em đã gia nhập Nhóm Đại Gia</h2>
        </div>
        <div class="content">
            <fieldset class="field_container align_right">
                <legend> <img src="images/arrow.gif"> Bộ lọc</legend>
                <form action="search.php" method="POST">
                <table style="border: 1px solid #ddd;">
                    <tr class="bg_h">
                        <th>Số mail</th>
                        <th>First Name</th>
                        <th>Niche</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td class="center">
                            <?php echo sizeof($list); ?>
                        </td>
                        <td>
                            <input type="text" name="first_name" class="in-search ip-first_name" placeholder="Nhập first name" value="<?php echo $first_name; ?>"/>
                        </td>
                        <td>
                            <input type="text" name="niche" class="in-search ip-niche" placeholder="Nhập niche" value="<?php echo $niche; ?>"/>
                        </td>
                        <td>
                            <input type="text" name="country" class="in-search ip-country" placeholder="Nhập Country" value="<?php echo $country; ?>"/>
                        </td>
                        <td>
                            <input type="submit" value="Search" />
                            <a href="index.php" onclick="resetForm()">Reset</a>
                        </td>
                    </tr>
                </table>
                    
                </form>
            </fieldset>

            <fieldset class="field_container align_right">
                <legend> <img src="images/arrow.gif"> Các hoạt động</legend>
                <span class="import" onclick="show_popup('popup_upload')">Nhập file CSV</span>
                <a href="export.php" class="export">Xuất ra file CSV để chạy</a>
            </fieldset>
            <fieldset class="field_container">
                <legend> <img src="images/arrow.gif"> Danh sách con vịt để trạc tiền :D </legend>
                <div id="list_container">
                    <table class="table_list" cellspacing="2" cellpadding="0">
                        <tr class="bg_h">
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
                        <?php
                            $bg = 'bg_1';$i = 1;
                            foreach ($list as $rs) {
                                ?>
                                <tr class="<?php echo $bg; ?>">
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
                                if ($bg == 'bg_1') {
                                    $bg = 'bg_2';
                                } else {
                                    $bg = 'bg_1';
                                }
                            }
                        ?>
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
            <span class="close" onclick="close_popup('popup_upload')">x</span>
            <h2>Upload CSV file</h2>
            <form action="import.php" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" id="csv_file" class="file_input">
                <input type="submit" value="Upload file" id="upload_btn">
            </form>
        </div>
    </div>
</body>
</html>
