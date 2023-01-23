<?php

namespace tstauras83\Controllers;

use tstauras83\Configs;
use tstauras83\Database;
use tstauras83\Exceptions\ValidatorException;
use tstauras83\FS;
use tstauras83\Request;
use tstauras83\Response;
use tstauras83\Validator;

class PersonController extends BaseController
{
    public const TITLE = 'Persons';

    public function index(): Response
    {
        $config = new Configs();
        $db = new Database($config);

        $amount = $_GET['amount'] ?? 10;
        $orderBy = $_GET['orderby'] ?? 'id';

        $persons = $db->query('SELECT p.*, concat(c.title, \' - \', a.city, \' - \', a.street, \' - \', a.postcode) addresses
FROM persons p
    LEFT JOIN addresses a on p.address_id = a.id 
    LEFT JOIN countries c on a.country_iso = c.iso 
ORDER BY ' . $orderBy . ' DESC LIMIT ' . $amount);

        //$people = $db->query('SELECT * FROM persons ORDER BY id DESC LIMIT ' . $limiter);

        /*        $rez = '<table class="table table-striped table-hover table-dark">
                <tr>
                <th scope="col">ID: </th>
                <th scope="col">First Name: </th>
                <th scope="col">Last Name: </th>
                <th scope="col">Email: </th>
                <th scope="col">Persona Code: </th>
                <th scope="col">Phone: </th>
                <th scope="col">Address ID: </th>
                <th scope="col">Actions: </th>
                <th scope="col"> </th>
                <th scope="col"> </th>
                </tr>';

                foreach ($people as $data) {
                    $rez .= '<tr>';
                    $rez .= '<th scope="row">' . $data['id'] . '</th>';
                    $rez .= '<td>' . $data['first_name'] . '</td>';
                    $rez .= '<td>' . $data['last_name'] . '</td>';
                    $rez .= "<td><a href='mailto:{$data['email']}'>{$data['email']}</a></td>";
                    $rez .= '<td>' . $data['code'] . '</td>';
                    $rez .= "<td><a href='tel:{$data['phone']}'>{$data['phone']}</a></td>";
                    $rez .= '<td>' . $data['address_id'] . '</td>';
                    $rez .= "<td><a href='/person/view?id={$data['id']}'>View</a></td>";
                    $rez .= "<td><a href='/person/edit?id={$data['id']}'>Update</a></td>";
                    $rez .= "<td><a href='/person/delete?id={$data['id']}'>Delete</a></td>";
                    $rez .= '</tr>';
                }
                $rez .= '</table>';*/

        $rez = $this->generatePersonsTable($persons);

        $fileSystem = new FS('../src/html/person.html');

        $fileContent = $fileSystem->getFileContents();
        $fileContent = str_replace("{{title}}", 'Persons Table', $fileContent);
        $fileContent = str_replace("{{body}}", $rez, $fileContent);


        return $this->Response($fileContent);
    }

    public function new(): Response
    {

        $fileSystem = new FS('../src/html/new_persons.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'New User Entry', $fileContent);

        return $this->Response($fileContent);


        /*        $fileSystem = new FS('../src/html/new_persons.html');
                $fileContent = $fileSystem->getFileContents();
                return $fileContent;*/


    }

    public function store(): Response
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $address_id = $_POST['address_id'];

        Validator::required($first_name);
        Validator::required($last_name);
        Validator::required($email);
        Validator::email($email);
        Validator::required($code);
        Validator::required($phone);
        Validator::phone($phone);
        Validator::required($address_id);
        Validator::numeric($address_id);
        Validator::numeric($code);
        Validator::personalcode($code);

        $conf = new Configs();
        $conn = new Database($conf);

        $conn->query(
            "INSERT INTO `persons` (`first_name`, `last_name`, `email`, `code`,`phone`, `address_id`)
                    VALUES (:first_name, :last_name, :email, :code, :phone, :address_id)",
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'code' => $code,
                'phone' => $phone,
                'address_id' => $address_id
            ]
        );

        return $this->redirect('/person', ['message' => "Record created successfully"]);
    }

    public function delete(): Response
    {
        $kuris = (int)$_GET['id'] ?? null;

        Validator::required($kuris);
        Validator::numeric($kuris);
        Validator::min($kuris, 1);

        $conf = new Configs();
        $db = new Database($conf);

        $db->query("DELETE FROM `persons` WHERE `id` = '$kuris'");

        return $this->redirect('/person', ['message' => "Record deleted successfully"]);
    }

