<?php
session_start();
$classArr = ["THT7CN01", "THT7CN02", "THT7CN03", "THT7CN04", "THT7CN05", "THT7CN06", "THT7CN07", "THT7CN08", "THT7CN09"];
if (isset($_GET["class"])) $class = $_GET["class"];
else $class = "";
$groupArr = ["windows"=>"Windows","word"=>"Word","excel"=>"Excel","powerpoint"=>"Power Point","luyenthi"=>"Luyện Thi"];
if (isset($_GET["group"])) $group = $_GET["group"];
else $group = "";
include "../template/header.php";
?>
<div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Bài nộp</h2>
    <?php
    if (isset($_SESSION["msg"])) {
        echo '
            <div class="col-3"></div>
            <div class="col-6">
                <div class="alert alert-' . $_SESSION["typeMsg"] . ' alert-dismissible text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>' . $_SESSION["msg"] . '</strong>
                </div>
            </div>
            <div class="col-3"></div>    
        ';
    }
    unset($_SESSION["typeMsg"]);
    unset($_SESSION["msg"]);
    ?>
    <div class="input-group mb-3">
        <label class="input-group-text" for="className">Lớp học</label>
        <select name="className" id="className" class="form-select" onchange="document.location='index.php?class='+this.value+'&group='+$('#group').val()">
            <option value="">Chọn lớp</option>
            <?php
            for ($i = 0; $i < count($classArr); $i++) {
                if ($classArr[$i] == $class) $selected = "selected";
                else $selected = "";
                echo '<option value="' . $classArr[$i] . '"' . $selected . '>' . $classArr[$i] . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="group">Nhóm bài tập</label>
        <select name="group" id="group" class="form-select" onchange="document.location='index.php?class='+$('#className').val()+'&group='+this.value">
            <option value="">Chọn nhóm bài tập</option>
            <?php
            foreach ($groupArr AS $k => $v){
                if ($k == $group) $selected = "selected";
                else $selected = "";
                echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
            }
            ?>
        </select>
    </div>
    <?php
    if (!empty($class) && !empty($group)) $dir = "../nop-bai-tap/".$class."/".$group;
    else {
        $class = "";
        $group = "";
    }
    // Open a directory, and read its contents
    if (!empty($class) && !empty($group) && is_dir($dir)) {
    ?>
    <div class="input-group mb-3">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Bài tập</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    if ($dh = opendir($dir)) {
                        while (($file = readdir($dh)) !== false) {
                            if ($file != '.' && $file != '..') {
                                echo '
                                        <tr>
                                            <th scope="row">' . $i . '</th>
                                            <td>' . $file . '</td>
                                        </tr>
                                    ';
                                $i++;
                            }
                        }
                        closedir($dh);
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
<?php
unset($_SESSION["fullName"]);
unset($_SESSION["className"]);
unset($_SESSION["fileUpload"]);
include "../template/footer.php";
?>