<?php
// this page can be accessed by http://localhost/Mathematics.php
// https://dev.to/jackmarchant/exploring-async-php-5b68
class Mathematics
{
    /**
     * Add two numbers
     * @soap
     * @param float $a
     * @param float $b
     * @return float
     */
    public function sum(float $a, float $b): float
    {
        return $this->_sum($a, $b);
    }

    /**
     * Subtract two numbers
     * @soap
     * @param float $a
     * @param float $b
     * @return float
     */
    public function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    /**
     * Multiply two numbers
     * @soap
     * @param float $a
     * @param float $b
     * @return float
     */
    public function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    protected function _sum(float $a, float $b): float
    {
        return $a + $b;
    }
}
