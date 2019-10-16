<?php
#http://persiangd.berlios.de
#Copyright (C) 2007  Milad Rastian (miladmovie[_at_]gmail)
#thanks to Bagram Siadat (info[_at_]gnudownload[_dot_]org) (bug fix and new developer)
#tahanks to Ramin Farmani (bug fix)
#
#This program is free software; you can redistribute it and/or
#modify it under the terms of the GNU General Public License
#as published by the Free Software Foundation; either version 2
#of the License, or (at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

function utf8_strlen($str)
{
    return preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy);
}


function fagd($str, $z = "", $method = 'normal')
{
    global $p_chars, $mp_chars, $ignorelist, $nastaligh, $normal;
    $mp_chars = array('آ', 'ا', 'د', 'ذ', 'ر', 'ز', 'ژ', 'و', 'أ', 'إ', 'ؤ');
    $ignorelist = array('', 'ٌ', 'ٍ', 'ً', 'ُ', 'ِ', 'َ', 'ّ', 'ٓ', 'ٰ', 'ٔ', 'ﹶ', 'ﹺ', 'ﹸ', 'ﹼ', 'ﹾ', 'ﹴ', 'ﹰ', 'ﱞ', 'ﱟ', 'ﱠ', 'ﱡ', 'ﱢ', 'ﱣ',);
///
    $nastaligh = array(
        'ه' => array('ﮫ', 'ﮭ', 'ﮬ')
    );
    $normal = array(
        'ه' => array('ﻪ', 'ﻬ', 'ﻫ')
    );
    $arr=[];
    $output = "";
    $str_next = null;
    $str_back = null;
    $p_chars = array (
        'آ' => array ('ﺂ', 'ﺂ', 'آ'),
        'ا' => array ('ﺎ', 'ﺎ', 'ا'),
        'ب' => array ('ﺐ', 'ﺒ', 'ﺑ'),
        'پ' => array ('ﭗ', 'ﭙ', 'ﭘ'),
        'ت' => array ('ﺖ', 'ﺘ', 'ﺗ'),
        'ث' => array ('ﺚ', 'ﺜ', 'ﺛ'),
        'ج' => array ('ﺞ', 'ﺠ', 'ﺟ'),
        'چ' => array ('ﭻ', 'ﭽ', 'ﭼ'),
        'ح' => array ('ﺢ', 'ﺤ', 'ﺣ'),
        'خ' => array ('ﺦ', 'ﺨ', 'ﺧ'),
        'د' => array ('ﺪ', 'ﺪ', 'ﺩ'),
        'ذ' => array ('ﺬ', 'ﺬ', 'ﺫ'),
        'ر' => array ('ﺮ', 'ﺮ', 'ﺭ'),
        'ز' => array ('ﺰ', 'ﺰ', 'ﺯ'),
        'ژ' => array ('ﮋ', 'ﮋ', 'ﮊ'),
        'س' => array ('ﺲ', 'ﺴ', 'ﺳ'),
        'ش' => array ('ﺶ', 'ﺸ', 'ﺷ'),
        'ص' => array ('ﺺ', 'ﺼ', 'ﺻ'),
        'ض' => array ('ﺾ', 'ﻀ', 'ﺿ'),
        'ط' => array ('ﻂ', 'ﻄ', 'ﻃ'),
        'ظ' => array ('ﻆ', 'ﻈ', 'ﻇ'),
        'ع' => array ('ﻊ', 'ﻌ', 'ﻋ'),
        'غ' => array ('ﻎ', 'ﻐ', 'ﻏ'),
        'ف' => array ('ﻒ', 'ﻔ', 'ﻓ'),
        'ق' => array ('ﻖ', 'ﻘ', 'ﻗ'),
        'ک' => array ('ﻚ', 'ﻜ', 'ﻛ'),
        'گ' => array ('ﮓ', 'ﮕ', 'ﮔ'),
        'ل' => array ('ﻞ', 'ﻠ', 'ﻟ'),
        'م' => array ('ﻢ', 'ﻤ', 'ﻣ'),
        'ن' => array ('ﻦ', 'ﻨ', 'ﻧ'),
        'و' => array ('ﻮ', 'ﻮ', 'ﻭ'),
        'ی' => array ('ﯽ', 'ﻴ', 'ﯾ'),
        'ك' => array ('ﻚ', 'ﻜ', 'ﻛ'),
        'ي' => array ('ﻲ', 'ﻴ', 'ﻳ'),
        'أ' => array ('ﺄ', 'ﺄ', 'ﺃ'),
        'ؤ' => array ('ﺆ', 'ﺆ', 'ﺅ'),
        'إ' => array ('ﺈ', 'ﺈ', 'ﺇ'),
        'ئ' => array ('ﺊ', 'ﺌ', 'ﺋ'),
        'ة' => array ('ﺔ', 'ﺘ', 'ﺗ')
    );

    if ($method == 'nastaligh') {
        $p_chars = array_merge($p_chars, $nastaligh);
    } else {
        $p_chars = array_merge($p_chars, $normal);
    }

//     $explod = explode(' ', $str);

     $output = '';

//    for ($j = sizeof($explod) - 1; $j >= 0; $j--) {
//    for ($j = 0; $j <sizeof($explod); $j++) {
        if (!preg_match('/[^A-Za-z0-9]/', $str)) // '/[^a-z\d]/i' should also work.
        {

            $str=strrev($str);
            // string contains only english letters & digits
        }
        $str_len = utf8_strlen($str);
        preg_match_all("/./u", $str, $array_string);
        $test = '';
        $output .= " ";

        for ($i = $str_len - 1; $i >= 0; $i--) {

            $current_char = '';
            $next_char = '';
            $back_char = '';

            $current_char = $array_string[0][$i];

            if (isset($array_string[0][$i - 1])) {
                $back_char = $array_string[0][$i - 1];
            }

            if (isset($array_string[0][$i + 1])) {
                $next_char = $array_string[0][$i + 1];
            }
            if (array_key_exists($current_char, $p_chars)) {

                if ($i == $str_len - 1) {



                    if(in_array($back_char,$mp_chars)){

                        $output .= $current_char;


                    }
                    else{
                        $output .= $p_chars[$current_char][0];



                    }
                } elseif ($i == 0) {
                    $output .= $p_chars[$current_char][2];


                } else {
                    if(in_array($back_char,$mp_chars)){
                        $output .= $p_chars[$current_char][2];

                    }
                    else{
                        $output .= $p_chars[$current_char][1];

                    }

                }

            }  else {
                $output .= $current_char;

            }


        }
//    }

    return $output;
}

?>