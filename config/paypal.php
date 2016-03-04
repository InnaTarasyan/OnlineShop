
<?php
return array(

    'client_id' => 'AUiFsxCrGkrXUcnG76IVUwQdtLe-5osZaxiTpDWmkAXGXdaS6iWrXeEj51w1FEVm6CLfxe8vKazhGPuF',
    'secret' => 'EAEHUkzQbhXL0lFjeT55Qz5RUXHWjDBtZ_rL-bstVe3CJbMV_Tl5-9IUxgVUQG73u_XIH4v89FH5ndiV',

    'settings' => array(

        'mode' => 'sandbox',

        'http.ConnectionTimeOut' => 30,


        'log.LogEnabled' => true,



        'log.FileName' => storage_path() . '/logs/paypal.log',

        'log.LogLevel' => 'FINE'
    ),
);
?>