<?php
namespace App\Workflows\Client\Code;

use App\Client;
use App\Company;
use App\Workflows\Client\Generated\WorkflowClientUpdateBase;
use App\Workflows\Company\Code\WorkflowCompanyRead;
use Exception;

/**
 */
class WorkflowClientUpdate extends WorkflowClientUpdateBase
{
    /**
     * @param int $companyId
     * @param int $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $joined
     *
     * @return Client
     *
     * @throws Exception
     */
    public static function execute(
        int $companyId,
        int $id,
        string $name = null,
        string $email = null,
        string $joined = null
    ): Client {
        $workflow = new static(
            [
                self::FIELD_COMPANY_ID => $companyId,
                self::FIELD_ID => $id,
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
     * @param string|null $name
     * @param string|null $email
     * @param string|null $joined
     *
     * @return bool
     */
    protected function shouldUpdateClient(string $name = null, string $email = null, string $joined = null): bool
    {
        if (!is_null($name)) {
            return true;
        } elseif(!is_null($email)) {
            return true;
        } elseif(!is_null($joined)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Client $client
     * @param string|null $name
     *
     * @return Client
     */
    protected function updateClientNameIfNeeded(Client $client, string $name = null): Client
    {
        if (is_null($name)) {
            // Do nothing
        } elseif ($name === $client->name) {
            // Do nothing
        } else {
            $client->name = $name;
            $client->save();
        }

        return $client;
    }

    /**
     * @param Client $client
     * @param string|null $email
     *
     * @return Client
     */
    protected function updateClientEmailIfNeeded(Client $client, string $email = null): Client
    {
        if (is_null($email)) {
            // Do nothing
        } elseif ($email === $client->email) {
            // Do nothing
        } else {
            $client->email = $email;
            $client->save();
        }

        return $client;
    }

    /**
     * @param Client $client
     * @param string|null $joined
     *
     * @return Client
     */
    protected function updateClientJoinedIfNeeded(Client $client, string $joined = null): Client
    {
        if (is_null($joined)) {
            // Do nothing
        } elseif ($joined === $client->joined) {
            // Do nothing
        } else {
            $client->joined = $joined;
            $client->save();
        }

        return $client;
    }
}
