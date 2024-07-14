<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- SDK  -->
<script type="text/javascript" src="https://api-test.eximbay.com/v1/javascriptSDK.js"></script>

<script type="text/javascript">
    function payment() {
        EXIMBAY.request_pay({
            "fgkey" : "0E9BE04BA239A519E68171F26B68604ADA0A85C8350DBF5C8C0FCCF98461DB09",
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
