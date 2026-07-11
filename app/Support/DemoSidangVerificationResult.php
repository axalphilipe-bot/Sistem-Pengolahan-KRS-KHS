<?php

namespace App\Support;

class DemoSidangVerificationResult
{
    /**
     * @param  array<int, array{label: string, passed: bool, expected: string, actual: string}>  $checks
     * @param  array<int, array{nim: string, issues: string[]}>  $failedStudents
     */
    public function __construct(
        public bool $passed,
        public array $checks = [],
        public array $failedStudents = [],
    ) {}
}
