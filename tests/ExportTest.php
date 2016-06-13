<?php

include '../vendor/autoload.php';

class ExportTest extends PHPUnit_Framework_TestCase
{
    public function testArray()
    {

        $testArray = include './data.php';
        $string = '<?php return '.\cszchen\export\Export::toArrayCode($testArray) . ';';
        $fileContent = file_get_contents('./data.php');
        $this->assertEquals($fileContent, $string);
    }

    public function testJson()
    {
        $testJson = file_get_contents('../composer.json');
        $array = json_decode($testJson);
        $export = \cszchen\export\Export::toJsonCode($array);
        $this->assertStringEqualsFile('../composer.json', $export);
    }
}
