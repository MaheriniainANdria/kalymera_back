<?php

namespace App\Controller;

use App\Entity\DiningTable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/tables', name: 'get_tables', methods: ['GET'])]
    public function getTables(): JsonResponse
    {
        $tables = $this->entityManager->getRepository(DiningTable::class)->findAll();
        return $this->json($tables);
    }

    #[Route('/api/tables', name: 'create_table', methods: ['POST'])]
    public function createTable(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (empty($data['name'])) {
            return new JsonResponse(['message' => 'Name is required'], 400);
        }

        $table = new DiningTable();
        $table->setName($data['name']);
        
        $this->entityManager->persist($table);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Table created successfully', 'id' => $table->getId()], 201);
    }
}
