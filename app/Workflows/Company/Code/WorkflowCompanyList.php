<?php
namespace App\Workflows\Company\Code;

use App\Company;
use App\Workflows\Company\Generated\WorkflowCompanyListBase;
use Exception;

/**
 */
class WorkflowCompanyList extends WorkflowCompanyListBase
{
    /**
     * @return Company[]|null
     *
     * @throws Exception
     */
    public static function execute() {
        $workflow = new static([]);
        $workflow->run();

        return $workflow->getResult();
    }

    /**
     * @return Company[]
     */
    protected function getAllCompany(): array
    {
        return Company::all()->toArray();
    }
}
