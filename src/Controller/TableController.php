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
    
        // Create new instance of DiningTable
        $table = new DiningTable();
        $table->setName($data['name']);
        $table->setTableNumber($data['tableNumber']); 
    
        // Use default value if not included in request
        $numberOfSeats = isset($data['number_of_seats']) ? $data['number_of_seats'] : 0;
        $type = isset($data['type']) ? $data['type'] : 'normal';
        $location = isset($data['location']) ? $data['location'] : 'interieur';
    
        $table->setNumberOfSeats($numberOfSeats);
        $table->setType($type);
        $table->setLocation($location);
    
        // Save table on database
        $this->entityManager->persist($table);
        $this->entityManager->flush();
    
        return new JsonResponse(['message' => 'Table created successfully', 'id' => $table->getId()], 201);
    }
 }  
