<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\Exceptions\CaptchaSolverException;

class ImageToText extends Task
{
    /**
     * Image body
     */
    private ?string $body = null;

    /**
     * Module
     */
    private ?string $module = null;

    /**
     * Sub type
     */
    private ?string $subType = null;

    /**
     * Phrase
     */
    private bool $phrase = false;

    /**
     * Case
     */
    private bool $case = false;

    /**
     * Score
     */
    private ?float $score = null;

    /**
     * Numeric
     */
    private bool $numeric = false;

    /**
     * Math
     */
    private int $math = 0;

    /**
     * Min length
     */
    private int $minLength = 0;

    /**
     * Max length
     */
    private int $maxLength = 0;

    /**
     * CapMonster module
     */
    private ?string $capMonsterModule = null;

    /**
     * Recognizing threshold
     */
    private ?float $recognizingThreshold = null;

    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'type' => 'ImageToTextTask',
            'body' => str_replace("\n", '', $this->getBody()),
        ];

        if ($this->getModule()) {
            $postData['module'] = $this->getModule();
        }

        if ($this->getSubType()) {
            $postData['subType'] = $this->getSubType();
        }

        if ($this->getCase()) {
            $postData['case'] = $this->getCase();
        }

        if ($this->getScore()) {
            $postData['score'] = $this->getScore();
        }

        if ($this->getPhrase()) {
            $postData['phrase'] = $this->getPhrase();
        }

        if ($this->getNumeric()) {
            $postData['numeric'] = $this->getNumeric();
        }

        if ($this->getMath()) {
            $postData['math'] = $this->getMath();
        }

        if ($this->getMinLength()) {
            $postData['minLength'] = $this->getMinLength();
        }

        if ($this->getMaxLength()) {
            $postData['maxLength'] = $this->getMaxLength();
        }

        if ($this->getCapMonsterModule()) {
            $postData['CapMonsterModule'] = $this->getCapMonsterModule();
        }

        if ($this->getRecognizingThreshold()) {
            $postData['recognizingThreshold'] = $this->getRecognizingThreshold();
        }

        return $postData;
    }

    /**
     * Get task solution
     */
    public function getTaskSolution(): ?string
    {
        return $this->getTaskInfo()->solution->text;
    }

    /**
     * Set file
     */
    public function setFile($fileName): bool
    {
        if (file_exists($fileName)) {
            if (filesize($fileName) > 100) {
                $this->body = base64_encode(file_get_contents($fileName));

                return true;
            } else {
                throw new CaptchaSolverException("file $fileName too small or empty");
            }
        } else {
            throw new CaptchaSolverException("file $fileName not found");
        }

        return false;
    }

    /**
     * Get module
     */
    public function getModule(): ?string
    {
        return $this->module;
    }

    /**
     * Set module
     */
    public function setModule(string $module): void
    {
        $this->module = $module;
    }

    /**
     * Get sub type
     */
    public function getSubType(): ?string
    {
        return $this->subType;
    }

    /**
     * Set sub type
     */
    public function setSubType(string $subType): void
    {
        $this->subType = $subType;
    }

    /**
     * Get body
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * Set body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * Get case
     */
    public function getCase(): bool
    {
        return $this->case;
    }

    /**
     * Set case
     */
    public function setCase(bool $case): void
    {
        $this->case = $case;
    }

    /**
     * Get score
     */
    public function getScore(): ?float
    {
        return $this->score;
    }

    /**
     * Set score
     */
    public function setScore(float $score): void
    {
        $this->score = $score;
    }

    /**
     * Get phrase
     */
    public function getPhrase(): bool
    {
        return $this->phrase;
    }

    /**
     * Set phrase
     */
    public function setPhrase(bool $phrase): void
    {
        $this->phrase = $phrase;
    }

    /**
     * Get numeric
     */
    public function getNumeric(): bool
    {
        return $this->numeric;
    }

    /**
     * Set numeric
     */
    public function setNumeric(bool $numeric): void
    {
        $this->numeric = $numeric;
    }

    /**
     * Get math
     */
    public function getMath(): int
    {
        return $this->math;
    }

    /**
     * Set math
     */
    public function setMath(int $math): void
    {
        $this->math = $math;
    }

    /**
     * Get min length
     */
    public function getMinLength(): int
    {
        return $this->minLength;
    }

    /**
     * Set min length
     */
    public function setMinLength(int $minLength): void
    {
        $this->minLength = $minLength;
    }

    /**
     * Get max length
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * Set max length
     */
    public function setMaxLength(int $maxLength): void
    {
        $this->maxLength = $maxLength;
    }

    /**
     * Get capMonsterModule
     */
    public function getCapMonsterModule(): ?string
    {
        return $this->capMonsterModule;
    }

    /**
     * Set capMonsterModule
     */
    public function setCapMonsterModule(string $capMonsterModule): void
    {
        $this->capMonsterModule = $capMonsterModule;
    }

    /**
     * Get recognizingThreshold
     */
    public function getRecognizingThreshold(): ?float
    {
        return $this->recognizingThreshold;
    }

    /**
     * Set recognizingThreshold
     */
    public function setRecognizingThreshold(float $recognizingThreshold): void
    {
        $this->recognizingThreshold = $recognizingThreshold;
    }
}
