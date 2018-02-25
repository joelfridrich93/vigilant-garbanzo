<?php

// Write a function getProductsOfAllIntsExceptAtIndex() that takes an array of integers and returns an array of the products.
// For example, given:
// [1, 7, 3, 4]
// your function would return:
// [84, 12, 28, 21]
// by calculating:
// [7 * 3 * 4,  1 * 3 * 4,  1 * 7 * 4,  1 * 7 * 3]
//Do not use division in your solution.

/**
 * @param array $numbers
 * @return array
 */
function getProductsOfAllIntsExceptAtIndex(array $numbers): array
{
    $products = [];
    foreach ($numbers as $index => $number) {
        $numbers[$index] = 1;
        $products[$index] = array_product($numbers);
        $numbers[$index] = $number;
    }

    return $products;
}

print_r(getProductsOfAllIntsExceptAtIndex([1, 7, 3, 4]));
