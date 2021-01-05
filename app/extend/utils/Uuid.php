<?php


namespace utils;


class Uuid
{
    /**
     * 字符
     * @var string
     */
    protected static $string = 'abcdefghijklmnopqrstuvwxyz1234567890';

    /**
     * 生成 18为用户id
     * 随机三位字符 + 函数生成 id + 随机两字符
     * @return string
     */
    public static function getUuid(): string
    {
        return (new Uuid)->random(3).uniqid(). (new Uuid)->random(2);
    }

    /**
     * 指定位数生成随机数
     * @param int $len
     * @return string
     */
    private function random(int $len = 2): string
    {
        $string = str_shuffle(self::$string);
        $result = '';
        for ($i = 0; $i < $len; $i++) {
            $result .= substr($string, (rand() % (strlen($string))), 1);
        }
        return $result;
    }

}