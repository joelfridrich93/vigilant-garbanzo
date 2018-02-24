# Applicant Tests

## SDK-Test

For this test you need to write your own SDK which handles all endpoints descriped in `\MockAPI\API`.

The goal (= testcases) is be able to
  * fetch all items and echo it. (echo a json is enough)
  * add new items and echo the added item.
  
 The SDK should also fulfill following requirements.
 
 * OOP CodeStyle.
 * Usage of PHP7 features.
 * Caching of the Token (more information below)
 * Hints: 
    * you can call the get endpoints with `$this->api->{'get_' . <endpoint>}(<token>, <data>);`
    * and post endpoints with `$this->api->{'post_' . <endpoint>}(<token>, <data>);` in your `Client`

Put your code into `\Client` namespace and the testcases into the `solution.php`.

To be able to call the `get_items` and `post_add_item` endpoint you need to ensure a valid access token.
You can get a valid access token with the `get_token` endpoint.
This token needs to be cached. For caching use the `\Cache\Adapter\PHPArray\ArrayCachePool` which implements the `Psr\Cache\CacheItemPoolInterface`.
The CacheItem should expire 60 seconds before the actual token expires.

The API returns all fields as string.
Please cast them into the correct types which are also described in the API.

The API has arrays as return values to keep it simple.

GET:
  * token - returns an valid access_token
  * items - returns a list of items.
  
POST:
  * add_item - accepts as data an item, returns on success the added item.
 
 ## Products of All Integers Test
 
 Please follow the Instructions in `products_of_all_ints.php`.
 Commit your solution in this file.