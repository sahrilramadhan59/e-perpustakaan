<?php
function encrypt($s)
{
    $cryptKey    = 'AIUJHDSJNKNKA123909428904839202asdskjfjksdnjjfdsdbdjasvhdvasvhdvavdevgfewh1234567890AHVGSBAHSHJASAVVSHA123455353';
    $qEncoded    = base64_encode(base64_encode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $s, MCRYPT_MODE_CBC, md5(md5($cryptKey))))));
    return ($qEncoded);
}
function decrypt($s)
{
    $cryptKey    = 'AIUJHDSJNKNKA123909428904839202asdskjfjksdnjjfdsdbdjasvhdvasvhdvavdevgfewh1234567890AHVGSBAHSHJASAVVSHA123455353';
    $qDecoded    = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode(base64_decode(base64_decode($s))), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return ($qDecoded);
}
