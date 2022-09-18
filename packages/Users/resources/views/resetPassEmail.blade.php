<?php
$secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
$encryptedMessage = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($secretHash), $email, MCRYPT_MODE_CBC, md5(md5($secretHash))));
$encryptedMessage = str_replace("/","3sAdW3x32wa0O",$encryptedMessage);
?>
شكراً لك لإستخدام خدمة متجري
<br>
يرجى زيارة الرابط التالي لإعادة تعيين كلمة المرور الخاصة بك:
<br>
<a href="{{url("/")}}/newPassword/{{$encryptedMessage}}">{{url("/")}}/newPassword/{{$encryptedMessage}}</a>

<br>
<br>
مع تحيات إدارة الموقع