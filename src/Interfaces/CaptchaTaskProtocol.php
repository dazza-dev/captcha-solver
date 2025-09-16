<?php

namespace DazzaDev\CaptchaSolver\Interfaces;

interface CaptchaTaskProtocol
{
    /**
     * Get post data for task
     */
    public function getPostData(): array;

    public function getTaskSolution();
}
