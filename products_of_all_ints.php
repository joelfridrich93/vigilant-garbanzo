<?php

// Write a function that takes an array of integers and returns an array of the products except at the index.
// For example, given:
// [1, 7, 3, 4]
// your function would return:
// [84, 12, 28, 21]
// by calculating:
// [7 * 3 * 4,  1 * 3 * 4,  1 * 7 * 4,  1 * 7 * 3]
// Do not use division in your solution.

/**
 * Solution Joel
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


// Viktors 
function getProductsOfAllIntsExceptAtIndex(array $input): array
{
    return array_map(function ($elem) use ($input) {
        return array_product(array_diff($input, [$elem]));
    }, $input);
}
