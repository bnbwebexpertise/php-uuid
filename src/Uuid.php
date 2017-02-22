<?php
namespace Bnb\Uuid;

class Uuid
{

    protected $uuid;


    /*
     * Constructors
     */

    public static function v4()
    {
        return new self;
    }


    /*
     * Implementation
     */

    private function __construct($mode = 'v4')
    {
        switch ($mode) {
            case 'v4':
                $this->uuid = self::generateV4();
        }
    }


    public function full()
    {
        return $this->uuid;
    }


    public function short()
    {
        return preg_replace('/[^a-z0-9]/i', '', $this->full());
    }


    public function base36()
    {
        return self::str_base_convert($this->short(), 16, 36);
    }


    public function base64()
    {
        return base64_encode($this->short());
    }


    private static function str_base_convert($str, $fromBase = 10, $toBase = 36)
    {
        $str = trim($str);

        if (intval($fromBase) != 10) {
            $len = strlen($str);
            $q = 0;
            for ($i = 0; $i < $len; $i++) {
                $r = base_convert($str[$i], $fromBase, 10);
                $q = bcadd(bcmul($q, $fromBase), $r);
            }
        } else {
            $q = $str;
        }

        if (intval($toBase) != 10) {
            $s = '';
            while (bccomp($q, '0', 0) > 0) {
                $r = intval(bcmod($q, $toBase));
                $s = base_convert($r, 10, $toBase) . $s;
                $q = bcdiv($q, $toBase, 0);
            }
        } else {
            $s = $q;
        }

        return $s;
    }


    private static function generateV4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}