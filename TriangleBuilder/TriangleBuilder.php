<?php

namespace TriangleBuilder;

use Generator;

/** Построитель равнобедренного треугольника. */
class TriangleBuilder
{
    /** Количество уровней треугольника.
     * @var int
     */
    private int $levels = 0;
    /** Ширина ячейки.
     * @var int
     */
    private int $cellWidth = 0;

    /** Форматирование вывода для веб-страницы.
     * @var bool
     */
    private bool $isWeb = false;

    public function __construct(private int $n)
    {
    }

    /** Возвращает объект строителя.
     * @param int $n
     * @return self
     */
    public static function make(int $n): self
    {
        return new self($n);
    }

    /** Форматирование вывода для веб-страницы.
     * @return $this
     */
    public function forWeb(): self
    {
        $this->isWeb = true;

        return $this;
    }

    /** Проверяет, можно ли построить треугольник.
     * @return bool
     */
    private function isAvailable(): bool
    {
        if ($this->n < 1) {
            return false;
        }

        $sum = 0;
        $level = 1;

        while (true) {
            $sum += 2 * $level - 1;
            if ($sum == $this->n) {
                $this->levels = $level;
                $this->cellWidth = strlen((string)$this->n);

                return true;
            }
            if ($sum > $this->n) {
                return false;
            }
            $level++;
        }
    }

    /** Определяет максимальную длину строки для выравнивания.
     * @return int
     */
    private function getMaxLineLength(): int
    {
        $count = 2 * ($this->levels - 1) + 1;

        return ($this->cellWidth + 1) * $count - 1;
    }

    /** Генерирует уровни треугольника.
     * @return Generator
     */
    private function generateLevels(): Generator
    {
        $current = 1;
        $maxWidth = $this->getMaxLineLength();

        for ($i = 0; $i < $this->levels; $i++) {
            $count = 2 * $i + 1;
            $nums = [];

            for ($j = 0; $j < $count; $j++) {
                $nums[] = str_pad((string)$current++, $this->cellWidth, ' ', STR_PAD_LEFT);
            }

            $line = implode(' ', $nums);
            $padding = $this->isWeb ? 0 : max(0, floor(($maxWidth - strlen($line)) / 2));
            yield str_repeat(' ', $padding) . $line;
        }
    }

    /** Построение равнобедренного треугольника.
     * @return void
     */
    public function build(): void
    {
        if (!$this->isAvailable()) {
            echo 'Невозможно построить треугольник' . PHP_EOL;

            return;
        }

        foreach ($this->generateLevels() as $line) {
            echo $line . PHP_EOL;
        }
    }
}