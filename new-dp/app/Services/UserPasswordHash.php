<?php

namespace App\Services;

class UserPasswordHash
{
    // 서비스 로직을 여기에 작성합니다.
    public function GB_decrypt_md5($enc_buf, $key = "DP2015")
    {
        $key1 = pack("H*", md5($key));
        $buf = base64_decode($enc_buf);
        $ret_buf = "";

        while ($buf) {
            $c = substr($buf, 0, 16);
            $buf = substr($buf, 16);

            $m = "";
            for ($i = 0; $i < 16; $i++) {
                $m .= $c[$i] ^ $key1[$i];
            }

            $ret_buf .= $m;
            $key1 = pack("H*", md5($key . $key1 . $m));
        }

        return $ret_buf;
    }
}
