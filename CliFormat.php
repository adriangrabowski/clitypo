<?php

namespace Grabower\CliTypo;

class CliFormat {

    /**
     * Get bordered text
     *
     * @param string $text text to show
     * @param string $border character used to border text
     * @return string bordered text
     */
    public function bordered($text, $border = "*") {
        $countOfChars = strlen($text);
        $emptyText = "";

        for ($i = 0; $i < (strlen($text) - 2) / 2; $i++) {
            $emptyText .= " ";
        }

        $string = "";

        for ($i = 0; $i < $countOfChars * 2; $i++) {
            $string .= $border;
        }

        if($countOfChars % 2 != 0) {
            $string .= $border;
        }

        $string .= "\n";
        $string .= $border. $emptyText. $text .$emptyText. $border. "\n";

        for ($i = 0; $i < $countOfChars * 2; $i++) {
            $string .= $border;
        }

        if($countOfChars % 2 != 0) {
            $string .= $border;
        }

        $string .= "\n";

        return $string;
    }

    /**
     * Get text with time
     *
     * @param string $text text to show
     * @param string $time_format format of time ex. H:i:s
     * @return string formatted text with time
     */
    public function with_time($text, $time_format = "H:i:s") {
        return "[".date($time_format, time()) . "] ". $text;
    }

    /**
     * Get text with date
     *
     * @param string $text text to show
     * @param string $date_format format of date ex. d.m.Y
     * @return string formatted text with date
     */
    public function with_date($text, $date_format = "d.m.Y") {
        return "[".date($date_format, time()) . "] ". $text;
    }

    /**
     * Get formatted progress bar
     *
     * @param int $percentage percents of progress
     * @return string formatted progress bar
     */
    public function percentage($percentage) {
        if($percentage > 100) {
            $percentage = 100;
        }
        if($percentage < 0) {
            $percentage = 0;
        }

        $empty = "░";
        $filled = "▓";

        $progressBar = "";

        for($i = 0; $i < $percentage; $i++) {
            $progressBar .= $filled;
        }

        for($i = 0; $i < 100 - $percentage; $i++) {
            $progressBar .= $empty;
        }

        return $progressBar . " " . $percentage ."%";
    }

    /**
     * Get indicator text (index / sum)
     *
     * @param int $index current index
     * @param int $sum max sum
     * @return string formatted indicator text
     */
    public function indicator($index, $sum) {
        return "(".$index . " / " . $sum.")";
    }


    /**
     * Show line with padding (name and value)
     *
     * @param string $name name of element in line
     * @param string $value value of element in line
     * @param int $padding count of padding before value, after name
     * @param string $limiter character of padding
     * @return string formatted line
     */
    public function list_item($name, $value, $padding = 10, $limiter = ".") {
        $countOfLetters = strlen($name);
        $output = $name. " ";

        for($i = 0; $i < ($padding - $countOfLetters); $i++) {
            $output .= $limiter;
        }

        $output .= " ".$value;

        return $output;
    }

    /**
     * Get color of text
     *
     * @param string $text  text to colorize
     * @param string $foreground color of foreground
     * @param string $background color of background
     * @return string colorized text
     * @throws \Exception
     */
    public function colorize($text, $foreground, $background = null) {
        if (DIRECTORY_SEPARATOR === '\\') {
            return $text;
        }

        if (!array_key_exists($foreground, CliText::$foreground_colors)) {
            throw new \Exception('Invalid CLI foreground color: '.$foreground);
        }

        if ($background !== null and !array_key_exists($background, CliText::$background_colors)) {
            throw new \Exception('Invalid CLI background color: '.$background);
        }

        $string = "\033[".CliText::$foreground_colors[$foreground]."m";

        if ($background !== null) {
            $string .= "\033[".CliText::$background_colors[$background]."m";
        }

        $string .= $text."\033[0m";

        return $string;
    }

    /**
     * Dumps information about a variable
     *
     * @param mixed $data variable to dump
     * @return mixed information about a variable
     */
    public function dump($data) {
        return var_dump($data);
    }

    /**
     * Get formatted json string
     *
     * @param string $json json string to print
     * @return mixed formated json
     */
    public function json($json) {
        $tabcount = 0;
        $result = '';
        $inquote = false;
        $ignorenext = false;

        $tab = "\t";
        $newline = "\n";

        for($i = 0; $i < strlen($json); $i++) {
            $char = $json[$i];
            if ($ignorenext) {
                $result .= $char;
                $ignorenext = false;
            } else {
                switch($char) {
                    case '{':
                        $tabcount++;
                        $result .= $char . $newline . str_repeat($tab, $tabcount);
                        break;
                    case '}':
                        $tabcount--;
                        $result = trim($result) . $newline . str_repeat($tab, $tabcount) . $char;
                        break;
                    case ',':
                        $result .= $char . $newline . str_repeat($tab, $tabcount);
                        break;
                    case '"':
                        $inquote = !$inquote;
                        $result .= $char;
                        break;
                    case '\\':
                        if ($inquote) $ignorenext = true;
                        $result .= $char;
                        break;
                    default:
                        $result .= $char;
                }
            }
        }
        return $result;
    }

    /**
     * Get text with attention
     *
     * @param string $text text to flank
     * @param string $limiter character of flank
     * @param int $count count of characters in flank
     * @return string
     */
    public function flank($text, $limiter = "!", $count = 1) {
        $output = "";

        for ($i = 0; $i < $count; $i++) {
            $output .= $limiter;
        }

        $output .= " " . $text . " ";

        for ($i = 0; $i < $count; $i++) {
            $output .= $limiter;
        }

        return $output;
    }
}