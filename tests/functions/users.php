<?php

session_start();

Test::add("Create new user", function() {
    try {
        $data = [
            "name" => "Steve",
            "email" => "steve@example.com",
            "password" => password_hash("example", PASSWORD_BCRYPT)
        ];
        $crud = new CRUD();
        $result = $crud->create('users', $data);
        if ($result) {
            $_SESSION['created_id'] = $result;
        }
        echo "OK\n\n";
    } catch (Exception $e) {
        echo "ERROR: ". $e->getMessage() . "\n\n";
    }
});

Test::add("Read user", function() {
    try {
        $crud = new CRUD();
        $user = $crud->read('users', 'id, name, email, phone, role', 'id = ?', [$_SESSION['created_id']]);
        if ($user) {
            echo "OK\n\n";
        } else {
            echo "User not found.\n\n";
        }
    } catch (Exception $e) {
        echo "ERROR: ". $e->getMessage(). "\n\n";
    }
});

Test::add("Update user", function() {
    try {
        $data = [
            "phone" => "5511948871377"
        ];
        $crud = new CRUD();
        $result = $crud->update('users', $data, 'id = ?', [$_SESSION['created_id']]);
        if ($result) {
            echo "OK\n\n";
        } else {
            echo "Failed to update user.\n\n";
        }
    } catch (Exception $e) {
        echo "ERROR: ". $e->getMessage(). "\n\n";
    }
});

Test::add("Delete user", function() {
    try {
        $crud = new CRUD();
        $result = $crud->delete('users', 'id =?', [$_SESSION['created_id']]);
        if ($result) {
            echo "OK\n\n";
        } else {
            echo "Failed to delete user.\n\n";
        }
    } catch (Exception $e) {
        echo "ERROR: ". $e->getMessage(). "\n\n";
    }
});