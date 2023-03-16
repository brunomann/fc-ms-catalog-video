<?php

namespace Core\UseCase\DTO\Category\ListCategory;

class ListCategoryOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public bool $isActive = true,
        public string $createdAt = ''
    )
    {
        
    }
}