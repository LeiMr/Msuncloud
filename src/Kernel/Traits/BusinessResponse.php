<?php
declare(strict_types=1);
namespace StarLei\Msuncloud\Kernel\Traits;

use StarLei\Msuncloud\Kernel\Exceptions\Exception;

/**
 * Trait BusinessResponse
 * @package StarLei\Msuncloud\Kernel\Traits
 */
trait BusinessResponse
{
    /**
     * 数组格式业务输出
     * @param array $params
     * @return array
     * @throws Exception
     */
    protected function toArray(array $params): array
    {
        if (isset($params['success']) && $params['success'] === true && $params['code'] === '0000') {
            return $params['data'] ?? [];
        } else {
            throw new Exception($params['message'] ?? '', (int)$params['code'] ?? 500);
        }
    }
}
