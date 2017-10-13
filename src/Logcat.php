<?php

namespace thesebas\logcat;

class Logcat {
    protected $tags = array(
        '<black>' => "\033[0;30m",
        '<red>' => "\033[1;31m",
        '<green>' => "\033[1;32m",
        '<yellow>' => "\033[1;33m",
        '<blue>' => "\033[1;34m",
        '<magenta>' => "\033[1;35m",
        '<cyan>' => "\033[1;36m",
        '<white>' => "\033[1;37m",
        '<gray>' => "\033[0;37m",
        '<darkRed>' => "\033[0;31m",
        '<darkGreen>' => "\033[0;32m",
        '<darkYellow>' => "\033[0;33m",
        '<darkBlue>' => "\033[0;34m",
        '<darkMagenta>' => "\033[0;35m",
        '<darkCyan>' => "\033[0;36m",
        '<darkWhite>' => "\033[0;37m",
        '<darkGray>' => "\033[1;30m",
        '<bgBlack>' => "\033[40m",
        '<bgRed>' => "\033[41m",
        '<bgGreen>' => "\033[42m",
        '<bgYellow>' => "\033[43m",
        '<bgBlue>' => "\033[44m",
        '<bgMagenta>' => "\033[45m",
        '<bgCyan>' => "\033[46m",
        '<bgWhite>' => "\033[47m",
        '<bold>' => "\033[1m",
        '<italics>' => "\033[3m",
        '<reset>' => "\033[0m",
    );
    protected $levels = array(
        100 => 'DEBUG',
        200 => '<green>INFO<reset>',
        250 => '<green>NOTICE<reset>',
        300 => '<red>WARNING<reset>',
        400 => '<red>ERROR<reset>',
        500 => '<red>CRITICAL<reset>',
        550 => '<white><bgRed>ALERT<reset>',
        600 => '<black><bgRed>EMERGENCY<reset>',
    );

    protected $useColors;

    public function __construct() {
        $this->useColors = true;
    }

    protected static function flattenFields($v) {
        return is_string($v) ? "\"{$v}\"" : json_encode($v);
    }

    protected static function printFields($fields) {
        foreach ($fields as $key => $val) {
            $val = self::flattenFields($val);
            yield "\"{$key}\" => {$val}";
        }
    }

    public function process($in = "php://stdin", $out = "php://stdout") {

        $fin = fopen($in, 'r');
        $fout = fopen($out, 'w+');

        while (!feof($fin)) {
            $rawLine = fgets($fin);
            $line = json_decode($rawLine);

            if (!$line || !$line instanceof \stdClass) {
                fputs($fout, $rawLine . PHP_EOL);
                continue;
            }

            $msg = [
                '<green>[', $line->{"@timestamp"}, ']<reset> ',
                ($this->levels[$line->{"@fields"}->level]), ' ',
                '<blue>', @$line->{"@type"}, '<reset> ',
                '<yellow>', join("/", $line->{"@tags"}), '@', $line->{"@source"}, '<reset> ',
                '<white>', $line->{"@message"}, '<reset> ',
                '<gray>[', join(", ", iterator_to_array(self::printFields((array)$line->{"@fields"}))), ']<reset>'
            ];

            $msg = join("", $msg);
            $msg = $this->replaceTags($msg);

            fputs($fout, $msg . PHP_EOL);
        }

        fclose($fin);
        fclose($fout);
    }

    protected function useColors() {
        return $this->useColors;
    }

    protected function replaceTags($msg) {
        return str_replace(array_keys($this->tags), $this->useColors() ? array_values($this->tags) : "", $msg);
    }
}




