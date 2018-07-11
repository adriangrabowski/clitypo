<?php

namespace Grabower\CliTypo;

class CliTypo {

    /**
     * Get alert functions
     * @return CliAlert
     */
    public static function alert() {
        return new CliAlert();
    }

    /**
     * Get text functions
     * @return CliText
     */
    public static function text() {
        return new CliText();
    }

    /**
     * Get component functions
     * @return CliComponent
     */
    public static function component() {
        return new CliComponent();
    }

    /**
     * Get format functions
     * @return CliFormat
     */
    public static function format() {
        return new CliFormat();
    }

}