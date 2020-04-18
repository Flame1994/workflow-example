<?php
namespace App\Workflows\Company\Generated;

use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowCompanyDeleteBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_ID = 'id';
    const FIELD_COMPANY = 'company';
    const FIELD_IS_DELETED = 'isDeleted';

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
    private $isDeleted;

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
            $this->executeGetCompany();
        } catch(Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     * @param int $id
     *
     * @return Company
     */
    abstract protected function getCompany(
        int $id
    );

    /**
     * @param Company $company
     *
     * @return bool
     */
    abstract protected function deleteAllCompanyClient(
        Company $company
    );

    /**
     * @param Company $company
     *
     * @return Company
     */
    abstract protected function deleteCompany(
        Company $company
    );

    
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

        $this->executeDeleteAllCompanyClient();
    }

    /**
     */
    private function executeDeleteAllCompanyClient()
    {
        try {
            $this->isDeleted = $this->deleteAllCompanyClient(
                $this->company
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeDeleteCompany();
    }

    /**
     */
    private function executeDeleteCompany()
    {
        try {
            $this->company = $this->deleteCompany(
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
        $this->result = $this->company;
    }
}
