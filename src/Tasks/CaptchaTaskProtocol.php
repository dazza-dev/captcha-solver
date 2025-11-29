<?php

namespace DazzaDev\CaptchaSolver\Tasks;

interface CaptchaTaskProtocol
{
    /**
     * Get the post data for the captcha task
     *
     * @return array The post data array
     */
    public function getPostData(): array;

    /**
     * Get the task solution
     *
     * @return string|null The task solution or null if not found
     */
    public function getTaskSolution(): ?string;
}
