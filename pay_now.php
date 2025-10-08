<!-- Not Integrated so not working -->

<?php

    function encrypt_e($input/*, $ky*/){
        /*$key = html_entity_decode($ky);*/
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_encrypt($input, "AES-128-CBC"/*, $key*/, 0, $iv);
        return $data;
    }

    function generateSalt_e($length){
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data = "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data = "0FGH45OP89";

        for($i = 0 ; $i < $length ; $i++){
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }

    function checkString_e($value){
        if($value == 'null')
            $value = '';
        return $value;
    }

    function getArray2Str($arrayList){
        $findme = "REFUND";
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;
        foreach($arrayList as $key => $value){
            $pos = strpos($value, $findme);
            $pospipe = strpos($value, $findmepipe);
            if($pos !== false || $pospipe !== false){
                continue;
            }

            if($flag){
                $paramStr .= checkString_e($value);
                $flag = 0;
            }
            else{
                $paramStr .= "|" . checkString_e($value);
            }
        }
    }

    function getChecksumFromArray($arrayList,/* $key,*/ $sort=1){
        if($sort != 0){
            ksort($arrayList);
        }
        $str = getArray2Str($arrayList);
        $salt = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        //$checksum = encrypt_e($hashString, $key);
        $checksum = encrypt_e($hashString);
        return $checksum;
    }

?>

<?php 

    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');

    //payment gateway - not intergrated 
    /*
    require('inc/');
    require('inc/');
    */

    date_default_timezone_set("Europe/Athens");

    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        redirect('index.php');
    }

    if(isset($_POST['pay_now'])){
        //payments with a devoloper kit gateway
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");

        $checkSum = "";

        $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);
        $CUST_ID = $_SESSION['uId'];
        /*
        $INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
        $CHANNEL_ID = CHANNEL_ID;
        */
        $TXN_AMOUNT = $_SESSION['room']['payment'];

        //array for all required parameters for checksum
        $paramList = array();
        $paramList["ORDER_ID"] = $ORDER_ID;
        $paramList["CUST_ID"] = $CUST_ID;
        $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;

        //checksum string
        $checkSum = getChecksumFromArray($paramList);

        //insert payment data to db
        $frm_data = filteration($_POST);

        $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) 
            VALUES (?,?,?,?,?)";

        insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],
            $frm_data['checkout'],$ORDER_ID],'issss');

        $booking_id = mysqli_insert_id($con);
        
        $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, 
            `total_pay`, `user_name`, `phonenum`) 
            VALUES (?,?,?,?,?,?)";

        insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],
            $TXN_AMOUNT,$frm_data['name'],$frm_data['phonenum']],'isssss');
    }

?>

<html>
<head>
    <title>Processing</title>
</head>

<body>

    <h1>Do not refresh this page ...</h1>

    <form method="post" action="" name="f1">
        <?php 
        foreach($paramList as $name => $value){
            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
        }
        ?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
    </form>

    <script>
        document.f1.submit();
    </script>

</body>
</html>