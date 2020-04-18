<?php
namespace App\Workflows\Company\Generated;

use App\Client;
use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowCompanyUpdateBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_EMAIL = 'email';
    const FIELD_FOUNDED = 'founded';
    const FIELD_ALL_CLIENT = 'allClient';
    const FIELD_COMPANY = 'company';
    const FIELD_SHOULD_UPDATE_COMPANY = 'shouldUpdateCompany';

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
    private $founded;

    /**
    * @var Client[]|null
    */
    private $allClient;

    /**
    * @var Company
    */
    private $company;

    /**
    * @var bool
    */
    private $shouldUpdateCompany;

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
                'name',
                'email',
                'founded',
                'allClient',
            ]
        );
        
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('founded', $data)) {
            $this->founded = $data['founded'];
        }

        if (array_key_exists('allClient', $data)) {
            $this->allClient = $data['allClient'];
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
     * @param string|null $name
     * @param string|null $email
     * @param string|null $founded
     * @param Client[]|null $allClient
     *
     * @return bool
     */
    abstract protected function shouldUpdateCompany(
        string $name = null,
        string $email = null,
        string $founded = null,
        array $allClient = null
    );

    /**
     * @param Company $company
     * @param string|null $name
     *
     * @return Company
     */
    abstract protected function updateCompanyNameIfNeeded(
        Company $company,
        string $name = null
    );

    /**
     * @param Company $company
     * @param string|null $email
     *
     * @return Company
     */
    abstract protected function updateCompanyEmailIfNeeded(
        Company $company,
        string $email = null
    );

    /**
     * @param Company $company
     * @param string|null $founded
     *
     * @return Company
     */
    abstract protected function updateCompanyFoundedIfNeeded(
        Company $company,
        string $founded = null
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

        $this->executeShouldUpdateCompany();
    }

    /**
     */
    private function executeShouldUpdateCompany()
    {
        try {
            $this->shouldUpdateCompany = $this->shouldUpdateCompany(
                $this->name,
                $this->email,
                $this->founded,
                $this->allClient
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        if ($this->shouldUpdateCompany === true) {
            $this->executeUpdateCompanyNameIfNeeded();
        } elseif ($this->shouldUpdateCompany === false) {
            $this->executeEnd();
        } else {
            throw new Exception();
        }
    }

    /**
     */
    private function executeUpdateCompanyNameIfNeeded()
    {
        try {
            $this->company = $this->updateCompanyNameIfNeeded(
                $this->company,
                $this->name
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeUpdateCompanyEmailIfNeeded();
    }

    /**
     */
    private function executeUpdateCompanyEmailIfNeeded()
    {
        try {
            $this->company = $this->updateCompanyEmailIfNeeded(
                $this->company,
                $this->email
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeUpdateCompanyFoundedIfNeeded();
    }

    /**
     */
    private function executeUpdateCompanyFoundedIfNeeded()
    {
        try {
            $this->company = $this->updateCompanyFoundedIfNeeded(
                $this->company,
                $this->founded
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
