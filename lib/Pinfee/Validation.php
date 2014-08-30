<?php
namespace Pinfee;


class Validation
{
    public static function validateUrl($string) {
        // FILTER_VALIDATE_URL は、国際化ドメイン未対応なので使えなかった
        return preg_match('/^https?:\\/\\//', $string) > 0;
    }

    public static function validateEmail($string) {
        // 検証ロジック参考) http://stackoverflow.com/questions/19220158/
        return !!filter_var($string, FILTER_VALIDATE_EMAIL);
    }
}
