<?php

class Product
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function save($name)
    {
        $sql = "INSERT INTO products (name) VALUES ('$name')";
        return $this->db->query($sql);
    }

    public function update($name, $id)
    {
        $sql = "UPDATE products SET name='$name' WHERE id='$id'";
        return $this->db->query($sql);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM products WHERE id='$id'";
        return $this->db->query($sql);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM products";
        return $this->db->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id='$id'";
        return $this->db->query($sql);
    }
}