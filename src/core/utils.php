<?php

$render = function ($name, $data = false) {
    if (file_exists(__DIR__ . "/../pages/" . $name . ".php")) {
        include(__DIR__ . "/../pages/" . $name . ".php");
    } else {
        echo "Page not found.";
    }
};

function uploadImages($fileInput, $uploadDir = "uploads/", $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'])
{
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $uploadedFiles = [];
    if (!empty($_FILES[$fileInput]['name'][0])) {
        foreach ($_FILES[$fileInput]['tmp_name'] as $key => $tmp_name) {
            $originalFileName = $_FILES[$fileInput]['name'][$key];
            $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
            if (in_array($fileType, $allowedTypes)) {
                $newFileName = generateUniqueFileName($originalFileName);
                $targetFile = $uploadDir . $newFileName;

                if (move_uploaded_file($tmp_name, $targetFile)) {
                    $uploadedFiles[] = $newFileName;
                }
            }
        }
    }
    return $uploadedFiles;
}

function generateUniqueFileName($fileName)
{
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    return uniqid("img_", true) . "." . $fileType;
}

function formatStringToURL($string)
{
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
    $string = strtolower($string);
    $string = str_replace(' ', '-', $string);
    return $string;
}

function verifyLogin()
{
    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }
}