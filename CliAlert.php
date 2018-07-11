<?php

namespace Grabower\CliTypo;

class CliAlert {

    /**
     * Show error message
     *
     * Font color: white
     * Background color: red
     *
     * @param string $text text to show
     */
    public function error($text) {
        CliTypo::text()->color($text, "white", "red");
    }

    /**
     * Show warning message
     *
     * Font color: white
     * Background color: orange
     *
     * @param string $text text to show
     */
    public function warning($text) {
        CliTypo::text()->color($text, "white", "yellow");
    }

    /**
     * Show success message
     *
     * Font color: white
     * Background color: green
     *
     * @param string $text text to show
     */
    public function success($text) {
        CliTypo::text()->color($text, "white", "green");
    }

    /**
     * Show info message
     *
     * Font color: white
     * Background color: blue
     *
     * @param string $text text to show
     */
    public function info($text) {
        CliTypo::text()->color($text, "white", "blue");
    }

}