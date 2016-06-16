Returns a pretty string representation of a variable.

返回数组或对象的源码字符串

Install
=======

`composer install cszchen\export`;  

Useage
======


use cszchen\export\Export;

`echo Export::toArrayCode($arr);`  

output:  
```php
array (
    "testString" => "cszchen/export",
    "testList" => array (
        1,
        3,
        "a"
    ),
    "testListAdv" => array (
        array (
            "name" => "cartmanchen",
            "email" => "csz@soyhw.com"
        ),
        array (
            "name" => "cszchen",
            "email" => "me@csz.link"
        )
    ),
    "testBool" => true,
    "testNumber" => 354.6,
    "testObj" => array (
        "level1" => array (
            "level2" => "test"
        )
    )
);
```

`echo Export::toJsonCode($arr);`  

output:  

```json
{
    "testString": "cszchen/export",
    "testList": [
        1,
        3,
        "a"
    ],
    "testListAdv": [
        {
            "name": "cartmanchen",
            "email": "csz@soyhw.com"
        },
        {
            "name": "cszchen",
            "email": "me@csz.link"
        }
    ],
    "testBool": true,
    "testNumber": 354.6,
    "testObj": {
        "level1": {
            "level2": "test"
        }
    }
}
```
