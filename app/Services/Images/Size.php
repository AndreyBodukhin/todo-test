<?php

namespace App\Services\Images;

final class Size
{
    public function __construct(
        public readonly int $width,
        public readonly int $height
    )
    {
    }

    /**
     * Парсит строку формата 100x150 и создает размер с шириной 100 и высотой 150
     *
     * @param string $size
     *
     * @return Size
     */
    public static function parseByString(string $size): Size
    {
        preg_match('/(?<width>\d+)x(?<heigth>\d+)/m', $size, $matches);
        if (empty($matches)) {
            throw new \InvalidArgumentException('Invalid size format. (Expected 100x150)');
        }
        return new self($matches['width'], $matches['heigth']);
    }
}
