<?php

namespace cszchen\export;

class Export
{
    protected static $marks = [
        'json' => [
            'objectBegin' => '{',
            'objectEnd' => '}',
            'listBegin' => '[',
            'listEnd' => ']',
            'kvSplit' => ': '
        ],
        'array' => [
            'objectBegin' => 'array (',
            'objectEnd' => ')',
            'listBegin' => 'array (',
            'listEnd' => ')',
            'kvSplit' => ' => '
        ]
    ];

    /**
     * Export an array to json code like hand write.
     * @param $data
     * @param string $lf LF char
     * @return mixed|string
     */
    public static function toJsonCode($data, $lf = "\n")
    {
        return static::parser($data, 'json', $lf);
    }

    /**
     * Export an array to parsable php code like hand write.
     * @param $data
     * @param string $lf LF char
     * @return mixed|string
     */
    public static function toArrayCode($data, $lf = "\n")
    {
        return static::parser($data, 'array', $lf);
    }

    protected static function parser($data, $type, $lf, $indent = '    ', $level = 0)
    {
        $arrayIdent = str_repeat($indent, $level);
        if (is_array($data) || is_object($data)) {
            $isList = static::isList($data);
            $items = [];
            foreach ($data as $key => $val) {
                if ($isList) {
                    $items[] = $arrayIdent . $indent . static::parser($val, $type, $lf, $indent, $level + 1);
                } else {
                    $items[] = $arrayIdent . $indent . '"' . addslashes($key) . '"' . static::$marks[$type]['kvSplit'] . static::parser($val, $type, $lf, $indent, $level + 1);
                }
            }
            $begin = $isList ? static::$marks[$type]['listBegin'] : static::$marks[$type]['objectBegin'];
            $end = $isList ? static::$marks[$type]['listEnd'] : static::$marks[$type]['objectEnd'];
            return $begin . ($items ? $lf . join(',' . $lf, $items) . $lf . $arrayIdent : '') . $end;
        } elseif (is_string($data)) {
            //return '"' . addcslashes($data, '\\' . chr(8) . chr(12)) . '"';
            return '"' . addslashes($data) . '"';
        } elseif (is_numeric($data)) {
            return $data;
        } else {
            return var_export($data, true);
        }
    }

    /**
     * Return an array wheather is a list.
     * @param $data
     * @return bool
     */
    public static function isList($data)
    {
        return is_array($data) && ( empty($data) || array_keys($data) === range(0,count($data)-1));
    }
}
