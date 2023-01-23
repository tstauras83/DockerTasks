<?php

namespace tstauras83;

use Exception;
use tstauras83\FS;

class HtmlRender extends AbstractRender
{
    public function setContent(mixed $content)
    {
        // Iš kontrolerio funkcijos gautą atsakymą talpiname į main.html layout failą
        $fs = new FS('../src/html/layout/main.html');
        $fileContents = $fs->getFileContents();
//        $title = $this->controller::TITLE;
//        $fileContents = str_replace("{{title}}", $title, $fileContents);
        if (is_array($content)) {
            foreach ($content as $key => $item) {
                $fileContents = str_replace("{{{$key}}}", $item, $fileContents);
            }
        } else {
            $fileContents = str_replace("{{content}}", $content, $fileContents);
        }

        // Išvalomi Templeituose likę {{}} tagai
        preg_match_all('/{{(.*?)}}/', $fileContents, $matches);
        foreach ($matches[0] as $key) {
            $fileContents = str_replace($key, '', $fileContents);
        }

        $this->output->store($fileContents);
    }
}