<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CreateCategory\{CreateCategoryOutputDto, CreateCategoryInputDto};

class CreateCategoryUseCase
{

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateCategoryInputDto $input):CreateCategoryOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );

        $categoryBd = $this->repository->insert($category);

        return new CreateCategoryOutputDto(
            id: $categoryBd->id(),
            name: $categoryBd->name,
            description: $categoryBd->description,
            isActive: $categoryBd->isActive,
            createdAt: $categoryBd->createdAt()
        );
    }
}