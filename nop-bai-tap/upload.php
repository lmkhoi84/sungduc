<?php
session_start();
include "function.php";
foreach ($_POST as $k => $v)
{
	$_SESSION[$k] = $v;
}
//$backSite = "http://localhost:81/sungduc.com/nop-bai-tap";
//$fwSite = "http://localhost:81/sungduc.com/bai-nop/?class=".$_POST["className"];
$backSite = "http://sungduc.com/nop-bai-tap";
$fwSite = "http://sungduc.com/bai-nop/?class=".$_POST["className"];

if (!isset($_POST["act"]) || $_POST["act"] != "upload") {
    $_SESSION["msg"] = "Lỗi ! Truy cập không hợp lệ !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}

if (empty($_POST["fullName"])) {
    $_SESSION["msg"] = "Lỗi ! Kiểm tra họ tên !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}

if (empty($_POST["className"])) {
    $_SESSION["msg"] = "Lỗi ! Kiểm tra lớp học !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}

if (empty($_POST["group"])) {
    $_SESSION["msg"] = "Lỗi ! Kiểm tra nhóm bài tập !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}

if (empty($_FILES['fileUpload']["name"])){
    $_SESSION["msg"] = "Lỗi ! Chưa chọn tập tin !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}

if ($_FILES["fileUpload"]["size"] > 5120000) {
    $_SESSION["msg"] = "Lỗi ! Tập tin upload quá lớn !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}

$uploadDir = $_POST["className"].'/'.$_POST["group"]."/";
$fileName = strtolower(ConvertStrVn($_POST["fullName"])."_".basename($_FILES["fileUpload"]["name"]));
$target_file = $uploadDir . $fileName;

if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
    $_SESSION["msg"] = "Thành công ! Nộp bài hoàn tất !";
    $_SESSION["typeMsg"] = "success";
    header("Location: " . $fwSite);
    unset($_SESSION["fullName"]);
    unset($_SESSION["className"]);
    unset($_SESSION["group"]);
    unset($_SESSION["fileUpload"]);
    exit;
} else {
    $_SESSION["msg"] = "Lỗi ! Nộp bài không thành công !";
    $_SESSION["typeMsg"] = "danger";
    header("Location: " . $backSite);
    exit;
}
?>