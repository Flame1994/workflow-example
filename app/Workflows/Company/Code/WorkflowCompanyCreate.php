<?php
namespace App\Workflows\Company\Code;

use App\Company;
use App\Workflows\Company\Generated\WorkflowCompanyCreateBase;
use Carbon\Carbon;
use Exception;

/**
 */
class WorkflowCompanyCreate extends WorkflowCompanyCreateBase
{
    /**
     * Error constants.
     */
    const ERROR_COMPANY_ALREADY_EXISTS = 'Company with email "%s" already exists.';
    const ERROR_INCORRECT_FOUNDED_DATE = 'Founded date "%s" can\'t be set after the current date';

    /**
     * Date constants.
     */
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param string $name
     * @param string $email
     * @param string $founded
     *
     * @return Company
     *
     * @throws Exception
     */
    public static function execute(
        string $name,
        string $email,
        string $founded
    ): Company {
        $workflow = new static(
            [
                self::FIELD_NAME => $name,
                self::FIELD_EMAIL => $email,
                self::FIELD_FOUNDED => $founded,
            ]
        );
        $workflow->run();

        return $workflow->getResult();
    }

    /**
     * @param string $email
     *
     * @return bool
     * @throws Exception
     */
    protected function assertCompanyUnique(string $email): bool
    {
        $company = Company::where(Company::COLUMN_EMAIL, $email)->first();

        if (is_null($company)) {
            return true;
        } else {
            throw new Exception(
                vsprintf(
                    self::ERROR_COMPANY_ALREADY_EXISTS,
                    [
                        $email,
                    ]
                )
            );
        }
    }

    /**
     * @param string $founded
     *
     * @return bool
     * @throws Exception
     */
    protected function assertFoundedBeforeCurrentDate(string $founded): bool
    {
        $dateFounded = Carbon::createFromFormat(self::DATE_FORMAT, $founded);

        if ($dateFounded->isBefore(Carbon::today())) {
            return true;
        } else {
            throw new Exception(
                vsprintf(
                    self::ERROR_INCORRECT_FOUNDED_DATE,
                    [
                        $dateFounded->toDateTimeString(),
                    ]
                )
            );
        }
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $founded
     *
     * @return Company
     */
    protected function createCompany(string $name, string $email, string $founded): Company
    {
        $company = Company::create(
            [
                Company::COLUMN_NAME => $name,
                Company::COLUMN_EMAIL => $email,
                Company::COLUMN_FOUNDED => $founded,
            ]
        );

        $company->save();

        return $company;
    }
}
