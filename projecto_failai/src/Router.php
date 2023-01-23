<?php

namespace tstauras83;


use tstauras83\Exceptions\PageNotFoundException;

class Router
{
    private array $routes = [];

    /**
     * Prideda Routus į $this->routes masyvą
     *
     * @param string $path
     * @param string $controller
     * @param string $method
     */
    public function addRoute(string $method, string $url, array $controllerData): void
    {
        $this->routes[$method][$url] = $controllerData;
    }

    public function get(string $url, array $controllerData): void
    {
        $this->addRoute('GET', $url, $controllerData);
    }

    public function post(string $url, array $controllerData): void
    {
        $this->addRoute('POST', $url, $controllerData);
    }

    /**
     * @throws PageNotFoundException
     */
    public function run(): void
    {
        // Iš $_SERVER paimame užklausos metodą ir URL adresą
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url)[0];
        $url = rtrim($url, '/');
        $url = ltrim($url, '/');

        // Tikriname ar yra toks URL adresas ir metodas sukurtas mūsų $this->routes masyve
        if (isset($this->routes[$method][$url])) {
            // Iš $this->routes masyvo paimame controller klasės pavadinimą ir metodą
            $controllerData = $this->routes[$method][$url];
            $controller = $controllerData[0];
            $action = $controllerData[1];
            // Iškviečiamas kontrolierio ($controller) objektas ir kviečiamas jo metodas ($action)
            $response = $controller->$action();
            if($response instanceof Response && $response->redirect) {
                header('location: ' . $response->redirectUrl);
                $response->redirect = false;
                exit;
            }
        } else {
            throw new PageNotFoundException("Adresas: [$method] /$url nerastas");
        }

        if (!$response instanceof Response) {
            throw new \Exception('Controllerio metodas turi grąžinti Response objektą');
        }
        $response = $response->content;

        // Iš kontrolerio funkcijos gautą atsakymą talpiname į main.html layout failą
        $filesystem = new FS('../src/html/layout/main.html');
        $fileContent = $filesystem->getFileContents();
        $title = $controller::TITLE;
        $fileContent = str_replace("{{title}}", $title, $fileContent);
        $fileContent = str_replace("{{content}}", $response, $fileContent);

        // Išvalomi Templeituose likę {{}} tagai
        preg_match_all('/{{(.*?)}}/', $fileContent, $matches);
        foreach ($matches[0] as $key) {
            $fileContent = str_replace($key, '', $fileContent);
        }

        echo $fileContent;
    }
}