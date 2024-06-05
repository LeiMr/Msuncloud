<?php
declare(strict_types=1);

use StarLei\Msuncloud\Kernel\Exceptions\HttpException;

/**
 * 生成签名
 * @param string|int $preStr 待签名字符串
 * @param $key
 * @return string base64字符串
 * @throws HttpException
 */
function getSign($preStr, $key): string
{
    $signature = getPrivateKey($key);
    // 待签名字符串转 byte 数组使用 UTF-8
    $msgBuf = utf8_encode($preStr . "");
    if (!$msgBuf) {
        throw new HttpException("Failed to encode string to UTF-8");
    }
    // 使用 SHA256 算法进行签名
    if (!openssl_sign($msgBuf, $byteSign, $signature, OPENSSL_ALGO_SHA256)) {
        throw new HttpException("Failed to sign data");
    }
    // 签名值 byte 数组转字符串用 BASE64
    $strSign = base64_encode($byteSign);
    if (!$strSign) {
        throw new HttpException("Failed to encode signature to base64");
    }
    return $strSign;
}

/**
 * 获取加密私钥
 * @param $key
 * @return resource
 * @throws HttpException
 */
function getPrivateKey(string $key)
{
    // 直接定义私钥字符串
    $privateKeyPem = <<<EOD
-----BEGIN PRIVATE KEY-----
{$key}
-----END PRIVATE KEY-----
EOD;
    $signature = openssl_get_privatekey($privateKeyPem);
    if (!$signature) {
        throw new HttpException("Failed to get private key");
    }
    return $signature;
}

/**
 * 将数据md5加密成字符串
 * @param array $data
 * @param $default
 * @return string
 */
function arrayToMd5String(array $data = [], $default = ''): string
{
    // 按照键名排序数组
    $string = json_encode((empty($data) ? (object)array() : $data), JSON_UNESCAPED_UNICODE) . $default;
    // 使用 md5加密全小写
    return strtolower(md5($string));
}

/**
 * 获取精确到毫秒的时间戳
 * @return int
 */
function getTime(): int
{
    return (int)(microtime(true) * 1000);
}

/**
 * 将数据转成url字符串
 * @param array $array
 * @param bool $encode
 * @return string
 */
function arrayToQueryString(array $array = [], bool $encode = false): string
{
    // 按照键名排序数组
    ksort($array);
    // 初始化一个空数组，用于存储转换后的键值对字符串
    $query = [];
    // 循环遍历数组，将键值对拼接为字符串形式
    foreach ($array as $key => $value) {
        // 拼接键值对字符串，并添加到结果数组中
        $query[] = $encode ? $key . '=' . urlencode((string)$value) : "$key=$value";
    }
    // 使用 & 符号连接数组中的字符串，并返回结果
    return (empty($query) ? '' : implode('&', $query));
}

/**
 * 返回数组中给定键的所有项目。
 * @param array $array
 * @param mixed ...$keys
 * @return array
 */
function only(array $array, ...$keys): array
{
    return empty($array) ? [] : array_intersect_key($array, array_flip(is_array($keys[0]) ? $keys[0] : explode(',', $keys[0])));
}

/**
 * 字符串根据映射数据输出新字符串
 * @param string $originalString
 * @param array $replacements
 * @return string
 */
function customReplace(string $originalString, array $replacements): string
{
    // 遍历替换关联数组
    foreach ($replacements as $keyword => $replacement) {
        // 使用 preg_quote 函数对关键字进行转义
        $escapedKeyword = preg_quote($keyword, '/');
        // 将替换内容转换为字符串
        $replacement = (string)$replacement;
        // 使用正则表达式替换关键字
        $originalString = preg_replace("/{" . $escapedKeyword . "}/", $replacement, $originalString);
    }
    // 返回替换后的字符串
    return $originalString;
}