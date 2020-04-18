<?php
namespace App\Workflows\Company\Code;

use App\Company;
use App\Workflows\Company\Generated\WorkflowCompanyReadBase;
use Exception;

/**
 */
class WorkflowCompanyRead extends WorkflowCompanyReadBase
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
     * @return bool
     */
    protected function assertCompanyExists(int $id): bool
    {
        Company::whereId($id)->firstOrFail();

        return true;
    }

    /**
     * @param int $id
     *
     * @return Company
     */
    protected function getCompany(int $id): Company
    {
        return Company::whereId($id)->first();
    }
}
