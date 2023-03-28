<?php
    function debug($data, $title = null) {
        echo "<br><strong>$title</strong>";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    // bez parametrov, bez navratovej hodnoty
    function f1() {

    }
    // s parametrami, bez navratovej hodnoty
    function f2($par1, $par2) {

    }
    // bez parametrov, s navratovou hodnotou
    function f3() {
        return true; // cele cislo, premenna, pole, vetu, znak
    }
    // s parametrami, s navratovou hodnotou
    function f4($par1, $par2) {
        return $par1 + $par2;
    }
?>