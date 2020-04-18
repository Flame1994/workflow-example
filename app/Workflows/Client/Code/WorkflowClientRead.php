<?php
namespace App\Workflows\Client\Code;

use App\Client;
use App\Company;
use App\Workflows\Client\Generated\WorkflowClientReadBase;
use App\Workflows\Company\Code\WorkflowCompanyRead;
use Exception;

/**
 */
class WorkflowClientRead extends WorkflowClientReadBase
{
    /**
     * @param int $companyId
     * @param int $id
     *
     * @return Client
     *
     * @throws Exception
     */
    public static function execute(
        int $companyId,
        int $id
    ): Client {
        $workflow = new static(
            [
                self::FIELD_COMPANY_ID => $companyId,
                self::FIELD_ID => $id,
            ]
        );
        $workflow->run();

        return $workflow->getResult();
    }

    /**
     * @param int $companyId
     *
     * @return Company
     * @throws Exception
     */
    protected function getCompany(int $companyId): Company
    {
        return WorkflowCompanyRead::execute($companyId);
    }

    /**
     * @param Company $company
     * @param int $id
     *
     * @return bool
     */
    protected function assertClientExists(Company $company, int $id): bool
    {
        Client::whereId($id)
            ->where(Client::COLUMN_COMPANY_ID, $company->id)
            ->firstOrFail();

        return true;
    }

    /**
     * @param Company $company
     * @param int $id
     *
     * @return Client
     */
    protected function getClient(Company $company, int $id): Client
    {
        return Client::whereId($id)
            ->where(Client::COLUMN_COMPANY_ID, $company->id)
            ->firstOrFail();
    }
}
