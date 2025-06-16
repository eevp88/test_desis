<?php
class FormController
{
    private Store $storeRepo;
    private Branch $branchRepo;
    private Currency $currencyRepo;

    public function __construct(
        Store $storeRepo,
        Branch $branchRepo,
        Currency $currencyRepo
    ) {
        $this->storeRepo = $storeRepo;
        $this->branchRepo = $branchRepo;
        $this->currencyRepo = $currencyRepo;
    }
    public function getFormOptions(): string
    {
        $stores = $this->storeRepo->getAllStores();
        $branches = $this->branchRepo->getAllBranchs();
        $currencies = $this->currencyRepo->getAllCurrencies();
        return json_encode([
            "stores" => $stores,
            "branches" => $branches,
            "currencies" => $currencies,
        ]);
    }

    public function getBranchForIdStore(int $idStore): string
    {
        $branches = $this->branchRepo->getBranchByIdStore($idStore);
        return json_encode($branches);
    }
}
?>
