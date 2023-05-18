<?php
require_once ROOT_DIR . '/app/models/company/Company.php';

class CompanyController{

    public function index(): void
    {
        $companyModel = new Company();
        $companies = $companyModel->getAllCompanies();

        require_once ROOT_DIR . '/app/view/company/index.php';
    }

    public function create(): void
    {
        //вызываем шабблон страницы
        require_once ROOT_DIR . '/app/view/company/create.php';
    }

    public function store(): void
    {
        if (isset($_POST['company_name']) && isset($_POST['company_description'])) {
            $company_name = trim($_POST['company_name']);
            $company_description = trim($_POST['company_description']);

            if (empty($company_name)) {
                echo "Role name is required";
                return;
            }

            $companyModel = new Company();
            $companyModel->createCompany(
                $company_name,
                $company_description
            );
        }
        header('Location: index.php?page=companies');
    }

    public function delete(): void
    {
        $companyModel = new Company();
        $companyModel->deleteCompany($_GET['id']);

        header('Location: index.php?page=companies');
    }

    public function edit($id): void
    {
        $companyModel = new Company();
        $company = $companyModel->getCompanyById($id);

        if (!$company) {
            echo "Company not found";
            return;
        }


        include ROOT_DIR . "/app/view/company/edit.php";
    }

    public function update(): void
    {
        if (isset($_POST['id']) && isset($_POST['company_name']) && isset($_POST['company_description'])) {
            $id = trim($_POST['id']);
            $company_name = trim($_POST['company_name']);
            $company_description = trim($_POST['company_description']);

            if (empty($company_name)) {
                echo "Company name is required";
                return;
            }

            $companyModel = new Company();
            $companyModel->updateCompany($id, $company_name, $company_description);
        }

        header('Location: index.php?page=companies');
    }
}