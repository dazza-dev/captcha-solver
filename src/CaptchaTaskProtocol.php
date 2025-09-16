<?php

namespace DazzaDev\CaptchaSolver;

interface CaptchaTaskProtocol
{
    public function getPostData();

    public function getTaskSolution();
}
