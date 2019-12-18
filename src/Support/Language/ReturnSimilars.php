<?php

declare(strict_types=1);

namespace Facilitador\Support\Language;

class ReturnSimilars
{
    protected $word;

    protected $similars = [
        'person' => [
            'user',
        ],
    ];

    public function __construct($word)
    {
        $this->word = strtolower($word);    
    }

    public function returnSimilars()
    {
        $word = $this->word;
        
        if (isset($this->similars[$word])) {
            return $this->similars[$word];
        }

        return $word;
    }


    public static function getSimilarsFor($word)
    {
        $classInstance = new self($word);

        return $classInstance->returnSimilars();
    }
}
