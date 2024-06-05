<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Kernel\Contracts;

use ArrayAccess;

/**
 * Interface Arrayable.
 *
 * @author overtrue <i@overtrue.me>
 */
interface Arrayable extends ArrayAccess
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
