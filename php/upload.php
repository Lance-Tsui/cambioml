<?php
session_start();  // Start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $target_dir = "uploads/";
    $currentTime = gmdate("YmdHis"); // 获取 UTC 时间并格式化为年-月-日_时-分-秒
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // 创建新的文件名，附加时间戳
    $newFilename = pathinfo($filename, PATHINFO_FILENAME) . "_" . $currentTime . "." . $fileType;
    $target_file = $target_dir . $newFilename;

    // 检查文件类型是否为允许的类型
    if ($fileType != "pdf" && $fileType != "jpg" && $fileType != "png") {
        $_SESSION['message'] = "Sorry, only PDF, JPG, and PNG files are allowed.";
        header("Location: index.php");
        exit;
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // 文件上传成功
            $_SESSION['message'] = "The file " . htmlspecialchars($newFilename) . " has been uploaded.";

            // 构建 URL 并包含文件名作为查询参数
            $url = 'http://victsoi.pythonanywhere.com/ocr?filename=' . urlencode($newFilename);

            // 初始化 cURL 会话
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // 执行 cURL 请求
            $response = curl_exec($curl);
            if ($response === false) {
                $_SESSION['message'] .= " Error during cURL request: " . curl_error($curl);
            } else {
                // 存储从 Python 服务返回的结果
                $_SESSION['extraction'] = $response;
            }
            curl_close($curl);
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
        }
        header("Location: index.php");
        exit;
    }
}
?>
