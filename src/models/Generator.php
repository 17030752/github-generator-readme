<?php
namespace d17030752\Github\models;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;

class Generator
{
    private string $title;
    private string $description;
    private string $markdown;
    private array $authors;
    private array $authorLinks;

    private CommonMarkConverter $converter;
    public function __construct(private array $options)
    {
        $this->title = Generator::get($options, 'title');
        $this->description = Generator::get($options, 'description');
        $this->authors=Generator::get($options,'authors');
        $this->authorLinks=Generator::get($options,'author_links');
        $this->converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

    }
    public function generate()
    {
        $this->markdown = '';
        $this->markdown .= $this->createMarkdown('title', $this->title);
        $this->markdown .= $this->createMarkdown('description', $this->description);
        $this->markdown .= $this->createMarkdown('authors', ['authors'=>$this->authors,'links'=>$this->authorLinks]);
    }
    public function createMarkdown($prop, $value)
    {
        if (is_null($value) || $value == '') {
            # code...
            return '';
        }
        switch ($prop) {
            case 'title':
                # code...
                return "# {$value} \n";
            case 'description':
                # code...
                return "{$value} \n";
            case 'authors':
                # code...
                $mk =$this->processAuthors($value);
                return "{$mk} \n";
            default;
                return '';
        }
    }
    public function processAuthors(array $arr)
    {
        $mk = "## Authors \n";
        $authors =$arr['authors'];
        $links =$arr['links'];
        for ($i=0; $i <count($authors); $i++) { 
            # code...
            $author =$authors[$i];
            $link=$links[$i];
            $mk .="-[{$author}]({$link}) \n";
        }return $mk;
    }
    public function getMarkdown()
    {
        return nl2br($this->markdown);
    }
    public function getHTML()
    {
        return $this->converter->convert($this->markdown);
    }
    public static function get($arr, $index)
    {
        if (isset($arr[$index]) && is_array($arr)) {
            # code...
            return $arr[$index];
        } else {
            return null;
        }
    }
    public static function getValue($obj, $getter)
    {
        if (isset($obj)) {
            return $obj->{$getter}();
        } else {
            return '';
        }

    }
    public function getTitle(){
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getAuthors()
    {
        $arr=[];
        $authors =$this->authors;
        $links=$this->authorLinks;
for ($i=0; $i < count($authors) ; $i++) { 
    # code...
    $author=$authors[$i];
    $link=$links[$i];
    $item = ['author'=>$author,'link'=>$link];
    array_push($arr,$item);
} return $arr;
    }
}
