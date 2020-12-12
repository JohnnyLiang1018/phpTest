<?php
    header("Access-Control-Allow-Origin: https://sevensea.herokuapp.com");
    header("Access-Control-Allow-Headers:*");

    if($_GET){
        $url = sprintf("https://ancient-retreat-00756.herokuapp.com/php_files/Hw_files/getAllReviewsCloud.php?wantTop5=&companyAffiliation=&numReviews=");
    }

    if($_POST){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $review = urlencode($data->review);
        $url = sprintf("https://ancient-retreat-00756.herokuapp.com/php_files/Hw_files/addReviewCloud.php?product=Travel+to+Asia+Island&rating=5&overwrite=True&text_review=Nice+service&email=&company_affiliation=sevensea");
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        $fp = curl_exec($ch);
        curl_close($ch);
        echo json_encode(array('code'=>200, 'message'=>'Review Added'));
    }

?>