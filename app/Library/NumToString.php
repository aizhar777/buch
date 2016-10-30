<?php

namespace App\Library;


class NumToString
{
    /**
     * Возвращает сумму прописью
     *
     * @author runcore
     * @uses NumToString::morph(...)
     * @param $num
     * @return string
     */
    public static function getStr($num)
    {
        $nul = self::getZero();
        $ten = self::getTen();
        $a20 = self::getTwenty();
        $tens = self::getDozens();
        $hundred = self::getHundreds();
        $unit = self::getUnits();
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) {
                    continue;
                }
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) {
                    $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];
                } # 20-99
                else {
                    $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];
                } # 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1) {
                    $out[] = self::morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            } //foreach
        } else {
            $out[] = $nul;
        }
        $out[] = self::morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        $out[] = $kop . ' ' . self::morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }


    /**
     * Склоняем словоформу
     *
     * @author runcore
     */
    protected static function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) {
            return $f5;
        }
        $n = $n % 10;
        if ($n > 1 && $n < 5) {
            return $f2;
        }
        if ($n == 1) {
            return $f1;
        }
        return $f5;
    }

    /**
     * Units
     *
     * @return array
     */
    protected static function getUnits()
    {
        return [ // Units
            ['тиын', 'тиын', 'тиын', 1],
            ['тенге', 'тенге', 'тенге', 0],
            ['тысяча', 'тысячи', 'тысяч', 1],
            ['миллион', 'миллиона', 'миллионов', 0],
            ['миллиард', 'милиарда', 'миллиардов', 0],
        ];
    }

    /**
     * Сотни
     *
     * @return array
     */
    protected static function getHundreds()
    {
        return [
            '',
            'сто',
            'двести',
            'триста',
            'четыреста',
            'пятьсот',
            'шестьсот',
            'семьсот',
            'восемьсот',
            'девятьсот'
        ];
    }

    /**
     * Десятки
     *
     * @return array
     */
    protected static function getDozens()
    {
        return [
            2 => 'двадцать',
            'тридцать',
            'сорок',
            'пятьдесят',
            'шестьдесят',
            'семьдесят',
            'восемьдесят',
            'девяносто'
        ];
    }

    /**
     * Двадцатка
     *
     * @return array
     */
    protected static function getTwenty()
    {
        return [
            'десять',
            'одиннадцать',
            'двенадцать',
            'тринадцать',
            'четырнадцать',
            'пятнадцать',
            'шестнадцать',
            'семнадцать',
            'восемнадцать',
            'девятнадцать'
        ];
    }

    /**
     * Десятка
     *
     * @return array
     */
    protected static function getTen()
    {
        return [
            ['', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
            ['', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
        ];
    }

    /**
     * НОЛЬ
     *
     * @return string
     */
    protected static function getZero()
    {
        return 'ноль';
    }
}