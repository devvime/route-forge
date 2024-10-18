<?php

$createUsers = function ($request) {
  $crud = new CRUD(db_host, db_username, db_password, db_name);
  $data = $request->body;
  $data['password'] = password_hash($data->password, PASSWORD_BCRYPT);

  if ($crud->create('users', $data)) {
    echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to create user']);
  }

  $crud = null;
};

$readUsers = function () {
  $crud = new CRUD(db_host, db_username, db_password, db_name);

  $users = $crud->read('users');

  if ($users) {
    echo json_encode(['status' => 200, 'data' => $users]);
  } else {
    echo json_encode(['status' => 'success', 'data' => []]);
  }

  $crud = null;
};

$updateUsers = function ($id, $request) {
  $crud = new CRUD(db_host, db_username, db_password, db_name);
  $data = $request->body;
  $data['password'] = password_hash($data->password, PASSWORD_BCRYPT);

  $where = 'id = ?';
  $whereParams = [$id];

  if ($crud->update('users', $data, $where, $whereParams)) {
    echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
  }

  $crud = null;
};

$deleteUsers = function ($id) {
  $crud = new CRUD(db_host, db_username, db_password, db_name);
  $where = 'id = ?';
  $params = [$id];

  if ($crud->delete('users', $where, $params)) {
    echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
  }

  $crud = null;
};
