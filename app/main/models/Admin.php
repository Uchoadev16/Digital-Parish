<?php

namespace App\Main\Models;

use App\Main\Models\Sessions;

/**
 * Classe Admin
 * Representa um administrador do sistema
 * Estende Sessions
 */
class Admin extends Sessions
{
    protected $id;
    protected $username;
    protected $email;
    protected $name;
    protected $role;
    protected $permissions;
    protected $createdAt;
    protected $updatedAt;
    
    /**
     * Construtor
     */
    public function __construct()
    {
        parent::__construct();
        $this->role = 'admin';
    }
    
    /**
     * Define os dados do administrador
     * 
     * @param array $data
     * @return void
     */
    public function setData(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->role = $data['role'] ?? 'admin';
        $this->permissions = $data['permissions'] ?? [];
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }
    
    /**
     * Obtém os dados do administrador
     * 
     * @return array
     */
    public function getData()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'name' => $this->name,
            'role' => $this->role,
            'permissions' => $this->permissions,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        ];
    }
    
    /**
     * Autentica o administrador
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authenticate($username, $password)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE (username = :username OR email = :username) AND role = 'admin'");
        $stmt->execute(['username' => $username]);
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['password'])) {
            $this->setData($admin);
            $this->set('admin_id', $admin['id']);
            $this->set('username', $admin['username']);
            $this->set('authenticated', true);
            $this->set('is_admin', true);
            $this->set('admin_data', $admin);
            return true;
        }
        
        return false;
    }
    
    /**
     * Verifica se o usuário atual é administrador
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->get('is_admin') === true && $this->isAuthenticated();
    }
    
    /**
     * Obtém o administrador atual da sessão
     * 
     * @return Admin|null
     */
    public function getCurrentAdmin()
    {
        if ($this->isAdmin()) {
            $adminData = $this->get('admin_data');
            if ($adminData) {
                $this->setData($adminData);
                return $this;
            }
        }
        return null;
    }
    
    /**
     * Verifica se o administrador tem uma permissão específica
     * 
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if (!$this->isAdmin()) {
            return false;
        }
        
        $permissions = $this->permissions ?? [];
        return in_array($permission, $permissions) || in_array('*', $permissions);
    }
    
    /**
     * Faz logout do administrador
     * 
     * @return void
     */
    public function logout()
    {
        $this->remove('admin_id');
        $this->remove('username');
        $this->remove('authenticated');
        $this->remove('is_admin');
        $this->remove('admin_data');
        $this->regenerateId(true);
    }
    
    // Getters
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getName() { return $this->name; }
    public function getRole() { return $this->role; }
    public function getPermissions() { return $this->permissions; }
}


