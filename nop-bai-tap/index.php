<?php
session_start();
$class = ["THT7CN01", "THT7CN02", "THT7CN03", "THT7CN04", "THT7CN05", "THT7CN06", "THT7CN07", "THT7CN08", "THT7CN09"];
$group = ["windows"=>"Windows","word"=>"Word","excel"=>"Excel","powerpoint"=>"Power Point","luyenthi"=>"Luyện Thi"];
include "../template/header.php";
?>
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Nộp bài</h2>
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
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Họ tên</span>
                <input type="text" name="fullName" id="fullName" value="<?php echo (isset($_SESSION["fullName"]) ? $_SESSION["fullName"] : ""); ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="className">Lớp học</label>
                <select name="className" id="className" class="form-select">
                    <option value="">Chọn lớp</option>
                    <?php
                    for ($i = 0; $i < count($class); $i++) {
                        if ($class[$i] == $_SESSION["className"]) $selected = "selected";
                        else $selected = "";
                        echo '<option value="' . $class[$i] . '"' . $selected . '>' . $class[$i] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="group">Nhóm bài tập</label>
                <select name="group" id="group" class="form-select">
                    <option value="">Chọn nhóm bài tập</option>
                    <?php
                    foreach ($group AS $k => $v){
                        if ($k == $_SESSION["group"]) $selected = "selected";
                        else $selected = "";
                        echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" id="fileUpload" name="fileUpload">
            </div>
            <div class="mb-3 text-danger text-center">
                <span class="">(Tập tin có dung lượng tối đa là 5MB)</span>
            </div>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
            <input type="hidden" name="act" value="upload">
        </form>
    </div>
    <?php
    unset($_SESSION["fullName"]);
    unset($_SESSION["className"]);
    unset($_SESSION["group"]);
    unset($_SESSION["fileUpload"]);
    include "../template/footer.php";
    ?>