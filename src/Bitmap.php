<?php

class Bitmap
{
    const MAX_BITS = 64;

    /**
     * @var int
     */
    private int $bitmap;

    /**
     * @param int $bitmap
     */
    public function __construct(int $bitmap = 0)
    {
        $this->bitmap = $bitmap;
    }

    /**
     * 判断位为1
     * @param int $index
     * @return bool
     */
    public function isBitSet(int $index): bool
    {
        return (bool)($this->bitmap & (1 << $index));
    }

    /**
     * mask单个
     * @param int $mask
     * @return bool
     */
    public function isAnyMaskBitSet(int $mask): bool
    {
        return ($this->bitmap & $mask) > 0;
    }

    /**
     * 全mask
     * @param int $mask
     * @return bool
     */
    public function isAllMaskBitsSet(int $mask): bool
    {
        return $mask === ($this->bitmap & $mask);
    }

    /**
     * 设置位
     * @param int $index
     * @return Bitmap
     */
    public function setBit(int $index): Bitmap
    {
        $this->bitmap = $this->bitmap | (1 << $index);
        return $this;
    }

    /**
     * 批量设置
     * @param int[] $indexList
     * @return Bitmap
     */
    public function setBits(array $indexList): Bitmap
    {
        $mask = 0;
        foreach ($indexList as $index) {
            $mask = $mask | (1 << $index);
        }

        $this->setBitsByMask($mask);

        return $this;
    }

    /**
     *
     * @param int $mask
     * @return Bitmap
     */
    public function setBitsByMask(int $mask): Bitmap
    {
        $this->bitmap = $this->bitmap | $mask;
        return $this;
    }

    /**
     * 删除位
     * @param int $index
     * @return Bitmap
     */
    public function unsetBit(int $index): Bitmap
    {
        $this->bitmap = $this->bitmap & ~(1 << $index);
        return $this;
    }

    /**
     * 批量删除
     * @param int[] $indexList
     * @return Bitmap
     */
    public function unsetBits(array $indexList): Bitmap
    {
        $mask = 0;
        foreach ($indexList as $index) {
            $mask = $mask | (1 << $index);
        }

        $this->unsetBitsByMask($mask);

        return $this;
    }

    /**
     *
     * @param int $mask
     * @return Bitmap
     */
    public function unsetBitsByMask(int $mask): Bitmap
    {
        $this->bitmap = $this->bitmap & ~$mask;
        return $this;
    }

    /**
     * 位计数
     * @return int
     */
    public function countBit(): int
    {
        $mask = 1;
        $sum = 0;
        for ($i = 0; $i < static::MAX_BITS; $i++) {
            $tmp = $this->bitmap & $mask;
            if ($tmp > 0 || $tmp < 0) {
                $sum++;
            }
            $mask = $mask << 1;
        }
        return $sum;
    }


    /**
     * 返回数值
     * @return int
     */
    public function getInt(): int
    {
        return $this->bitmap;
    }


}