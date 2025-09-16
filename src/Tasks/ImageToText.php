<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\CaptchaTaskProtocol;

class ImageToText extends CaptchaSolver implements CaptchaTaskProtocol
{
    private $body;

    private $module;

    private $subType;

    private $phrase = false;

    private $case = false;

    private $score;

    private $numeric = false;

    private $math = 0;

    private $minLength = 0;

    private $maxLength = 0;

    private $capMonsterModule;

    private $recognizingThreshold;

    public function getPostData()
    {
        $postData = [
            'type' => 'ImageToTextTask',
            'body' => str_replace("\n", '', $this->body),
        ];

        if ($this->module) {
            $postData['module'] = $this->module;
        }

        if ($this->subType) {
            $postData['subType'] = $this->subType;
        }

        if ($this->case) {
            $postData['case'] = $this->case;
        }

        if ($this->score) {
            $postData['score'] = $this->score;
        }

        if ($this->phrase) {
            $postData['phrase'] = $this->phrase;
        }

        if ($this->numeric) {
            $postData['numeric'] = $this->numeric;
        }

        if ($this->math) {
            $postData['math'] = $this->math;
        }

        if ($this->minLength) {
            $postData['minLength'] = $this->minLength;
        }

        if ($this->maxLength) {
            $postData['maxLength'] = $this->maxLength;
        }

        if ($this->capMonsterModule) {
            $postData['CapMonsterModule'] = $this->capMonsterModule;
        }

        if ($this->recognizingThreshold) {
            $postData['recognizingThreshold'] = $this->recognizingThreshold;
        }

        return $postData;
    }

    public function getTaskSolution()
    {
        return $this->taskInfo->solution->text;
    }

    public function setFile($fileName)
    {
        if (file_exists($fileName)) {
            if (filesize($fileName) > 100) {
                $this->body = base64_encode(file_get_contents($fileName));

                return true;
            } else {
                $this->setErrorMessage("file $fileName too small or empty");
            }
        } else {
            $this->setErrorMessage("file $fileName not found");
        }

        return false;
    }

    public function setModule($value)
    {
        $this->module = $value;
    }

    public function setSubType($value)
    {
        $this->subType = $value;
    }

    public function setBody($value)
    {
        $this->body = $value;
    }

    public function setCase($value)
    {
        $this->case = $value;
    }

    public function setScore($value)
    {
        $this->score = $value;
    }

    public function setPhrase($value)
    {
        $this->phrase = $value;
    }

    public function setNumeric($value)
    {
        $this->numeric = $value;
    }

    public function setMath($value)
    {
        $this->math = $value;
    }

    public function setMinLength($value)
    {
        $this->minLength = $value;
    }

    public function setMaxLength($value)
    {
        $this->maxLength = $value;
    }

    public function setCapMonsterModule($value)
    {
        $this->capMonsterModule = $value;
    }

    public function setRecognizingThreshold($value)
    {
        $this->recognizingThreshold = $value;
    }
}
