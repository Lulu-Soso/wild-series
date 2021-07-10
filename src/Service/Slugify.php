<?php


namespace App\Service;


class Slugify
{
    public const CARAC_SPECIAUX = [
        'à' => 'a',
        'é' => 'e',
        'è' => 'e',
        'ê' => 'e',
        'â' => 'a',
        'ô' => 'o',
        'ù' => 'u',
        'ç' => 'c',
        "'" => '-',
    ];

    public const CARAC_FORBIDDEN = [
        '!',
        '?',
        '.',
        ';',
        ':',
        ',',
    ];

    public function generate(string $input): string
    {
        $input = strtolower($input);
        foreach (self::CARAC_SPECIAUX as $key => $char) {
            $input = str_replace($key, $char, $input);
        }
        $input = str_replace(self::CARAC_FORBIDDEN, '', $input);
        $input = trim($input);
        return str_replace(' ', '-', $input);
    }
}
