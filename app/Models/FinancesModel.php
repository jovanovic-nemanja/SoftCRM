<?php

namespace App\Models;

use App\Services\FinancesService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class FinancesModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'finances';

    public function companies()
    {
        return $this->belongsTo(CompaniesModel::class);
    }

    public function storeFinance(array $requestedData, int $adminId) : int
    {
        $financesHelper = new FinancesService();
        $dataToInsert = $financesHelper->loadCalculateNetAndVatByGivenGross($requestedData['gross']);

        return $this->insertGetId(
            [
                'name' => $requestedData['name'],
                'description' => $requestedData['description'],
                'category' => $requestedData['category'],
                'type' => $requestedData['type'],
                'gross' => $requestedData['gross'],
                'net' => $dataToInsert['net'],
                'vat' => $dataToInsert['vat'],
                'date' => $requestedData['date'] ?? now(),
                'companies_id' => $requestedData['companies_id'],
                'created_at' => now(),
                'is_active' => 1,
                'admin_id' => $adminId
            ]
        );
    }

    public function updateFinance(int $financeId, array $requestedData) : int
    {
        $financesHelper = new FinancesService();
        $dataToInsert = $financesHelper->loadCalculateNetAndVatByGivenGross($requestedData['gross']);

        return $this->where('id', $financeId)->update(
            [
                'name' => $requestedData['name'],
                'description' => $requestedData['description'],
                'type' => $requestedData['type'] ?? null,
                'category' => $requestedData['category'],
                'gross' => $requestedData['gross'],
                'net' => $dataToInsert['net'],
                'vat' => $dataToInsert['vat'],
                'date' => $requestedData['date'],
                'companies_id' => $requestedData['companies_id'],
                'updated_at' => now(),
                'is_active' => 1
            ]
        );
    }

    public function setActive(int $financeId, int $activeType) : int
    {
        return $this->where('id', '=', $financeId)->update(
            [
                'is_active' => $activeType,
                'updated_at' => now()
            ]
        );
    }

    public function countFinances() : int
    {
        return $this->get()->count();
    }

    public function getPluckCompanies()
    {
        return CompaniesModel::pluck('name', 'id');
    }

    public function getFinancesSortedByCreatedAt()
    {
        return $this->all()->sortByDesc('created_at');
    }

    public function getPaginate()
    {
        return $this->paginate(Config::get('crm_settings.pagination_size'));
    }
}
