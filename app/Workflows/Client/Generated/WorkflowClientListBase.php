<?php
namespace App\Workflows\Client\Generated;

use App\Client;
use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowClientListBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_COMPANY_ID = 'companyId';
    const FIELD_COMPANY = 'company';
    const FIELD_ALL_CLIENT = 'allClient';

    /**
    * @var int
    */
    private $companyId;

    /**
    * @var Company
    */
    private $company;

    /**
    * @var Client[]
    */
    private $allClient;

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
            ]
        );
        
        if (array_key_exists('companyId', $data)) {
            $this->companyId = $data['companyId'];
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
     *
     * @return Client[]
     */
    abstract protected function getAllClient(
        Company $company
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

        $this->executeGetAllClient();
    }

    /**
     */
    private function executeGetAllClient()
    {
        try {
            $this->allClient = $this->getAllClient(
                $this->company
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
        $this->result = $this->allClient;
    }
}
