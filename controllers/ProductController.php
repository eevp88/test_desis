<?php
class ProductController
{
    private Product $productRepo;
    public function __construct(Product $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function productSave(array $input): void
    {
        $resultado = $this->productRepo->saveProduct($input);
        header("Content-Type: application/json");
        echo json_encode($resultado);
    }
}
