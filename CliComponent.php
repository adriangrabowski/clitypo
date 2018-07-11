<?php

namespace Grabower\CliTypo;

class CliComponent {

    private $wait_msg = 'Press any key to continue...';

    /**
     * Waits a certain number of seconds, optionally showing a wait message and
     * waiting for a key press.
     *
     * @param int $seconds number of seconds
     * @param bool $countdown show a countdown or not
     */
    public function wait($seconds = 0, $countdown = false) {
        if ($countdown === true) {
            $time = $seconds;

            while ($time > 0) {
                fwrite(STDOUT, $time.'... ');
                sleep(1);
                $time--;
            }

            CliTypo::text()->write();
        } else {
            if ($seconds > 0) {
                sleep($seconds);
            } else {
                CliTypo::component()->read($this->wait_msg);
            }
        }
    }

    /**
     * Reads input from the user. This can have either 1 or 2 arguments.
     *
     * Usage:
     *
     * // Waits for any key press
     * CliTypo::component->read();
     *
     * // Takes any input
     * $color = CliTypo::component->read('What is your favorite color?');
     *
     * // Will only accept the options in the array
     * $ready = CliTypo::component->read('Are you ready?', array('y','n'));
     *
     * @param  string  $text    text to show user before waiting for input
     * @param  array   $options array of options the user is shown
     * @return string  the user input
     */
    public static function read($text = '', array $options = NULL) {
        // If a question has been asked with the read
        $options_output = '';
        if ( ! empty($options)) {
            $options_output = ' [ '.implode(', ', $options).' ]';
        }

        fwrite(STDOUT, $text.$options_output.': ');

        // Read the input from keyboard.
        $input = trim(fgets(STDIN));

        // If options are provided and the choice is not in the array, tell them to try again
        if ( ! empty($options) && ! in_array($input, $options)) {
            CliTypo::text()->write('This is not a valid option. Please try again.');

            $input = CliTypo::component()->read($text, $options);
        }

        // Read the input
        return $input;
    }

    /**
     * Reads input from the user. Text will be printed with options [Y, n]
     *
     * // Takes any input
     * $color = CliTypo::component->read('Are you sure?');
     *
     *
     * @param  string  $text text to show user before waiting for input
     * @return bool  the user decision
     */
    public static function decision($text) {
        return (strtolower(CliTypo::component()->read($text, array("Y","n"))) == "y" );
    }

    /**
     * Reads hidden input from the user
     *
     * Usage:
     *
     * $password = CliTypo::component->password('Enter your password');
     *
     *
     * @param string $text text to show user before waiting for input
     * @return string
     */
    public function password($text = '') {
        $text .= ': ';

        if (DIRECTORY_SEPARATOR === '\\') {
            $vbscript = sys_get_temp_dir().'Minion_CLI_Password.vbs';

            // Create temporary file
            file_put_contents($vbscript, 'wscript.echo(InputBox("'.addslashes($text).'"))');

            $password = shell_exec('cscript //nologo '.escapeshellarg($vbscript));

            // Remove temporary file.
            unlink($vbscript);
        } else {
            $password = shell_exec('/usr/bin/env bash -c \'read -s -p "'.escapeshellcmd($text).'" var && echo $var\'');
        }

        CliTypo::text()->write();

        return trim($password);
    }

    /**
     * Show progress bar 
     *
     * @param int $percentage percents of progress
     */
    public function progress($percentage) {
        $stringOfPercentage = CliTypo::format()->percentage($percentage);
        CliTypo::text()->write_back_caret($stringOfPercentage);
    }


    /**
     * Show list of elements
     *
     * @param array $elements list of element with name and value
     * @param int $padding count of padding before value
     * @param string $limiter character of padding
     */
    public function elements($elements, $padding = 20, $limiter = ".") {
        foreach ($elements as $key => $value) {
            CliTypo::text()->write(CliTypo::format()->list_item($key, $value, $padding, $limiter));
        }
    }

    /**
     * Show indicator in format (1 / 10)
     *
     * @param int $index   Current progress
     * @param int $count   Max of progress
     */
    public function indicator($index, $count) {
        $stringOfPercentage = CliTypo::format()->indicator($index, $count);
        CliTypo::text()->write_back_caret($stringOfPercentage);
    }


    /**
     * Show table
     *
     * @param array $data array of rows (row is array of elements)
     * @param array $headers array of headers
     */
    public function table($data, $headers = array()) {

        if(count($headers) != 0) {
            $data = array_merge(array($headers), $data);
        }

        $padding = 5;
        $output = "";

        foreach ($data as $numberOfRow => $row) {
            foreach ($row as $item) {
                $tmpPadding = strlen($item);
                if($tmpPadding > $padding) {
                    $padding = $tmpPadding;
                }
            }
        }

        foreach ($data as $numberOfRow => $row) {
            foreach ($row as $item) {
                $output .= "|";
                for ($i = 0; $i < $padding + 3; $i++) {
                    $output .= "-";
                }
            }
            $output .= "|\n| ";

            foreach ($row as $item) {
                $output .= CliTypo::format()->list_item($item,"", $padding," ");
                $output .= "| ";
            }

            $output .= "\n";

            if($numberOfRow == count($data) - 1) {
                foreach ($row as $item) {
                    $output .= "|";
                    for ($i = 0; $i < $padding + 3; $i++) {
                        $output .= "-";
                    }
                }
                $output .= "|";
            }
        }

        CliTypo::text()->write($output);
    }
}