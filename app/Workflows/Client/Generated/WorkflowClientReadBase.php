<?php
namespace App\Workflows\Client\Generated;

use App\Client;
use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowClientReadBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_COMPANY_ID = 'companyId';
    const FIELD_ID = 'id';
    const FIELD_COMPANY = 'company';
    const FIELD_CLIENT_EXISTS = 'clientExists';
    const FIELD_CLIENT = 'client';

    /**
    * @var int
    */
    private $companyId;

    /**
    * @var int
    */
    private $id;

    /**
    * @var Company
    */
    private $company;

    /**
    * @var bool
    */
    private $clientExists;

    /**
    * @var Client
    */
    private $client;

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
            ]
        );
        
        if (array_key_exists('companyId', $data)) {
            $this->companyId = $data['companyId'];
        }

        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
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
     * @return bool
     */
    abstract protected function assertClientExists(
        Company $company,
        int $id
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

        $this->executeAssertClientExists();
    }

    /**
     */
    private function executeAssertClientExists()
    {
        try {
            $this->clientExists = $this->assertClientExists(
                $this->company,
                $this->id
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

        $this->executeEnd();
    }

    /**
     */
    protected function executeEnd()
    {
        $this->result = $this->client;
    }
}
