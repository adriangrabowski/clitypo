<?php

namespace Grabower\CliTypo;

class CliText {

    public static $foreground_colors = array(
        'black'        => '0;30',
        'dark_gray'    => '1;30',
        'blue'         => '0;34',
        'light_blue'   => '1;34',
        'green'        => '0;32',
        'light_green'  => '1;32',
        'cyan'         => '0;36',
        'light_cyan'   => '1;36',
        'red'          => '0;31',
        'light_red'    => '1;31',
        'purple'       => '0;35',
        'light_purple' => '1;35',
        'brown'        => '0;33',
        'yellow'       => '1;33',
        'light_gray'   => '0;37',
        'white'        => '1;37',
    );
    public static $background_colors = array(
        'black'      => '40',
        'red'        => '41',
        'green'      => '42',
        'yellow'     => '43',
        'blue'       => '44',
        'magenta'    => '45',
        'cyan'       => '46',
        'light_gray' => '47',
    );


    /**
     * Show text
     * 
     * @param string $text text to show
     */
    public function write($text = "") {
        if (is_array($text))  {
            foreach ($text as $line) {
                $this->write($line);
            }
        } else {
            fwrite(STDOUT, $text.PHP_EOL);
        }
    }

    /**
     * Show empty line
     */
    public function empty_line() {
        $text = "\n";
        fwrite(STDOUT, $text.PHP_EOL);
    }

    /**
     * Show text end move caret to begin
     * 
     * @param string $text
     * @param bool $end_line
     */
    public function write_back_caret($text = '', $end_line = FALSE) {
        // Append a newline if $end_line is TRUE
        $text = $end_line ? $text.PHP_EOL : $text;
        fwrite(STDOUT, "\r\033[K".$text);
    }

    /**
     * Show colorized text
     *
     * @param string $text  text to colorize
     * @param string $foreground color of foreground
     * @param string|null $background color of background
     * @throws \Exception
     */
    public function color($text, $foreground, $background = null) {
        $this->write(CliTypo::format()->colorize($text, $foreground, $background));
    }
}