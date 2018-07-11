<?php

namespace Grabower\CliTypo;

class CliTypo {

    /**
     * Get alert functions
     * @return CliAlert
     */
    public function alert() {
        return new CliAlert();
    }

    /**
     * Get text functions
     * @return CliText
     */
    public function text() {
        return new CliText();
    }

    /**
     * Get component functions
     * @return CliComponent
     */
    public function component() {
        return new CliComponent();
    }

    /**
     * Get format functions
     * @return CliFormat
     */
    public function format() {
        return new CliFormat();
    }

}