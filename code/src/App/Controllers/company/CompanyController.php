<?php

namespace App\Controllers\company;

use App\Models\company\Company;
use App\Models\regions\RegionsModel;
use App\Utils\TemplatesEngine;


class CompanyController
{
    public $filterCompanies = null;
    public $filterCompaniesName = null;
    public $filterCompaniesBin = null;
    public $filterCompaniesRegion = null;

    public function index(): void
    {
        $page = (int)($_GET['page'] ?? null);
        $count = (int)($_GET['count'] ?? null);
        if ($page < 1) {
            $page = null;
        }

        $this->filter(page: $page,limit: $count);
        $valueName = $this->filterCompaniesName !== null ? $this->filterCompaniesName : '';
        $valueBin = $this->filterCompaniesBin !== null ? $this->filterCompaniesBin : '';
        $valueRegion = $this->filterCompaniesRegion !== null ? $this->filterCompaniesRegion : '';
        $companyModel = new Company();
        $companiesAll = $companyModel->getAllCompanies(page: $page,limit: $count);
        $companies = $this->filterCompanies !== null ? $this->filterCompanies : $companiesAll;
        echo TemplatesEngine::render('layout', [
            'content' => TemplatesEngine::render('company/index', [
                'companies' => $companies,
                'valueBin' => $valueBin,
                'valueName' => $valueName,
                'valueRegion' => $valueRegion,
            ]),
            'title' => 'Company list',
        ]);

//        require_once ROOT_DIR . '/templates/company/index.php';
    }

    public function create(): void
    {
        $regionModel = new RegionsModel();
        $regions = $regionModel->getAllRegion();

        echo TemplatesEngine::render('layout', [
            'content' => TemplatesEngine::render('company/create', [
                'regions' => $regions
            ]),
            'title' => 'Company list',
        ]);
    }

    public function store(): void
    {
        if (isset($_POST['company_name'])) {
            $company_bin = trim($_POST['company_bin']);
            $company_name = trim($_POST['company_name']);
            $region = isset($_POST['region']) && trim($_POST['region']) !== ''? $_POST['region']:'Kazakhstan';
            $address = isset($_POST['address']) && trim($_POST['address']) !== ''? $_POST['address']:'Astana';;
            $otrasl = isset($_POST['otrasl']) && trim($_POST['otrasl']) !== ''? $_POST['otrasl']:'Kazakhstan';;
            $phone = isset($_POST['phone']) && trim($_POST['phone']) !== ''? $_POST['phone']:'phone none';;
            $email = isset($_POST['email']) && trim($_POST['email']) !== ''? $_POST['email']:'email@email.com';;

            if (empty($company_name)) {
                echo "Company name is required";
                return;
            }

            $companyModel = new Company();
            $companyModel->createCompany(
                $company_name,
                $company_bin,
                $region,
                $address,
                $otrasl,
                $phone,
                $email
            );
        }
        header('Location: /companies');
    }

    public function info($params){
        $companyModel = new Company();
        $company = $companyModel->getCompanyById($params['id']);

        $regionModel = new RegionsModel();
        $regions = $regionModel->getAllRegion();

        if (!$company) {
            echo "Company not found";
            return;
        }

        echo TemplatesEngine::render('layout', [
            'content' => TemplatesEngine::render('company/info', [
                'company' => $company
            ]),
            'title' => 'Company info',
        ]);
    }

    public function filter($page, $limit = 30){
        $this->filterCompaniesName = $_GET['company_name_filter'] ?? null;
        $this->filterCompaniesBin = $_GET['company_bin_filter'] ?? null;
        $this->filterCompaniesRegion = $_GET['company_region_filter'] ?? null;
        if (isset($_GET['company_name_filter']) || isset($_GET['company_bin_filter']) || isset($_GET['company_region_filter'])) {
            $company_name = trim($_GET['company_name_filter']) ?? '';
            $company_bin = trim($_GET['company_bin_filter']) ?? '';
            $company_region = isset($_GET['company_region_filter'])? trim($_GET['company_region_filter']) : '';

            $companyModel = new Company();
            $this->filterCompanies = $companyModel->filter($company_name, $company_bin, $company_region, (int)$page, $limit = 30);
        }else{
            $this->filterCompanies = null;
        }
    }

    public function delete($params): void
    {
        $companyModel = new Company();
        $companyModel->deleteCompany($params['id']);

        header('Location: /companies');
    }

    public function edit($params): void
    {
        $companyModel = new Company();
        $company = $companyModel->getCompanyById($params['id']);

        $regionModel = new RegionsModel();
        $regions = $regionModel->getAllRegion();

        if (!$company) {
            echo "Company not found";
            return;
        }


        echo TemplatesEngine::render('layout', [
            'content' => TemplatesEngine::render('company/edit', [
                'company' => $company,
                'regions' => $regions
            ]),
            'title' => 'Company info',
        ]);
    }

    public function update($params): void
    {
        if (isset($params['id']) && isset($_POST['company_name']) && isset($_POST['email'])) {
            $id = trim($params['id']);
            $company_name = trim($_POST['company_name']);
            $company_bin = trim($_POST['company_bin']);
            $region = isset($_POST['region']) && trim($_POST['region']) !== ''? $_POST['region']:'Kazakhstan';
            $address = isset($_POST['address']) && trim($_POST['address']) !== ''? $_POST['address']:'Astana';;
            $otrasl = isset($_POST['otrasl']) && trim($_POST['otrasl']) !== ''? $_POST['otrasl']:'Kazakhstan';;
            $phone = isset($_POST['phone']) && trim($_POST['phone']) !== ''? $_POST['phone']:'phone none';;
            $email = isset($_POST['email']) && trim($_POST['email']) !== ''? $_POST['email']:'email@email.com';;

            if (empty($company_name)) {
                echo "Company name is required";
                return;
            }

            $companyModel = new Company();
            $companyModel->updateCompany($id, $company_name,
                $company_bin,
                $region,
                $address,
                $otrasl,
                $phone,
                $email);
        }

        header('Location: /companies');
    }

    public function qa($title = 'QA:', $value = ''): void
    {
        echo '<br/>';
        var_dump("$title __: ", $value);
        echo '<br/>';
    }

    public function getAllRowsCompanies(){
        $companyModel = new Company();
        $rows = $companyModel->getCompanies();
        return $rows;
    }
}