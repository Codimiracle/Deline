<?php
namespace Deline\Validator;

interface Validator
{

    const RESULT_OK = 0x00;

    const RESULT_EMPTY = 0x10;

    const RESULT_UNRECOGNIZED = 0x20;

    /**
     * 验证所有的字段
     */
    public function verifyAll();

    /**
     * 验证特定字段，成功返回真，否则返回假。
     *
     * @param string $field
     * @return bool
     */
    public function verify($field);

    /**
     * 判断该验证实例是否通过。
     *
     * @return bool
     */
    public function isValidity();

    /**
     * 验证并返回特定的字段验证代码
     *
     * @param string $field
     * @return string
     */
    public function getValidationCode($field);

    /**
     * 验证并返回特定的字段验证信息
     *
     * @param string $field
     * @return string
     */
    public function getValidationMessage($field);

    /**
     * 验证并返回该验证实例验证代码
     * 也即是第一个验证失败的字段的验证代码或者最后一个成功的验证代码
     *
     * @return string
     */
    public function getResultCode();

    /**
     * 验证并返回该验证实例验证代码
     * 也即是第一个验证失败的字段的验证信息或者最后一个成功的信息
     *
     * @return string
     */
    public function getResultMessage();
}