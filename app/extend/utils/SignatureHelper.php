<?php


namespace utils;


class SignatureHelper
{
    protected static $character = 'abcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*';

    protected static $string = 'abcdefghijklmnopqrstuvwxyz1234567890';

    private static $mixinsMap = 'W3siayI6ImEiLCJ2IjoiYmQifSx7ImsiOiJiIiwidiI6InZoIn0seyJrIjoiYyIsInYiOiIwdSJ9LHsiayI6ImQiLCJ2IjoiazkifSx7ImsiOiJlIiwidiI6InJoIn0seyJrIjoiZiIsInYiOiI1dCJ9LHsiayI6ImciLCJ2IjoiNzYifSx7ImsiOiJoIiwidiI6ImRoIn0seyJrIjoiaSIsInYiOiJwNCJ9LHsiayI6ImoiLCJ2IjoiamQifSx7ImsiOiJrIiwidiI6Im1yIn0seyJrIjoibCIsInYiOiJycSJ9LHsiayI6Im0iLCJ2IjoibGQifSx7ImsiOiJuIiwidiI6Imp0In0seyJrIjoibyIsInYiOiIwaiJ9LHsiayI6InAiLCJ2IjoicXoifSx7ImsiOiJxIiwidiI6InA0In0seyJrIjoiciIsInYiOiJyZSJ9LHsiayI6InMiLCJ2IjoiZjUifSx7ImsiOiJ0IiwidiI6InN4In0seyJrIjoidSIsInYiOiJrayJ9LHsiayI6InYiLCJ2IjoicDAifSx7ImsiOiJ3IiwidiI6ImVmIn0seyJrIjoieCIsInYiOiJuNyJ9LHsiayI6InkiLCJ2IjoiNmYifSx7ImsiOiJ6IiwidiI6Ijg5In0seyJrIjoiMSIsInYiOiI2MiJ9LHsiayI6IjIiLCJ2IjoiMGMifSx7ImsiOiIzIiwidiI6InFoIn0seyJrIjoiNCIsInYiOiJ4byJ9LHsiayI6IjUiLCJ2IjoicmwifSx7ImsiOiI2IiwidiI6IjFyIn0seyJrIjoiNyIsInYiOiJlMCJ9LHsiayI6IjgiLCJ2Ijoib2QifSx7ImsiOiI5IiwidiI6ImRtIn0seyJrIjoiMCIsInYiOiJrZiJ9LHsiayI6IiEiLCJ2IjoibDgifSx7ImsiOiJAIiwidiI6InkzIn0seyJrIjoiIyIsInYiOiJzeCJ9LHsiayI6IiQiLCJ2IjoiZnEifSx7ImsiOiIlIiwidiI6ImM2In0seyJrIjoiXiIsInYiOiJqbCJ9LHsiayI6IiYiLCJ2IjoiZzMifSx7ImsiOiIqIiwidiI6IjRjIn1d';


    /**
     * 生成密文对照表
     * @return array|string
     */
    private static function createMixinsMap(): string
    {
        $mixins = [];
        for ($i = 0; $i < strlen(self::$character); $i++) {
            $mixins[$i]['k'] = self::$character[$i];
            $mixins[$i]['v'] = self::random();
        }
        return base64_encode(json_encode($mixins));
    }

    /**
     * 混淆后的密文对照表 解析
     * @return mixed
     */
    private static function decryptMixinsMap()
    {
        return json_decode(base64_decode(self::$mixinsMap), true);
    }


    /**
     * 随机密文
     * @param int $len
     * @return string
     */
    private static function random(int $len = 2): string
    {
        $string = str_shuffle(self::$string);
        $result = '';
        for ($i = 0; $i < $len; $i++) {
            $result .= substr($string, (rand() % (strlen($string))), 1);
        }
        return $result;
    }


    /**
     * 验证密文
     * @param string $string
     * @param string $token
     * @return bool
     */
    public static function verify(string $string, string $token): bool
    {
        $deToken = self::decode($token);
        if ($string === $deToken) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 加密
     * @param string $string
     * @return string
     */
    public static function encode(string $string): string
    {
        $dataSplit = [];
        for ($i = 0; $i < strlen($string); $i++) {
            $dataSplit[$i] = substr($string, $i, 1);
        }
        $result = '';
        $mixinsMap = self::decryptMixinsMap();
        foreach ($dataSplit as $item) {
            foreach ($mixinsMap as $key) {
                if ($item === $key['k']) {
                    $result .= $key['v'];
                }
            }
        }
        return $result;
    }

    /**
     * 解密
     * @param string $string
     * @return string
     */
    public static function decode(string $string): string
    {
        $strArr = [];
        for ($i = 0; $i < strlen($string); $i++) {
            $strArr[] = substr($string, $i * 2, 2);
        }
        $result = '';
        $mixinsMap = self::decryptMixinsMap();
        foreach ($strArr as $item) {
            foreach ($mixinsMap as $key) {
                if ($item === $key['v']) {
                    $result .= $key['k'];
                }
            }
        }

        return $result;
    }
}