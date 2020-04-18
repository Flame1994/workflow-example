<?php
namespace App\Workflows\Company\Code;

use App\Client;
use App\Company;
use App\Workflows\Company\Generated\WorkflowCompanyUpdateBase;
use Exception;

/**
 */
class WorkflowCompanyUpdate extends WorkflowCompanyUpdateBase
{
    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $founded
     * @param Client[]|null $allClient
     *
     * @return Company
     *
     * @throws Exception
     */
    public static function execute(
        int $id,
        string $name = null,
        string $email = null,
        string $founded = null,
        array $allClient = null
    ): Company {
        $workflow = new static(
            [
                self::FIELD_ID => $id,
                self::FIELD_NAME => $name,
                self::FIELD_EMAIL => $email,
                self::FIELD_FOUNDED => $founded,
                self::FIELD_ALL_CLIENT => $allClient,
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
     * @param string|null $name
     * @param string|null $email
     * @param string|null $founded
     * @param Client[]|null $allClient
     *
     * @return bool
     */
    protected function shouldUpdateCompany(
        string $name = null,
        string $email = null,
        string $founded = null,
        array $allClient = null
    ) {
        if (!is_null($name)) {
            return true;
        } elseif (!is_null($email)) {
            return true;
        } elseif (!is_null($founded)) {
            return true;
        } elseif (!is_null($allClient)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Company $company
     * @param string|null $name
     *
     * @return Company
     */
    protected function updateCompanyNameIfNeeded(Company $company, string $name = null)
    {
        if (is_null($name)) {
            // Do nothing
        } elseif ($name === $company->name) {
            // Do nothing
        } else {
            $company->name = $name;
            $company->save();
        }

        return $company;
    }

    /**
     * @param Company $company
     * @param string|null $email
     *
     * @return Company
     */
    protected function updateCompanyEmailIfNeeded(Company $company, string $email = null)
    {
        if (is_null($email)) {
            // Do nothing
        } elseif ($email === $company->email) {
            // Do nothing
        } else {
            $company->email = $email;
            $company->save();
        }

        return $company;
    }

    /**
     * @param Company $company
     * @param string|null $founded
     *
     * @return Company
     */
    protected function updateCompanyFoundedIfNeeded(Company $company, string $founded = null)
    {
        if (is_null($founded)) {
            // Do nothing
        } elseif ($founded === $company->founded) {
            // Do nothing
        } else {
            $company->founded = $founded;
            $company->save();
        }

        return $company;
    }
}
