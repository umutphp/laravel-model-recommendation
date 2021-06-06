<?php
namespace Umutphp\LaravelModelRecommendation;

/**
 * Helper class for calculating similarity
 */
class SimilarityHelper
{
    /**
     * Calculate Haming distance
     *
     * @link https://en.wikipedia.org/wiki/Hamming_distance
     *
     * @param string  $string1
     * @param string  $string2
     * @param boolean $returnDistance
     *
     * @return float
     */
    public static function hamming(string $string1, string $string2, bool $returnDistance = false): float
    {
        $a        = str_pad($string1, strlen($string2) - strlen($string1), ' ');
        $b        = str_pad($string2, strlen($string1) - strlen($string2), ' ');
        $distance = count(array_diff_assoc(str_split($a), str_split($b)));

        if ($returnDistance) {
            return $distance;
        }

        return (strlen($a) - $distance) / strlen($a);
    }

    /**
     * Calculate Euclidean distance
     *
     * @link https://en.wikipedia.org/wiki/Euclidean_distance
     *
     * @param array   $array1
     * @param array   $array2
     * @param boolean $returnDistance
     *
     * @return float
     */
    public static function euclidean(array $array1, array $array2, bool $returnDistance = false): float
    {
        $a   = $array1;
        $b   = $array2;
        $set = [];

        foreach ($a as $index => $value) {
            $set[] = $value - $b[$index] ?? 0;
        }

        $distance = sqrt(
            array_sum(
                array_map(
                    function ($x) {
                        return pow($x, 2);
                    },
                    $set
                )
            )
        );

        if ($returnDistance) {
            return $distance;
        }

        return 1 - $distance;
    }

    /**
     * Calculate Jaccard similarity coefficient
     *
     * @link https://en.wikipedia.org/wiki/Jaccard_index
     *
     * @param string $string1
     * @param string $string2
     * @param string $separator
     *
     * @return float
     */
    public static function jaccard(string $string1, string $string2, string $separator = ','): float
    {
        $a            = explode($separator, $string1);
        $b            = explode($separator, $string2);
        $intersection = array_unique(array_intersect($a, $b));
        $union        = array_unique(array_merge($a, $b));

        return count($intersection) / count($union);
    }

    /**
     * Calculate min max norm
     *
     * @param array $values
     * @param mixed $min
     * @param mixed $max
     *
     * @return array
     */
    public static function minMaxNorm(array $values, $min = null, $max = null): array
    {
        $norm = [];
        $min  = $min ?? min($values);
        $max  = $max ?? max($values);

        foreach ($values as $value) {
            $numerator   = $value - $min;
            $denominator = $max - $min;
            $minMaxNorm  = $numerator / $denominator;
            $norm[]      = $minMaxNorm;
        }

        return $norm;
    }
}
