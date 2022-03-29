<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('send_sms')) {

    function send_sms($mob, $text) {
//        $text = strtolower($text);
//        $template = array('OTP' => 'Dear Customer, One Time Password (OTP) to complete your order is ' . $text,
//            'Place Order' => $text,
//            'Confirm Order' => $text,
//            'Cancel Order' => 'Hi ' . $text,
//            'Dispatch Order' => 'Dear Customer your order no.  ' . $text . ' is dispatched from the restaurant. It will be delivered on your requested time.',
//            'Delivered' => $text
//        );


        
//Prepare you post parameters
        $postData = array(
            'authkey' => '91530AMv3Yit9q55e05196',
            'mobiles' => $mob,
            'message' => $text,
            'sender' => 'FFUNKY',
            'route' => '4'
        );

//API URL
        $url = "http://t.askspidy.com/api/sendhttp.php";

// init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
                //,CURLOPT_FOLLOWLOCATION => true
        ));


        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);

//        file_get_contents('http://t.askspidy.com/api/sendhttp.php?authkey=91530AMv3Yit9q55e05196&mobiles=' . $mob . '&message=' . $template[$temp] . '&sender=FFUNKY&route=4&country=91');
    }

    function send_sms_ff($mob, $text, $temp) {
        $text = strtolower($text);
        $template = array('Place Order' => $text,
            'Cancel Order' => $text);

        //Prepare you post parameters
        $postData = array(
            'authkey' => '91530AMv3Yit9q55e05196',
            'mobiles' => $mob,
            'message' => $template[$temp],
            'sender' => 'FFUNKY',
            'route' => '4'
        );

//API URL
        $url = "http://t.askspidy.com/api/sendhttp.php";

// init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
                //,CURLOPT_FOLLOWLOCATION => true
        ));


        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);


//        file_get_contents('http://t.askspidy.com/api/sendhttp.php?authkey=91530AMv3Yit9q55e05196&mobiles=' . $mob . '&message=' . $template[$temp] . '&sender=FFUNKY&route=4&country=91');
    }

    function send_smart_sms($regId, $message, $orderId) {
//        $sh = & get_instance();
//        $sh->load->library('curl');
//
//        $sh->curl->create('http://dev.foodfunky.com/secapi/send_message.php?regId=' . $regId . '&message=' . $message . '&orderId=' . $orderId);
//
//        $sh->curl->option('buffersize', 10);
//        $sh->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
//
//        $sh->curl->option('returntransfer', 1);
//        $sh->curl->option('followlocation', 1);
//        $sh->curl->option('HEADER', true);
//        $sh->curl->option('connecttimeout', 600);
//
//        $sh->curl->execute();

        $sm = file_get_contents('http://dev.foodfunky.com/secapi/send_message.php?regId=' . $regId . '&message=' . $message . '&orderId=' . $orderId);
        return true;
    }

}
?>
