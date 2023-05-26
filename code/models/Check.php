<?php

namespace models;

use models\pages\Pages;

class Check
{
    private $userRole;

    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }

    public function getCurrentUrlSlug(): string
    {
//        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = "$_SERVER[REQUEST_URI]";
        $parseUrl = parse_url($url);
        $path = $parseUrl['path'];
        $pathWithoutBase = str_replace(APP_BASE_PATH, '', $path);
        $segments = explode('/', trim($pathWithoutBase, '/'));
        $two_segments = array_slice($segments, 0, 2);
        $slug = implode('/', $two_segments);
        return '/' . $slug;
    }

    public function checkPermission($slug): bool
    {
        $pageModel = new Pages();
        $page = $pageModel->findBySlug($slug);
        if (!$page) {
            return false;
        }

        $allowedRoles = explode(',', $page['role']);
        if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $allowedRoles)) {
            return true;
        } else {
            return false;
        }
    }

    public function requirePermission(): void
    {
        $slug = $this->getCurrentUrlSlug();
        if (!$this->checkPermission($slug)) {
            if (isset($_SESSION['user_id'])) {
                header("Location: /");
            } else {
                header("Location: /auth/login");
            }
        }
    }

    public function isCurrentUserRole($role): bool
    {
        return $this->userRole == $role;
    }
}