<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

/**
 * @todo
 * 관리자 페이지에서 설정한 값을 불러와야한다.
 */
$api_key = 'test_1849705C642C217E0B2D';
$base64_encode_api_key = base64_encode($api_key.":"); // api_key값 끝에는 콜론(:)를 붙여서 호출해야한다.

$url = 'https://api-test.eximbay.com/v1/payments/ready';
$data = '{
    "payment": {
        "transaction_type": "PAYMENT",
        "order_id": "20220819105102",
        "currency": "USD",
        "amount": "1",
        "lang": "EN"
    },
    "merchant": {
        "mid": "1849705C64"
    },
    "buyer": {
        "name": "eximbay",
        "email": "test@eximbay.com"
    },
    "url": {
        "return_url": "eximbay.com",
        "status_url": "eximbay.com"
    }
}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.$base64_encode_api_key));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response  = json_decode(curl_exec($ch), true);

curl_close($ch);

/**
 * @todo
 * rescode가 0000인 경우가 아닐 때 에러 처리가 필요할거 같다.
 */
$fgkey = '';
if ( $response["rescode"] == "0000" ) {
    $fgkey = $response["fgkey"];
}

?>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- SDK  -->
<script type="text/javascript" src="https://api-test.eximbay.com/v1/javascriptSDK.js"></script>

<script type="text/javascript">
    function payment() {
        EXIMBAY.request_pay({
            "fgkey" : "<?php echo $fgkey?>",
            "payment" : {
                "transaction_type" : "PAYMENT",
                "order_id" : "20220819105102",
                "currency" : "USD",
                "amount" : "1",
                "lang" : "EN"
            },
            "merchant" : {
                "mid" : "1849705C64"
            },
            "buyer" : {
                "name" : "eximbay",
                "email" : "test@eximbay.com"
            },
            "url" : {
                "return_url" : "eximbay.com",
                "status_url" : "eximbay.com"
            }
        });
    }
</script>
<?php
