<?php
// /core/Model.php

abstract class Model
{
    protected $db;
    protected $table;
    
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function create($data)
    {
        $fields = array_keys($data);
        $placeholders = array_map(function($field) {
            return ":{$field}";
        }, $fields);
        
        $query = "INSERT INTO {$this->table} (" . implode(", ", $fields) . ") 
                 VALUES (" . implode(", ", $placeholders) . ")";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($data);
        
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data)
    {
        $fields = array_keys($data);
        $setStatements = array_map(function($field) {
            return "{$field} = :{$field}";
        }, $fields);
        
        $query = "UPDATE {$this->table} SET " . implode(", ", $setStatements) . " WHERE id = :id";
        
        $data['id'] = $id;
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }
    
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
    
    public function findBy($field, $value)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$field} = :value";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['value' => $value]);
        return $stmt->fetch();
    }
    
    public function findAllBy($field, $value)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$field} = :value";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll();
    }
}