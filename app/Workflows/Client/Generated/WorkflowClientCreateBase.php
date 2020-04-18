<?php
namespace App\Workflows\Client\Generated;

use App\Client;
use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowClientCreateBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_COMPANY_ID = 'companyId';
    const FIELD_NAME = 'name';
    const FIELD_EMAIL = 'email';
    const FIELD_JOINED = 'joined';
    const FIELD_COMPANY = 'company';
    const FIELD_IS_CLIENT_UNIQUE = 'isClientUnique';
    const FIELD_CLIENT = 'client';

    /**
    * @var int
    */
    private $companyId;

    /**
    * @var string
    */
    private $name;

    /**
    * @var string
    */
    private $email;

    /**
    * @var string
    */
    private $joined;

    /**
    * @var Company
    */
    private $company;

    /**
    * @var bool
    */
    private $isClientUnique;

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
                'name',
                'email',
                'joined',
            ]
        );
        
        if (array_key_exists('companyId', $data)) {
            $this->companyId = $data['companyId'];
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
     * @param string $email
     *
     * @return bool
     */
    abstract protected function assertClientUniqueForCompany(
        Company $company,
        string $email
    );

    /**
     * @param Company $company
     * @param string $name
     * @param string $email
     * @param string $joined
     *
     * @return Client
     */
    abstract protected function createClient(
        Company $company,
        string $name,
        string $email,
        string $joined
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

        $this->executeAssertClientUniqueForCompany();
    }

    /**
     */
    private function executeAssertClientUniqueForCompany()
    {
        try {
            $this->isClientUnique = $this->assertClientUniqueForCompany(
                $this->company,
                $this->email
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeCreateClient();
    }

    /**
     */
    private function executeCreateClient()
    {
        try {
            $this->client = $this->createClient(
                $this->company,
                $this->name,
                $this->email,
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
