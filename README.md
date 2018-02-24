# Applicant Tests

## SDK-Test

For this test you need to write your own SDK which handles all endpoints described in `\MockAPI\API`.

The goal (= testcases) is be able to
  * fetch all items and echo it. (echo a json is enough)
  * add new items and echo the added item.
  
 The SDK should also fulfill following requirements.
 
 * OOP code style.
 * Usage of PHP7 features.
 * Caching of the Token (more information below)

Put your code into `\Client` namespace and the testcases into the `solution.php`.

To be able to call the `GET items` and `POST add_item` endpoint you need to ensure a valid access token.
You can get a valid access token with the `get_token` endpoint.
This token needs to be cached. For caching use the `\Cache\Adapter\PHPArray\ArrayCachePool` which implements the `Psr\Cache\CacheItemPoolInterface`.
The CacheItem should expire 60 seconds before the actual token expires.

The Mocked API has arrays as return values to keep it simple and returns all fields as strings.
Please cast the fields from the api responses into the correct types. (Definition is in `\MockAPI\API`)

* To get a Token use `\MockAPI\API::get_token()`
* To get an list of Items use `\MockAPI\API::get('items', <token>, <data>)`
* To add an Item use `\MockAPI\API::post('add_item', <token>, <data>)`
  
 For detailed information please look into `\MockAPI\API`.
 
 ## Products of All Integers Test
 
 Please follow the Instructions in `products_of_all_ints.php`.
 Commit your solution in that file.