    public function edit(): Response
    {
        $fileSystem = new FS('../src/html/update_persons.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'Edit User', $fileContent);

        $id = (int)$_GET['id'] ?? null;

        $conf = new Configs();
        $db = new Database($conf);

        $person = $db->query("select `id`,`first_name`, `last_name`,`email`, `code`, `phone`, `address_id` from  `persons` where `id` = :id",
            ['id' => $_GET['id']])[0];

        foreach ($person as $key => $item) {
            $fileContent = str_replace("{{" . $key . "}}", $item, $fileContent);
        }
        return $this->Response($fileContent);

    }

    /**
     * @throws ValidatorException
     */
    public function update(Request $request): Response
    {


/*        Validator::required($request->get($id));
        Validator::required($request->get($first_name));
        Validator::required($request->get($last_name));
        Validator::required($request->get($email));
        Validator::email($request->get($email));
        Validator::required($request->get($code));
        Validator::personalcode($request->get($code));
        Validator::numeric($request->get($code));
        Validator::required($request->get($phone));
        Validator::phone($request->get($phone));
        Validator::required($request->get($address_id));
        Validator::numeric($request->get($address_id));
        Validator::numeric($request->get($id));
        Validator::min($request->get($id, 1));*/

        $conf = new Configs();
        $db = new Database($conf);

        $db->query("update `persons` set `first_name` = :first_name, `last_name` = :last_name,
                     `email` = :email, `code` = :code, `phone` = :phone, `address_id` = :address_id
                 where `id` = :id",
            $request->all());
        return $this->redirect('/person/view?id=' . $request->get('id'), ['message' => "Record updated successfully"]);

    }

    public function view(): Response
    {
        $fileSystem = new FS('../src/html/view_persons.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'View Users Info', $fileContent);
        $id = (int)$_GET['id'] ?? null;

        $conf = new Configs();
        $db = new Database($conf);

        $person = $db->query("SELECT `persons`.`id`,`first_name`, `last_name`,`email`, `code`, `phone`, `address_id`,
                             `addresses`.`country_iso`,`addresses`.`city`,`addresses`.`street`,`addresses`.`postcode`
                      FROM `persons`
                      JOIN `addresses`
                      ON `persons`.`address_id` = `addresses`.`id`
                      WHERE `persons`.`id` = :id", ['id' => $id]);

        $id = $person[0]['id'];
        $first_name = $person[0]['first_name'];
        $last_name = $person[0]['last_name'];
        $email = $person[0]['email'];
        $code = $person[0]['code'];
        $phone = $person[0]['phone'];
        $address_id = $person[0]['address_id'];
        $country_iso = $person[0]['country_iso'];
        $city = $person[0]['city'];
        $street = $person[0]['street'];
        $postcode = $person[0]['postcode'];

        $fileContent = str_replace("{{id}}", $id, $fileContent);
        $fileContent = str_replace("{{first_name}}", $first_name, $fileContent);
        $fileContent = str_replace("{{last_name}}", $last_name, $fileContent);
        $fileContent = str_replace("{{email}}", $email, $fileContent);
        $fileContent = str_replace("{{code}}", $code, $fileContent);
        $fileContent = str_replace("{{phone}}", $phone, $fileContent);
        $fileContent = str_replace("{{address_id}}", $address_id, $fileContent);
        $fileContent = str_replace("{{country_iso}}", $country_iso, $fileContent);
        $fileContent = str_replace("{{city}}", $city, $fileContent);
        $fileContent = str_replace("{{street}}", $street, $fileContent);
        $fileContent = str_replace("{{postcode}}", $postcode, $fileContent);

        return new Response($fileContent);
    }


    protected function generatePersonRow(array $persons): string
    {
        $fileSystem = new FS('../src/html/person/person_row.html');
        $fileContent = $fileSystem->getFileContents();
        foreach ($persons as $key => $item) {
            $fileContent = str_replace("{{" . $key . "}}", $item, $fileContent);
        }

        return $fileContent;
    }


    protected function generatePersonsTable(array $persons): string
    {
        $rez = '<table class="table table-striped table-hover table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Persona Code</th>
                <th><a href="/person?orderby=phone">Phone</a></th>
                <th>Address ID</th>
                <th>Actions</th>
                <th> </th>
            </tr>';
        foreach ($persons as $person) {
            $rez .= $this->generatePersonRow($person);
        }
        $rez .= '</table>';
        return $rez;
    }
}