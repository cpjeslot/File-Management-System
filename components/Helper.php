<?php 

namespace app\components;

/**
 * @author Chetan Patel <cpjeslot@gmail.com>>
*/
class Helper
{
    public static function inr_format($num) {
        if (is_null($num))
            return '';
        
        $pos = strpos((string)$num, ".");
        if ($pos === false) { 
            $decimalpart = "00";
        }
        else { 
            $decimalpart = substr($num, $pos+1, 2); 
            $num = substr($num, 0, $pos); 
        }
    
        if (strlen($num) > 3 & strlen($num) <= 12) {
            $last3digits = substr($num, -3);
            $numexceptlastdigits = substr($num, 0, -3);
            $formatted = self::insert_comma($numexceptlastdigits);
            $stringtoreturn = $formatted . "," . $last3digits . "." . str_pad($decimalpart, '2', '0', STR_PAD_RIGHT);
        }
        elseif (strlen($num) <= 3)
            $stringtoreturn = $num . "." . str_pad($decimalpart, '2', '0', STR_PAD_RIGHT);
        elseif (strlen($num) > 12)
            $stringtoreturn = number_format($num, 2);
    
        if (substr($stringtoreturn, 0, 2) == "-,")
            $stringtoreturn = "-" . substr($stringtoreturn, 2);
    
        return $stringtoreturn;
    }

    
    public static function insert_comma($input, $group_digits = 2) {
        if(strlen($input) <= $group_digits) { 
            return $input; 
        }
        $length = substr($input, 0, strlen($input) - $group_digits);
        $formatted_input = self::insert_comma($length) . "," . substr($input, - $group_digits);
        return $formatted_input;
    }

    /**
    * Function : NumberToWords
    *
    * @param $Num
    * @param $argOnly = true
    */
    public static function numberToWords ($Num, $argOnly = true) {
        $Words = "";

        if ($Num == 0) {
            $Words = "Zero";
        }

        if ($Num < 0) {
            $Words = "Negative ";
            $Num -= $Num;
        }

        $arrNum = explode (".", $Num);
        $Num = $arrNum[0];

        if ($Num >= 10000000) {
            $Words .= self::EnglishDigitGroup (($Num - ($Num % 10000000)) / 10000000) . " Crore";
        $Num %= 10000000;
            if ($Num) { $Words .= " "; }
        }

        if ($Num >= 100000) {
            $Words .= self::EnglishDigitGroup (($Num - ($Num % 100000)) / 100000) . " Lacs";
            $Num %= 100000;
            if ($Num) { $Words .= " "; }
        }

        if ($Num >= 1000) {
            $Words .= self::EnglishDigitGroup (($Num - ($Num % 1000)) / 1000) . " Thousand";
            $Num %= 1000;
            if ($Num) { $Words .= " "; }
        }

        if ($Num > 0) {
            $Words .= self::EnglishDigitGroup($Num);
        }

        if ($argOnly) {
            $Words .= " Only";
        }

        return $Words;
    }


    /**
    * Function : EnglishDigitGroup
    *
    * @param $Num
    */
    public static function englishDigitGroup ($Num) {
        $Words = "";
        $Flag = 0;

        switch (($Num - ($Num % 100)) / 100) {
            case 0: $Flag = 0; break;
            case 1: $Words = "One Hundred"; 	$Flag = 1; break;
            case 2: $Words = "Two Hundred"; 	$Flag = 1; break;
            case 3: $Words = "Three Hundred"; 	$Flag = 1; break;
            case 4: $Words = "Four Hundred"; 	$Flag = 1; break;
            case 5: $Words = "Five Hundred"; 	$Flag = 1; break;
            case 6: $Words = "Six Hundred"; 	$Flag = 1; break;
            case 7: $Words = "Seven Hundred";	$Flag = 1; break;
            case 8: $Words = "Eight Hundred";	$Flag = 1; break;
            case 9: $Words = "Nine Hundred"; 	$Flag = 1; break;
        }

        if ($Flag) { $Num %= 100; }
        if ($Num)  {	if ($Flag) { $Words .= " "; } }
        else { return $Words;	}

        switch (($Num - ($Num % 10)) / 10) {
            case 0:
            case 1: $Flag = 0; break;
            case 2: $Words .= "Twenty";  $Flag = 1; break;
            case 3: $Words .= "Thirty";  $Flag = 1; break;
            case 4: $Words .= "Forty";   $Flag = 1; break;
            case 5: $Words .= "Fifty";   $Flag = 1; break;
            case 6: $Words .= "Sixty";   $Flag = 1; break;
            case 7: $Words .= "Seventy"; $Flag = 1; break;
            case 8: $Words .= "Eighty";  $Flag = 1; break;
            case 9: $Words .= "Ninety";  $Flag = 1; break;
        }

        if ($Flag) { $Num %= 10; }
        if ($Num)  { if ($Flag) { $Words .= "-"; } }
        else { return $Words; }

        switch ($Num) {
            case 1:  $Words .= "One";   break;
            case 2:  $Words .= "Two";   break;
            case 3:  $Words .= "Three"; break;
            case 4:  $Words .= "Four";  break;
            case 5:  $Words .= "Five";  break;
            case 6:  $Words .= "Six";   break;
            case 7:  $Words .= "Seven"; break;
            case 8:  $Words .= "Eight"; break;
            case 9:  $Words .= "Nine";  break;
            case 10: $Words .= "Ten";   break;
            case 11: $Words .= "Eleven";    break;
            case 12: $Words .= "Twelve";    break;
            case 13: $Words .= "Thirteen";  break;
            case 14: $Words .= "Fourteen";  break;
            case 15: $Words .= "Fifteen";   break;
            case 16: $Words .= "Sixteen";   break;
            case 17: $Words .= "Seventeen"; break;
            case 18: $Words .= "Eighteen";  break;
            case 19: $Words .= "Nineteen";  break;
        }

        return $Words;
    }

    /**
     * @param int $number
     * @return string
     */
    public static function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function custom_filter($array) { 
        $temp = [];
          array_walk($array, function($item,$key) use (&$temp){
              foreach($item as $key => $value)
                 $temp[$key] = trim($value);
          });
          return $temp;
    }

    function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }
      
}


