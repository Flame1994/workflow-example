<?php
namespace App\Workflows\Client\Generated;

use App\Client;
use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowClientUpdateBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_COMPANY_ID = 'companyId';
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_EMAIL = 'email';
    const FIELD_JOINED = 'joined';
    const FIELD_COMPANY = 'company';
    const FIELD_CLIENT = 'client';
    const FIELD_SHOULD_UPDATE_CLIENT = 'shouldUpdateClient';

    /**
    * @var int
    */
    private $companyId;

    /**
    * @var int
    */
    private $id;

    /**
    * @var string|null
    */
    private $name;

    /**
    * @var string|null
    */
    private $email;

    /**
    * @var string|null
    */
    private $joined;

    /**
    * @var Company
    */
    private $company;

    /**
    * @var Client
    */
    private $client;

    /**
    * @var bool
    */
    private $shouldUpdateClient;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->setAllProperty($data);

        parent::__construct($data);
    }

    /**
     * @param array $data
     *
     * @throws Exception
     */
    private function setAllProperty(array $data)
    {
        $this->assertDataHasAllKey(
            $data,
            [
                'companyId',
                'id',
                'name',
                'email',
                'joined',
            ]
        );
        
        if (array_key_exists('companyId', $data)) {
            $this->companyId = $data['companyId'];
        }

        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('joined', $data)) {
            $this->joined = $data['joined'];
        }

    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $this->start();
    }

    /**
     * @throws Exception
     */
    protected function start()
    {
        try {
            $this->executeGetCompany();
        } catch(Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     * @param int $companyId
     *
     * @return Company
     */
    abstract protected function getCompany(
        int $companyId
    );

    /**
     * @param Company $company
     * @param int $id
     *
     * @return Client
     */
    abstract protected function getClient(
        Company $company,
        int $id
    );

    /**
     * @param string|null $name
     * @param string|null $email
     * @param string|null $joined
     *
     * @return bool
     */
    abstract protected function shouldUpdateClient(
        string $name = null,
        string $email = null,
        string $joined = null
    );

    /**
     * @param Client $client
     * @param string|null $name
     *
     * @return Client
     */
    abstract protected function updateClientNameIfNeeded(
        Client $client,
        string $name = null
    );

    /**
     * @param Client $client
     * @param string|null $email
     *
     * @return Client
     */
    abstract protected function updateClientEmailIfNeeded(
        Client $client,
        string $email = null
    );

    /**
     * @param Client $client
     * @param string|null $joined
     *
     * @return Client
     */
    abstract protected function updateClientJoinedIfNeeded(
        Client $client,
        string $joined = null
    );

    
    /**
     */
    private function executeGetCompany()
    {
        try {
            $this->company = $this->getCompany(
                $this->companyId
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeGetClient();
    }

    /**
     */
    private function executeGetClient()
    {
        try {
            $this->client = $this->getClient(
                $this->company,
                $this->id
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeShouldUpdateClient();
    }

    /**
     */
    private function executeShouldUpdateClient()
    {
        try {
            $this->shouldUpdateClient = $this->shouldUpdateClient(
                $this->name,
                $this->email,
                $this->joined
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        if ($this->shouldUpdateClient === true) {
            $this->executeUpdateClientNameIfNeeded();
        } elseif ($this->shouldUpdateClient === false) {
            $this->executeEnd();
        } else {
            throw new Exception();
        }
    }

    /**
     */
    private function executeUpdateClientNameIfNeeded()
    {
        try {
            $this->client = $this->updateClientNameIfNeeded(
                $this->client,
                $this->name
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeUpdateClientEmailIfNeeded();
    }

    /**
     */
    private function executeUpdateClientEmailIfNeeded()
    {
        try {
            $this->client = $this->updateClientEmailIfNeeded(
                $this->client,
                $this->email
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeUpdateClientJoinedIfNeeded();
    }

    /**
     */
    private function executeUpdateClientJoinedIfNeeded()
    {
        try {
            $this->client = $this->updateClientJoinedIfNeeded(
                $this->client,
                $this->joined
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeEnd();
    }

    /**
     */
    protected function executeEnd()
    {
        $this->result = $this->client;
    }
}
