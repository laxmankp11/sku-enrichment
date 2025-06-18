    <?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'product_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $product = new Product();
        $product->setSku($data['sku'] ?? null);
        $product->setName($data['name'] ?? null);
        $product->setDescription($data['description'] ?? null);
        $product->setPrice($data['price'] ?? null);
        $product->setDimensions($data['dimensions'] ?? null);

        $em->persist($product);
        $em->flush();

        return $this->json(['message' => 'Product added', 'id' => $product->getId()]);
    }

    #[Route('/api/products/{id}', name: 'product_view', methods: ['GET'])]
    public function view(Product $product): JsonResponse
    {
        return $this->json([
            'id' => $product->getId(),
            'sku' => $product->getSku(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'dimensions' => $product->getDimensions()
        ]);
    }

    #[Route('/api/products/{id}/enrich', name: 'product_enrich', methods: ['PUT'])]
    public function enrich(Product $product, EntityManagerInterface $em): JsonResponse
    {
        // Mock enrichment logic
        if (!$product->getName()) {
            $product->setName('Auto Enriched Name');
        }

        if (!$product->getDescription()) {
            $product->setDescription('Auto Enriched Description');
        }

        if (!$product->getPrice()) {
            $product->setPrice(999.99);
        }

        if (!$product->getDimensions()) {
            $product->setDimensions('10x10x10');
        }

        $em->flush();

        return $this->json(['message' => 'Product enriched', 'product' => $product]);
    }
}
