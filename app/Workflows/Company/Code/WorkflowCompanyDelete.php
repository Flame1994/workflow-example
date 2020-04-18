<?php
namespace App\Workflows\Company\Code;

use App\Company;
use App\Workflows\Client\Code\WorkflowClientDelete;
use App\Workflows\Client\Code\WorkflowClientList;
use App\Workflows\Company\Generated\WorkflowCompanyDeleteBase;
use Exception;

/**
 */
class WorkflowCompanyDelete extends WorkflowCompanyDeleteBase
{
    /**
     * @param int $id
     *
     * @return Company
     *
     * @throws Exception
     */
    public static function execute(
        int $id
    ): Company {
        $workflow = new static(
            [
                self::FIELD_ID => $id,
            ]
        );
        $workflow->run();

        return $workflow->getResult();
    }

    /**
     * @param int $id
     *
     * @return Company
     * @throws Exception
     */
    protected function getCompany(int $id): Company
    {
        return WorkflowCompanyRead::execute($id);
    }

    /**
     * @param Company $company
     *
     * @return bool
     * @throws Exception
     */
    protected function deleteAllCompanyClient(Company $company)
    {
        $allClient = WorkflowClientList::execute($company->id);

        foreach ($allClient as $client) {
            WorkflowClientDelete::execute($company->id, $client['id']);
        }

        return true;
    }

    /**
     * @param Company $company
     *
     * @return Company
     * @throws Exception
     */
    protected function deleteCompany(Company $company): Company
    {
        $company->delete();

        return $company;
    }
}
