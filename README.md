# myLibrary
some useful php library

1. php encrypt / decrypt 加密/解密类
```php
<?php
include '_baseEncode.php';
$handle = _baseEncode::getInstance('this is a key!');
//$handle = _baseEncode::getInstance(); //key为空时，使用默认值;
echo $encodedStr = $handle->encrypt('Hello,world! - 你好，世界！');
echo $handle->decrypt($encodedStr);

//error
$c = clone $handle;
```
