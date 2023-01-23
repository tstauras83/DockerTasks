<?php

namespace tstauras83\Controllers;

use tstauras83\Configs;
use tstauras83\Database;
use tstauras83\Exceptions\ValidatorException;
use tstauras83\FS;
use tstauras83\Response;
use tstauras83\Validator;

class AddressController extends BaseController
{


    public function index(): Response
    {
        $config = new Configs();
        $db = new Database($config);

        $limiter = $_GET['amount'] ?? 10;
        $people = $db->query('SELECT * FROM addresses ORDER BY id DESC LIMIT ' . $limiter);

        $rez = '<table class="table table-striped table-hover table-dark">
        <tr>
        <th scope="col">ID: </th>
        <th scope="col">Country ISO: </th>
        <th scope="col">City: </th>
        <th scope="col">Street: </th>
        <th scope="col">PostCode: </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        </tr>';

        foreach ($people as $data) {
            $rez .= '<tr>';
            $rez .= '<th scope="row">' . $data['id'] . '</th>';
            $rez .= '<td>' . $data['country_iso'] . '</td>';
            $rez .= '<td>' . $data['city'] . '</td>';
            $rez .= '<td>' . $data['street'] . '</td>';
            $rez .= '<td>' . $data['postcode'] . '</td>';
            $rez .= "<td><a href='/address/view?id={$data['id']}'>View</a></td>";
            $rez .= "<td><a href='/address/edit?id={$data['id']}'>Update</a></td>";
            $rez .= "<td><a href='/address/delete?id={$data['id']}'>Delete</a></td>";
            $rez .= '</tr>';
        }
        $rez .= '</table>';

        $fileSystem = new FS('../src/html/addressHTML/address.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'Address Table', $fileContent);
        $fileContent = str_replace("{{body}}", $rez, $fileContent);

        return new Response($fileContent);
    }

    public function new(): Response
    {
        $fileSystem = new FS('../src/html/addressHTML/new_address.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'New Address Entry', $fileContent);

        return new Response($fileContent);
    }

    public function store(): Response
    {
        $country_iso = $_POST['country_iso'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $postcode = $_POST['postcode'];

        Validator::required($country_iso);
        Validator::required($city);
        Validator::required($street);
        Validator::required($postcode);

        $conf = new Configs();
        $conn = new Database($conf);

        $conn->query(
            "INSERT INTO `addresses` (`country_iso`,`city`, `street`, `postcode`)
                    VALUES (:country_iso, :city, :street, :postcode)",
            [
                'country_iso' => $country_iso,
                'city' => $city,
                'street' => $street,
                'postcode' => $postcode,
            ]
        );

        $response = new Response("Record updated successfully");
        $response->redirect('/address');
        return $response;
    }

    public function edit(): Response
    {
        $fileSystem = new FS('../src/html/addressHTML/update_address.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'Edit Address', $fileContent);

        $id = (int)$_GET['id'] ?? null;

        $conf = new Configs();
        $db = new Database($conf);

        $person = $db->query("select `id`,`country_iso`, `city`, `street`,`postcode` from  `addresses` where `id` = :id",
            ['id' => $id]);

        $id = $person[0]['id'];
        $country_iso = $person[0]['country_iso'];
        $city = $person[0]['city'];
        $street = $person[0]['street'];
        $postcode = $person[0]['postcode'];


        $fileContent = str_replace("{{id}}", $id, $fileContent);
        $fileContent = str_replace("{{country_iso}}", $country_iso, $fileContent);
        $fileContent = str_replace("{{city}}", $city, $fileContent);
        $fileContent = str_replace("{{street}}", $street, $fileContent);
        $fileContent = str_replace("{{postcode}}", $postcode, $fileContent);
        return new Response($fileContent);

    }

    public function update(): Response
    {
        $id = (int)$_POST['id'] ?? null;
        $country_iso = (string)$_POST['country_iso'] ?? null;
        $city = (string)$_POST['city'] ?? null;
        $street = (string)$_POST['street'] ?? null;
        $postcode = (string)$_POST['postcode'] ?? null;


        Validator::required($id);
        Validator::required($country_iso);
        Validator::required($city);
        Validator::required($street);
        Validator::required($postcode);


        $conf = new Configs();
        $db = new Database($conf);

        $db->query("update `addresses` set `country_iso` = :country_iso,`city` = :city, `street` = :street, `postcode` = :postcode
                 where `id` = :id",
            [
                'id' => $id,
                'country_iso' => $country_iso,
                'city' => $city,
                'street' => $street,
                'postcode' => $postcode,
            ]);
        $response = new Response("Record updated successfully");
        $response->redirect('/address');
        return $response;

    }

    public function delete(): Response
    {
        $kuris = (int)$_GET['id'] ?? null;

        Validator::required($kuris);
        Validator::numeric($kuris);
        Validator::min($kuris, 1);

        $conf = new Configs();
        $db = new Database($conf);

        $db->query("DELETE FROM `addresses` WHERE `id` = '$kuris'");

        $response = new Response("Record updated successfully");
        $response->redirect('/address');
        return $response;
    }

    public function view(): Response
    {
        $fileSystem = new FS('../src/html/addressHTML/view_address.html');
        $headerPath = '../src/html/header.html';

        $fileContent = $fileSystem->getFileContents();
        $headerContent = file_get_contents($headerPath);
        $fileContent = str_replace("{{header}}", $headerContent, $fileContent);
        $fileContent = str_replace("{{title}}", 'View address Info', $fileContent);

        $id = (int)$_GET['id'] ?? null;

        $conf = new Configs();
        $db = new Database($conf);

        $person = $db->query("SELECT `addresses`.`id`, `country_iso`, `city`, `street`, `postcode`, 
                      `persons`.`address_id`
                      FROM `addresses`
                      JOIN `persons`
                      ON `addresses`.`id` = `persons`.`address_id`
                      WHERE `addresses`.`id` = :id", ['id' => $id]);

        $id = $person[0]['id'];
        $address_id = $person[0]['address_id'];
        $country_iso = $person[0]['country_iso'];
        $city = $person[0]['city'];
        $street = $person[0]['street'];
        $postcode = $person[0]['postcode'];

        $fileContent = str_replace("{{id}}", $id, $fileContent);
        $fileContent = str_replace("{{address_id}}", $address_id, $fileContent);
        $fileContent = str_replace("{{country_iso}}", $country_iso, $fileContent);
        $fileContent = str_replace("{{city}}", $city, $fileContent);
        $fileContent = str_replace("{{street}}", $street, $fileContent);
        $fileContent = str_replace("{{postcode}}", $postcode, $fileContent);
        return new Response($fileContent);
    }


}