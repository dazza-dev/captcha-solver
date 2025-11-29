<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class CustomCaptcha extends Task
{
    /**
     * Image URL
     */
    private ?string $imageUrl = null;

    /**
     * Assignment
     */
    private ?string $assignment = null;

    /**
     * Forms
     */
    private ?array $forms = null;

    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        return [
            'type' => 'CustomCaptchaTask',
            'imageUrl' => $this->imageUrl,
            'assignment' => $this->assignment,
            'forms' => $this->forms,
        ];
    }

    /**
     * Get task solution
     */
    public function getTaskSolution(): ?string
    {
        return $this->getTaskInfo()->solution->answers;
    }

    /**
     * Set image URL
     */
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * Set assignment
     */
    public function setAssignment(string $assignment): void
    {
        $this->assignment = $assignment;
    }

    /**
     * Set forms
     */
    public function setForms(array $forms): void
    {
        $this->forms = $forms;
    }
}
