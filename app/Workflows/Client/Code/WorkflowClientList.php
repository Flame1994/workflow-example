<?php
namespace App\Workflows\Client\Code;

use App\Client;
use App\Company;
use App\Workflows\Client\Generated\WorkflowClientListBase;
use App\Workflows\Company\Code\WorkflowCompanyRead;
use Exception;

/**
 */
class WorkflowClientList extends WorkflowClientListBase
{
    /**
     * @param int $companyId
     *
     * @return Client[]
     *
     * @throws Exception
     */
    public static function execute(
        int $companyId
    ): array {
        $workflow = new static(
            [
                self::FIELD_COMPANY_ID => $companyId,
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
     *
     * @return Client[]
     */
    protected function getAllClient(Company $company): array
    {
        return Client::where('company_id', $company->id)->get()->toArray();
    }
}
