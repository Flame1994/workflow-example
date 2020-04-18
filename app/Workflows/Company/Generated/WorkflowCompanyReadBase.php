<?php
namespace App\Workflows\Company\Generated;

use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowCompanyReadBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_ID = 'id';
    const FIELD_COMPANY_EXISTS = 'companyExists';
    const FIELD_COMPANY = 'company';

    /**
    * @var int
    */
    private $id;

    /**
    * @var bool
    */
    private $companyExists;

    /**
    * @var Company
    */
    private $company;

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
                'id',
            ]
        );
        
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
            $this->executeAssertCompanyExists();
        } catch(Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     * @param int $id
     *
     * @return bool
     */
    abstract protected function assertCompanyExists(
        int $id
    );

    /**
     * @param int $id
     *
     * @return Company
     */
    abstract protected function getCompany(
        int $id
    );

    
    /**
     */
    private function executeAssertCompanyExists()
    {
        try {
            $this->companyExists = $this->assertCompanyExists(
                $this->id
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeGetCompany();
    }

    /**
     */
    private function executeGetCompany()
    {
        try {
            $this->company = $this->getCompany(
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
        $this->result = $this->company;
    }
}
