<?php

function datetimeforms($date)
{
    if ($date == "0000-00-00 00:00:00") {
        echo "No Date Set";
    } else {
        if (!empty($date)) {
            $dtime = new DateTime($date);
            print $dtime->format("d M Y H:ia");
        } else {
            echo "-";
        }
    }
}

function dateforms($date)
{
    if ($date == "0000-00-00 00:00:00") {
        echo "No Date Set";
    } else {

        if (!empty($date)) {
            $dtime = new DateTime($date);

            print $dtime->format("d M Y");
        } else {
            echo "[no date]";
        }
    }
}

function getAge($date)
{
    if (!empty($date)) {
        $dateOfBirth = $date;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $age = $diff->format('%y');
        if ($age == date("Y")) {
            echo "--";
        } else {
            echo $age;
        }
    } else {
        echo "-";
    }
}

function getDateAgo($date)
{
    if (!empty($date)) {
        $dateAgo = round((strtotime(date("Y-m-d H:i:s")) - strtotime($date)) / 86400);
        echo $dateAgo;
    } else {
        echo "-";
    }
}

function imgcheck($img)
{
    if (empty($img)) {
        echo base_url() . "/public/assets/system_img/no-img.jpg";
    } else {
        echo base_url() . $img;
    }
}

function filecheck($file)
{
    if (empty($file)) {
        echo "";
    } else {
        echo base_url() . $file;
    }
}

function imgfilecheck($img)
{
    if (empty($img) || isImageFile($img) == false) {
        echo base_url() . "/public/assets/system_img/no-file.png";
    } else {
        echo base_url() . $img;
    }
}

function isImageFile($filePath)
{
    $imageInfo = @getimagesize($filePath);
    return $imageInfo !== false;
}

function getfileExtension($filepath)
{

    if (!empty($filepath)) {
        echo $fileExt = pathinfo($filepath, PATHINFO_EXTENSION);
    } else {
        echo "No File";
    }
}


function get_status_icon($status)
{
    // Standardized status values: active, completed, hold, canceled
    // Color scheme: active=success(green), completed=primary(blue), hold=warning(yellow), canceled=secondary(gray)

    switch (strtolower($status)) {
        case "active":
            echo "<span class='badge badge-success'>$status</span>";
            break;
        case "completed":
            echo "<span class='badge badge-primary'>$status</span>";
            break;
        case "hold":
            echo "<span class='badge badge-warning'>$status</span>";
            break;
        case "canceled":
            echo "<span class='badge badge-secondary'>$status</span>";
            break;
        default:
            echo "<span class='badge badge-secondary'>$status</span>";
            break;
    }
}


function get_notice_flags($flags)
{

    if ($flags == "excellent") {
        echo "<i class='fa fa-tag text-success ' ></i>";
    }
    if ($flags == "good") {
        echo "<i class='fa fa-tag text-primary ' ></i>";
    }
    if ($flags == "warning") {
        echo "<i class='fa fa-tag text-warning ' ></i>";
    }
    if ($flags == "banned") {
        echo "<i class='fa fa-tag text-danger ' ></i>";
    }
    if ($flags == "blacklist") {
        echo "<i class='fa fa-tag text-dark ' ></i>";
    }
}

function formatNumberMK($number)
{
    if ($number >= 1000000) {
        return round(($number / 1000000), 1) . 'm';
    } else if ($number >= 1000) {
        return round(($number / 1000), 1) . 'k';
    } else {
        return number_format($number, 2);
    }
}

function checkZero($data)
{
    if ($data == 0 || $data == "" || $data == null || $data <= 0) {
        return "0";
    } else {
        return $data;
    }
}
