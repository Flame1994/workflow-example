<?php
namespace App\Workflows\Client\Code;

use App\Client;
use App\Company;
use App\Workflows\Client\Generated\WorkflowClientCreateBase;
use App\Workflows\Company\Code\WorkflowCompanyRead;
use Exception;

/**
 */
class WorkflowClientCreate extends WorkflowClientCreateBase
{
    /**
     * Error constants.
     */
    const ERROR_CLIENT_ALREADY_EXISTS = 'Client with email "%s" already exists.';

    /**
     * @param int $companyId
     * @param string $name
     * @param string $email
     * @param string $joined
     *
     * @return Client
     *
     * @throws Exception
     */
    public static function execute(
        int $companyId,
        string $name,
        string $email,
        string $joined
    ): Client {
        $workflow = new static(
            [
                self::FIELD_COMPANY_ID => $companyId,
                self::FIELD_NAME => $name,
                self::FIELD_EMAIL => $email,
                self::FIELD_JOINED => $joined,
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
     * @param string $email
     *
     * @return bool
     * @throws Exception
     */
    protected function assertClientUniqueForCompany(Company $company, string $email): bool
    {
        $client = Client::where(Client::COLUMN_EMAIL, $email)->first();

        if (is_null($client)) {
            return true;
        } else {
            throw new Exception(
                vsprintf(
                    self::ERROR_CLIENT_ALREADY_EXISTS,
                    [
                        $email,
                    ]
                )
            );
        }
    }

    /**
     * @param Company $company
     * @param string $name
     * @param string $email
     * @param string $joined
     *
     * @return Client
     */
    protected function createClient(Company $company, string $name, string $email, string $joined): Client
    {
        $client = new Client();

        $client->name = $name;
        $client->email = $email;
        $client->joined = $joined;

        $client->company()->associate($company);

        $client->save();

        return $client;
    }
}
