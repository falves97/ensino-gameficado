<?php

namespace App\DTO;

readonly class TestModuleListDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public int $grade,
        public bool $isRealizedByStudent,
    ) {
    }
}
