<?php
namespace App\Workflows\Client\Code;

use App\Client;
use App\Company;
use App\Workflows\Client\Generated\WorkflowClientDeleteBase;
use App\Workflows\Company\Code\WorkflowCompanyRead;
use Exception;

/**
 */
class WorkflowClientDelete extends WorkflowClientDeleteBase
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
     * @return Client
     * @throws Exception
     */
    protected function getClient(Company $company, int $id): Client
    {
        return WorkflowClientRead::execute($company->id, $id);
    }

    /**
     * @param Client $client
     *
     * @return Client
     * @throws Exception
     */
    protected function deleteClient(Client $client): Client
    {
        $client->delete();

        return $client;
    }
}
